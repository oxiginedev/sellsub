<?php

namespace App\Services\Vtpass\Resources;

use App\Services\Vtpass\Contracts\VtpassClient;

class UtilityResource
{
    public function __construct(
        private VtpassClient $client,
    ) {
    }

    public function airtime(string $phone, int $amount, string $network, string $reference)
    {
        $response = $this->client->request()->post(
            url: '/api/pay',
            data: [
                'request_id' => $reference,
                'serviceID' => $network,
                'amount' => $amount,
                'phone' => $phone,
            ],
        );
    }
}