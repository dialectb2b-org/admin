<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use SendGrid;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\SendGridEmailService', function ($app) {
            return new \App\Services\SendGridEmailService(
                new SendGrid(env('SENDGRID_API_KEY'))
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('key', 'value');
        Schema::defaultStringLength(191);

        // $company=\DB::table('companies')->first();
        // View::share('company',$company); 
    }
}
