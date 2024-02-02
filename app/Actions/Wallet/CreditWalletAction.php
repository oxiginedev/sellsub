<?php

namespace App\Actions\Wallet;

use App\Models\Wallet;

class CreditWalletAction
{
    public static function credit(int $id, int $amount): void
    {
        $wallet = Wallet::query()->where('user_id', $id)->lockForUpdate()->first();

        $wallet->increment('available_balance', $amount);
    }
}
