# Changelog

All notable changes to `toolbox` will be documented in this file.

## 3.2.0 - 2022-04-11

- use infection/infection -> dev-master branch
- add support and suggest sections to composer.json
- improve Pest configuration


## 3.1.0 - 2022-03-04

- updated .php-cs-fixer.php stub file. Now it uses rulesets @PSR12 and @PHP81Migration

## 3.0.0 - 2022-02-03

- added laravel 9 support
- added new packages: 
    - barryvdh/laravel-ide-helper
    - infection/infection
    - roave/security-advisories
- removed packages:
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

