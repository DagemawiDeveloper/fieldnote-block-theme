import fs from 'node:fs/promises';
import path from 'node:path';
import { request } from '@playwright/test';
import { RequestUtils } from '@wordpress/e2e-test-utils-playwright';

export default async function globalSetup( config ) {
	const { baseURL, storageState } = config.projects[0].use;
	const storageStatePath = typeof storageState === 'string' ? storageState : undefined;

	if ( storageStatePath ) {
		await fs.mkdir( path.dirname( storageStatePath ), { recursive: true } );
	}

	const requestContext = await request.newContext( { baseURL } );
	const requestUtils = new RequestUtils( requestContext, { storageStatePath } );

	await requestUtils.setupRest();
	await requestUtils.activateTheme( 'fieldnote-block-theme' );
	await requestUtils.activatePlugin( 'fieldnote-editorial-blocks' );
	await Promise.all( [
		requestUtils.deleteAllPosts(),
		requestUtils.deleteAllPages(),
		requestUtils.deleteAllBlocks(),
		requestUtils.resetPreferences(),
	] );

	await requestContext.dispose();
}
