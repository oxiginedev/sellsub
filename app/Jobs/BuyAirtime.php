<?php

namespace App\Jobs;

use App\Actions\Airtime\BuyAirtimeAction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class BuyAirtime implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private User $user,
        private string $network,
        private string $phone,
        private int $amount,
        private string $owner
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $lock = Cache::restoreLock('airtime:purchase'.$this->user->id, $this->owner);
    
        $buyer = app(BuyAirtimeAction::class)->create();

        $buyer->buy($this->network, $this->phone, $this->amount);

        $lock->release();
    }
}
