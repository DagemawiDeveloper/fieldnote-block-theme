# Manual test plan

Automated validation catches release consistency, required files, JSON syntax, block attribute JSON, block-comment balance, pattern metadata, landmarks, recursive style variations, contrast targets, screenshot dimensions, responsive states, interaction states, and ZIP integrity. PHP syntax is checked separately in CI.

Those checks cannot prove that the editing and reading experiences are usable.

## Fast release checks

Run the dependency-free theme and companion-plugin validators, then build and inspect both archives:

~~~bash
npm test
npm run lint
npm run package:verify
unzip -t dist/fieldnote.zip
unzip -t dist/fieldnote-editorial-blocks.zip
~~~

## Editor and browser automation

Start WordPress 7.1 with the theme and companion plugin mounted, then run the critical Playwright flows:

~~~bash
npm ci
npx playwright install chromium firefox webkit
npm run env:start
npm run test:e2e
npm run env:stop
~~~

The suite verifies:

- Issue Details and Lead Story can be inserted in the editor.
- Important block attributes serialize into post content.
- A specifically selected story renders instead of relying on an accidental global query.
- Lead Story layout, image position, category, and excerpt controls affect the public output.
- An unavailable selection falls back without selecting the post that contains the block.
- Both public block components are visible with expected headings.
- A complete public story route has one header, main, and footer landmark.
- Search, 404, site-aware internal links, and a 390px viewport behave without routing or overflow regressions.
- Whole-page axe checks return no tested WCAG 2.0/2.1 A/AA violations.

The suite runs in desktop Chromium, mobile Chromium, Firefox, and WebKit. It intentionally covers critical paths, not every editor option or assistive-technology combination.

## Activation and routes

- Install the packaged ZIP on a clean WordPress 7.1 site with WP_DEBUG enabled.
- Activate Fieldnote and confirm there are no notices or recovery-mode errors.
- Check front page, posts page, fallback index, single post, page, wide page, category, tag, author, date archive, search, and 404 routes.
- Confirm the Page (Wide) template appears only for pages.
- Confirm header and footer landmarks are not duplicated by their inner Groups.

## Site Editor

- Open and save the Announcement, Header, and Footer template parts.
- Set and remove the Site Logo; confirm the brand line remains balanced.
- Create desktop and mobile Navigation menus, including nested items.
- Switch among the default, Ink, and Moss global designs.
- Apply Obsidian, Parchment, Signal, and Editorial Byline to supported containers.
- Inspect Mobile and Tablet responsive states at the configured 37.5rem and 64rem viewports.
- Inspect Button hover, focus-visible, and active states.
- Confirm the current Navigation Link receives its intended state.
- Insert all nine Fieldnote patterns and review their previews.
- Confirm the four content-only patterns allow copy and link changes but protect composition.
- Reset user customizations and confirm the theme files remain the source of truth.
- Insert Issue Details and edit its number, date, title, summary, colors, and spacing.
- Insert Lead Story, select a specific published post, and review both layouts and image positions.
- Remove the selected story and confirm the block falls back to the latest published post.
- Deactivate the companion plugin and confirm the default theme templates remain intact.

## Content stress cases

- Import WordPress Theme Unit Test data.
- Test very long titles, one-word titles, long contributor names, missing excerpts, missing featured images, and empty categories.
- Test nested lists, captions, pull quotes, quotes, galleries, tables, code, embeds, footnotes, and wide/full-aligned blocks.
- Add enough posts to exercise every pagination state.
- Confirm the story mosaic remains coherent with fewer than five posts.
- Confirm Category counts, author descriptions, search terms, and archive titles wrap safely.

## Responsive behavior

- Review at 320px, 375px, 600px, 768px, 1024px, 1280px, and 1600px.
- Confirm the lead-story mosaic becomes two columns on Tablet and one column on Mobile.
- Confirm Columns stack in a logical content order.
- Confirm header controls do not collide with a long site title.
- Confirm the overlay Navigation traps focus, closes with Escape, and restores focus.
- Confirm no block introduces horizontal scrolling at 200% and 400% zoom.

## Accessibility

- Navigate every route with only a keyboard.
- Confirm the core skip link appears and moves focus to main.
- Review heading order and landmark names with browser accessibility tools.
- Test menus, search, buttons, pagination, and post-navigation links with a screen reader.
- Verify default, Ink, Moss, and all section styles with automated contrast tooling, then review manually.
- Test prefers-reduced-motion, prefers-contrast, forced-colors, and browser text-only zoom.
- Confirm linked story-card overlays do not block category, date, or other interactive elements.

## Performance and resilience

- Verify the theme introduces no remote font, script, stylesheet, tracking, or image requests.
- Test with JavaScript disabled; all publication content and navigation links should remain available.
- Record Core Web Vitals only after representative images and content are loaded.
- Check the print preview for a single story.
- Test recent Chromium, Firefox, and Safari, then confirm progressive effects fail gracefully.
- Run an RTL pass before describing the theme as production-ready.
