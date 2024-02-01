<?php

namespace App\Services\Vtpass\Contracts;

use Illuminate\Http\Client\PendingRequest;

interface VtpassClient
{
    public function request(): PendingRequest;
}
