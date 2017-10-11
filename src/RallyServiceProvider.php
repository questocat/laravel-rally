<?php

/*
 * This file is part of laravel-rally package.
 *
 * (c) emanci <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Emanci\Rally;

use Illuminate\Support\ServiceProvider;

class RallyServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->setupConfig();
        $this->setupMigrations();
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
    }

    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/rally.php');
        $this->publishes([
            $source => config_path('rally.php'),
        ], 'config');

        $this->mergeConfigFrom($source, 'rally');
    }

    /**
     * Setup the migrations.
     */
    protected function setupMigrations()
    {
        $timestamp = date('Y_m_d_His');
        $migrationsSource = realpath(__DIR__.'/../database/migrations/create_followables_table.php');
        $migrationsTarget = database_path("/migrations/{$timestamp}_create_followables_table.php");
        $this->publishes([
            $migrationsSource => $migrationsTarget,
        ], 'migrations');
    }
}
