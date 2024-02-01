<?php

namespace App\Http\Controllers\Webhooks;

use App\Events\WebhookReceived;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VtpassWebhookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $payload = $request->all();

        WebhookReceived::dispatch($payload);

        return new Response;
    }
}
