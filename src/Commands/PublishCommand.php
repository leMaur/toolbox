<?php

declare(strict_types=1);

namespace Lemaur\Toolbox\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class PublishCommand extends Command
{
    protected $signature = "toolbox:install
                            {--only=* : Specify which group of files do you want to copy. Possible values are: `static-analysis`, `code-style`, `refactor`, `common`, `tests`}
                            {--T|test-suites : Configure Pest and Dusk test suites}
                            {--S|safe : Specify if you don't want to overwrite your existing files}";

    protected $description = "Install Toolbox's files and tests resources";

    private function files(?string $key = null): array
    {
        $files = [
            'static-analysis' => [
                __DIR__.'/../Commands/stubs/phpstan.neon.stub' => base_path('phpstan.neon'),
            ],

            'code-style' => [
                __DIR__.'/../Commands/stubs/pint.json.stub' => base_path('pint.json'),
            ],

            'refactor' => [
                __DIR__.'/../Commands/stubs/rector-bootstrap.php.stub' => base_path('rector-bootstrap.php'),
                __DIR__.'/../Commands/stubs/rector.php.stub' => base_path('rector.php'),
            ],

            'common' => [
                __DIR__.'/../Commands/stubs/.editorconfig.stub' => base_path('.editorconfig'),
                __DIR__.'/../Commands/stubs/.gitignore.stub' => base_path('.gitignore'),
                __DIR__.'/../Commands/stubs/config/ide-helper.php.stub' => base_path('config/ide-helper.php'),
            ],

            'tests' => [
                __DIR__.'/../Commands/stubs/tests/Analysis/AnalysisTest.php.stub' => base_path('tests/Analysis/AnalysisTest.php'),
                __DIR__.'/../Commands/stubs/tests/Browser/Pages/HomePage.php.stub' => base_path('tests/Browser/Pages/HomePage.php'),
                __DIR__.'/../Commands/stubs/tests/Browser/Pages/Page.php.stub' => base_path('tests/Browser/Pages/Page.php'),
                __DIR__.'/../Commands/stubs/tests/Browser/HomePageTest.php.stub' => base_path('tests/Browser/HomePageTest.php'),
                __DIR__.'/../Commands/stubs/tests/Feature/HomePageTest.php.stub' => base_path('tests/Feature/HomePageTest.php'),
                __DIR__.'/../Commands/stubs/tests/Helpers.php.stub' => base_path('tests/Helpers.php'),
                __DIR__.'/../Commands/stubs/tests/Pest.php.stub' => base_path('tests/Pest.php'),
                __DIR__.'/../Commands/stubs/phpunit.xml.stub' => base_path('phpunit.xml'),
                __DIR__.'/../Commands/stubs/.env.dusk.stub' => base_path('.env.dusk'),
                __DIR__.'/../Commands/stubs/infection.json.stub' => base_path('infection.json'),
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
            $this->call('pest:install', ['--quiet' => true, '--no-interaction' => true]);
            $this->info("Successfully installed Pest test suite.");

            $this->call('dusk:install', ['--quiet' => true, '--no-interaction' => true]);
            $this->info("Successfully installed Dusk test suite.");

            $this->newLine();
            $this->line("You can delete Example tests...");

            $this->copy($filesystem, ['tests']);

            return self::SUCCESS;
        }

        if ($this->option('only')) {
            $this->copy($filesystem, $this->option('only'));

            return self::SUCCESS;
        }

        $this->call('pest:install', ['--quiet' => true, '--no-interaction' => true]);
        $this->info("Successfully installed Pest test suite.");

        $this->call('dusk:install', ['--quiet' => true, '--no-interaction' => true]);
        $this->info("Successfully installed Dusk test suite.");

        $this->copy($filesystem, collect($this->files())->keys()->except('tests')->toArray());

        $this->newLine();
        $this->line("You can now delete Example tests...");

        return self::SUCCESS;
    }

    private function copy(Filesystem $filesystem, array $keys): void
    {
        foreach ($keys as $key) {
            $this->copyFiles($filesystem, $this->files($key), $key);
        }
    }

    private function copyFiles(Filesystem $filesystem, array $files, string $group): int
    {
        collect($files)->each(function ($destination, $original) use ($filesystem) {
            if ($this->option('safe') && $filesystem->exists($destination)) {
                $this->error("The file [{$destination}] already exists.");

                return self::FAILURE;
            }

            $path = Str::beforeLast($destination, '/');
            $filesystem->ensureDirectoryExists($path);
            $filesystem->copy($original, $destination);

            $this->info("Successfully published {$destination}.");
        });

        $this->info("Successfully published all files for [{$group}] group.");

        return self::SUCCESS;
    }
}
