<?php

namespace Modules\Common\Providers;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ThemeServiceProvider extends ServiceProvider
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
        $theme_folder = env('THEME', 'default');
        $theme_namespace = "Theme\\" . str_replace('_', '', ucwords($theme_folder, '_')) . "\\";

        $theme_config = file_exists(base_path('themes/' . $theme_folder . '/config/config.php'));
        if ($theme_config) {
            $this->mergeConfigFrom(base_path('themes/' . $theme_folder . '/config/config.php'), $theme_folder);
        }

        $this->mapApiRoutes($theme_namespace);

        $this->mapWebRoutes($theme_namespace);

        $loader = new ClassLoader();
        $loader->setPsr4($theme_namespace, base_path('themes/' . $theme_folder . '/src'));
        $loader->register(true);

        $this->loadViewsFrom(base_path('themes/' . $theme_folder . '/resources/views'), 'theme/' . $theme_folder);
    }

    protected function mapApiRoutes($themeNamespace)
    {
        $theme_folder = env('THEME', 'default');
        $theme_api_route_path = base_path('themes/' . $theme_folder . '/routes/api.php');
        $theme_api_route = file_exists($theme_api_route_path);

        if ($theme_api_route) {
            Route::prefix('api')
            ->middleware(['api', 'cors'])    
            ->namespace($themeNamespace)
            ->group($theme_api_route_path);
        }
    }

    protected function mapWebRoutes($themeNamespace)
    {
        $theme_folder = env('THEME', 'default');
        $theme_web_route_path = base_path('themes/' . $theme_folder . '/routes/web.php');
        $theme_web_route = file_exists($theme_web_route_path);
        if ($theme_web_route) {
            Route::middleware('web')    
            ->namespace($themeNamespace)
            ->group($theme_web_route_path);
        }
    }
}
