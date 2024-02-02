<?php

namespace App\Http\Controllers\Webhooks;

use App\Events\WebhookHandled;
use App\Events\WebhookReceived;
use App\Http\Controllers\Controller;
use App\Models\VariationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VtpassWebhookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        event(new WebhookReceived($payload = $request->all()));

        $method = 'handle' . Str::studly(data_get($payload, 'type'));

        if (! method_exists($this, $method)) {
            Log::info('Unhandled vtpass webhook', $payload);
        }

        $this->{$method}($payload);

        event(new WebhookHandled($payload));

        return new Response('Webhook handled successfully');
    }

    protected function handleTransactionUpdate(array $payload)
    {

    }
    
    /**
     * Handle variations-update webhook
     *
     * @param  array $payload
     * @return void
     */
    protected function handleVariationsUpdate(array $payload): void
    {
        $removedVariations = (array) data_get($payload, 'actionRequired.removed.variation_codes');
    
        if (isset($removedVariations) && count($removedVariations)) {
            VariationCode::query()->where('provider', 'vtpass')
                ->whereIn('code', $removedVariations)
                ->delete();
        }
    }
}
