# Tools for Artisan!

Toolbox full of useful packages to keep your Laravel project compliant with your coding standards.   
It provides a minimum configuration to help you start with `static analysis`, `code styling` and `testing`.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lemaur/toolbox.svg?style=flat-square)](https://packagist.org/packages/lemaur/toolbox)
[![Total Downloads](https://img.shields.io/packagist/dt/lemaur/toolbox.svg?style=flat-square)](https://packagist.org/packages/lemaur/toolbox)
[![License](https://img.shields.io/packagist/l/lemaur/toolbox.svg?style=flat-square&color=yellow)](https://github.com/leMaur/toolbox/blob/master/LICENSE.md)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/lemaur/toolbox/Check%20&%20fix%20styling?label=code%20style&style=flat-square)](https://github.com/lemaur/toolbox/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![GitHub Sponsors](https://img.shields.io/github/sponsors/lemaur?style=flat-square&color=ea4aaa)](https://github.com/sponsors/leMaur)
[![Trees](https://img.shields.io/badge/dynamic/json?color=yellowgreen&style=flat-square&label=Trees&query=%24.total&url=https%3A%2F%2Fpublic.offset.earth%2Fusers%2Flemaur%2Ftrees)](https://ecologi.com/lemaur?r=6012e849de97da001ddfd6c9)

## What's Included
- [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
- [Laravel Ide Helper](https://github.com/barryvdh/laravel-ide-helper)
- [Php Cs Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)
- [Analyzer](https://github.com/GrahamCampbell/Analyzer)
- [Infection](https://github.com/infection/infection)
- [Phpunit SpeedTrap](https://github.com/johnkary/phpunit-speedtrap)
- [Laravel Dusk](https://github.com/laravel/dusk)
- [Mockery](https://github.com/mockery/mockery)
- [Collision](https://github.com/nunomaduro/collision)
- [Larastan](https://github.com/nunomaduro/larastan)
- [Laravel Mojito](https://github.com/nunomaduro/laravel-mojito)
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
```
composer require --dev lemaur/toolbox
```

Launch the installation:
> Be careful, this package was created to be used on a fresh new Laravel project.  
> Commands listed below will OVERWRITE your existing files!

If you install this package in a fresh Laravel installation, you can simply run:

```bash
php artisan toolbox:install
```

⬇️ configure only Pest and Dusk test suites. [Those files will be overwritten](/src/Commands/PublishCommand.php#L22).
```bash
php artisan toolbox:install --test-suites
```

Otherwise, you can install only the group of files you need without test suites:

⬇️ will overwrite [phpstan.neon](/src/Commands/PublishCommand.php#L24).
```bash
php artisan toolbox:install --only="static-analysis"
```

or you can specify multiple values, ⬇️ will overwrite [phpstan.neon](/src/Commands/PublishCommand.php#L24) and [.php-cs-fixer.php](/src/Commands/PublishCommand.php#L28).
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
    "post-update-cmd": [
        ...
        "@php artisan clear-compiled",
        "@php artisan ide-helper:generate",
        "@php artisan ide-helper:meta"
    ],
    "models": "@php artisan ide-helper:models --write",
    "analyse": "./vendor/bin/phpstan analyse --memory-limit=2G",
    "refactor": "./vendor/bin/rector process",
    "format": "./vendor/bin/php-cs-fixer fix --allow-risky=yes",
    "test": "./vendor/bin/pest --exclude-group=e2e",
    "test:fast": "./vendor/bin/pest --exclude-group=e2e --parallel",
    "test:coverage": "./vendor/bin/pest --exclude-group=e2e --coverage --min=100 --coverage-html=.coverage --coverage-clover=coverage.xml",
    "test:e2e": "@php artisan pest:dusk",
    "test:mutation": "XDEBUG_MODE=coverage ./vendor/bin/infection --test-framework=pest --show-mutations"
}
```

Allow plugins to be executed by Composer, by putting these lines on `composer.json`:
```bash
"config": {
    ...
    "allow-plugins": {
        "phpstan/extension-installer": true,
        "pestphp/pest-plugin": true
    }
}
```

## Available Commands 

Generate PHPDoc on your models (helpful for static analysis) [for more info](https://github.com/barryvdh/laravel-ide-helper#automatic-phpdocs-for-models)
```bash
composer models
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
