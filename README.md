# Action Scheduler Stubs

[![Latest Version](https://img.shields.io/packagist/v/mralaminahamed/action-scheduler-stubs.svg?color=4CC61E&style=flat-square)](https://packagist.org/packages/mralaminahamed/action-scheduler-stubs)
[![Downloads](https://img.shields.io/packagist/dt/mralaminahamed/action-scheduler-stubs.svg?style=flat-square)](https://packagist.org/packages/mralaminahamed/action-scheduler-stubs/stats)
[![License](https://img.shields.io/packagist/l/mralaminahamed/action-scheduler-stubs.svg?style=flat-square)](./LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/mralaminahamed/action-scheduler-stubs.svg?style=flat-square)](./composer.json)

PHP stub declarations for [Action Scheduler](https://actionscheduler.org) (`woocommerce/action-scheduler`) to enhance IDE completion and static analysis capabilities. Generated using [php-stubs/generator](https://github.com/php-stubs/generator) directly from the source code.

## Why

Action Scheduler usually arrives at runtime from something else on the site — WooCommerce, or the plugin installed alongside yours — so your own code calls `as_schedule_recurring_action()` and friends without depending on the package. PHPStan then reports `Function as_next_scheduled_action not found` in every file that schedules anything, and the usual workaround is a per-file baseline entry.

Those suppressions match by message and path, so they silence real mistakes too: a wrong argument count in one of those files is ignored along with the "not found". Declaring the symbols instead makes the calls checkable.

Stub versions track upstream Action Scheduler releases, so you can pin the same major you run against.

## Requirements

- PHP >= 7.4

## Installation

```bash
composer require --dev mralaminahamed/action-scheduler-stubs
```

## Usage

Add the stubs to `scanFiles` in your `phpstan.neon`:

```neon
parameters:
    scanFiles:
        - vendor/mralaminahamed/action-scheduler-stubs/action-scheduler-stubs.stub
        - vendor/mralaminahamed/action-scheduler-stubs/action-scheduler-constants-stubs.stub
```

`scanFiles`, not `stubFiles`. `stubFiles` **replaces** the signature of a symbol PHPStan already knows about; these are symbols it does not know at all, and scanning is what makes them exist. Use `stubFiles` only if Action Scheduler is already installed and you want these declarations to win over it.

If you install Action Scheduler as a real dependency — for tests, or because you ship it — scan its own `functions.php` instead and skip this package. The library is the more accurate source when you have it; this package is for when you do not.

### Manual installation

Download the stub files directly:

- [action-scheduler-stubs.stub](https://raw.githubusercontent.com/mralaminahamed/phpstan-action-scheduler-stubs/main/action-scheduler-stubs.stub)
- [action-scheduler-constants-stubs.stub](https://raw.githubusercontent.com/mralaminahamed/phpstan-action-scheduler-stubs/main/action-scheduler-constants-stubs.stub)

## Package structure

```
phpstan-action-scheduler-stubs/
├── bin/
│   ├── generate.sh                       # Stub generation
│   └── release-latest-versions.sh        # Release automation
├── configs/
│   ├── bootstrap.php                     # PHPStan bootstrap with WP constants
│   └── finder.php                        # File finder configuration
├── source/                               # Action Scheduler source the stubs are generated from
├── tests/                                # Parse + upstream-parity checks
├── action-scheduler-stubs.stub           # Classes, interfaces and functions
├── action-scheduler-constants-stubs.stub # Constants
├── phpcs.xml.dist                        # Standards for the hand-written PHP
├── phpstan.neon                          # Scans the stubs, analyses configs/ and tests/
└── phpunit.xml.dist                      # Test suite configuration
```

## Development

```bash
composer generate       # regenerate the stubs from source/
composer test           # run the test suite
composer test-coverage  # tests with coverage
composer analyze        # PHPStan over configs/ and tests/
composer cs             # coding standards
composer cs-fix         # fix what can be fixed
composer check          # cs + analyze + test
composer release        # tag and publish
```

## Changelog

See [CHANGELOG.md](./CHANGELOG.md). Package versions track upstream Action Scheduler releases.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This package is open-sourced software licensed under the [MIT license](./LICENSE).
