<?php
/**
 * Title: Field letter invitation
 * Slug: fieldnote/newsletter
 * Categories: fieldnote-sections, call-to-action
 * Description: A content-locked reader invitation with strong contrast and one clear action.
 * Viewport Width: 1280
 */
?>
<!-- wp:group {"align":"wide","className":"fieldnote-newsletter","backgroundColor":"moss","textColor":"white","metadata":{"name":"Field letter invitation"},"templateLock":"contentOnly","style":{"border":{"radius":"0.5rem"},"spacing":{"margin":{"top":"var:preset|spacing|70"},"padding":{"bottom":"var:preset|spacing|60","left":"var:preset|spacing|60","right":"var:preset|spacing|60","top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide fieldnote-newsletter has-white-color has-moss-background-color has-text-color has-background" style="border-radius:0.5rem;margin-top:var(--wp--preset--spacing--70);padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)">
	<!-- wp:group {"layout":{"type":"constrained","contentSize":"760px","justifyContent":"left"}} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {"className":"fieldnote-kicker","textColor":"sky"} -->
		<p class="fieldnote-kicker has-sky-color has-text-color"><?php echo esc_html_x( 'The Field Letter', 'Newsletter eyebrow', 'fieldnote' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"fontSize":"heading-2"} -->
		<h2 class="wp-block-heading has-heading-2-font-size"><?php echo esc_html_x( 'One thoughtful dispatch. No daily noise.', 'Newsletter heading', 'fieldnote' ); ?></h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"textColor":"mist","fontSize":"lead"} -->
		<p class="has-mist-color has-text-color has-lead-font-size"><?php echo esc_html_x( 'A short editor’s note, one essential story, and a handful of links worth your attention—sent twice a month.', 'Newsletter supporting text', 'fieldnote' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)">
			<!-- wp:button {"backgroundColor":"saffron","textColor":"ink"} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-ink-color has-saffron-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url( home_url( '/newsletter/' ) ); ?>"><?php echo esc_html_x( 'Join the field letter', 'Newsletter action', 'fieldnote' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
