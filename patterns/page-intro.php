<?php
/**
 * Title: Page introduction
 * Slug: fieldnote/page-intro
 * Categories: fieldnote, text
 * Description: A restrained page heading with an eyebrow, headline, and supporting introduction.
 * Viewport Width: 1100
 *
 * @package Fieldnote
 */

?>
<!-- wp:group {"align":"wide","metadata":{"name":"Page introduction"},"templateLock":"contentOnly","style":{"border":{"bottom":{"color":"var:preset|color|line","style":"solid","width":"1px"}},"spacing":{"padding":{"bottom":"var:preset|spacing|60","top":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"980px","justifyContent":"left"}} -->
<div class="wp-block-group alignwide" style="border-bottom-color:var(--wp--preset--color--line);border-bottom-style:solid;border-bottom-width:1px;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:paragraph {"className":"fieldnote-kicker","textColor":"clay-dark"} -->
	<p class="fieldnote-kicker has-clay-dark-color has-text-color"><?php echo esc_html_x( 'Fieldnote / About', 'Page eyebrow', 'fieldnote' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":1,"fontSize":"display"} -->
	<h1 class="wp-block-heading has-display-font-size"><?php echo esc_html_x( 'Independent publishing with a patient point of view.', 'Page heading', 'fieldnote' ); ?></h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"textColor":"graphite","fontSize":"lead"} -->
	<p class="has-graphite-color has-text-color has-lead-font-size"><?php echo esc_html_x( 'Use this introduction for a clear promise, a sharp argument, or the opening to a longer story.', 'Page introduction text', 'fieldnote' ); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
