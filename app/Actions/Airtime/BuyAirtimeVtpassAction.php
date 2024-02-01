<?php

namespace App\Actions\Airtime;

use App\Services\Vtpass\Contracts\VtpassClient as VtpassClientContract;

class BuyAirtimeVtpassAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected VtpassClientContract $vtpass
    ) {
        //
    }
    
    /**
     * Buy airtime
     *
     * @param  string $phone
     * @param  int    $amount
     * @param  string $network
     * 
     * @return void
     */
    public function buy(string $phone, int $amount, string $network, ?string $reference = null)
    {
        
    }
}
