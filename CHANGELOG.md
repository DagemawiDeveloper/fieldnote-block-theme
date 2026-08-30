# Changelog

## 1.0.1 - 2026-08-30

- Replaced root-relative publication links with site-aware URLs and added a validator that prevents regressions.
- Added five hidden utility patterns so template parts retain native block markup while resolving links through WordPress.
- Replaced auto-generated Page List navigation with explicit Navigation Link blocks to preserve valid list semantics.
- Added a contextual link-color token so links retain WCAG AA contrast on announcement and footer surfaces.
- Explicitly enqueued the shared composition stylesheet on the public site and added a browser regression assertion for it.
- Prevented Lead Story fallback queries from selecting the post containing the block.
- Added a locked Node toolchain, WordPress JavaScript/CSS linting, WordPress PHP coding standards, Theme Check, and Plugin Check.
- Made both ZIP builders deterministic and added repeated-build SHA-256 verification.
- Expanded Playwright coverage to desktop Chromium, mobile Chromium, Firefox, and WebKit, including full-route axe, responsive overflow, search, 404, portable-link, fallback, and presentation-control cases.

## 1.0.0 - 2026-08-30

- Added the optional Fieldnote Editorial Blocks companion plugin without coupling the theme to it.
- Added a server-rendered Issue Details block with editable metadata and accessible regional labeling.
- Added a server-rendered Lead Story block with core-data post selection, two layouts, resilient fallbacks, and live editor preview.
- Added two companion-plugin patterns for editorial mastheads and lead dispatches.
- Added a one-click WordPress Playground blueprint with nine fictional stories, four original local illustrations, author profiles, categories, supporting pages, and a dedicated block lab.
- Added Playwright coverage for editor insertion, serialized attributes, front-end rendering, and scoped axe WCAG checks.
- Added separate reproducible theme and plugin ZIP packages.
- Added architecture, accessibility, performance, testing, and contribution documentation.
- Promoted the theme and companion system to the first portfolio release.

## 0.2.0 - 2026-08-30

- Rebuilt the visual direction as a modern field journal with a coherent editorial front page.
- Moved to theme.json schema version 3 and WordPress 7.1 native responsive, pseudo, and current-navigation states.
- Expanded the system to ten templates, three template parts, nine patterns, two global variations, and four scoped styles.
- Added an asymmetric story mosaic, live topic index, author archive, richer single-post treatment, reader invitation, and editorial manifesto.
- Added configurable 37.5rem and 64rem viewports with matching resilient CSS compositions.
- Added increased-contrast and print treatments while retaining visible focus and reduced-motion behavior.
- Expanded structural validation to cover recursive style files, block attribute JSON, release consistency, contrast, screenshot dimensions, and 7.1 features.

## 0.1.0 - 2026-08-30

- Added the initial block-theme design system and alternate Ink style variation.
- Added editable header and footer template parts.
- Added home, index, single, page, wide-page, archive, search, and 404 templates.
- Added four editorial patterns, including two content-only locked layouts.
- Added accessibility-oriented focus, landmark, navigation, and reduced-motion behavior.
- Added structural validation, PHP linting in CI, local Playground setup, and ZIP packaging.
