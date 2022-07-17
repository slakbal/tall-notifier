<?php

namespace Slakbal\TallNotifier\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Slakbal\TallNotifier\TallNotifierServiceProvider;
use Livewire\LivewireServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {

        parent::setUp();
        // Factory::guessFactoryNamesUsing(
        //     fn (string $modelName) => 'Slakbal\\TallNotifier\\Database\\Factories\\'.class_basename($modelName).'Factory'
        // );
        // $this->viewsDirectory = __DIR__.'/views';
    }

    protected function getPackageProviders($app)
    {
        return [
            TallNotifierServiceProvider::class,
            LivewireServiceProvider::class
        ];
    }
    // protected function overrideApplicationProviders($app)
    // {
    //     return [
    //         'Livewire' => 'Livewire\Livewire',
    //     ];
    // }
    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        /*
        include_once __DIR__.'/../database/migrations/create_livewire_notifier_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
