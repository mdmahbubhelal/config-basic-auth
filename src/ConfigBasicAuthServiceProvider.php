<?php

namespace MdMahbubHelal\ConfigBasicAuth;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use MdMahbubHelal\ConfigBasicAuth\Http\Middleware\ConfigBasicAuth;

class ConfigBasicAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'basicauth');
    }

    /**
     * @param \Illuminate\Foundation\Http\Kernel $kernel
     */
    public function boot(Kernel $kernel)
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('basicauth.php'),
            ], 'config');
        }

        $enabled = config('basicauth.enabled');

        if ($enabled) {
            $kernel->pushMiddleware(ConfigBasicAuth::class);
        }
    }
}
