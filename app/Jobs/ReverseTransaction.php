<?php

namespace App\Jobs;

use App\Actions\Support\GenerateReferenceAction;
use App\Actions\Wallet\CreditWalletAction;
use App\Enums\TransactionStatus;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ReverseTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Transaction $transaction
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // create a counter transaction to reverse given transaction
        // only reverse pending transactions

        if ($this->transaction->status === TransactionStatus::PENDING) {
            DB::transaction(function () {
                CreditWalletAction::credit($this->transaction->user_id, $this->transaction->amount);

                $this->transaction->update([
                    'status' => TransactionStatus::FAILED, 
                ]);
    
                Transaction::query()->create([
                    'reference' => app(GenerateReferenceAction::class)->execute(),
                    'api_reference' => $this->transaction->reference,
                    'description' => 'Reversal of '.$this->transaction->amount.' for '.$this->transaction->description,
                    'amount' => $this->transaction->amount,
                    'requested_amount' => $this->transaction->amount, 
                    'status' => TransactionStatus::SUCCESS,
                ]);
            });
        }
    }
}
