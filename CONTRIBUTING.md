# Contributing to Fieldnote

Fieldnote is a focused portfolio project, but changes should still be reviewable and reproducible.

## Development loop

1. Create a small branch with one clear purpose.
2. Run `npm test` before starting WordPress.
3. Use `npm run env:start` for WordPress 7.1 with the theme and companion plugin mounted.
4. Test the changed editor flow and its public rendering at desktop, Tablet, and Mobile widths.
5. Run `npm run test:e2e` for changes affecting either custom block.
6. Run `npm run package` and inspect both ZIP files.
7. Record meaningful behavior or architectural changes in the changelog and relevant docs.

## Engineering expectations

- Prefer core blocks, `theme.json`, and WordPress APIs before adding custom behavior.
- Keep content behavior in the plugin and visual site structure in the theme.
- Do not add remote fonts, trackers, frameworks, or front-end scripts without a documented need and budget.
- Escape at output, sanitize at input, and preserve WordPress-generated wrapper attributes.
- Use accessible names and native controls; keyboard and narrow-screen behavior are part of completion.
- Add a regression check for a bug that can be reproduced automatically.
- Do not describe a manual or runtime check as passed unless it was actually completed for the current release.

## Versioning

Theme, plugin, block metadata, package metadata, and documentation share the same release number for this repository. A release is ready only when both installable archives build and the required CI jobs pass.
