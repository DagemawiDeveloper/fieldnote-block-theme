import fs from 'node:fs';
import path from 'node:path';
import process from 'node:process';

const root = path.resolve(import.meta.dirname, '..');
const errors = [];
const notes = [];

function relative(file) {
	return path.relative(root, file).replaceAll(path.sep, '/');
}

function fail(message) {
	errors.push(message);
}

function assert(condition, message) {
	if (!condition) {
		fail(message);
	}
}

function read(file) {
	return fs.readFileSync(path.join(root, file), 'utf8');
}

function listFiles(directory, extension, recursive = false) {
	const absolute = path.join(root, directory);
	if (!fs.existsSync(absolute)) {
		return [];
	}

	const found = [];
	for (const entry of fs.readdirSync(absolute, { withFileTypes: true })) {
		const item = path.join(absolute, entry.name);
		if (entry.isDirectory() && recursive) {
			found.push(...listFiles(relative(item), extension, true));
		} else if (entry.isFile() && entry.name.endsWith(extension)) {
			found.push(item);
		}
	}

	return found.sort();
}

function parseJson(file) {
	try {
		return JSON.parse(read(file));
	} catch (error) {
		fail(`${file}: invalid JSON (${error.message})`);
		return null;
	}
}

function validateBlockMarkup(file) {
	const source = fs.readFileSync(file, 'utf8');
	const stack = [];
	const comments = source.matchAll(/<!--\s*(\/?)wp:([a-z0-9-]+(?:\/[a-z0-9-]+)?)([\s\S]*?)-->/gi);
	let blockCount = 0;

	for (const match of comments) {
		blockCount += 1;
		const closing = match[1] === '/';
		const name = match[2];
		const tail = match[3];
		const selfClosing = /\/\s*$/.test(tail);

		if (closing) {
			const open = stack.pop();
			if (open !== name) {
				fail(`${relative(file)}: closing block ${name} does not match ${open ?? 'nothing'}`);
			}
			continue;
		}

		const attributes = tail.trim().replace(/\/\s*$/, '').trim();
		if (attributes.startsWith('{')) {
			try {
				JSON.parse(attributes);
			} catch (error) {
				fail(`${relative(file)}: ${name} has invalid JSON attributes (${error.message})`);
			}
		}

		if (!selfClosing) {
			stack.push(name);
		}
	}

	assert(blockCount > 0, `${relative(file)}: no WordPress block markup found`);
	assert(stack.length === 0, `${relative(file)}: unclosed blocks: ${stack.join(', ')}`);
}

function findKeys(value, wanted, found = []) {
	if (!value || typeof value !== 'object') {
		return found;
	}
	for (const [key, child] of Object.entries(value)) {
		if (wanted.has(key)) {
			found.push(key);
		}
		findKeys(child, wanted, found);
	}
	return found;
}

function contrast(hexA, hexB) {
	const luminance = (hex) => {
		const rgb = hex
			.replace('#', '')
			.match(/.{2}/g)
			.map((channel) => Number.parseInt(channel, 16) / 255)
			.map((channel) => (channel <= 0.04045 ? channel / 12.92 : ((channel + 0.055) / 1.055) ** 2.4));
		return 0.2126 * rgb[0] + 0.7152 * rgb[1] + 0.0722 * rgb[2];
	};
	const light = Math.max(luminance(hexA), luminance(hexB));
	const dark = Math.min(luminance(hexA), luminance(hexB));
	return (light + 0.05) / (dark + 0.05);
}

const requiredFiles = [
	'style.css',
	'theme.json',
	'functions.php',
	'screenshot.png',
	'templates/front-page.html',
	'templates/index.html',
	'parts/announcement.html',
	'parts/header.html',
	'parts/footer.html',
];

for (const file of requiredFiles) {
	assert(fs.existsSync(path.join(root, file)), `${file}: required file is missing`);
}

const stylesheet = read('style.css');
for (const header of [
	'Theme Name: Fieldnote',
	'Version: 1.0.0',
	'Text Domain: fieldnote',
	'Requires at least: 7.1',
	'Tested up to: 7.1',
	'Requires PHP: 7.4',
]) {
	assert(stylesheet.includes(header), `style.css: missing header '${header}'`);
}
assert(stylesheet.includes(':focus-visible'), 'style.css: focus-visible treatment is missing');
assert(stylesheet.includes('prefers-reduced-motion'), 'style.css: reduced-motion treatment is missing');
assert(stylesheet.includes('prefers-contrast'), 'style.css: increased-contrast treatment is missing');
assert(stylesheet.includes('@media print'), 'style.css: print treatment is missing');
assert(!/@import\s/i.test(stylesheet), 'style.css: render-blocking @import is not allowed');
assert(!/url\(\s*["']?https?:/i.test(stylesheet), 'style.css: remote assets are not allowed');

const theme = parseJson('theme.json');
if (theme) {
	assert(theme.$schema === 'https://schemas.wp.org/trunk/theme.json', 'theme.json: use the official schema URL');
	assert(theme.version === 3, 'theme.json: schema version must be 3');
	assert(theme.settings?.appearanceTools === true, 'theme.json: appearanceTools should be enabled');
	assert(theme.settings?.useRootPaddingAwareAlignments === true, 'theme.json: root-padding-aware alignments should be enabled');
	assert(theme.settings?.viewport?.mobile === '37.5rem', 'theme.json: configured mobile viewport is missing');
	assert(theme.settings?.viewport?.tablet === '64rem', 'theme.json: configured tablet viewport is missing');

	const states = findKeys(theme.styles, new Set(['@mobile', '@tablet', ':hover', ':focus-visible', ':active', '-current']));
	for (const state of ['@mobile', '@tablet', ':hover', ':focus-visible', ':active', '-current']) {
		assert(states.includes(state), `theme.json: WordPress 7.1 state '${state}' is not demonstrated`);
	}
	assert(theme.styles?.blocks?.['core/button']?.[':hover'], 'theme.json: Button hover state is missing');
	assert(theme.styles?.blocks?.['core/navigation-link']?.['-current'], 'theme.json: current Navigation Link state is missing');

	const palette = Object.fromEntries((theme.settings?.color?.palette ?? []).map((item) => [item.slug, item.color]));
	assert(contrast(palette.ink, palette.canvas) >= 7, 'theme.json: default ink/canvas contrast should exceed 7:1');
	assert(contrast(palette.white, palette.clay) >= 4.5, 'theme.json: white/clay contrast should meet WCAG AA for normal text');

	for (const part of theme.templateParts ?? []) {
		assert(fs.existsSync(path.join(root, 'parts', `${part.name}.html`)), `theme.json: template part '${part.name}' has no matching file`);
	}
	const templatePartAreas = Object.fromEntries((theme.templateParts ?? []).map((part) => [part.name, part.area]));
	assert(templatePartAreas.announcement === 'general', 'theme.json: announcement template part must use the general area');
	assert(templatePartAreas.header === 'header', 'theme.json: header template part must use the header area');
	assert(templatePartAreas.footer === 'footer', 'theme.json: footer template part must use the footer area');

	for (const template of theme.customTemplates ?? []) {
		assert(fs.existsSync(path.join(root, 'templates', `${template.name}.html`)), `theme.json: custom template '${template.name}' has no matching file`);
	}
}

const styleFiles = listFiles('styles', '.json', true);
let globalVariationCount = 0;
let scopedVariationCount = 0;
for (const file of styleFiles) {
	try {
		const variation = JSON.parse(fs.readFileSync(file, 'utf8'));
		assert(variation.version === 3, `${relative(file)}: schema version must be 3`);
		assert(typeof variation.title === 'string' && variation.title.length > 0, `${relative(file)}: title is required`);
		if (variation.blockTypes) {
			scopedVariationCount += 1;
			assert(typeof variation.slug === 'string' && variation.slug.startsWith('fieldnote-'), `${relative(file)}: scoped variation needs a namespaced slug`);
			assert(Array.isArray(variation.blockTypes) && variation.blockTypes.length > 0, `${relative(file)}: blockTypes are required`);
		} else {
			globalVariationCount += 1;
		}
	} catch (error) {
		fail(`${relative(file)}: invalid JSON (${error.message})`);
	}
}
assert(globalVariationCount >= 2, 'styles: expected at least two global style variations');
assert(scopedVariationCount >= 4, 'styles: expected at least four section or block style variations');

const templateFiles = listFiles('templates', '.html');
for (const file of templateFiles) {
	const source = fs.readFileSync(file, 'utf8');
	validateBlockMarkup(file);
	assert(source.includes('"slug":"header"'), `${relative(file)}: header template part is missing`);
	assert(source.includes('"slug":"footer"'), `${relative(file)}: footer template part is missing`);
	assert(source.includes('"tagName":"main"'), `${relative(file)}: semantic main landmark is missing`);
	assert(!(/wp:template-part[^>]*"tagName":"(?:header|footer)"/.test(source)), `${relative(file)}: template-part wrappers must not duplicate header or footer landmarks`);
}
assert(templateFiles.length >= 10, 'templates: expected at least ten template files');

const partFiles = listFiles('parts', '.html');
for (const file of partFiles) {
	validateBlockMarkup(file);
}
assert(read('parts/header.html').includes('"slug":"announcement"'), 'parts/header.html: announcement template part is missing');
assert(read('parts/header.html').includes('wp:navigation'), 'parts/header.html: Navigation block is missing');
assert(!read('parts/header.html').includes('"tagName":"header"'), 'parts/header.html: inner group must not duplicate the template-part header landmark');
assert(!read('parts/footer.html').includes('"tagName":"footer"'), 'parts/footer.html: inner group must not duplicate the template-part footer landmark');

const patternSlugs = new Set();
const patternFiles = listFiles('patterns', '.php');
for (const file of patternFiles) {
	const source = fs.readFileSync(file, 'utf8');
	const header = source.match(/<\?php\s*\/\*\*([\s\S]*?)\*\//)?.[1] ?? '';
	const field = (name) => header.match(new RegExp(`\\*\\s*${name}:\\s*(.+)`))?.[1]?.trim();
	const title = field('Title');
	const slug = field('Slug');
	const description = field('Description');

	assert(Boolean(title), `${relative(file)}: pattern Title header is missing`);
	assert(Boolean(slug), `${relative(file)}: pattern Slug header is missing`);
	assert(Boolean(description), `${relative(file)}: accessible Description header is missing`);
	if (slug) {
		assert(slug.startsWith('fieldnote/'), `${relative(file)}: pattern slug must use the fieldnote namespace`);
		assert(!patternSlugs.has(slug), `${relative(file)}: duplicate pattern slug '${slug}'`);
		patternSlugs.add(slug);
	}
	if (source.includes('"border":{"color"')) {
		assert(source.includes('has-border-color'), `${relative(file)}: serialized border color class is missing`);
	}
	validateBlockMarkup(file);
}

assert(patternFiles.length >= 9, 'patterns: expected at least nine bundled editorial patterns');
for (const lockedPattern of ['home-hero.php', 'editorial-callout.php', 'editorial-manifesto.php', 'newsletter.php']) {
	assert(read(`patterns/${lockedPattern}`).includes('"templateLock":"contentOnly"'), `patterns/${lockedPattern}: content-only editorial lock is missing`);
}

const packageJson = parseJson('package.json');
assert(packageJson?.version === '1.0.0', 'package.json: version must match the theme release');
assert(read('readme.txt').includes('Stable tag: 1.0.0'), 'readme.txt: stable tag must match the theme release');

const screenshotPath = path.join(root, 'screenshot.png');
const screenshot = fs.existsSync(screenshotPath) ? fs.readFileSync(screenshotPath) : null;
assert(screenshot && screenshot.length > 20_000, 'screenshot.png: expected a substantial 1200x900 preview image');
if (screenshot?.subarray(1, 4).toString() === 'PNG') {
	assert(screenshot.readUInt32BE(16) === 1200, 'screenshot.png: width must be 1200 pixels');
	assert(screenshot.readUInt32BE(20) === 900, 'screenshot.png: height must be 900 pixels');
}

notes.push(`${templateFiles.length} templates`);
notes.push(`${partFiles.length} template parts`);
notes.push(`${patternFiles.length} patterns`);
notes.push(`${globalVariationCount} global styles`);
notes.push(`${scopedVariationCount} section/block styles`);
notes.push('WordPress 7.1 responsive and interaction states');

if (errors.length > 0) {
	console.error('Fieldnote validation failed:');
	for (const error of errors) {
		console.error(`- ${error}`);
	}
	process.exit(1);
}

console.log(`Fieldnote validation passed (${notes.join(', ')}).`);
