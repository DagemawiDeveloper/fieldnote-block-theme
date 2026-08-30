# Accessibility approach

Fieldnote treats accessibility as a design constraint rather than a final audit label. The project does not claim formal certification.

## Built-in measures

- One semantic main landmark per template and no duplicate Header or Footer landmarks.
- Visible three-pixel keyboard focus with a dedicated focus color.
- Default text contrast above 7:1 and validated Button contrast at WCAG AA.
- Responsive reading order that remains linear when editorial mosaics collapse.
- Reduced-motion, increased-contrast, forced-colors-friendly foundations, and print treatments.
- Core Navigation and explicit Navigation Link blocks instead of a custom menu implementation or invalid nested Page List markup.
- Context-aware link colors that preserve the intended light-on-dark contrast in the announcement and footer.
- Accessible names on linked story artwork and on the Issue Details region.
- Semantic headings, time values, article wrappers, and real links in both custom blocks.

## Automated coverage

The Playwright suite inserts both custom blocks through the WordPress editor, renders them through a real WordPress request, and runs axe using WCAG 2.0 and 2.1 A/AA tags. It also audits a complete public story route, verifies semantic page landmarks, and checks narrow-screen overflow across desktop Chromium, mobile Chromium, Firefox, and WebKit projects.

Automated results are a regression signal, not proof that a complete publication is barrier-free.

## Required manual release pass

- Keyboard-only navigation through header, content, blocks, pagination, search, and footer.
- Browser zoom at 200% and 400% with no lost content or horizontal page scrolling.
- VoiceOver or NVDA review of landmarks, headings, repeated story links, and Navigation behavior.
- Reduced motion, increased contrast, and forced-colors review.
- Editor review at configured Mobile and Tablet viewports.
- RTL review before claiming RTL production support.
