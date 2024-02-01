<?php

namespace App\Providers;

use App\Services\Vtpass\Contracts\VtpassClient as VtpassClientContract;
use App\Services\Vtpass\VtpassClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindServices();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Model::preventLazyLoading(! app()->isProduction());
    }

    protected function bindServices(): void
    {
        $this->app->singleton(VtpassClientContract::class, VtpassClient::class);
    }
}
