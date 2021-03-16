<?php

declare(strict_types=1);

namespace Codeat3\BladeUnicons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

final class BladeUniconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->callAfterResolving(Factory::class, function (Factory $factory) {
            $factory->add('unicons', [
                'path' => __DIR__.'/../resources/svg',
                'prefix' => 'uni',
            ]);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-uni'),
            ], 'blade-uni');
        }
    }
}
