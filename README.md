# Tools every developer needs to build the next project

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lemaur/toolbox.svg?style=flat-square)](https://packagist.org/packages/lemaur/toolbox)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/lemaur/toolbox/run-tests?label=tests)](https://github.com/lemaur/toolbox/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/lemaur/toolbox/Check%20&%20fix%20styling?label=code%20style)](https://github.com/lemaur/toolbox/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/lemaur/toolbox.svg?style=flat-square)](https://packagist.org/packages/lemaur/toolbox)

## Installation

You can install the package via composer:

```bash
composer require lemaur/toolbox
```

You can launch the installation:

```bash
php artisan toolbox:install --force
```

Add there scripts to your `composer.json`:
```bash
"scripts": {
    "analyse": "./vendor/bin/phpstan analyse --memory-limit=2G",
    "rector": "./vendor/bin/rector process",
    "format": "./vendor/bin/php-cs-fixer fix --allow-risky=yes",
    "test": "./vendor/bin/pest --printer mheap\\GithubActionsReporter\\Printer --coverage --min=100 --coverage-html=.coverage --coverage-clover=coverage.xml",
}
```

## Testing

```bash
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
