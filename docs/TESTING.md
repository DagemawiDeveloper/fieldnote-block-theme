# Manual test plan

Automated validation catches structure, JSON, pattern metadata, block-comment balance, required landmarks, missing files, and PHP syntax in CI. It cannot prove that the Site Editor experience is usable.

## Theme activation

- Activate Fieldnote with `WP_DEBUG` enabled and confirm there are no notices.
- Confirm the front page, posts page, single post, normal page, archive, search, and 404 routes render.
- Confirm the Page (Wide) template appears for pages.

## Site Editor

- Edit and save the Header and Footer template parts.
- Change the site logo, site title, and Navigation block.
- Switch between the default design and the Ink style variation.
- Modify palette, typography, and spacing controls and verify editor/front-end parity.
- Insert every Fieldnote pattern and verify its preview.
- Confirm content-only locked patterns allow copy edits but protect their layout.
- Reset user customizations and confirm the theme files remain the source of truth.

## Content stress cases

- Import WordPress Theme Unit Test data.
- Check long titles, empty excerpts, missing featured images, nested lists, captions, pull quotes, galleries, tables, and embeds.
- Test archive and search empty states.
- Test pagination with enough posts to produce multiple pages.

## Accessibility

- Navigate every template using only a keyboard.
- Confirm the skip link appears and moves focus to `main`.
- Test the responsive Navigation block and submenu states.
- Verify visible focus at 200% and 400% zoom.
- Check heading order and landmark names with browser accessibility tools.
- Test default and Ink palettes with an automated contrast tool, then review manually.
- Test with at least one desktop screen reader before calling the theme production-ready.

## Responsive and performance checks

- Review 320px, 768px, 1024px, and wide desktop layouts.
- Confirm grids collapse without horizontal scrolling.
- Inspect image dimensions and responsive `srcset` output.
- Verify no remote font, script, or stylesheet requests are introduced by the theme.
- Record Lighthouse results only after testing representative real content.

