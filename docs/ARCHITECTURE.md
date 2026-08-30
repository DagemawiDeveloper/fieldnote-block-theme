# Fieldnote architecture

Fieldnote 1.0 is an editorial system with two installable units and one disposable demonstration layer. The boundary is intentional: design belongs to the theme, reusable content behavior belongs to the plugin, and sample publication data belongs only to the demo.

## Repository topology

| Area | Responsibility | Ships to a production installation? |
| --- | --- | --- |
| Theme root | Templates, template parts, patterns, global styles, design tokens, and progressive presentation | Yes, as `fieldnote.zip` |
| `plugins/fieldnote-editorial-blocks` | Dynamic Issue Details and Lead Story blocks plus their editor patterns | Optional, as `fieldnote-editorial-blocks.zip` |
| `demo` and `blueprint.json` | Fictional stories, local illustration assets, and one-click Playground setup | No |
| `scripts` and `tests` | Static validation, packaging, Playwright editor flows, and accessibility checks | No |

## Render flow

### Theme

WordPress reads `theme.json`, resolves the requested block template, and composes reusable template parts and PHP patterns. Core blocks handle publication queries and content rendering. The theme adds layout and accessibility refinements through local CSS, with a small `functions.php` limited to editor styles, pattern categories, and block-aware Button CSS.

### Issue Details

1. The editor script manages issue attributes through native RichText and Inspector Controls.
2. The post stores only block attributes; `save()` returns `null`.
3. WordPress invokes `render.php` on every view.
4. PHP applies defaults, builds an accessible section label, escapes editor values, and preserves generated block-support attributes.

### Lead Story

1. The editor uses the WordPress core-data store to list recent published posts.
2. ServerSideRender provides a faithful preview rather than maintaining duplicate preview markup.
3. The saved attributes contain a post ID and presentation choices, not copied post content.
4. PHP validates that the selected object is a published post and falls back to the latest published post when it is missing or unavailable.
5. Core APIs supply the title, permalink, image, category, author, date, and excerpt. The public page receives CSS and semantic HTML, but no plugin JavaScript.

## Portability boundary

The theme never requires the companion plugin. Its default templates contain only core blocks and theme-owned patterns. The plugin registers its own patterns so an editor can use the blocks with Fieldnote or another compatible block theme.

Likewise, neither installable ZIP contains the Playground seed. Demo content cannot silently appear in a real publication.

## Failure behavior

- An unavailable selected story falls back to the latest published post.
- A publication with no posts receives no Lead Story output instead of broken placeholder markup.
- A post without a featured image receives a local CSS placeholder with a readable editorial treatment.
- Failure to download demo artwork does not stop Playground from creating the sample posts.
- Unsupported progressive CSS effects fall back to solid colors, borders, and normal document flow.

## Quality gates

The fast suite validates file structure, JSON, serialized block markup, version consistency, contrast pairs, responsive states, block metadata, asset declarations, packaging boundaries, and editor-script syntax. GitHub Actions adds PHP linting across the supported matrix and Playwright checks for block insertion, saved attributes, server-rendered output, and WCAG-focused axe results.
