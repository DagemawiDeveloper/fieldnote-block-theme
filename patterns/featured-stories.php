<?php
/**
 * Title: Featured story grid
 * Slug: fieldnote/featured-stories
 * Categories: fieldnote, posts
 * Description: A three-column editorial query with pagination and an empty state.
 * Block Types: core/query
 * Viewport Width: 1440
 */
?>
<!-- wp:group {"tagName":"section","align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--60)">
	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:heading {"anchor":"latest-stories","fontSize":"large"} -->
		<h2 class="wp-block-heading has-large-font-size" id="latest-stories"><?php echo esc_html_x( 'Latest stories', 'Section heading', 'fieldnote' ); ?></h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"textColor":"slate"} -->
		<p class="has-slate-color has-text-color"><?php echo esc_html_x( 'Reporting, essays, and practical notes.', 'Section supporting text', 'fieldnote' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":1,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"enhancedPagination":true,"align":"wide"} -->
	<div class="wp-block-query alignwide">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"className":"fieldnote-card","style":{"border":{"bottom":{"color":"var:preset|color|line","style":"solid","width":"1px"}},"spacing":{"padding":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group fieldnote-card" style="border-bottom-color:var(--wp--preset--color--line);border-bottom-style:solid;border-bottom-width:1px;padding-bottom:var(--wp--preset--spacing--40)">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3"} /-->
				<!-- wp:post-terms {"term":"category","className":"fieldnote-kicker","style":{"typography":{"fontSize":"0.75rem","fontWeight":"700"}}} /-->
				<!-- wp:post-title {"isLink":true,"fontSize":"large"} /-->
				<!-- wp:post-excerpt {"moreText":"Read story","excerptLength":24} /-->
				<!-- wp:post-date /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph -->
			<p><?php echo esc_html_x( 'No stories are published yet.', 'Empty query message', 'fieldnote' ); ?></p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->

		<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"space-between"}} -->
			<!-- wp:query-pagination-previous /-->
			<!-- wp:query-pagination-numbers /-->
			<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->

