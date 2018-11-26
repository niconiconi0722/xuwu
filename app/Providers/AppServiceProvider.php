<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
	{
        \Carbon\Carbon::setLocale('zh');

        \App\Models\Reply::observe(\App\Observers\ReplyObserver::class);
        \App\Models\Chat::observe(\App\Observers\ChatObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
