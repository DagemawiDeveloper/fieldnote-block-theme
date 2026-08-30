# Fieldnote

Fieldnote is a small, accessibility-minded WordPress block theme for editorial sites. It is a personal engineering project built to practice and demonstrate current block-theme architecture: `theme.json`, Site Editor templates, template parts, patterns, style variations, and a deliberately constrained editorial workflow.

It is not a production client theme and has not been submitted to the WordPress.org theme directory.

## What it demonstrates

- A complete block-theme template hierarchy for home, index, single, page, archive, search, 404, and a custom wide-page template.
- Registered header and footer template parts that remain editable in Appearance > Editor.
- Four bundled patterns, including content-only locked layouts that let editors change copy without dismantling structure.
- A curated `theme.json` design system with fluid type, spacing presets, a restrained color palette, and an alternate Ink style variation.
- Semantic `header`, `main`, `section`, and `footer` landmarks, the core Navigation block, visible keyboard focus, and reduced-motion handling.
- Performance choices that avoid remote fonts, JavaScript, large frameworks, and global block CSS when a block-specific stylesheet is enough.
- Dependency-free structural validation, PHP syntax checks in CI, and a reproducible installable ZIP.

## Local setup

The quickest option uses the official `@wordpress/env` package with its WordPress Playground runtime, so Docker is not required:

```bash
npm install
npm run env:start
```

Open `http://localhost:8888`, sign in with the credentials printed by `wp-env`, and activate Fieldnote under **Appearance → Themes** if it is not already active. To stop the environment:

```bash
npm run env:stop
```

You can also copy or symlink this repository into `wp-content/themes/fieldnote` in an existing local WordPress installation and activate **Fieldnote** from Appearance > Themes.

## Explore it in the Site Editor

1. Open Appearance > Editor and modify the Header or Footer template part.
2. Switch Global Styles from the default Paper palette to the Ink variation.
3. Open Templates and inspect the home, single, archive, search, and custom wide-page layouts.
4. Insert one of the Fieldnote patterns into a page.
5. Edit the text inside the Editorial hero or Editorial callout and observe how content-only locking protects its structure.

## Checks and packaging

Run the dependency-free validation script:

```bash
npm test
```

Build an installable theme archive:

```bash
npm run package
```

The ZIP is written to `dist/fieldnote.zip`. GitHub Actions repeats structural validation and packaging, then lints every PHP file across PHP 7.4, 8.2, 8.3, and 8.4.

## Engineering notes

The reasoning behind the design system, editorial controls, accessibility choices, and asset strategy is recorded in [docs/DECISIONS.md](docs/DECISIONS.md). See the [WordPress 7.1 verification results](docs/TEST-RESULTS.md) and the broader [manual test plan](docs/TESTING.md).

## Current limits

- The theme intentionally covers a focused editorial use case rather than WooCommerce or complex application UI.
- Automated checks cannot replace manual Site Editor, keyboard, browser, screen-reader, and real-content testing.
- RTL layout and older-browser behavior still need dedicated manual verification.

## License

Fieldnote is released under the GNU General Public License v2 or later.
