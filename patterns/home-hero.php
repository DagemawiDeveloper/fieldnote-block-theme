<?php
/**
 * Title: Editorial hero
 * Slug: fieldnote/home-hero
 * Categories: fieldnote, banner, featured
 * Description: A content-locked editorial introduction with a clear heading and two actions.
 * Viewport Width: 1440
 */
?>
<!-- wp:group {"align":"full","backgroundColor":"ink","textColor":"white","metadata":{"name":"Editorial hero"},"templateLock":"contentOnly","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|60","top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-white-color has-ink-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:group {"align":"wide","layout":{"type":"constrained","contentSize":"900px","justifyContent":"left"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:paragraph {"className":"fieldnote-kicker","textColor":"line","style":{"typography":{"fontSize":"0.8rem","fontWeight":"700"}}} -->
		<p class="fieldnote-kicker has-line-color has-text-color" style="font-size:0.8rem;font-weight:700"><?php echo esc_html_x( 'Field notes for curious people', 'Hero eyebrow text', 'fieldnote' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":1,"fontSize":"display"} -->
		<h1 class="wp-block-heading has-display-font-size"><?php echo esc_html_x( 'Ideas deserve room to breathe.', 'Hero heading', 'fieldnote' ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"textColor":"line","fontSize":"lead"} -->
		<p class="has-line-color has-text-color has-lead-font-size"><?php echo esc_html_x( 'A flexible editorial starting point built with native WordPress blocks, patterns, and Site Editor controls.', 'Hero supporting text', 'fieldnote' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#latest-stories"><?php echo esc_html_x( 'Browse stories', 'Hero primary action', 'fieldnote' ); ?></a></div>
			<!-- /wp:button -->

			<!-- wp:button {"className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/about"><?php echo esc_html_x( 'About the publication', 'Hero secondary action', 'fieldnote' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

