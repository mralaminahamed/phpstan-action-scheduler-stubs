# Changelog

All notable changes to this package are documented here.

**Versions track upstream Action Scheduler.** `v4.1.0` of this package stubs Action Scheduler
`4.1.0`, so you can require the same major you run against. That is also why entries below are
mostly "regenerated against X" — the stubs have no behaviour of their own to change.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/).

## [Unreleased]

### Added

- `tests/StubsTest.php`, and the `phpunit.xml.dist` that lets `composer test` run at all. It asserts
  both stub files parse, and that the `as_*` functions declared here match the installed upstream
  copy in both directions — a missing one, and one upstream has since removed.
- `phpcs.xml.dist`, so `composer cs` and `composer cs-fix` have a ruleset. Generated `.stub` files
  and `source/` are excluded; only the PHP this repository writes by hand is checked.
- CI on push and pull request, across PHP 7.4 and 8.3, running `cs`, `analyze` and `test`.
- A weekly `Upstream check` workflow that compares the pinned Action Scheduler against the latest
  release and opens an issue when it falls behind. Staleness is the failure mode a stubs package
  actually has, and it is silent without something watching for it.
- This changelog.

### Fixed

- `composer test`, `composer cs` and `composer check` all failed: `phpunit` had no config and an
  empty `tests/` directory, and `phpcs` had no ruleset. The README documented all three.
- `composer analyze` could not pass. The generated stubs were in PHPStan's `paths`, which asks it to
  check the bodies of declarations that are empty by definition — around 330 errors, none of them a
  defect here. The `ignoreErrors` pattern that hid them stopped working when PHPStan 2.x classified
  `return.missing` and `class.notFound` as non-ignorable, and a baseline could not hold them either.
  The stubs are now `scanFiles`, which makes the symbols known without asserting anything about
  bodies a stub cannot have; `paths` covers the hand-written PHP instead.

### Changed

- README pointed at `mralaminahamed/phpstan-action-scheduler-stubs` — the repository name, not the
  package name. Every badge rendered "not found" and the documented install command failed. It is
  `mralaminahamed/action-scheduler-stubs`.
- The "Basic Configuration" section linked to `docs/usage.md`, which does not exist. Usage is now in
  the README, including why these go in `scanFiles` rather than `stubFiles`.
- Documented the composer scripts that exist; there are eleven, of which three were listed.

## [4.1.0] - 2026-08-16

Regenerated against Action Scheduler 4.1.0.

## [4.0.0] - 2026-08-16

Regenerated against Action Scheduler 4.0.0.

## [3.9.3] - 2026-06-15

Regenerated against Action Scheduler 3.9.3.

## [3.8.2] - 2026-06-15

Regenerated against Action Scheduler 3.8.2.

## [3.7.4] - 2026-06-15

Regenerated against Action Scheduler 3.7.4.

## [3.6.4] - 2026-06-15

Regenerated against Action Scheduler 3.6.4.

## [3.5.4] - 2026-06-15

Regenerated against Action Scheduler 3.5.4.

## [3.4.2] - 2026-06-15

Regenerated against Action Scheduler 3.4.2. First published release.

[Unreleased]: https://github.com/mralaminahamed/phpstan-action-scheduler-stubs/compare/v4.1.0...HEAD
[4.1.0]: https://github.com/mralaminahamed/phpstan-action-scheduler-stubs/compare/v4.0.0...v4.1.0
[4.0.0]: https://github.com/mralaminahamed/phpstan-action-scheduler-stubs/compare/v3.9.3...v4.0.0
[3.9.3]: https://github.com/mralaminahamed/phpstan-action-scheduler-stubs/compare/v3.8.2...v3.9.3
[3.8.2]: https://github.com/mralaminahamed/phpstan-action-scheduler-stubs/compare/v3.7.4...v3.8.2
[3.7.4]: https://github.com/mralaminahamed/phpstan-action-scheduler-stubs/compare/v3.6.4...v3.7.4
[3.6.4]: https://github.com/mralaminahamed/phpstan-action-scheduler-stubs/compare/v3.5.4...v3.6.4
[3.5.4]: https://github.com/mralaminahamed/phpstan-action-scheduler-stubs/compare/v3.4.2...v3.5.4
[3.4.2]: https://github.com/mralaminahamed/phpstan-action-scheduler-stubs/releases/tag/v3.4.2
