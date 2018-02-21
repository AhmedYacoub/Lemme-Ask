<?php

namespace App\Providers;

use View;
use App\Channel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);           // avoid MariaDB bug with Laravel migration

        View::share('channels', Channel::all());    // Make $channels global through all views.

        // get top 10 channels that has most discussions
        // for more details check this link: https://stackoverflow.com/a/43491725/9328663
        View::share('top_channels', Channel::withCount('discussions')
                                        ->orderBy('discussions_count', 'desc')
                                        ->take(10)->get());
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
