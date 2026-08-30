/* eslint-disable no-console -- This file is a command-line validator. */
import fs from 'node:fs';
import path from 'node:path';
import process from 'node:process';

const root = path.resolve( import.meta.dirname, '..' );
const pluginRoot = path.join( root, 'plugins', 'fieldnote-editorial-blocks' );
const errors = [];
const notes = [];

function fail( message ) {
	errors.push( message );
}

function assert( condition, message ) {
	if ( ! condition ) {
		fail( message );
	}
}

function relative( file ) {
	return path.relative( root, file ).replaceAll( path.sep, '/' );
}

function read( file ) {
	return fs.readFileSync( file, 'utf8' );
}

function parseJson( file ) {
	try {
		return JSON.parse( read( file ) );
	} catch ( error ) {
		fail( `${ relative( file ) }: invalid JSON (${ error.message })` );
		return null;
	}
}

const mainFile = path.join( pluginRoot, 'fieldnote-editorial-blocks.php' );
const readmeFile = path.join( pluginRoot, 'readme.txt' );
const licenseFile = path.join( pluginRoot, 'LICENSE' );

for ( const file of [ mainFile, readmeFile, licenseFile ] ) {
	assert(
		fs.existsSync( file ),
		`${ relative( file ) }: required plugin file is missing`,
	);
}

if ( fs.existsSync( mainFile ) ) {
	const source = read( mainFile );
	for ( const header of [
		'Plugin Name:       Fieldnote Editorial Blocks',
		'Version:           1.0.1',
		'Requires at least: 7.1',
		'Requires PHP:      7.4',
		'Text Domain:       fieldnote-editorial-blocks',
	] ) {
		assert(
			source.includes( header ),
			`${ relative( mainFile ) }: missing header '${ header }'`,
		);
	}
	assert(
		source.includes( 'register_block_type' ),
		`${ relative( mainFile ) }: metadata registration is missing`,
	);
	assert(
		source.includes( 'block_categories_all' ),
		`${ relative( mainFile ) }: inserter category registration is missing`,
	);
	assert(
		( source.match( /register_block_pattern\(/g ) ?? [] ).length === 2,
		`${ relative( mainFile ) }: expected two bundled block patterns`,
	);
}

const blocksDirectory = path.join( pluginRoot, 'blocks' );
const blockDirectories = fs.existsSync( blocksDirectory )
	? fs
		.readdirSync( blocksDirectory, { withFileTypes: true } )
		.filter( ( entry ) => entry.isDirectory() )
		.map( ( entry ) => path.join( blocksDirectory, entry.name ) )
		.sort()
	: [];

assert(
	blockDirectories.length === 2,
	'companion plugin: expected exactly two focused blocks',
);

const blockNames = new Set();
for ( const directory of blockDirectories ) {
	const metadataFile = path.join( directory, 'block.json' );
	assert(
		fs.existsSync( metadataFile ),
		`${ relative( directory ) }: block.json is missing`,
	);
	if ( ! fs.existsSync( metadataFile ) ) {
		continue;
	}

	const metadata = parseJson( metadataFile );
	if ( ! metadata ) {
		continue;
	}

	assert(
		metadata.$schema === 'https://schemas.wp.org/trunk/block.json',
		`${ relative( metadataFile ) }: use the official schema URL`,
	);
	assert(
		metadata.apiVersion === 3,
		`${ relative( metadataFile ) }: apiVersion must be 3`,
	);
	assert(
		metadata.version === '1.0.1',
		`${ relative(
			metadataFile,
		) }: block version must match the plugin release`,
	);
	assert(
		typeof metadata.name === 'string' &&
			metadata.name.startsWith( 'fieldnote/' ),
		`${ relative(
			metadataFile,
		) }: block name must use the fieldnote namespace`,
	);
	assert(
		! blockNames.has( metadata.name ),
		`${ relative( metadataFile ) }: duplicate block name '${
			metadata.name
		}'`,
	);
	blockNames.add( metadata.name );
	assert(
		metadata.category === 'fieldnote-editorial',
		`${ relative( metadataFile ) }: use the plugin inserter category`,
	);
	assert(
		typeof metadata.description === 'string' &&
			metadata.description.length >= 40,
		`${ relative( metadataFile ) }: add a useful description`,
	);
	assert(
		metadata.textdomain === 'fieldnote-editorial-blocks',
		`${ relative( metadataFile ) }: text domain is inconsistent`,
	);
	assert(
		metadata.render === 'file:./render.php',
		`${ relative( metadataFile ) }: dynamic render file is required`,
	);
	assert(
		metadata.editorScript === 'file:./index.js',
		`${ relative( metadataFile ) }: editor script is required`,
	);
	assert(
		metadata.style === 'file:./style.css',
		`${ relative( metadataFile ) }: shared block style is required`,
	);
	assert(
		metadata.editorStyle === 'file:./editor.css',
		`${ relative( metadataFile ) }: editor-only style is required`,
	);

	for ( const asset of [
		'render.php',
		'index.js',
		'index.asset.php',
		'style.css',
		'editor.css',
	] ) {
		assert(
			fs.existsSync( path.join( directory, asset ) ),
			`${ relative( directory ) }: ${ asset } is missing`,
		);
	}

	const javascript = read( path.join( directory, 'index.js' ) );
	const render = read( path.join( directory, 'render.php' ) );
	const styles = read( path.join( directory, 'style.css' ) );
	const assets = read( path.join( directory, 'index.asset.php' ) );

	assert(
		javascript.includes( `registerBlockType( '${ metadata.name }'` ),
		`${ relative( directory ) }: editor registration must match block.json`,
	);
	assert(
		javascript.includes( 'InspectorControls' ),
		`${ relative( directory ) }: editor controls are missing`,
	);
	assert(
		/save\(\)\s*{\s*return null;\s*}/s.test( javascript ),
		`${ relative( directory ) }: dynamic block save must return null`,
	);
	assert(
		! /\bfetch\s*\(/.test( javascript ),
		`${ relative(
			directory,
		) }: use WordPress data APIs instead of unmanaged fetch calls`,
	);
	assert(
		! /https?:\/\//i.test( javascript ),
		`${ relative(
			directory,
		) }: editor script must not call remote services`,
	);
	assert(
		render.includes( 'get_block_wrapper_attributes' ),
		`${ relative( directory ) }: server markup must preserve block supports`,
	);
	assert(
		render.includes( 'esc_' ),
		`${ relative( directory ) }: rendered values need explicit escaping`,
	);
	assert(
		assets.includes( "'wp-blocks'" ),
		`${ relative( directory ) }: wp-blocks dependency is missing`,
	);
	assert(
		styles.includes( '@media' ),
		`${ relative(
			directory,
		) }: responsive or user-preference treatment is missing`,
	);
	assert(
		! /@import\s/i.test( styles ),
		`${ relative( directory ) }: render-blocking @import is not allowed`,
	);
	assert(
		! /url\(\s*["']?https?:/i.test( styles ),
		`${ relative( directory ) }: shared styles must not load remote assets`,
	);
}

assert(
	blockNames.has( 'fieldnote/issue-details' ),
	'companion plugin: Issue Details block is missing',
);
assert(
	blockNames.has( 'fieldnote/lead-story' ),
	'companion plugin: Lead Story block is missing',
);

const leadEditor = path.join( blocksDirectory, 'lead-story', 'index.js' );
if ( fs.existsSync( leadEditor ) ) {
	const source = read( leadEditor );
	assert(
		source.includes( 'getEntityRecords' ),
		`${ relative( leadEditor ) }: post selection should use core data`,
	);
	assert(
		source.includes( 'ServerSideRender' ),
		`${ relative( leadEditor ) }: dynamic editor preview is missing`,
	);
}

const leadRender = path.join( blocksDirectory, 'lead-story', 'render.php' );
if ( fs.existsSync( leadRender ) ) {
	const source = read( leadRender );
	const metadata = parseJson(
		path.join( blocksDirectory, 'lead-story', 'block.json' ),
	);
	assert(
		metadata?.usesContext?.includes( 'postId' ),
		`${ relative(
			leadRender,
		) }: post context is required for self-reference protection`,
	);
	assert(
		source.includes( "'post__not_in'" ),
		`${ relative(
			leadRender,
		) }: fallback query must exclude the containing post`,
	);
	assert(
		source.includes( 'aria-label=' ),
		`${ relative(
			leadRender,
		) }: linked lead image needs an accessible name`,
	);
	assert(
		! source.includes( 'aria-hidden="true"' ),
		`${ relative(
			leadRender,
		) }: do not hide a linked story from assistive technology`,
	);
}

const packageJson = parseJson( path.join( root, 'package.json' ) );
assert(
	packageJson?.devDependencies?.[ '@playwright/test' ],
	'package.json: Playwright dependency is missing',
);
assert(
	packageJson?.devDependencies?.[ '@wordpress/e2e-test-utils-playwright' ],
	'package.json: WordPress Playwright utilities are missing',
);
assert(
	packageJson?.devDependencies?.[ '@axe-core/playwright' ],
	'package.json: axe Playwright integration is missing',
);
assert(
	packageJson?.scripts?.[ 'test:e2e' ]?.includes(
		'WP_BASE_URL=http://localhost:8888',
	),
	'package.json: E2E tests must target the development WordPress port',
);
for ( const file of [
	path.join( root, 'playwright.config.js' ),
	path.join( root, 'tests', 'e2e', 'global-setup.js' ),
	path.join( root, 'tests', 'e2e', 'specs', 'editorial-blocks.spec.js' ),
] ) {
	assert(
		fs.existsSync( file ),
		`${ relative( file ) }: E2E test file is missing`,
	);
}

const blueprintFile = path.join( root, 'blueprint.json' );
const blueprint = fs.existsSync( blueprintFile )
	? parseJson( blueprintFile )
	: null;
assert(
	Boolean( blueprint ),
	'blueprint.json: one-click demo blueprint is missing',
);
if ( blueprint ) {
	assert(
		blueprint.preferredVersions?.wp === '7.1',
		'blueprint.json: WordPress demo version must be pinned to 7.1',
	);
	assert(
		blueprint.preferredVersions?.php === '8.3',
		'blueprint.json: PHP demo version must be pinned to 8.3',
	);
	const steps = blueprint.steps ?? [];
	assert(
		steps.some( ( step ) => step.step === 'installTheme' ),
		'blueprint.json: theme installation step is missing',
	);
	assert(
		steps.some( ( step ) => step.step === 'installPlugin' ),
		'blueprint.json: plugin installation step is missing',
	);
	assert(
		steps.some( ( step ) => step.step === 'runPHP' ),
		'blueprint.json: representative content seed is missing',
	);
}

const mediaDirectory = path.join( root, 'demo', 'media' );
const demoPngs = fs.existsSync( mediaDirectory )
	? fs
		.readdirSync( mediaDirectory )
		.filter( ( file ) => file.endsWith( '.png' ) )
		.sort()
	: [];
assert(
	demoPngs.length === 4,
	'demo/media: expected four local editorial images',
);
for ( const filename of demoPngs ) {
	const image = fs.readFileSync( path.join( mediaDirectory, filename ) );
	assert(
		image.subarray( 1, 4 ).toString() === 'PNG',
		`demo/media/${ filename }: expected a PNG file`,
	);
	assert(
		image.readUInt32BE( 16 ) === 1600,
		`demo/media/${ filename }: width must be 1600 pixels`,
	);
	assert(
		image.readUInt32BE( 20 ) === 1000,
		`demo/media/${ filename }: height must be 1000 pixels`,
	);
}

const blocksPreview = path.join( root, 'docs', 'editorial-blocks-preview.png' );
assert(
	fs.existsSync( blocksPreview ),
	'docs/editorial-blocks-preview.png: documentation preview is missing',
);
if ( fs.existsSync( blocksPreview ) ) {
	const image = fs.readFileSync( blocksPreview );
	assert(
		image.length > 50_000,
		'docs/editorial-blocks-preview.png: expected a substantial preview image',
	);
	assert(
		image.subarray( 1, 4 ).toString() === 'PNG',
		'docs/editorial-blocks-preview.png: expected a PNG file',
	);
	assert(
		image.readUInt32BE( 16 ) === 1600,
		'docs/editorial-blocks-preview.png: width must be 1600 pixels',
	);
	assert(
		image.readUInt32BE( 20 ) === 1000,
		'docs/editorial-blocks-preview.png: height must be 1000 pixels',
	);
}

notes.push( `${ blockDirectories.length } dynamic blocks` );
notes.push( '2 editor patterns' );
notes.push( `${ demoPngs.length } local demo images` );
notes.push( 'one-click WordPress Playground blueprint' );
notes.push( 'Playwright editor and axe coverage' );

if ( errors.length > 0 ) {
	console.error( 'Fieldnote companion plugin validation failed:' );
	for ( const error of errors ) {
		console.error( `- ${ error }` );
	}
	process.exit( 1 );
}

console.log(
	`Fieldnote companion plugin validation passed (${ notes.join( ', ' ) }).`,
);
