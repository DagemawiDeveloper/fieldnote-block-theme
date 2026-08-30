# Accessibility approach

Fieldnote treats accessibility as a design constraint rather than a final audit label. The project does not claim formal certification.

## Built-in measures

- One semantic main landmark per template and no duplicate Header or Footer landmarks.
- Visible three-pixel keyboard focus with a dedicated focus color.
- Default text contrast above 7:1 and validated Button contrast at WCAG AA.
- Responsive reading order that remains linear when editorial mosaics collapse.
- Reduced-motion, increased-contrast, forced-colors-friendly foundations, and print treatments.
- Core Navigation behavior instead of a custom menu implementation.
- Accessible names on linked story artwork and on the Issue Details region.
- Semantic headings, time values, article wrappers, and real links in both custom blocks.

## Automated coverage

The Playwright suite inserts both custom blocks through the WordPress editor, renders them through a real WordPress request, and runs axe against the two block components using WCAG 2.0 and 2.1 A/AA tags.

Automated results are a regression signal, not proof that a complete publication is barrier-free.

## Required manual release pass

- Keyboard-only navigation through header, content, blocks, pagination, search, and footer.
- Browser zoom at 200% and 400% with no lost content or horizontal page scrolling.
- VoiceOver or NVDA review of landmarks, headings, repeated story links, and Navigation behavior.
- Reduced motion, increased contrast, and forced-colors review.
- Editor review at configured Mobile and Tablet viewports.
- RTL review before claiming RTL production support.
