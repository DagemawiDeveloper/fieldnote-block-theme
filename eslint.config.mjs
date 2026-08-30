import wordpress from '@wordpress/eslint-plugin';

export default [
	{
		ignores: [ 'dist/**', 'node_modules/**', 'playwright-report/**', 'test-results/**' ],
	},
	...wordpress.configs[ 'recommended-with-formatting' ],
	{
		files: [ 'tests/e2e/**/*.js' ],
		...wordpress.configs[ 'test-playwright' ][ 0 ],
	},
];
