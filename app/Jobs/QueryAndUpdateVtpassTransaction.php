<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Services\Vtpass\Contracts\VtpassClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QueryAndUpdateVtpassTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Transaction $transaction
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = app(VtpassClient::class);

        $transaction = $client->transactions()->fetch($this->transaction->api_reference);
    }
}
