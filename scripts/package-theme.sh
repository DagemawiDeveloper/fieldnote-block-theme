#!/usr/bin/env bash

set -euo pipefail

project_root="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
archive_dir="${project_root}/dist"
archive_path="${archive_dir}/fieldnote.zip"
staging_root="$(mktemp -d)"
staging_theme="${staging_root}/fieldnote"

cleanup() {
	rm -rf "${staging_root}"
}
trap cleanup EXIT

mkdir -p "${archive_dir}" "${staging_theme}"
rm -f "${archive_path}"

files=(
	"LICENSE"
	"functions.php"
	"readme.txt"
	"screenshot.png"
	"style.css"
	"theme.json"
)

directories=(
	"assets/css"
	"parts"
	"patterns"
	"styles"
	"templates"
)

for file in "${files[@]}"; do
	cp "${project_root}/${file}" "${staging_theme}/${file}"
done

for directory in "${directories[@]}"; do
	mkdir -p "${staging_theme}/${directory}"
	cp -R "${project_root}/${directory}/." "${staging_theme}/${directory}/"
done

(
	cd "${staging_root}"
	zip -q -r "${archive_path}" fieldnote
)

printf 'Created %s\n' "${archive_path}"

