<?php

namespace App\Actions\Wallet;

use App\Events\WalletDebited;
use App\Models\Wallet;

class DebitWalletAction
{
    public static function debit(int $id, int $amount): void
    {
        $wallet = Wallet::query()->where('user_id', $id)->lockForUpdate()->first();

        $wallet->decrement('available_balance', $amount);

        WalletDebited::dispatch();
    }
}
