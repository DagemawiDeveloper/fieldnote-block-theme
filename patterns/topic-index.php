<?php
/**
 * Title: Topic index
 * Slug: fieldnote/topic-index
 * Categories: fieldnote-sections, text
 * Description: A two-column editorial introduction paired with a live category index.
 * Viewport Width: 1280
 *
 * @package Fieldnote
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"paper","style":{"spacing":{"margin":{"top":"var:preset|spacing|70"},"padding":{"bottom":"var:preset|spacing|70","top":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-paper-background-color has-background" style="margin-top:var(--wp--preset--spacing--70);padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"align":"wide","verticalAlignment":"top"} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-top">
		<!-- wp:column {"verticalAlignment":"top","width":"42%"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:42%">
			<!-- wp:paragraph {"className":"fieldnote-kicker","textColor":"moss"} -->
			<p class="fieldnote-kicker has-moss-color has-text-color"><?php echo esc_html_x( 'Follow a thread', 'Topic index eyebrow', 'fieldnote' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"fontSize":"heading-2"} -->
			<h2 class="wp-block-heading has-heading-2-font-size"><?php echo esc_html_x( 'An archive made for wandering.', 'Topic index heading', 'fieldnote' ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"graphite","fontSize":"lead"} -->
			<p class="has-graphite-color has-text-color has-lead-font-size"><?php echo esc_html_x( 'Start with a subject and see where the reporting takes you.', 'Topic index supporting text', 'fieldnote' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"top","width":"58%"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:58%">
			<!-- wp:categories {"showPostCounts":true,"showHierarchy":false,"className":"fieldnote-topic-list"} /-->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
