<?php
/**
 * Title: Field journal hero
 * Slug: fieldnote/home-hero
 * Categories: fieldnote, banner, featured
 * Description: An asymmetric, content-locked editorial hero with issue details and two calls to action.
 * Viewport Width: 1440
 *
 * @package Fieldnote
 */

?>
<!-- wp:group {"align":"full","className":"fieldnote-hero","textColor":"white","metadata":{"name":"Field journal hero"},"templateLock":"contentOnly","style":{"background":{"gradient":"var:preset|gradient|night-forest"},"spacing":{"padding":{"bottom":"var:preset|spacing|70","top":"var:preset|spacing|70"}},"@mobile":{"spacing":{"padding":{"bottom":"var:preset|spacing|60","top":"var:preset|spacing|60"}}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull fieldnote-hero has-white-color has-text-color" style="background-image:var(--wp--preset--gradient--night-forest);padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"66.66%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:66.66%">
			<!-- wp:paragraph {"className":"fieldnote-kicker","textColor":"sky"} -->
			<p class="fieldnote-kicker has-sky-color has-text-color"><?php echo esc_html_x( 'Issue 08 · Notes from the edge', 'Hero eyebrow text', 'fieldnote' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1,"className":"fieldnote-hero-title","fontSize":"display"} -->
			<h1 class="wp-block-heading fieldnote-hero-title has-display-font-size"><?php echo esc_html_x( 'Look closer. Tell it clearly.', 'Hero heading', 'fieldnote' ); ?></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"fieldnote-hero-copy","textColor":"mist","fontSize":"lead"} -->
			<p class="fieldnote-hero-copy has-mist-color has-text-color has-lead-font-size"><?php echo esc_html_x( 'Independent reporting, grounded essays, and useful ideas for people curious about how the world is changing.', 'Hero supporting text', 'fieldnote' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
			<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)">
				<!-- wp:button {"backgroundColor":"saffron","textColor":"ink"} -->
				<div class="wp-block-button"><a class="wp-block-button__link has-ink-color has-saffron-background-color has-text-color has-background wp-element-button" href="#latest-stories"><?php echo esc_html_x( 'Read the latest issue', 'Hero primary action', 'fieldnote' ); ?></a></div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline","textColor":"white"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-white-color has-text-color wp-element-button" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php echo esc_html_x( 'Why Fieldnote exists', 'Hero secondary action', 'fieldnote' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"33.33%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:33.33%">
			<!-- wp:group {"className":"fieldnote-issue-card","style":{"border":{"radius":"0.45rem"},"spacing":{"padding":{"bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50","top":"var:preset|spacing|50"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"space-between"}} -->
			<div class="wp-block-group fieldnote-issue-card" style="border-radius:0.45rem;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
				<!-- wp:paragraph {"className":"fieldnote-microcopy","textColor":"sky","fontSize":"micro"} -->
				<p class="fieldnote-microcopy has-sky-color has-text-color has-micro-font-size"><?php echo esc_html_x( 'FIELD JOURNAL / 2026', 'Issue card label', 'fieldnote' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"fieldnote-issue-number","textColor":"white"} -->
				<p class="fieldnote-issue-number has-white-color has-text-color">08</p>
				<!-- /wp:paragraph -->

				<!-- wp:group {"layout":{"type":"constrained","justifyContent":"left"}} -->
				<div class="wp-block-group">
					<!-- wp:separator {"backgroundColor":"saffron"} -->
					<hr class="wp-block-separator has-text-color has-saffron-color has-alpha-channel-opacity has-saffron-background-color has-background"/>
					<!-- /wp:separator -->
					<!-- wp:paragraph {"textColor":"mist","fontSize":"small"} -->
					<p class="has-mist-color has-text-color has-small-font-size"><?php echo esc_html_x( 'Inside: patient technology, public spaces, and the quiet work behind lasting change.', 'Issue card summary', 'fieldnote' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
