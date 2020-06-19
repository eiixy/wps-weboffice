<?php

namespace Eiixy\WebOffice\Providers;

use Illuminate\Support\ServiceProvider;


class WebOfficeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 发布配置文件
        $config_path = realpath(__DIR__ . '/../../config/weboffice.php.php');
        $this->publishes([
            $config_path => database_path('config/weboffice.php'),
        ], 'weboffice');

        // 加载数据库迁移文件
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // 加载路由
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
    }


    protected function loadMigrationsFrom($paths)
    {
        $this->app->afterResolving('migrator', function ($migrator) use ($paths) {
            foreach ((array) $paths as $path) {
                $migrator->path($path);
            }
        });
    }
}
