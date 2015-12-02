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
            'Tenderos\Http\ViewComposers\MenuComposer' => ['auth.login',
                                                                            'dashboard.pages.*', ],
            'Tenderos\Http\ViewComposers\Companies\ListComposer' => 'dashboard.pages.companies.list',
            'Tenderos\Http\ViewComposers\Areas\ListComposer' => 'dashboard.pages.companies.users.areas.list',
            'Tenderos\Http\ViewComposers\Roles\ListComposer' => 'dashboard.pages.companies.users.roles.list',
            'Tenderos\Http\ViewComposers\Categories\ListComposer' => 'dashboard.pages.companies.users.categories.list',
            'Tenderos\Http\ViewComposers\Protocols\ListComposer' => 'dashboard.pages.companies.users.protocols.list',
            'Tenderos\Http\ViewComposers\Protocols\FormComposer' => 'dashboard.pages.companies.users.protocols.form',
            'Tenderos\Http\ViewComposers\Users\ListComposer' => 'dashboard.pages.companies.users.admin.list',
            'Tenderos\Http\ViewComposers\Users\FormComposer' => 'dashboard.pages.companies.users.admin.form',
            'Tenderos\Http\ViewComposers\Formats\ListComposer' => 'dashboard.pages.companies.users.formats.list',
            'Tenderos\Http\ViewComposers\Formats\FormComposer' => 'dashboard.pages.companies.users.formats.form',
            'Tenderos\Http\ViewComposers\Formats\MyFormatsComposer' => 'dashboard.pages.companies.users.formats.myformats',
            'Tenderos\Http\ViewComposers\Protocols\Generator\ListComposer' => 'dashboard.pages.companies.users.protocols.generator.config',
            'Tenderos\Http\ViewComposers\GeneratedProtocols\ListComposer' => 'dashboard.pages.companies.users.protocols.generator.list',
            'Tenderos\Http\ViewComposers\GeneratedProtocols\FormComposer' => 'dashboard.pages.companies.users.protocols.generator.form'


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
