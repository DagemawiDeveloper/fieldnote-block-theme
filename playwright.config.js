import path from 'node:path';
import { defineConfig, devices } from '@playwright/test';

const authenticationState = path.resolve( 'tests/e2e/.auth/admin.json' );

export default defineConfig( {
	testDir: './tests/e2e/specs',
	globalSetup: './tests/e2e/global-setup.js',
	fullyParallel: false,
	workers: 1,
	retries: process.env.CI ? 1 : 0,
	forbidOnly: Boolean( process.env.CI ),
	reporter: process.env.CI
		? [ [ 'line' ], [ 'html', { open: 'never' } ] ]
		: 'list',
	outputDir: 'test-results',
	use: {
		baseURL: process.env.WP_BASE_URL || 'http://localhost:8888',
		storageState: authenticationState,
		trace: 'retain-on-failure',
		screenshot: 'only-on-failure',
		video: 'retain-on-failure',
	},
	projects: [
		{
			name: 'desktop-chromium',
			use: { ...devices[ 'Desktop Chrome' ] },
		},
		{
			name: 'mobile-chromium',
			use: { ...devices[ 'Pixel 7' ] },
		},
		{
			name: 'desktop-firefox',
			use: { ...devices[ 'Desktop Firefox' ] },
		},
		{
			name: 'desktop-webkit',
			use: { ...devices[ 'Desktop Safari' ] },
		},
	],
} );
