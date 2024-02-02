<?php

namespace App\Livewire\Forms\User\Forms;

use App\Actions\Airtime\BuyAirtimeAction;
use App\Jobs\BuyAirtime;
use App\Rules\SufficientBalance;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BuyAirtimeForm extends Form
{
    #[Validate('required|string')]
    public $network;

    #[Validate('required|string|digits:11')]
    public $phone;

    #[Validate('required|integer|min:50|'.SufficientBalance::class)]
    public $amount;

    public function handle(string $owner): void
    {
        $this->validate();

        dispatch(new BuyAirtime());

        $this->reset();
    }
}
