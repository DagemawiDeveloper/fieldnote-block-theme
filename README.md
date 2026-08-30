# Fieldnote

[![Theme checks](https://github.com/DagemawiDeveloper/fieldnote-block-theme/actions/workflows/theme-checks.yml/badge.svg)](https://github.com/DagemawiDeveloper/fieldnote-block-theme/actions/workflows/theme-checks.yml)

Fieldnote is a performance-minded WordPress block theme shaped like a modern field journal. It is a personal engineering project for exploring contemporary editorial systems with native WordPress: no front-end JavaScript, no remote font requests, no framework, and no required plugin.

It is not a production client theme and has not been submitted to the WordPress.org theme directory.

![Fieldnote editorial homepage preview](screenshot.png)

## The editorial system

| Layer | Included |
| --- | --- |
| Templates | Front page, home, index, single, page, wide page, archive, author, search, and 404 |
| Template parts | Announcement bar, header, and footer |
| Patterns | Hero, lead-story mosaic, archive grid, topic index, manifesto, reader invitation, author profile, editor’s note, and page intro |
| Global styles | Paper-led default, Ink, and Moss |
| Section styles | Obsidian, Parchment, Signal, and Editorial Byline |

The front page is built as a coherent publication rather than a collection of isolated blocks: an issue-led hero, an asymmetric story mosaic, live category navigation, a high-contrast editorial statement, a deeper archive, and a reader invitation.

## WordPress 7.1, used deliberately

- **theme.json** schema version 3 with custom Mobile and Tablet viewports.
- Native **@mobile** and **@tablet** block style states for spacing and typography.
- Native Button and Navigation Link states for hover, focus-visible, active, and current-page styling.
- The new **styles.background.gradient** support for layered editorial surfaces.
- JSON-registered section and block style variations that remain available in the Site Editor.
- Content-only locking where editors should own the words without accidentally dismantling the composition.

## Engineering qualities

- Ten templates, each with one semantic **main** landmark and editable template parts.
- Visible keyboard focus, reduced-motion behavior, increased-contrast treatment, readable default contrast, and print styles.
- Responsive query compositions that adapt from editorial mosaics to a linear reading order.
- System serif, sans, and monospace stacks with fluid local type and spacing tokens.
- Block-aware Button CSS loaded with **wp_enqueue_block_style()**.
- Dependency-free structural validation, recursive style validation, PHP linting, and a reproducible installable ZIP.
- No front-end scripts, remote fonts, trackers, CSS framework, or remotely hosted theme assets.

## Local setup

The quickest option uses the official **@wordpress/env** package with its WordPress Playground runtime:

~~~bash
npm install
npm run env:start
~~~

Open http://localhost:8888, sign in with the credentials printed by wp-env, and activate **Fieldnote** under **Appearance → Themes** if needed. Stop the environment with:

~~~bash
npm run env:stop
~~~

You can also copy or symlink this repository into **wp-content/themes/fieldnote** in an existing WordPress 7.1 installation.

## Explore it in the Site Editor

1. Open **Appearance → Editor** and inspect the Front Page composition.
2. Edit the Announcement, Header, or Footer template part.
3. Switch Global Styles between the default, Ink, and Moss designs.
4. Apply Fieldnote Obsidian, Parchment, Signal, or Editorial Byline to a supported container.
5. Preview responsive block styles at the configured Mobile and Tablet viewports.
6. Insert any Fieldnote pattern and confirm content-only patterns protect their structure.

## Checks and packaging

Run the dependency-free validator:

~~~bash
npm test
~~~

Build the installable archive:

~~~bash
npm run package
~~~

The ZIP is written to **dist/fieldnote.zip**. GitHub Actions repeats structure, JSON, markup, contrast, screenshot, and packaging checks, then lints every PHP file across PHP 7.4, 8.2, 8.3, and 8.4.

## Engineering notes

The reasoning behind the design, responsive system, editorial controls, accessibility approach, and performance budget is recorded in [docs/DECISIONS.md](docs/DECISIONS.md). See [docs/TEST-RESULTS.md](docs/TEST-RESULTS.md) for verified results and [docs/TESTING.md](docs/TESTING.md) for the broader manual plan.

## Current limits

- Fieldnote covers a focused editorial use case rather than commerce or application UI.
- Automated checks cannot replace manual Site Editor, keyboard, browser, assistive-technology, RTL, and representative-content testing.
- The bundled example copy and links are starting points for an editor, not production publication content.

## License

Fieldnote is released under the GNU General Public License v2 or later.
