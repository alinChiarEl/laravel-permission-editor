<?php

namespace Laraveldaily\LaravelPermissionEditor;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use Illuminate\Routing\Router;
use Laraveldaily\LaravelPermissionEditor\Http\Middleware\SpatiePermissionMiddleware;
use Laraveldaily\LaravelPermissionEditor\Commands\CreateTask;
use Laraveldaily\LaravelPermissionEditor\Commands\DeleteTaskById;

class PermissionEditorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {


        Route::prefix('permission-editor')
            ->as('permission-editor.')
            ->middleware(['web', 'spatie-permission']) // <- THIS
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/assets' => public_path('permission-editor'),
            ], 'permission-editor-assets');

            // In addition to publishing assets, we also publish the config
            $this->publishes([
                __DIR__ . '/../config/permission-editor.php' => config_path('permission-editor.php'),
            ], 'permission-editor-config');

            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

            $this->commands([
                CreateTask::class,
                DeleteTaskById::class
            ]);
        }




        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'permission-editor');
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('spatie-permission', SpatiePermissionMiddleware::class);
    }
}
