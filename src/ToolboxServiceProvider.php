<?php

declare(strict_types=1);

namespace Lemaur\Toolbox;

use Lemaur\Toolbox\Commands\PublishCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ToolboxServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('toolbox')
            ->hasCommand(PublishCommand::class);
    }
}
