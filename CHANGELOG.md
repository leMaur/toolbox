# Changelog

All notable changes to `toolbox` will be documented in this file.

## 4.2.0 - 2022-12-29

### Added
- add `thecodingmachine/phpstan-safe-rule` composer package
- add `phpstan-safe-rule` to phpstan.neon.stub
- add `thecodingmachine/safe/rector-migrate` to rector.php.stub

### Changed
- rename deprecated set `TYPE_DECLARATION_STRICT` to `TYPE_DECLARATION` on rector.php.stub
- temporarily disable `AddArrowFunctionReturnTypeRector` on rector.php.stub
- fix PhpMD badge in README.md


## 4.1.0 - 2022-11-22

### Added
- add driftingly/rector-laravel and update rector configuration file
- add schedule run on PHPMD workflow

### Changed
- change .editorconfig file
- change `allow-plugins` section on composer.json

### Removed
- remove laravel/sail (it is always required in a fresh new Laravel installation)


## 4.0.0 - 2022-11-21

### Added
- add ide-helper custom configuration file
- add Laravel Pint custom configuration

### Changed
- change required minimum PHP version to ^8.1
- update .gitignore stub
- update rector configuration file
- update php-stan configuration file
- update test helpers
- update Pest configuration

### Removed
- remove friendsofphp/php-cs-fixer
- remove nunomaduro/laravel-mojito
- remove phpstan/extension-installer


## 3.2.1 - 2022-04-12

- remove double helper function `actingAs()`


## 3.2.0 - 2022-04-11

- use infection/infection -> dev-master branch
- add support and suggest sections to composer.json
- update Pest configuration


## 3.1.0 - 2022-03-04

- update .php-cs-fixer.php stub file. Now it uses rulesets @PSR12 and @PHP81Migration

## 3.0.0 - 2022-02-03

- add laravel 9 support
- add new packages: 
    - barryvdh/laravel-ide-helper
    - infection/infection
    - roave/security-advisories
- remove packages:
    - fakerphp/faker
    - jasonmccreary/laravel-test-assertions
    - mheap/phpunit-github-actions-printer
    - mockery/mockery
    - orchestra/testbench
    - nunomaduro/collision
    - phpunit/phpunit

## 2.2.0 - 2021-08-24

- add pestphp/pest-plugin-parallel

## 2.1.1 - 2021-05-09

- fix test stubs

## 2.1.0 - 2021-05-08

- add --test-suites option to toolbox:install command
- add --only option to toolbox:install command

## 2.0.0 - 2021-05-08

- update php-cs-fixer
- update phpunit-speedtrap

## 1.1.0 - 2021-05-02

- add test stubs
- add .env.dusk.stub
- update phpstan.neon.stub
- update PublishCommand.php

## 1.0.0 - 2021-05-02

- initial release

