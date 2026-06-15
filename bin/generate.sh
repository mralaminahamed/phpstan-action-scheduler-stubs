#!/usr/bin/env bash
#
# Generate Action Scheduler stubs from the source directory.
#

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(dirname "$SCRIPT_DIR")"

HEADER=$'/**\n * Generated stub declarations for Action Scheduler.\n * @see https://actionscheduler.org\n * @see https://github.com/mralaminahamed/phpstan-action-scheduler-stubs\n */'

FILE="$ROOT_DIR/action-scheduler-stubs.php"
FILE_CONSTANTS="$ROOT_DIR/action-scheduler-constants-stubs.php"
GENERATOR_BIN="$ROOT_DIR/vendor/bin/generate-stubs"
FINDER_FILE="$ROOT_DIR/configs/finder.php"

set -e

test -f "$FILE" || touch "$FILE"
test -f "$FILE_CONSTANTS" || touch "$FILE_CONSTANTS"
test -d "$ROOT_DIR/source/vendor/woocommerce/action-scheduler"

"$GENERATOR_BIN" \
    --include-inaccessible-class-nodes \
    --force \
    --finder="$FINDER_FILE" \
    --header="$HEADER" \
    --functions \
    --classes \
    --interfaces \
    --traits \
    --out="$FILE"

"$GENERATOR_BIN" \
    --include-inaccessible-class-nodes \
    --force \
    --finder="$FINDER_FILE" \
    --header="$HEADER" \
    --constants \
    --out="$FILE_CONSTANTS"
