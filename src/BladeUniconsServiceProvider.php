<?php

declare(strict_types=1);

namespace Codeat3\BladeUnicons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladeUniconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-unicons', []);

            $factory->add('unicons', array_merge(['path' => __DIR__ . '/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blade-unicons.php', 'blade-unicons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/svg' => public_path('vendor/blade-unicons'),
            ], 'blade-uni'); // TODO: update this alias to `blade-unicons` in next major release

            $this->publishes([
                __DIR__ . '/../config/blade-unicons.php' => $this->app->configPath('blade-unicons.php'),
            ], 'blade-unicons-config');
        }
    }
}
