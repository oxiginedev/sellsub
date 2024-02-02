<?php

namespace App\Services\Vtpass;

use App\Services\Vtpass\Contracts\VtpassClient as VtpassClientContract;
use App\Services\Vtpass\Resources\AirtimeResource;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class VtpassClient implements VtpassClientContract
{
    public function airtimes(): AirtimeResource
    {
        return new AirtimeResource(
            client: $this
        );
    }

    public function request(): PendingRequest
    {
        return Http::baseUrl(strval(config('services.vtpass.url')))
            ->withBasicAuth(
                username: strval(config('services.vtpass.username')),
                password: strval(config('services.vtpass.password'))
            )
            ->asJson()
            ->acceptJson();
    }
}
