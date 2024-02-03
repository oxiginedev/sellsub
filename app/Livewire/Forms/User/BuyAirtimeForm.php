<?php

namespace App\Livewire\Forms\User;

use App\Actions\Airtime\BuyAirtimeAction;
use App\Jobs\BuyAirtime;
use App\Models\User;
use App\Rules\SufficientBalance;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BuyAirtimeForm extends Form
{
    #[Validate('required|string')]
    public $network = '';

    #[Validate('required|string|digits:11')]
    public $phone = '';

    #[Validate('required|integer|min:50')]
    public $amount;

    public function handle(string $owner): void
    {
        $this->validate();

        $user = User::query()->where('id', auth()->id())->first();

        dispatch(new BuyAirtime($user, $this->network, $this->phone, $this->amount, $owner));
        
        $this->reset();
    }
}
