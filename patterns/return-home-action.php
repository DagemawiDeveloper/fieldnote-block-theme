<?php
/**
 * Title: Return home action
 * Slug: fieldnote/return-home-action
 * Description: A portable return link for empty and not-found experiences.
 * Inserter: no
 *
 * @package Fieldnote
 */

?>
<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)">
	<!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html_x( 'Return to the journal', '404 action', 'fieldnote' ); ?></a></div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
