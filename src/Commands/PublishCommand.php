<?php

declare(strict_types=1);

namespace Lemaur\Toolbox\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class PublishCommand extends Command
{
    protected $signature = 'toolbox:install
                            {--F|force}';

    protected $description = '';

    public function handle(Filesystem $filesystem): int
    {
        // Install Pest
        $this->call('pest:install', ['--quiet']);

        // Install Dusk
        $this->call('dusk:install', ['--quiet']);

        $this->copyFiles($filesystem, [

            // 'static-analysis'
            __DIR__.'/../Commands/stubs/phpstan.neon.stub' => base_path('phpstan.neon'),
            __DIR__.'/../Commands/stubs/tests/Analysis/AnalysisTest.php.stub' => base_path('tests/Analysis/AnalysisTest.php'),

            // 'code-style'
            __DIR__ . '/../Commands/stubs/.php-cs-fixer.stub' => base_path('.php-cs-fixer'),

            // 'rector'
            __DIR__.'/../Commands/stubs/rector.php.stub' => base_path('rector.php'),

            // 'tests'
            __DIR__.'/../Commands/stubs/phpunit.xml.stub' => base_path('phpunit.xml'),
            __DIR__.'/../Commands/stubs/tests/Pest.php.stub' => base_path('tests/Pest.php'),

            // 'commons'
            __DIR__.'/../Commands/stubs/.editorconfig.stub' => base_path('.editorconfig'),
            __DIR__.'/../Commands/stubs/.gitignore.stub' => base_path('.gitignore'),
            __DIR__.'/../Commands/stubs/.env.dusk' => base_path('.env.dusk'),

        ]);

        return 0;
    }

    private function copyFiles(Filesystem $filesystem, array $files): void
    {
        collect($files)->each(function ($published, $original) use ($filesystem) {
            if (! $this->option('force') && $filesystem->exists($published)) {
                $this->error("The file [$published] already exists.");
            }

            $path = Str::beforeLast($published, '/');
            $filesystem->ensureDirectoryExists($path);
            $filesystem->copy($original, $published);
        });

        $this->info("Successfully published all files!");
    }
}
