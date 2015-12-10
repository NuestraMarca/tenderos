<?php

namespace Tenderos\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        View::composers([
            'Tenderos\Http\ViewComposers\Users\RegisterComposer' => 'auth.register.form',
            'Tenderos\Http\ViewComposers\SubregionsComposer' => 'dashboard.pages.shopkeeper',
            'Tenderos\Http\ViewComposers\MonthsComposer' => 'dashboard.pages.shopkeeper',
            'Tenderos\Http\ViewComposers\HomeComposer' => ['dashboard.pages.shopkeeper', 'dashboard.pages.producer'],
            'Tenderos\Http\ViewComposers\ShopkeeperComposer' => 'dashboard.pages.shopkeeper',
            'Tenderos\Http\ViewComposers\ProducerComposer' => 'dashboard.pages.producer',
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
