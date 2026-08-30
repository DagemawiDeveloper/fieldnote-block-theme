#!/usr/bin/env bash

set -euo pipefail

project_root="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
plugin_source="${project_root}/plugins/fieldnote-editorial-blocks"
archive_dir="${project_root}/dist"
archive_path="${archive_dir}/fieldnote-editorial-blocks.zip"
staging_root="$(mktemp -d)"
staging_plugin="${staging_root}/fieldnote-editorial-blocks"

cleanup() {
	rm -rf "${staging_root}"
}
trap cleanup EXIT

mkdir -p "${archive_dir}" "${staging_plugin}"
rm -f "${archive_path}"

files=(
	"LICENSE"
	"fieldnote-editorial-blocks.php"
	"readme.txt"
)

for file in "${files[@]}"; do
	cp "${plugin_source}/${file}" "${staging_plugin}/${file}"
done

mkdir -p "${staging_plugin}/blocks"
cp -R "${plugin_source}/blocks/." "${staging_plugin}/blocks/"

find "${staging_plugin}" -type d -exec chmod 755 {} +
find "${staging_plugin}" -type f -exec chmod 644 {} +
find "${staging_plugin}" -exec touch -t 200001010000.00 {} +

(
	cd "${staging_root}"
	find fieldnote-editorial-blocks -type f -print | LC_ALL=C sort | zip -X -q "${archive_path}" -@
)

printf 'Created %s\n' "${archive_path}"
