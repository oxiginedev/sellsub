<?php

namespace App\Services\Vtpass\Contracts;

use App\Services\Vtpass\Resources\AirtimeResource;
use App\Services\Vtpass\Resources\DataResource;
use Illuminate\Http\Client\PendingRequest;

interface VtpassClient
{
    public function request(): PendingRequest;

    public function airtimes(): AirtimeResource;

    public function datas(): DataResource;
}
