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
        view()->composer(['admin.user.create', 'admin.user.edit'], 'App\Http\ViewComposers\RoleComposer');
        view()->composer(['admin.promotion.create', 'admin.promotion.edit'], 'App\Http\ViewComposers\ProductComposer');
        view()->composer(['admin.code.create', 'admin.code.edit', 'user.module.header'], 'App\Http\ViewComposers\CategoryComposer');
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
