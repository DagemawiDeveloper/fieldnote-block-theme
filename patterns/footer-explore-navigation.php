<?php
/**
 * Title: Footer explore navigation
 * Slug: fieldnote/footer-explore-navigation
 * Description: A portable footer navigation with explicit, semantic menu items.
 * Inserter: no
 *
 * @package Fieldnote
 */

?>
<!-- wp:navigation {"textColor":"white","overlayMenu":"never","layout":{"type":"flex","orientation":"vertical","justifyContent":"left"},"fontSize":"small"} -->
	<!-- wp:navigation-link {"label":"<?php echo esc_attr_x( 'Home', 'Footer navigation link', 'fieldnote' ); ?>","type":"custom","url":"<?php echo esc_url( home_url( '/' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
	<!-- wp:navigation-link {"label":"<?php echo esc_attr_x( 'Journal', 'Footer navigation link', 'fieldnote' ); ?>","type":"custom","url":"<?php echo esc_url( home_url( '/#latest-stories' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
	<!-- wp:navigation-link {"label":"<?php echo esc_attr_x( 'About', 'Footer navigation link', 'fieldnote' ); ?>","type":"custom","url":"<?php echo esc_url( home_url( '/about/' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
	<!-- wp:navigation-link {"label":"<?php echo esc_attr_x( 'Newsletter', 'Footer navigation link', 'fieldnote' ); ?>","type":"custom","url":"<?php echo esc_url( home_url( '/newsletter/' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
<!-- /wp:navigation -->
