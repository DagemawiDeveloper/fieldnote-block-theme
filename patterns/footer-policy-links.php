<?php
/**
 * Title: Footer policy links
 * Slug: fieldnote/footer-policy-links
 * Description: Portable privacy and accessibility links for the footer utility row.
 * Inserter: no
 *
 * @package Fieldnote
 */

?>
<!-- wp:paragraph {"className":"fieldnote-microcopy","textColor":"mist","fontSize":"micro"} -->
<p class="fieldnote-microcopy has-mist-color has-text-color has-micro-font-size"><a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>"><?php echo esc_html_x( 'Privacy', 'Footer policy link', 'fieldnote' ); ?></a> · <a href="<?php echo esc_url( home_url( '/accessibility/' ) ); ?>"><?php echo esc_html_x( 'Accessibility', 'Footer policy link', 'fieldnote' ); ?></a></p>
<!-- /wp:paragraph -->
