<?php

use App\Http\Controllers\Webhooks\VtpassWebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('webhooks')->as('webhooks.')->group(function () {
    Route::post('vtpass', VtpassWebhookController::class)->name('vtpass');
});
