# Action Scheduler Stubs

[![Latest Version](https://img.shields.io/packagist/v/mralaminahamed/phpstan-action-scheduler-stubs.svg?color=4CC61E&style=flat-square)](https://packagist.org/packages/mralaminahamed/phpstan-action-scheduler-stubs)
[![Downloads](https://img.shields.io/packagist/dt/mralaminahamed/phpstan-action-scheduler-stubs.svg?style=flat-square)](https://packagist.org/packages/mralaminahamed/phpstan-action-scheduler-stubs/stats)
[![License](https://img.shields.io/packagist/l/mralaminahamed/phpstan-action-scheduler-stubs.svg?style=flat-square)](./LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/mralaminahamed/phpstan-action-scheduler-stubs.svg?style=flat-square)](./composer.json)

PHP stub declarations for [Action Scheduler](https://actionscheduler.org) (`woocommerce/action-scheduler`) to enhance IDE completion and static analysis capabilities. Generated using [php-stubs/generator](https://github.com/php-stubs/generator) directly from the source code.

## Features

- Complete function, class, and interface declarations
- Constant definitions for proper static analysis
- IDE autocompletion support
- PHPStan integration
- Regular updates with latest Action Scheduler versions

## Requirements

- PHP >= 7.4
- Composer for dependency management

## Installation

### Via Composer (Recommended)

```bash
composer require --dev mralaminahamed/phpstan-action-scheduler-stubs
```

### Manual Installation

Download the stub files directly:
- [action-scheduler-stubs.php](https://raw.githubusercontent.com/mralaminahamed/phpstan-action-scheduler-stubs/main/action-scheduler-stubs.php)
- [action-scheduler-constants-stubs.php](https://raw.githubusercontent.com/mralaminahamed/phpstan-action-scheduler-stubs/main/action-scheduler-constants-stubs.php)

## Basic Configuration

To use these stubs with PHPStan or your IDE, see our [Usage Guide](./docs/usage.md) for detailed instructions.

## Package Structure

```
phpstan-action-scheduler-stubs/
├── bin/                                      # Scripts for generating and releasing stubs
│   ├── generate.sh                           # Stub generation script
│   └── release-latest-versions.sh           # Release automation script
├── configs/                                  # Configuration files for stub generation
│   ├── bootstrap.php                         # PHPStan bootstrap with WP constants
│   └── finder.php                            # File finder configuration
├── action-scheduler-constants-stubs.php      # Constants stub file
├── action-scheduler-stubs.php               # Main stubs file with classes and functions
├── phpstan.neon                              # PHPStan configuration
├── source/                                   # Source for generating stubs
└── tests/                                    # Test files
```

## Development

### Generating Stubs

```bash
composer generate
```

### Running Tests

```bash
composer test
```

### Releasing a New Version

```bash
composer release
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This package is open-sourced software licensed under the [MIT license](./LICENSE).
