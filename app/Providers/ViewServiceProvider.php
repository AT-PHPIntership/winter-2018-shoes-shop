<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['admin.code.create', 'admin.code.edit'], 'App\Http\ViewComposers\CategoryComposer');
        view()->composer(['admin.user.create', 'admin.user.edit'], 'App\Http\ViewComposers\RoleComposer');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
