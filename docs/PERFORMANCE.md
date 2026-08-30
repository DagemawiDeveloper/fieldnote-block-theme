# Performance budget

Fieldnote aims for visual richness through composition, typography, tokens, and native blocks rather than runtime weight.

## Runtime constraints

- Zero theme front-end JavaScript.
- Zero companion-plugin front-end JavaScript.
- Zero remote fonts, CSS frameworks, analytics, or tracking calls.
- System font stacks to avoid font downloads and font-driven layout shifts.
- WordPress responsive image markup for featured media.
- One versioned shared composition stylesheet used on both the public site and in the editor.
- Block-aware Button CSS enqueued through `wp_enqueue_block_style()`.
- Editor scripts load only inside WordPress administration.

## Review budget

Representative production content should be checked against these targets before deployment:

| Signal | Target |
| --- | --- |
| Additional theme/plugin front-end JavaScript | 0 KB |
| Remote font requests | 0 |
| Unexpected third-party requests | 0 |
| Largest Contentful Paint | Under 2.5 seconds at the 75th percentile |
| Cumulative Layout Shift | Under 0.1 at the 75th percentile |
| Interaction to Next Paint | Under 200 ms at the 75th percentile |

Core Web Vitals depend heavily on hosting, cache policy, representative images, plugins, and real traffic. This repository therefore documents budgets but does not publish invented laboratory scores.
