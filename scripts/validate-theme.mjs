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

function listFiles(directory, extension) {
	const absolute = path.join(root, directory);
	if (!fs.existsSync(absolute)) {
		return [];
	}

	return fs
		.readdirSync(absolute, { withFileTypes: true })
		.filter((entry) => entry.isFile() && entry.name.endsWith(extension))
		.map((entry) => path.join(absolute, entry.name))
		.sort();
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
		} else if (!selfClosing) {
			stack.push(name);
		}
	}

	assert(blockCount > 0, `${relative(file)}: no WordPress block markup found`);
	assert(stack.length === 0, `${relative(file)}: unclosed blocks: ${stack.join(', ')}`);
}

const requiredFiles = [
	'style.css',
	'theme.json',
	'functions.php',
	'screenshot.png',
	'templates/index.html',
	'parts/header.html',
	'parts/footer.html',
];

for (const file of requiredFiles) {
	assert(fs.existsSync(path.join(root, file)), `${file}: required file is missing`);
}

const stylesheet = read('style.css');
for (const header of [
	'Theme Name: Fieldnote',
	'Version: 0.1.0',
	'Text Domain: fieldnote',
	'Requires at least: 6.6',
	'Tested up to: 7.1',
]) {
	assert(stylesheet.includes(header), `style.css: missing header '${header}'`);
}
assert(stylesheet.includes(':focus-visible'), 'style.css: focus-visible treatment is missing');
assert(stylesheet.includes('prefers-reduced-motion'), 'style.css: reduced-motion treatment is missing');
assert(!/@import\s/i.test(stylesheet), 'style.css: remote or render-blocking @import is not allowed');
assert(!/url\(\s*["']?https?:/i.test(stylesheet), 'style.css: remote assets are not allowed');

const theme = parseJson('theme.json');
if (theme) {
	assert(theme.$schema === 'https://schemas.wp.org/trunk/theme.json', 'theme.json: use the official schema URL');
	assert(theme.version === 2, 'theme.json: schema version must be 2');
	assert(theme.settings?.appearanceTools === true, 'theme.json: appearanceTools should be enabled');
	assert(theme.settings?.useRootPaddingAwareAlignments === true, 'theme.json: root-padding-aware alignments should be enabled');

	for (const part of theme.templateParts ?? []) {
		assert(fs.existsSync(path.join(root, 'parts', `${part.name}.html`)), `theme.json: template part '${part.name}' has no matching file`);
	}
	const templatePartAreas = Object.fromEntries(
		(theme.templateParts ?? []).map((part) => [part.name, part.area]),
	);
	assert(templatePartAreas.header === 'header', 'theme.json: header template part must use the header area');
	assert(templatePartAreas.footer === 'footer', 'theme.json: footer template part must use the footer area');

	for (const template of theme.customTemplates ?? []) {
		assert(fs.existsSync(path.join(root, 'templates', `${template.name}.html`)), `theme.json: custom template '${template.name}' has no matching file`);
	}
}

for (const file of listFiles('styles', '.json')) {
	try {
		const variation = JSON.parse(fs.readFileSync(file, 'utf8'));
		assert(variation.version === 2, `${relative(file)}: schema version must be 2`);
		assert(typeof variation.title === 'string' && variation.title.length > 0, `${relative(file)}: title is required`);
	} catch (error) {
		fail(`${relative(file)}: invalid JSON (${error.message})`);
	}
}

const templateFiles = listFiles('templates', '.html');
for (const file of templateFiles) {
	const source = fs.readFileSync(file, 'utf8');
	validateBlockMarkup(file);
	assert(source.includes('"slug":"header"'), `${relative(file)}: header template part is missing`);
	assert(source.includes('"slug":"footer"'), `${relative(file)}: footer template part is missing`);
	assert(source.includes('"tagName":"main"'), `${relative(file)}: semantic main landmark is missing`);
	assert(
		!(/wp:template-part[^>]*"tagName":"(?:header|footer)"/.test(source)),
		`${relative(file)}: template-part wrappers must not duplicate header or footer landmarks`,
	);
}

const partFiles = listFiles('parts', '.html');
for (const file of partFiles) {
	validateBlockMarkup(file);
}
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

assert(patternFiles.length >= 4, 'patterns: expected at least four bundled editorial patterns');
assert(read('patterns/home-hero.php').includes('"templateLock":"contentOnly"'), 'patterns/home-hero.php: content-only editorial lock is missing');
assert(read('patterns/editorial-callout.php').includes('"templateLock":"contentOnly"'), 'patterns/editorial-callout.php: content-only editorial lock is missing');

const screenshot = fs.existsSync(path.join(root, 'screenshot.png'))
	? fs.statSync(path.join(root, 'screenshot.png'))
	: null;
assert(screenshot && screenshot.size > 10_000, 'screenshot.png: expected a non-empty 1200x900 preview image');

notes.push(`${templateFiles.length} templates`);
notes.push(`${partFiles.length} template parts`);
notes.push(`${patternFiles.length} patterns`);
notes.push(`${listFiles('styles', '.json').length} style variation`);

if (errors.length > 0) {
	console.error('Fieldnote validation failed:');
	for (const error of errors) {
		console.error(`- ${error}`);
	}
	process.exit(1);
}

console.log(`Fieldnote validation passed (${notes.join(', ')}).`);
