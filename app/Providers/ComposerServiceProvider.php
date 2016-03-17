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
            'Tenderos\Http\ViewComposers\Users\RegisterComposer' => ['auth.register.form', 'dashboard.pages.admin.producers.form', 'dashboard.pages.admin.shopkeepers.form'],
            'Tenderos\Http\ViewComposers\SubregionsComposer' => ['dashboard.pages.shopkeeper', 'dashboard.pages.admin.shopkeepers.lists'],
            'Tenderos\Http\ViewComposers\MonthsComposer' => ['dashboard.pages.shopkeeper', 'dashboard.pages.admin.shopkeepers.lists'],
            'Tenderos\Http\ViewComposers\HomeComposer' => ['dashboard.pages.shopkeeper', 'dashboard.pages.producer'],
            'Tenderos\Http\ViewComposers\ShopkeeperComposer' => ['dashboard.pages.shopkeeper', 'dashboard.pages.admin.shopkeepers.lists'],
            'Tenderos\Http\ViewComposers\ProducerComposer' => ['dashboard.pages.producer', 'dashboard.pages.admin.producers.lists'],
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
