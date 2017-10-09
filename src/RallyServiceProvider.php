<?php

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
        $migrationsSource = realpath(__DIR__.'/../database/migrations/create_followers_table.php');
        $migrationsTarget = database_path("/migrations/{$timestamp}_create_followers_table.php");
        $this->publishes([
            $migrationsSource => $migrationsTarget,
        ], 'migrations');
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
    }
}
