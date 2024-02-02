<?php

namespace App\Livewire\User;

use App\Livewire\Forms\User\Forms\BuyAirtimeForm;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class BuyAirtime extends Component
{
    public BuyAirtimeForm $form;

    public function buyAirtime()
    {
        $lock = Cache::lock('airtime:purchase'.auth()->id(), 10);

        if (! $lock->get()) {
            
        }

        $this->form->handle($lock->owner());
    }

    public function render(): View
    {
        return view('livewire.user.buy-airtime');
    }
}
