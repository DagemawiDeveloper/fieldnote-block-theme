#!/usr/bin/env bash

set -euo pipefail

project_root="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
theme_archive="${project_root}/dist/fieldnote.zip"
plugin_archive="${project_root}/dist/fieldnote-editorial-blocks.zip"

npm run package >/dev/null
theme_first="$(sha256sum "${theme_archive}" | cut -d ' ' -f 1)"
plugin_first="$(sha256sum "${plugin_archive}" | cut -d ' ' -f 1)"

npm run package >/dev/null
theme_second="$(sha256sum "${theme_archive}" | cut -d ' ' -f 1)"
plugin_second="$(sha256sum "${plugin_archive}" | cut -d ' ' -f 1)"

if [[ "${theme_first}" != "${theme_second}" || "${plugin_first}" != "${plugin_second}" ]]; then
	printf 'Package verification failed: archive hashes changed between clean builds.\n' >&2
	exit 1
fi

printf 'Deterministic packages verified.\n'
printf 'Theme SHA-256:  %s\n' "${theme_first}"
printf 'Plugin SHA-256: %s\n' "${plugin_first}"
