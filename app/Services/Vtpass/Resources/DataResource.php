<?php

namespace App\Services\Vtpass\Resources;

use App\Services\Vtpass\Contracts\VtpassClient;
use Illuminate\Http\Client\Response;

class DataResource
{
    public function __construct(
        private VtpassClient $client,
    ) {
    }

    public function purchase(string $code, string $phone, string $service, string $reference): Response
    {
        return $this->client->request()->post(
            url: '/api/pay',
            data: [
                'request_id' => $reference,
                'serviceID' => $service,
                'variation_code' => $code,
                'phone' => $phone
            ],
        );
    }

    public function getVariationCodes(string $service): array
    {
        $response = $this->client->request()->get(
            url: '/api/service-variations',
            query: [
                'serviceID' => $service
            ],
        );

        return $response->collect('content.variations')->toArray();
    }
}