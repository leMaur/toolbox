<?php

declare(strict_types=1);

namespace Lemaur\Toolbox\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class PublishCommand extends Command
{
    protected $signature = 'toolbox:install
                            {--only=* : Specify which group of files do you want to copy. Possible values are: `static-analysis`, `code-style`, `rector`, `common`, `tests`}
                            {--T|test-suites : Specify which test suite do you want to install}
                            {--F|force : Specify if you want to overwrite you existing files}';

    protected $description = 'Install Toolbox\'s files and tests resources';

    private function files(?string $key = null): array
    {
        $files = [
            'static-analysis' => [
                __DIR__.'/../Commands/stubs/tests/Analysis/AnalysisTest.php.stub' => base_path('tests/Analysis/AnalysisTest.php'),
                __DIR__.'/../Commands/stubs/phpstan.neon.stub' => base_path('phpstan.neon'),
            ],

            'code-style' => [
                __DIR__.'/../Commands/stubs/.php-cs-fixer.php.stub' => base_path('.php-cs-fixer.php'),
            ],

            'rector' => [
                __DIR__.'/../Commands/stubs/rector.php.stub' => base_path('rector.php'),
            ],

            'tests' => [
                __DIR__.'/../Commands/stubs/tests/Pest.php.stub' => base_path('tests/Pest.php'),
                __DIR__.'/../Commands/stubs/phpunit.xml.stub' => base_path('phpunit.xml'),
                __DIR__.'/../Commands/stubs/.env.dusk' => base_path('.env.dusk'),
            ],

            'common' => [
                __DIR__.'/../Commands/stubs/.editorconfig.stub' => base_path('.editorconfig'),
                __DIR__.'/../Commands/stubs/.gitignore.stub' => base_path('.gitignore'),
            ],
        ];

        if (is_null($key)) {
            return $files;
        }

        return (array_key_exists($key, $files)) ? $files[$key] : [];
    }

    public function handle(Filesystem $filesystem): int
    {
        if ($this->option('test-suites')) {
            $this->call('pest:install', ['--quiet']);
            $this->call('dusk:install', ['--quiet']);
            $this->info("Successfully installed [pest, dusk] test suite!");
        }

        if ($this->option('only')) {
            $this->copy($filesystem, $this->option('only'));

            return 0;
        }

        $this->copy($filesystem, array_keys($this->files()));

        return 0;
    }

    private function copy(Filesystem $filesystem, array $keys): void
    {
        foreach ($keys as $key) {
            $this->copyFiles($filesystem, $this->files($key), $key);
        }
    }

    private function copyFiles(Filesystem $filesystem, array $files, string $group): void
    {
        collect($files)->each(function ($published, $original) use ($filesystem) {
            if (! $this->option('force') && $filesystem->exists($published)) {
                $this->error("The file [$published] already exists.");
            }

            $path = Str::beforeLast($published, '/');
            $filesystem->ensureDirectoryExists($path);
            $filesystem->copy($original, $published);
        });

        $this->info("Successfully published all files for [$group] group!");
    }
}
