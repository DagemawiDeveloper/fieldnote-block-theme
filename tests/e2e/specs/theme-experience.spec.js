import AxeBuilder from '@axe-core/playwright';
import { expect, test } from '@wordpress/e2e-test-utils-playwright';

test.describe( 'Fieldnote public experience', () => {
	const storyTitle = 'Trustworthy systems begin with careful fieldwork';
	let story;

	test.beforeAll( async ( { requestUtils } ) => {
		await Promise.all( [
			requestUtils.deleteAllPosts(),
			requestUtils.deleteAllPages(),
		] );

		story = await requestUtils.createPost( {
			status: 'publish',
			title: storyTitle,
			excerpt:
				'A representative story used to exercise Fieldnote routes and responsive behavior.',
			content: `<!-- wp:paragraph {"fontSize":"lead"} --><p class="has-lead-font-size">Clear evidence should survive the journey from collection to publication.</p><!-- /wp:paragraph -->

<!-- wp:heading --><h2 class="wp-block-heading">What the team learned</h2><!-- /wp:heading -->

<!-- wp:paragraph --><p>Reliable editorial systems preserve context, expose uncertainty, and keep recovery paths understandable.</p><!-- /wp:paragraph -->`,
		} );

		for ( const page of [
			[ 'About', 'about' ],
			[ 'Newsletter', 'newsletter' ],
			[ 'Privacy', 'privacy' ],
			[ 'Accessibility', 'accessibility' ],
		] ) {
			await requestUtils.createPage( {
				status: 'publish',
				title: page[ 0 ],
				slug: page[ 1 ],
				content:
					'<!-- wp:paragraph --><p>Representative publication information.</p><!-- /wp:paragraph -->',
			} );
		}
	} );

	test.beforeEach( async ( { page } ) => {
		await page.context().clearCookies();
	} );

	test.afterAll( async ( { requestUtils } ) => {
		await Promise.all( [
			requestUtils.deleteAllPosts(),
			requestUtils.deleteAllPages(),
		] );
	} );

	test( 'renders a semantic single-story route without serious accessibility violations', async ( {
		page,
	} ) => {
		await page.goto( `/?p=${ story.id }` );

		await expect( page.locator( 'link#fieldnote-style-css' ) ).toHaveCount( 1 );
		await expect( page.locator( 'header' ) ).toHaveCount( 1 );
		await expect( page.locator( 'main' ) ).toHaveCount( 1 );
		await expect( page.locator( 'footer' ) ).toHaveCount( 1 );
		await expect(
			page.getByRole( 'heading', { level: 1, name: storyTitle } ),
		).toBeVisible();

		const accessibility = await new AxeBuilder( { page } )
			.withTags( [ 'wcag2a', 'wcag2aa', 'wcag21a', 'wcag21aa' ] )
			.analyze();

		expect( accessibility.violations ).toEqual( [] );
	} );

	test( 'keeps navigation and story content inside a narrow viewport', async ( {
		page,
	} ) => {
		await page.setViewportSize( { width: 390, height: 844 } );
		await page.goto( `/?p=${ story.id }` );

		await expect( page.locator( 'header' ) ).toBeVisible();
		await expect( page.locator( 'main' ) ).toBeVisible();

		const overflow = await page.evaluate( () => ( {
			documentWidth: document.documentElement.scrollWidth,
			viewportWidth: window.innerWidth,
		} ) );

		expect( overflow.documentWidth ).toBeLessThanOrEqual(
			overflow.viewportWidth + 1,
		);
	} );

	test( 'renders useful search and not-found routes', async ( { page } ) => {
		await page.goto( '/?s=trustworthy' );
		await expect( page.getByRole( 'heading', { level: 1 } ) ).toContainText(
			'trustworthy',
		);
		await expect(
			page.getByRole( 'heading', { name: storyTitle } ),
		).toBeVisible();

		await page.goto( '/?p=99999999' );
		await expect(
			page.getByRole( 'heading', {
				level: 1,
				name: 'The trail ends here.',
			} ),
		).toBeVisible();
		await expect(
			page.getByRole( 'link', { name: 'Return to the journal' } ),
		).toHaveAttribute( 'href', /\/$/ );
	} );

	test( 'resolves default publication links from the active WordPress site URL', async ( {
		page,
	} ) => {
		await page.goto( '/' );

		for ( const [ scope, name, pathname ] of [
			[
				'.fieldnote-header-action',
				'Get the field letter',
				'/newsletter/',
			],
			[ '.fieldnote-footer', 'Privacy', '/privacy/' ],
			[ '.fieldnote-footer', 'Accessibility', '/accessibility/' ],
		] ) {
			const href = await page
				.locator( scope )
				.getByRole( 'link', { name, exact: true } )
				.getAttribute( 'href' );
			const resolved = new URL( href, page.url() );

			expect( resolved.origin ).toBe( new URL( page.url() ).origin );
			expect( resolved.pathname ).toBe( pathname );
		}
	} );
} );
