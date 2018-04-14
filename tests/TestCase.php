<?php

/*
 * This file is part of questocat/laravel-rally package.
 *
 * (c) emanci <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Stubs\User;

class TestCase extends BaseTestCase
{
    /**
     * Setup DB before each test.
     */
    public function setUp()
    {
        parent::setUp();

        $this->app['config']->set('database.default', 'sqlite');
        $this->app['config']->set('database.connections.sqlite.database', ':memory:');

        if (empty($this->config)) {
            $this->config = require __DIR__.'/../config/rally.php';
        }

        $this->app['config']->set('rally', $this->config);
        $this->app['config']->set('rally.follower_model', User::class);

        $this->migrate();
        $this->seedDatabase();
    }

    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    /**
     * run package database migrations.
     */
    public function migrate()
    {
        $fileSystem = new Filesystem();
        foreach ($fileSystem->files(__DIR__.'/../tests/database/migrations') as $file) {
            $fileSystem->requireOnce($file);
        }

        (new \CreateUsersTable())->up();
        (new \CreateFollowablesTable())->up();
    }

    /**
     * Seed testing database.
     */
    public function seedDatabase()
    {
        User::create([
            'name' => 'Emanci',
            'email' => 'Emanci@qq.com',
            'password' => bcrypt('secret'),
        ]);
        User::create([
            'name' => 'Phil',
            'email' => 'Phil@qq.com',
            'password' => bcrypt('secret'),
        ]);
        User::create([
            'name' => 'Zhengchaopu',
            'email' => 'Zhengchaopu@qq.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
