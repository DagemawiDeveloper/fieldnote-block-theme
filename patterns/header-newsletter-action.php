<?php
/**
 * Title: Header newsletter action
 * Slug: fieldnote/header-newsletter-action
 * Description: A portable header action that resolves from the active site URL.
 * Inserter: no
 *
 * @package Fieldnote
 */

?>
<!-- wp:buttons {"className":"fieldnote-header-action"} -->
<div class="wp-block-buttons fieldnote-header-action">
	<!-- wp:button {"backgroundColor":"ink","textColor":"white"} -->
	<div class="wp-block-button"><a class="wp-block-button__link has-white-color has-ink-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url( home_url( '/newsletter/' ) ); ?>"><?php echo esc_html_x( 'Get the field letter', 'Header action', 'fieldnote' ); ?></a></div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
