# Tools for Artisan!

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lemaur/toolbox.svg?style=flat-square)](https://packagist.org/packages/lemaur/toolbox)
[![Total Downloads](https://img.shields.io/packagist/dt/lemaur/toolbox.svg?style=flat-square)](https://packagist.org/packages/lemaur/toolbox)
[![License](https://img.shields.io/packagist/l/lemaur/toolbox.svg?style=flat-square&color=yellow)](https://github.com/leMaur/toolbox/blob/master/LICENSE.md)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/lemaur/toolbox/Check%20&%20fix%20styling?label=code%20style&style=flat-square)](https://github.com/lemaur/toolbox/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![GitHub Sponsors](https://img.shields.io/github/sponsors/lemaur?style=flat-square&color=ea4aaa)](https://github.com/sponsors/leMaur)
[![Trees](https://img.shields.io/badge/dynamic/json?color=yellowgreen&style=flat-square&label=Trees&query=%24.total&url=https%3A%2F%2Fpublic.offset.earth%2Fusers%2Flemaur%2Ftrees)](https://ecologi.com/lemaur?r=6012e849de97da001ddfd6c9)

## What's Included
- [Rector](https://github.com/rectorphp/rector)
- [Pest](https://pestphp.com/)
- [Dusk](https://laravel.com/docs/8.x/dusk)
- [Larastan](https://github.com/nunomaduro/larastan)
- [Php Cs Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)

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
> Be careful, this command (with `--force` option) will overwrite [existing files](https://github.com/leMaur/toolbox/blob/master/src/Commands/PublishCommand.php#L38) in your project.

If you install this package in a fresh Laravel installation, you can simply run:
```
php artisan toolbox:install --test-suites --force
```

Otherwise, you can install only the group of files you may need without test suites:
```
php artisan toolbox:install --force --only="static-analysis"

# or you can specify multiple values
php artisan toolbox:install --force --only="static-analysis" --only="code-style"

# Available values:
- static-analysis
- code-style
- rector
- tests
- common
```

Add those scripts to your `composer.json`:
```
"scripts": {
    "analyse": "./vendor/bin/phpstan analyse --memory-limit=2G",
    "rector": "./vendor/bin/rector process",
    "format": "./vendor/bin/php-cs-fixer fix --allow-risky=yes",
    "test": "./vendor/bin/pest --coverage --min=100 --coverage-html=.coverage --coverage-clover=coverage.xml"
}
```

If you use a continuous integration, you can run your test with a custom printer:
[for more info](https://github.com/mheap/phpunit-github-actions-printer)
```
# an example from Github Actions

- name: Run Tests
  run: ./vendor/bin/pest --printer mheap\\GithubActionsReporter\\Printer --coverage --min=100 --coverage-html=.coverage --coverage-clover=coverage.xml
```

## Available Commands 

```
# Analyse
composer analyse

# Run Rector
composer rector

# Run Code Style Formatting
composer format

# Run tests
composer test
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
