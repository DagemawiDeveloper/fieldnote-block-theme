# Engineering decisions

This note records why Fieldnote is structured the way it is. The goal is to make the trade-offs reviewable rather than hide them behind a polished screenshot.

## Native blocks first

The theme uses core blocks, `theme.json`, HTML templates, and PHP pattern files. It does not introduce JavaScript for behavior that WordPress already provides. That keeps the editor and front end closer together and reduces code that must be maintained.

PHP remains useful for registering the Fieldnote pattern category, loading an editor stylesheet, loading Button CSS only when the block is used, and translating bundled pattern text.

## Editorial control without a locked-down editor

Most templates stay flexible in the Site Editor. The Editorial hero and Editorial callout use `templateLock: "contentOnly"` because their structure is easy to break but their copy should remain editable. This is a focused example of protecting layout while preserving editorial ownership.

## Design tokens over scattered CSS

Colors, spacing, typography, layout widths, element styles, and most block styles live in `theme.json`. This gives editors a coherent Styles interface and reduces drift between front-end and editor rendering. CSS is reserved for visible focus, reduced motion, small utilities, and the block-specific Button interaction.

## Accessibility as structure

Every top-level template contains a `main` landmark. WordPress can use that landmark to generate a skip-to-content link. Header and footer template parts use their corresponding landmarks, and the core Navigation block supplies keyboard behavior and ARIA state. Focus remains clearly visible, motion is reduced when requested, and the default palette is designed for readable contrast.

Those choices do not make the theme automatically accessible. Manual keyboard, zoom, screen-reader, contrast, and real-content tests are still required.

## Performance budget

Fieldnote ships no front-end JavaScript, remote fonts, tracking code, image library, or CSS framework. System fonts avoid network requests. WordPress loads the small Button stylesheet through `wp_enqueue_block_style()`, which allows block-aware loading and inlining. Content images remain WordPress-managed so responsive image attributes and loading behavior come from core.

## Compatibility

The theme requires WordPress 6.6 and is tested against the WordPress 7.1 structure. It uses `theme.json` schema version 2 because that remains the current version in the official Theme Handbook. PHP code avoids syntax newer than PHP 7.4.

