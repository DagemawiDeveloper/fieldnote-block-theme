# WordPress 7.1 verification

Tested on August 30, 2026 in WordPress Playground with WordPress 7.1 and PHP 8.3.32.

## Passed

- The packaged ZIP installed and activated without PHP errors.
- WordPress registered all eight templates, both template parts, the Page (Wide) custom template, four Fieldnote patterns, and the Ink style variation.
- The home page rendered with one header landmark, one main landmark, one footer landmark, and the core skip-to-content link.
- The Site Editor loaded the complete home layout as native blocks without an invalid-block warning.
- Templates, template parts, patterns, Navigation, and the Ink variation were available through their Site Editor screens.
- The final package passed the repository's structural validation and ZIP integrity check.

## Issues found during testing

- Header and footer landmarks were initially duplicated because semantics were set on both the template-part wrapper and its inner Group block. The inner landmarks were removed, and the validator now checks the intended structure.
- The Editorial callout initially omitted Gutenberg's serialized `has-border-color` class. The class and a matching validation rule were added.

## Still manual

This check does not replace the broader plan in [TESTING.md](TESTING.md). Dedicated screen-reader, RTL, Theme Unit Test data, older-browser, and representative-content performance testing remain before the theme should be described as production-ready.
