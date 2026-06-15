#!/usr/bin/env bash
#
# Generate Action Scheduler stubs from the latest versions.
#

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(dirname "$SCRIPT_DIR")"

set -e

PACKAGIST_JSON="$(wget -q -O- "https://packagist.org/packages/woocommerce/action-scheduler.json")"

VERSIONS=(3.4 3.5 3.6 3.7 3.8 3.9)

for V in "${VERSIONS[@]}"; do
    printf -v JQ_FILTER '."package"."versions" | keys[] | select(test("^%s\\\\.%s\\\\.\\\\d+$"))' "${V%.*}" "${V#*.}"
    LATEST="$(jq -r "$JQ_FILTER" <<<"$PACKAGIST_JSON" | sort -t "." -k 3 -g | tail -n 1)"
    if [ -z "$LATEST" ]; then
        continue
    fi

    echo "Releasing version ${LATEST} ..."

    if git -C "$ROOT_DIR" rev-parse "refs/tags/v${LATEST}" >/dev/null 2>&1; then
        echo "Tag exists!"
        continue
    fi

    printf -v SED_EXP 's#\\("woocommerce/action-scheduler"\\): "[^"]*"#\\1: "%s"#' "${LATEST}"
    sed -i -e "$SED_EXP" "$ROOT_DIR/source/composer.json"

    composer --working-dir="$ROOT_DIR/source" update --no-interaction

    echo "Generating stubs ..."
    "$SCRIPT_DIR/generate.sh"

    git -C "$ROOT_DIR" commit --all -m "Generate stubs for Action Scheduler ${LATEST}"
    git -C "$ROOT_DIR" tag "v${LATEST}"
done
