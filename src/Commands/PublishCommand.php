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
                __DIR__.'/../Commands/stubs/.php-cs-fixer.php.stub' => base_path('.php-cs-fixer.php'),
            ],

            'refactor' => [
                __DIR__.'/../Commands/stubs/rector-bootstrap.php.stub' => base_path('rector-bootstrap.php'),
                __DIR__.'/../Commands/stubs/rector.php.stub' => base_path('rector.php'),
            ],

            'common' => [
                __DIR__.'/../Commands/stubs/.editorconfig.stub' => base_path('.editorconfig'),
                __DIR__.'/../Commands/stubs/.gitignore.stub' => base_path('.gitignore'),
                __DIR__.'/../Commands/stubs/infection.json.stub' => base_path('infection.json'),
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

            $this->line("");
            $this->line("You can now delete Example tests and tests/Unit folder with its content.");

            $this->copy($filesystem, ['tests']);

            return 0;
        }

        if ($this->option('only')) {
            $this->copy($filesystem, $this->option('only'));

            return 0;
        }

        $this->call('pest:install', ['--quiet' => true, '--no-interaction' => true]);
        $this->info("Successfully installed Pest test suite.");

        $this->call('dusk:install', ['--quiet' => true, '--no-interaction' => true]);
        $this->info("Successfully installed Dusk test suite.");

        $this->copy($filesystem, collect($this->files())->keys()->except('tests')->toArray());

        $this->line("");
        $this->line("You can now delete Example tests and tests/Unit folder with its content.");

        return 0;
    }

    private function copy(Filesystem $filesystem, array $keys): void
    {
        foreach ($keys as $key) {
            $this->copyFiles($filesystem, $this->files($key), $key);
        }
    }

    private function copyFiles(Filesystem $filesystem, array $files, string $group): int
    {
        collect($files)->each(function ($toPublish, $original) use ($filesystem) {
            if ($this->option('safe') && $filesystem->exists($toPublish)) {
                $this->error("The file [$toPublish] already exists.");

                return 1;
            }

            $path = Str::beforeLast($toPublish, '/');
            $filesystem->ensureDirectoryExists($path);
            $filesystem->copy($original, $toPublish);

            $this->info("Successfully published $toPublish.");
        });

        $this->info("Successfully published all files for [$group] group.");

        return 0;
    }
}
