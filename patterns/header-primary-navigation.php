<?php
/**
 * Title: Header primary navigation
 * Slug: fieldnote/header-primary-navigation
 * Description: A portable primary navigation with explicit, semantic menu items.
 * Inserter: no
 *
 * @package Fieldnote
 */

?>
<!-- wp:navigation {"overlayMenu":"mobile","icon":"menu","layout":{"type":"flex","justifyContent":"right"}} -->
	<!-- wp:navigation-link {"label":"<?php echo esc_attr_x( 'Home', 'Primary navigation link', 'fieldnote' ); ?>","type":"custom","url":"<?php echo esc_url( home_url( '/' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
	<!-- wp:navigation-link {"label":"<?php echo esc_attr_x( 'Journal', 'Primary navigation link', 'fieldnote' ); ?>","type":"custom","url":"<?php echo esc_url( home_url( '/#latest-stories' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
	<!-- wp:navigation-link {"label":"<?php echo esc_attr_x( 'About', 'Primary navigation link', 'fieldnote' ); ?>","type":"custom","url":"<?php echo esc_url( home_url( '/about/' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
<!-- /wp:navigation -->
