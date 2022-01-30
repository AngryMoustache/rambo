<?php

namespace AngryMoustache\Rambo;

use AngryMoustache\Rambo\Facades\Rambo as FacadeRambo;
use AngryMoustache\Rambo\Facades\RamboBreadcrumbs as FacadeRamboBreadcrumbs;
use AngryMoustache\Rambo\Http\Livewire\Actions\ActionComponent;
use AngryMoustache\Rambo\Http\Livewire\Actions\DeleteActionComponent;
use AngryMoustache\Rambo\Http\Livewire\Auth\Login;
use AngryMoustache\Rambo\Http\Livewire\Fields\FormField;
use AngryMoustache\Rambo\Http\Livewire\Fields\ShowField;
use AngryMoustache\Rambo\Http\Livewire\Crud\ResourceCreate;
use AngryMoustache\Rambo\Http\Livewire\Crud\ResourceEdit;
use AngryMoustache\Rambo\Http\Livewire\Crud\ResourceIndex;
use AngryMoustache\Rambo\Http\Livewire\Crud\ResourceShow;
use AngryMoustache\Rambo\Http\Livewire\Dashboard;
use AngryMoustache\Rambo\Http\Livewire\Fields\Show\ShowBooleanField;
use AngryMoustache\Rambo\Http\Livewire\Pickers\AttachmentPicker;
use AngryMoustache\Rambo\Http\Livewire\Pickers\HabtmPicker;
use AngryMoustache\Rambo\Rambo;
use AngryMoustache\Rambo\RamboBreadcrumbs;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\DB;
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
    }

    public function register()
    {
        DB::disableQueryLog();

        $this->app->booting(function() {
            $loader = AliasLoader::getInstance();
            $loader->alias('Rambo', FacadeRambo::class);
        });

        $this->app->alias(Rambo::class, 'rambo');

        $this->app->booting(function() {
            $loader = AliasLoader::getInstance();
            $loader->alias('RamboBreadcrumbs', FacadeRamboBreadcrumbs::class);
        });

        $this->app->alias(RamboBreadcrumbs::class, 'rambo-breadcrumbs');
    }

    private function livewire()
    {
        /** AUTH */
        Livewire::component('rambo-auth-login', Login::class);
        Livewire::component('rambo-dashboard', Dashboard::class);

        /** CRUD */
        Livewire::component('rambo-resource-index', ResourceIndex::class);
        Livewire::component('rambo-resource-create', ResourceCreate::class);
        Livewire::component('rambo-resource-show', ResourceShow::class);
        Livewire::component('rambo-resource-edit', ResourceEdit::class);

        /** FIELDS (FORM) */
        Livewire::component('rambo-field-form-field', FormField::class);

        /** FIELDS (SHOW) */
        Livewire::component('rambo-field-show-field', ShowField::class);
        Livewire::component('rambo-field-show-boolean-field', ShowBooleanField::class);

        /** ACTIONS */
        Livewire::component('rambo-action', ActionComponent::class);
        Livewire::component('rambo-action-delete', DeleteActionComponent::class);

        /** PICKERS */
        Livewire::component('rambo-attachment-picker', AttachmentPicker::class);
        Livewire::component('rambo-habtm-picker', HabtmPicker::class);
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
