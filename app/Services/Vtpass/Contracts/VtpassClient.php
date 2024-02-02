<?php

namespace App\Services\Vtpass\Contracts;

use App\Services\Vtpass\Resources\AirtimeResource;
use Illuminate\Http\Client\PendingRequest;

interface VtpassClient
{
    public function request(): PendingRequest;

    public function airtimes(): AirtimeResource;
}
