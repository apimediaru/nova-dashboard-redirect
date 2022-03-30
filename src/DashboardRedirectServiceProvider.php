<?php

namespace APIMedia\DashboardRedirect;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Tool\DashboardRedirect\Http\Middleware\Authorize;

class DashboardRedirectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-dashboard-redirect', __DIR__.'/../dist/js/tool.js');
            Nova::provideToScript([
                'NovaDashboardRedirect' => [
                    'redirect' => $this->getRedirectConfiguration(),
                ],
            ]);
        });

        $this->publishes([
            __DIR__.'/../config/nova-dashboard-redirect.php' => config_path('nova-dashboard-redirect.php')
        ], 'nova-dashboard-redirect');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/nova-dashboard-redirect.php', 'nova-dashboard-redirect'
        );
    }

    public function getRedirectConfiguration()
    {
        $redirect = config('nova-dashboard-redirect.redirect', false);

        if (!empty($redirect) && is_callable($redirect)) {
            $redirect = $redirect();
        }

        return $redirect;
    }
}
