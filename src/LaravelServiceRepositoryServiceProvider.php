<?php

namespace BarnoxDev\ServiceRepositoryPattern;

use Illuminate\Support\ServiceProvider;
use BarnoxDev\ServiceRepositoryPattern\Console\ServiceMakeCommand;
use BarnoxDev\ServiceRepositoryPattern\Console\RepositoryMakeCommand;

class LaravelServiceRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            ServiceMakeCommand::class,
            RepositoryMakeCommand::class,
        ]);
    }

    public function boot()
    {
        // You can add any boot logic here if needed
    }
}
