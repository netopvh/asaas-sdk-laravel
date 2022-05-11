<?php

declare(strict_types=1);

namespace CreativeMobile\Asaas;

use CreativeMobile\Asaas\Console\InstallAsaasPackage;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class AsaasServiceProvider extends ServiceProvider
{
  /**
   * Boot the service provider.
   *
   * @return void
   */
  public function boot()
  {
    $src = realpath($raw = __DIR__ . '/../config/asaas.php') ?: $raw;

    if ($this->app->runningInConsole()) {
      $this->publishes([
        $src => config_path('asaas.php')
      ], 'config');

      $this->commands([
        InstallAsaasPackage::class,
      ]);
    }

    $this->mergeConfigFrom($src, 'asaas');
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $this->app->singleton('creativemobile.asaas', function (Container $app) {
      return new Asaas($app['config']['asaas'] ?? []);
    });

    $this->app->alias('creativemobile.asaas', Asaas::class);
  }

  /**
   * Get the services provided by the provider.
   *
   * @return string[]
   */
  public function provides()
  {
    return [
      'creativemobile.asaas',
    ];
  }
}
