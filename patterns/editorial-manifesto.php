<?php
/**
 * Title: Editorial manifesto
 * Slug: fieldnote/editorial-manifesto
 * Categories: fieldnote-sections, text, about
 * Description: A high-contrast editorial statement with a protected layout and editable copy.
 * Viewport Width: 1440
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"fieldnote-manifesto","backgroundColor":"clay","textColor":"white","metadata":{"name":"Editorial manifesto"},"templateLock":"contentOnly","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|70","top":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull fieldnote-manifesto has-white-color has-clay-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"align":"wide","verticalAlignment":"top"} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-top">
		<!-- wp:column {"verticalAlignment":"top","width":"25%"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:25%">
			<!-- wp:paragraph {"className":"fieldnote-kicker","textColor":"white"} -->
			<p class="fieldnote-kicker has-white-color has-text-color"><?php echo esc_html_x( 'Our editorial promise', 'Manifesto eyebrow', 'fieldnote' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"top","width":"75%"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:75%">
			<!-- wp:heading {"fontSize":"heading-2"} -->
			<h2 class="wp-block-heading has-heading-2-font-size"><?php echo esc_html_x( 'We choose clarity over noise, context over speed, and useful questions over easy answers.', 'Manifesto statement', 'fieldnote' ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"fontSize":"lead"} -->
			<p class="has-lead-font-size"><?php echo esc_html_x( 'Every story should leave the reader with a sharper view of the world and a reason to keep looking.', 'Manifesto supporting text', 'fieldnote' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
