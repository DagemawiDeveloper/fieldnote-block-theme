import AxeBuilder from '@axe-core/playwright';
import { expect, test } from '@wordpress/e2e-test-utils-playwright';

test.describe( 'Fieldnote editorial blocks', () => {
	test.afterAll( async ( { requestUtils } ) => {
		await Promise.all( [ requestUtils.deleteAllPosts(), requestUtils.deleteAllPages() ] );
	} );

	test( 'inserts both dynamic blocks in the editor', async ( { admin, editor } ) => {
		await admin.createNewPost();

		await editor.insertBlock( {
			name: 'fieldnote/issue-details',
			attributes: {
				issueNumber: '12',
				title: 'Signals from the field',
			},
		} );
		await editor.insertBlock( {
			name: 'fieldnote/lead-story',
			attributes: {
				eyebrow: 'Editor selection',
				layout: 'stacked',
			},
		} );

		const content = await editor.getEditedPostContent();
		expect( content ).toContain( '<!-- wp:fieldnote/issue-details' );
		expect( content ).toContain( '"issueNumber":"12"' );
		expect( content ).toContain( '<!-- wp:fieldnote/lead-story' );
		expect( content ).toContain( '"layout":"stacked"' );
	} );

	test( 'renders selected content accessibly on the front end', async ( { page, requestUtils } ) => {
		const story = await requestUtils.createPost( {
			status: 'publish',
			title: 'A deliberately selected field story',
			excerpt: 'A concise summary used to verify the server-rendered lead story.',
			content: '<!-- wp:paragraph --><p>Representative story content.</p><!-- /wp:paragraph -->',
		} );
		const showcase = await requestUtils.createPost( {
			status: 'publish',
			title: 'Fieldnote block showcase',
			content: `<!-- wp:fieldnote/issue-details {"issueNumber":"12","title":"Signals from the field","summary":"A focused accessibility and rendering check."} /-->

<!-- wp:fieldnote/lead-story {"postId":${ story.id },"eyebrow":"Editor selection"} /-->`,
		} );

		await page.goto( `/?p=${ showcase.id }` );

		await expect( page.locator( '.wp-block-fieldnote-issue-details' ) ).toBeVisible();
		await expect( page.getByRole( 'heading', { name: 'Signals from the field' } ) ).toBeVisible();
		await expect( page.locator( '.wp-block-fieldnote-lead-story' ) ).toBeVisible();
		await expect( page.getByRole( 'heading', { name: 'A deliberately selected field story' } ) ).toBeVisible();

		const accessibility = await new AxeBuilder( { page } )
			.include( '.wp-block-fieldnote-issue-details' )
			.include( '.wp-block-fieldnote-lead-story' )
			.withTags( [ 'wcag2a', 'wcag2aa', 'wcag21a', 'wcag21aa' ] )
			.analyze();

		expect( accessibility.violations ).toEqual( [] );
	} );
} );
