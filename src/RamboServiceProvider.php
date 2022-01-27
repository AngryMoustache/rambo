<?php

namespace AngryMoustache\Rambo;

use AngryMoustache\Rambo\Facades\Rambo as FacadeRambo;
use AngryMoustache\Rambo\Http\Livewire\Actions\ActionComponent;
use AngryMoustache\Rambo\Http\Livewire\Actions\DeleteActionComponent;
use AngryMoustache\Rambo\Http\Livewire\Auth\Login;
use AngryMoustache\Rambo\Http\Livewire\Crud\Fields\FieldRender;
use AngryMoustache\Rambo\Http\Livewire\Crud\Fields\FieldShowRender;
use AngryMoustache\Rambo\Http\Livewire\Crud\ResourceIndex;
use AngryMoustache\Rambo\Http\Livewire\Crud\ResourceShow;
use AngryMoustache\Rambo\Http\Livewire\Dashboard;
use AngryMoustache\Rambo\Rambo;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class RamboServiceProvider extends ServiceProvider
{
    public $singletons = [
        Rambo::class => Rambo::class
    ];

    public function boot()
    {
        $this->config();
        $this->views();
        $this->routes();
        $this->migrations();
        $this->publishing();
        $this->livewire();

        Route::bind('resource', function ($value, $route) {
            return FacadeRambo::resource($value, $route->parameter('itemId'))
                ?? abort(404);
        });
    }

    public function register()
    {
        $this->app->booting(function() {
            $loader = AliasLoader::getInstance();
            $loader->alias('Rambo', FacadeRambo::class);
        });

        $this->app->alias(Rambo::class, 'rambo');
    }

    private function livewire()
    {
        /** AUTH */
        Livewire::component('rambo-auth-login', Login::class);
        Livewire::component('rambo-dashboard', Dashboard::class);

        /** CRUD */
        Livewire::component('rambo-resource-index', ResourceIndex::class);
        Livewire::component('rambo-resource-show', ResourceShow::class);

        /** FIELDS */
        Livewire::component('rambo-field-render', FieldRender::class);
        Livewire::component('rambo-field-show-render', FieldShowRender::class);

        /** ACTIONS */
        Livewire::component('rambo-action', ActionComponent::class);
        Livewire::component('rambo-action-delete', DeleteActionComponent::class);
    }

    private function config()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/rambo.php', 'rambo');
    }

    private function views()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'rambo');
    }

    private function routes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    private function migrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    private function publishing()
    {
        $this->publishes([
            __DIR__ . '/../config/rambo.php' => config_path('rambo.php'),
        ], 'rambo-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/rambo'),
        ], 'rambo-views');

        $this->publishes([
            __DIR__ . '/../public/css' => public_path('vendor/rambo/css'),
            __DIR__ . '/../public/js' => public_path('vendor/rambo/js'),
            __DIR__ . '/../public/images' => public_path('vendor/rambo/images'),
        ], 'rambo-required-assets');
    }
}
