<?php
/**
 * Title: Lead story mosaic
 * Slug: fieldnote/story-mosaic
 * Categories: fieldnote, posts, featured
 * Description: A responsive five-story query composition with one dominant lead story.
 * Block Types: core/query
 * Viewport Width: 1440
 */
?>
<!-- wp:group {"tagName":"section","align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70)">
	<!-- wp:group {"align":"wide","className":"fieldnote-section-heading","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide fieldnote-section-heading">
		<!-- wp:group {"layout":{"type":"constrained","justifyContent":"left"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"className":"fieldnote-kicker","textColor":"clay-dark"} -->
			<p class="fieldnote-kicker has-clay-dark-color has-text-color"><?php echo esc_html_x( 'The current issue', 'Section eyebrow', 'fieldnote' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"anchor":"latest-stories","fontSize":"heading-2"} -->
			<h2 class="wp-block-heading has-heading-2-font-size" id="latest-stories"><?php echo esc_html_x( 'Stories worth carrying with you.', 'Section heading', 'fieldnote' ); ?></h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:group -->

		<!-- wp:paragraph {"textColor":"graphite","fontSize":"lead"} -->
		<p class="has-graphite-color has-text-color has-lead-font-size"><?php echo esc_html_x( 'Reporting, conversations, and practical notes selected by the editors.', 'Section supporting text', 'fieldnote' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":11,"query":{"perPage":5,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-query alignwide" style="margin-top:var(--wp--preset--spacing--60)">
		<!-- wp:post-template {"className":"fieldnote-story-mosaic","layout":{"type":"default"}} -->
			<!-- wp:group {"className":"fieldnote-story-card","style":{"border":{"bottom":{"color":"var:preset|color|line","style":"solid","width":"1px"}},"spacing":{"padding":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group fieldnote-story-card" style="border-bottom-color:var(--wp--preset--color--line);border-bottom-style:solid;border-bottom-width:1px;padding-bottom:var(--wp--preset--spacing--40)">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3"} /-->
				<!-- wp:post-terms {"term":"category","className":"fieldnote-kicker","textColor":"clay-dark"} /-->
				<!-- wp:post-title {"isLink":true,"fontSize":"heading-3"} /-->
				<!-- wp:post-excerpt {"moreText":"Continue reading","excerptLength":22,"fontSize":"small"} /-->
				<!-- wp:post-date {"format":"M j, Y"} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph -->
			<p><?php echo esc_html_x( 'The first stories are being prepared. Check back soon.', 'Empty query message', 'fieldnote' ); ?></p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->
