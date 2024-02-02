<?php

namespace App\Actions\Airtime;

use App\Contracts\BuyAirtimeContract;
use App\Services\Vtpass\Contracts\VtpassClient;

class BuyAirtimeAction
{
    public function __construct(
        private VtpassClient $vtpassClient
    ) {
    }

    public function create(string $provider): BuyAirtimeContract
    {
        return match ($provider) {
            'vtpass' => $this->buyAirtimeWithVtpass()
        };
    }

    private function buyAirtimeWithVtpass(): BuyAirtimeVtpassAction
    {
        $client = app(VtpassClient::class);

        return new BuyAirtimeVtpassAction($client);
    }
}
