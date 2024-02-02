<?php

namespace App\Contracts;

interface BuyAirtimeContract
{
    public function buy(string $phone, int $amount, string $network, ?string $reference = null): void;
}
