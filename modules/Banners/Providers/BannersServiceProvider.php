<?php

namespace Modules\Banners\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Banners\Contracts\Repositories\IBannerItemRepository;
use Modules\Banners\Contracts\Repositories\IBannerRepository;
use Modules\Banners\Models\Banner;
use Modules\Banners\Models\BannerItem;
use Modules\Banners\Observers\BannerItemObserver;
use Modules\Banners\Observers\BannerObserver;
use Modules\Banners\Repositories\BannerItemRepository;
use Modules\Banners\Repositories\BannerRepository;

class BannersServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $moduleName = 'Banners';

    /**
     * @var string
     */
    protected $moduleNameLower = 'banners';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerObservers();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->registerRepositories();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower.'.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/'.$this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath,
        ], ['views', $this->moduleNameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/'.$this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'Resources/lang'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path.'/modules/'.$this->moduleNameLower)) {
                $paths[] = $path.'/modules/'.$this->moduleNameLower;
            }
        }

        return $paths;
    }

    private function registerRepositories(): void
    {
        $this->app->bind(IBannerRepository::class, function ($app) {
            return new BannerRepository(new Banner());
        });
        $this->app->bind(IBannerItemRepository::class, BannerItemRepository::class);
    }

    private function registerObservers(): void
    {
        Banner::observe(BannerObserver::class);
        BannerItem::observe(BannerItemObserver::class);
    }
}
