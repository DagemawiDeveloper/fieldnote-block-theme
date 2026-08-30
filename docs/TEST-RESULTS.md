# Verification results

## Fieldnote 1.0.0

Local release checks completed on August 30, 2026:

- Theme validation passes for ten templates, three template parts, nine patterns, two global styles, four section/block styles, and the WordPress 7.1 responsive and interaction states.
- Companion-plugin validation passes for two metadata-registered dynamic blocks, two editor patterns, four local demo images, the one-click Playground blueprint, and Playwright/axe coverage files.
- Every editor JavaScript and test file passes Node syntax checking.
- Both installable archives build successfully and pass ZIP integrity checks.
- Visual review passed for the four local demo illustrations and the 1600×1000 editorial-blocks preview.

The [Fieldnote 1.0 release workflow](https://github.com/DagemawiDeveloper/fieldnote-block-theme/actions/runs/33333614856) also completed successfully on August 30, 2026. It confirmed:

- PHP syntax across PHP 7.4, 8.2, 8.3, and 8.4.
- Theme and plugin package integrity from a clean checkout.
- Insertion and serialization of both dynamic blocks in the WordPress 7.1 editor.
- Selection and PHP rendering of a published Lead Story on the public site.
- No scoped axe violations in the Issue Details and Lead Story output for the tested WCAG 2.0/2.1 A and AA rules.

The current workspace does not provide a native PHP binary or a stable interactive WordPress browser runtime, so those runtime results come from the required public GitHub Actions jobs rather than being represented as local checks.

## Fieldnote 0.2.0

Repository checks completed on August 30, 2026:

- All ten templates contain balanced block markup, a Header, a semantic main landmark, and a Footer.
- All three template parts and nine PHP patterns contain valid block attribute JSON and balanced block comments.
- Both global styles and all four section/block styles parse as theme.json schema version 3 files.
- The design system includes WordPress 7.1 Mobile, Tablet, hover, focus-visible, active, and current-navigation states.
- Release numbers agree across style.css, package.json, and readme.txt.
- The default ink/canvas and white/clay pairs meet the validator’s contrast thresholds.
- The installable ZIP is reproducible and its contents are inspected by CI.
- PHP syntax is checked across PHP 7.4, 8.2, 8.3, and 8.4 in GitHub Actions.

The 0.2.0 package still needs a fresh interactive Site Editor and front-end pass before it should be described as production-ready. The broader cases are listed in TESTING.md.

## Fieldnote 0.1.0 baseline

The previous 0.1.0 package was interactively installed and activated in WordPress Playground on August 30, 2026 using WordPress 7.1 and PHP 8.3.32.

That pass confirmed theme activation, registration of the earlier eight templates, two template parts, four patterns, the wide-page template, and the Ink variation. It also caught and led to fixes for duplicate Header/Footer landmarks and one missing serialized border class.

That earlier runtime result is useful evidence for the project setup, but it is not presented as an interactive verification of the redesigned 0.2.0 release.
