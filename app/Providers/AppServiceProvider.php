<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// [2017-03-10] Fix SQL error when migrating tables #17508
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
        // [2017-03-10] Fix SQL error when migrating tables #17508
        Schema::defaultStringLength(191);
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
