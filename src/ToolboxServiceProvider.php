<?php

namespace Lemaur\Toolbox;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Lemaur\Toolbox\Commands\PublishCommand;

class ToolboxServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('toolbox')
            ->hasCommand(PublishCommand::class);
    }
}
