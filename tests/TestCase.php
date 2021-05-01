<?php

namespace Lemaur\Toolbox\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Lemaur\Toolbox\ToolboxServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Spatie\\Toolbox\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            ToolboxServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        include_once __DIR__.'/../database/migrations/create_toolbox_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
