# Engineering decisions

This note records the reasoning behind Fieldnote 1.0. The intent is to make the work reviewable: each visual choice and technical boundary should have a clear editorial or engineering purpose.

## Theme and plugin are separate products

Fieldnote 1.0 adds custom editorial behavior without placing it in the theme. The companion plugin owns Issue Details and Lead Story because those blocks can become part of saved post content. A publication should be able to change its theme without losing the code that renders that content.

The default theme still uses only core blocks and theme-owned patterns. It does not break or show missing blocks when the optional plugin is inactive. The plugin also carries its own patterns so it remains useful with another compatible block theme.

## Two custom blocks, not a private block library

The plugin deliberately contains two blocks:

- Issue Details gives repeated publication metadata a stable, accessible structure.
- Lead Story solves a real editorial selection problem that Query Loop cannot express as directly for a single curated article.

Both are dynamic. The saved post stores concise attributes, PHP owns public markup, and the editor uses WordPress packages instead of a parallel front-end application. Lead Story delegates post discovery to the core-data store and its preview to ServerSideRender. This avoids duplicating WordPress query and rendering behavior in JavaScript.

No custom front-end script is justified for either block.

## The demo is disposable

The one-click Playground setup uses fictional publication content and original repository-owned artwork. The seed is idempotent and excluded from both release ZIPs. A normal installation therefore never receives sample users, posts, media, settings, or pages.

## A publication, not a component gallery

The design direction is “modern field journal”: tactile paper colors, a precise mono accent, an editorial serif, asymmetric story rhythm, and restrained clay, moss, and saffron signals.

The front page reads as one issue:

1. The hero establishes the issue and publication voice.
2. The story mosaic gives one lead article more visual weight.
3. The topic index offers a second, non-chronological path into the archive.
4. The manifesto states the editorial standard.
5. The archive grid supports deeper browsing.
6. The field-letter panel ends with one clear reader action.

This sequence is deliberate. Patterns remain individually reusable, but the default composition demonstrates product thinking beyond isolated blocks.

## Native WordPress 7.1 features

Fieldnote now requires WordPress 7.1 because its design system uses the release directly:

- theme.json schema version 3.
- Configurable Mobile and Tablet viewports at 37.5rem and 64rem.
- Native @mobile and @tablet style states.
- Button hover, focus-visible, and active states.
- Navigation Link hover, focus-visible, and current-page states.
- Background gradients in the background style group.

The CSS layout breakpoints match the configured WordPress viewports. This keeps the editor preview, generated block styles, and hand-authored editorial compositions aligned.

## Section styles instead of one-off classes

Obsidian, Parchment, Signal, and Editorial Byline are JSON-registered block style variations. Editors can apply them through the normal Styles interface to supported Group and Columns blocks.

These styles encode a whole context—surface, text, links, spacing, and selected nested blocks—rather than a single color utility. Pattern-specific CSS is reserved for compositions such as the story mosaic where relationships between repeated query items cannot be expressed cleanly through theme.json alone.

## Editorial freedom with guarded structure

Most templates remain fully editable in the Site Editor. Four high-value patterns use content-only locking:

- Field journal hero
- Editorial manifesto
- Editorial note
- Field letter invitation

Editors can change the words and destinations while the hierarchy, spacing, and responsive composition remain intact. Query patterns and general page sections stay unlocked because their structure is part of normal editorial iteration.

## Performance budget

The Fieldnote theme and companion plugin ship no front-end JavaScript, remote fonts, analytics, image library, CSS framework, or required external service.

System serif, sans, and mono stacks remove font requests and avoid layout shifts. WordPress handles responsive content images. Button interaction CSS is loaded through wp_enqueue_block_style(), allowing core to load or inline it in a block-aware way.

The shared composition stylesheet is explicitly enqueued on the public site and registered as an editor style. This gives responsive editorial layouts and progressive enhancements one versioned source of truth across both surfaces; a Playwright assertion protects the public enqueue from regression.

The richer visual result comes from tokens, native blocks, layout, color, and type—not from a heavier runtime.

## Accessibility as a system constraint

Every template includes a semantic main landmark. Header and Footer are represented only by their template-part areas, avoiding duplicate landmarks. Core Navigation retains its keyboard and ARIA behavior.

The default header and footer use explicit core Navigation Link blocks rather than an empty Navigation block that auto-inserts Page List. This keeps WordPress-native overlay behavior while ensuring each generated list has only valid list-item children. The links live in hidden PHP patterns so `home_url()` resolves correctly for root, subdirectory, and multisite installations.

The global link color resolves through a contextual `--fieldnote-link-color` token. Light sections use the accessible clay-dark default, while dark announcement and footer surfaces set the token to white. This avoids a cascade-specific override and keeps dynamically generated category and policy links at the same accessible contrast.

The theme also includes:

- A visible three-pixel focus treatment.
- Default ink/canvas contrast above 7:1.
- Reduced-motion handling for every animated or transitioned element.
- A higher-contrast media-query treatment.
- A linear mobile reading order for query mosaics.
- Print rules that remove navigation and reader-acquisition panels.
- Underline thickness and offset tuned for legibility.

These choices reduce predictable barriers, but they do not replace manual keyboard, zoom, screen-reader, forced-colors, contrast, and real-content testing.

## Progressive enhancement

Backdrop blur, color-mix, and masking add texture in capable browsers. The publication remains readable without them: solid theme colors, real borders, and normal document flow provide the baseline.

Likewise, the story mosaic is a CSS enhancement over a semantic Post Template list. At narrow widths it becomes a one-column reading sequence without changing the content order.
