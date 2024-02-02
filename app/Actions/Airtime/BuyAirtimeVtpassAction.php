<?php

namespace App\Actions\Airtime;

use App\Actions\Support\GenerateReferenceAction;
use App\Actions\Support\GenerateVtpassReferenceAction;
use App\Actions\Wallet\DebitWalletAction;
use App\Contracts\BuyAirtimeContract;
use App\Enums\TransactionStatus;
use App\Exceptions\VtpassException;
use App\Jobs\QueryAndUpdateVtpassTransaction;
use App\Jobs\ReverseTransaction;
use App\Models\Transaction;
use App\Services\Vtpass\Contracts\VtpassClient;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BuyAirtimeVtpassAction implements BuyAirtimeContract
{

    /**
     * Create a new class instance.
     */
    public function __construct(
        protected VtpassClient $client
    ) {
        //
    }
    
    /**
     * Buy airtime
     *
     * @param  string $phone
     * @param  int    $amount
     * @param  string $network
     * 
     * @return void
     */
    public function buy(string $phone, int $amount, string $network, ?string $reference = null): void
    {
        $reference = app(GenerateVtpassReferenceAction::class)->execute();

        $transaction = DB::transaction(function () use ($reference, $phone, $amount, $network) {
            // debit first, entertain stories later
            DebitWalletAction::debit(auth()->id(), $amount);

            return Transaction::query()->create([
                'reference' => app(GenerateReferenceAction::class)->execute(),
                'api_reference' => $reference,
                'description' => 'Airtime purchase',
                'channel' => 'wallet',
                'balance_before' => auth()->user()->wallet->available_balance,
                'amount' => $amount,
                'requested_amount' => $amount,
                'fees' => 0,
                'status' => TransactionStatus::PENDING,
                'metadata' => [
                    'product' => 'Airtime',
                    'phone_number' => $phone,
                    'network' => $network
                ],
                'paid_at' => Carbon::now()
            ]);
        });

        try {
            $response = $this->client->airtimes()
                ->purchase($phone, $amount, $network, $reference)
                ->collect()
                ->toArray();
        
            // 000 - TRANSACTION PROCESSED
            // 099 - TRANSACTION IS PROCESSING
            if (in_array($response['code'], ['000', '099'])) {
                if (Str::lower(data_get($response, 'content.transactions.status')) === 'delivered') {
                    $transaction->update([
                        'status' => TransactionStatus::SUCCESS,
                        'balance_after' => auth()->user()->wallet->available_balance,
                    ]);
                }

                // handle pending transactions
                dispatch(new QueryAndUpdateVtpassTransaction($transaction));
            }

            // transaction has failed here, hence initiate a reversal
            throw new VtpassException($response['response_description']);
        } catch (Exception $exception) {
            Log::error('Vtpass airtime purchase failed', ['reason' => $exception->getMessage()]);

            // transaction will be reversed
            dispatch(new ReverseTransaction($transaction));
        }
    }
}
