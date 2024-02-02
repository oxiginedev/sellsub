<?php

namespace App\Services\Vtpass\Resources;

use App\Services\Vtpass\Contracts\VtpassClient;
use Illuminate\Http\Client\Response;

class AirtimeResource
{
    public function __construct(
        private VtpassClient $client,
    ) {
    }

    public function purchase(string $phone, int $amount, string $network, string $reference): Response
    {
        return $this->client->request()->post(
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