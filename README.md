# Tools for Artisan!

Toolbox full of useful packages to keep your **Laravel** project compliant with your coding standards.   
It provides a minimum configuration to help you start with `static analysis`, `code styling` and `testing`.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lemaur/toolbox.svg?style=flat-square)](https://packagist.org/packages/lemaur/toolbox)
[![Total Downloads](https://img.shields.io/packagist/dt/lemaur/toolbox.svg?style=flat-square)](https://packagist.org/packages/lemaur/toolbox)
[![License](https://img.shields.io/packagist/l/lemaur/toolbox.svg?style=flat-square&color=yellow)](https://github.com/leMaur/toolbox/blob/master/LICENSE.md)
[![GitHub PHPMD](https://img.shields.io/github/actions/workflow/status/lemaur/toolbox/phpmd.yml?label=PHPMD&style=flat-square)](https://github.com/leMaur/toolbox/actions/workflows/phpmd.yml)
[![GitHub Sponsors](https://img.shields.io/github/sponsors/lemaur?style=flat-square&color=ea4aaa)](https://github.com/sponsors/leMaur)
[![Trees](https://img.shields.io/badge/dynamic/json?color=yellowgreen&style=flat-square&label=Trees&query=%24.total&url=https%3A%2F%2Fpublic.offset.earth%2Fusers%2Flemaur%2Ftrees)](https://ecologi.com/lemaur?r=6012e849de97da001ddfd6c9)

## What's Included
- [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
- [Laravel Ide Helper](https://github.com/barryvdh/laravel-ide-helper)
- [Analyzer](https://github.com/GrahamCampbell/Analyzer)
- [Infection](https://github.com/infection/infection)
- [Phpunit SpeedTrap](https://github.com/johnkary/phpunit-speedtrap)
- [Laravel Dusk](https://github.com/laravel/dusk)
- [Laravel Sail](https://github.com/laravel/sail)
- [Larastan](https://github.com/nunomaduro/larastan)
- [Pest](https://pestphp.com)
- [Phpunit](https://github.com/sebastianbergmann/phpunit)
- [Rector](https://github.com/rectorphp/rector)
- [Security Advisories](https://github.com/Roave/SecurityAdvisories)
- [Laravel Ray](https://github.com/spatie/laravel-ray)

## Support Me

Hey folks,

Do you like this package? Do you find it useful, and it fits well in your project?

I am glad to help you, and I would be so grateful if you considered supporting my work.

You can even choose 😃:
* You can [sponsor me 😎](https://github.com/sponsors/leMaur) with a monthly subscription.
* You can [buy me a coffee ☕ or a pizza 🍕](https://github.com/sponsors/leMaur?frequency=one-time&sponsor=leMaur) just for this package.
* You can [plant trees 🌴](https://ecologi.com/lemaur?r=6012e849de97da001ddfd6c9). By using this link we will both receive 30 trees for free and the planet (and me) will thank you. 
* You can "Star ⭐" this repository (it's free 😉).

## Installation

Install the package via composer:
```bash
composer require lemaur/toolbox --dev 
```

if you still using php8.0 you should use:
```bash
composer require "lemaur/toolbox:^3.2" --dev
```

Launch the installation:
> Be careful, this package was created to be used on a fresh new Laravel project.  
> Commands listed below will OVERWRITE your existing files!

If you install this package in a fresh Laravel installation, you can simply run:

```bash
php artisan toolbox:install
```

⬇️ configure only Pest and Dusk test suites. [Those files will be overwritten](/src/Commands/PublishCommand.php#L42).
```bash
php artisan toolbox:install --test-suites
```

Otherwise, you can install only the group of files you need without test suites:

⬇️ will overwrite [phpstan.neon](/src/Commands/PublishCommand.php#L23).
```bash
php artisan toolbox:install --only="static-analysis"
```

or you can specify multiple values, ⬇️ will overwrite [phpstan.neon](/src/Commands/PublishCommand.php#L23) and [pint.json](/src/Commands/PublishCommand.php#L27).
```bash
php artisan toolbox:install --only="static-analysis" --only="code-style"
```

Available values for the `--only` option:
```bash
- static-analysis
- code-style
- refactor
- tests
- common
```

Add those scripts to your `composer.json`:
```bash
"scripts": {
    "ide-helper": [
        "@php artisan ide-helper:models --write-mixin --reset",
        "@php artisan ide-helper:generate",
        "@php artisan ide-helper:eloquent",
        "@php artisan ide-helper:meta"
    ],
    "analyse": "./vendor/bin/phpstan analyse --memory-limit=2G",
    "refactor": "./vendor/bin/rector process  --memory-limit=2G",
    "format": "./vendor/bin/pint",
    "test": "./vendor/bin/pest --exclude-group=e2e",
    "test:fast": "./vendor/bin/pest --exclude-group=e2e --parallel",
    "test:coverage": "./vendor/bin/pest --exclude-group=e2e --coverage --min=50 --coverage-html=.coverage --coverage-clover=coverage.xml",
    "test:e2e": "@php artisan pest:dusk",
    "test:mutation": [
        "Composer\\Config::disableProcessTimeout",
        "XDEBUG_MODE=coverage vendor/bin/infection --show-mutations --threads=4 --only-covering-test-cases --min-msi=25 --min-covered-msi=85 --test-framework=pest --test-framework-options='--configuration=phpunit.xml --exclude-group=e2e'"
    ]
}
```

Allow plugins to be executed by Composer, by putting these lines on `composer.json`:
```bash
"config": {
    ...
    "allow-plugins": {
        "phpstan/extension-installer": true,
        "pestphp/pest-plugin": true,
        "infection/extension-installer": true
    }
}
```

## Available Commands 

Generate PHPDoc for your models and   
other (helpful for your IDE and static analysis tools) [for more info](https://github.com/barryvdh/laravel-ide-helper#usage)
```bash
composer ide-helpers
```

Run code refactoring [for more info](https://github.com/rectorphp/rector)
```bash
composer refactor
```

Run code style formatting [for more info](https://github.com/FriendsOfPHP/PHP-CS-Fixer)
```bash
composer format
```

Run static analysis [for more info](https://github.com/nunomaduro/larastan)
```bash
composer analyse
```

Run tests [for more info](https://pestphp.com)
```bash
composer test
```

Run tests with coverage [for more info](https://pestphp.com/docs/coverage)
```bash
composer test:coverage
```

Run e2e tests [for more info](https://pestphp.com/docs/plugins/laravel#laravel-dusk)
```bash
composer test:e2e
```

Run mutation tests [for more info](https://infection.github.io/guide)
```bash
composer test:mutation
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Maurizio](https://github.com/lemaur)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
