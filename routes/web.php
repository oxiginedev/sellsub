<?php

use App\Http\Controllers\Webhooks\VtpassWebhookController;
use App\Livewire\User\BuyAirtime;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/buy-airtime', BuyAirtime::class)->name('buy-airtime');

Route::prefix('webhooks')->as('webhooks.')->group(function () {
    Route::post('vtpass', VtpassWebhookController::class)->name('vtpass');
});
