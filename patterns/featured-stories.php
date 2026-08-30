<?php
/**
 * Title: Latest story grid
 * Slug: fieldnote/featured-stories
 * Categories: fieldnote, posts
 * Description: A reusable three-column story archive with an empty state and pagination.
 * Block Types: core/query
 * Viewport Width: 1440
 */
?>
<!-- wp:group {"tagName":"section","align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70)">
	<!-- wp:group {"align":"wide","className":"fieldnote-section-heading","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide fieldnote-section-heading">
		<!-- wp:heading {"fontSize":"heading-2"} -->
		<h2 class="wp-block-heading has-heading-2-font-size"><?php echo esc_html_x( 'From the archive', 'Section heading', 'fieldnote' ); ?></h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"textColor":"graphite"} -->
		<p class="has-graphite-color has-text-color"><?php echo esc_html_x( 'More dispatches, essays, and observations from the Fieldnote desk.', 'Section supporting text', 'fieldnote' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":12,"query":{"perPage":6,"pages":0,"offset":5,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"enhancedPagination":true,"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-query alignwide" style="margin-top:var(--wp--preset--spacing--60)">
		<!-- wp:post-template {"className":"fieldnote-card-grid","layout":{"type":"default"}} -->
			<!-- wp:group {"className":"fieldnote-card fieldnote-story-card","style":{"border":{"bottom":{"color":"var:preset|color|line","style":"solid","width":"1px"}},"spacing":{"padding":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group fieldnote-card fieldnote-story-card" style="border-bottom-color:var(--wp--preset--color--line);border-bottom-style:solid;border-bottom-width:1px;padding-bottom:var(--wp--preset--spacing--40)">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3"} /-->
				<!-- wp:post-terms {"term":"category","className":"fieldnote-kicker","textColor":"clay-dark"} /-->
				<!-- wp:post-title {"isLink":true,"fontSize":"heading-3"} /-->
				<!-- wp:post-excerpt {"moreText":"Read story","excerptLength":24,"fontSize":"small"} /-->
				<!-- wp:post-date {"format":"M j, Y"} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph -->
			<p><?php echo esc_html_x( 'No additional stories are published yet.', 'Empty query message', 'fieldnote' ); ?></p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->

		<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"space-between"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
			<!-- wp:query-pagination-previous {"label":"Newer stories"} /-->
			<!-- wp:query-pagination-numbers /-->
			<!-- wp:query-pagination-next {"label":"Older stories"} /-->
		<!-- /wp:query-pagination -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->
