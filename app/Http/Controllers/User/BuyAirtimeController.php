<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Utilities\BuyAirtimeRequest;
use App\Jobs\BuyAirtime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class BuyAirtimeController extends Controller
{
    public function store(BuyAirtimeRequest $request): RedirectResponse
    {
        $lock = Cache::lock(auth()->id().':airtime:buy', 10);

        if (! $lock->get()) {
            return back()->with('status', [
                'type' => 'error',
                'message' => 'Duplicate transaction. Please try again'
            ]);
        }

        dispatch(new BuyAirtime($request->user(), $lock->owner()));

        return back()->with('status', [
            'type' => 'success',
            'message' => 'Airtime purchase in progress'
        ]);
    }
}
