<?php
/**
 * Title: Page introduction
 * Slug: fieldnote/page-intro
 * Categories: fieldnote, text
 * Description: A simple, wide introduction for editorial landing pages.
 * Block Types: core/post-content
 * Viewport Width: 1200
 */
?>
<!-- wp:group {"align":"wide","style":{"border":{"bottom":{"color":"var:preset|color|line","style":"solid","width":"1px"}},"spacing":{"padding":{"bottom":"var:preset|spacing|50","top":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"900px","justifyContent":"left"}} -->
<div class="wp-block-group alignwide" style="border-bottom-color:var(--wp--preset--color--line);border-bottom-style:solid;border-bottom-width:1px;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:paragraph {"className":"fieldnote-kicker","textColor":"terracotta-dark","style":{"typography":{"fontSize":"0.8rem","fontWeight":"700"}}} -->
	<p class="fieldnote-kicker has-terracotta-dark-color has-text-color" style="font-size:0.8rem;font-weight:700"><?php echo esc_html_x( 'Section introduction', 'Page intro eyebrow text', 'fieldnote' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":1,"fontSize":"display"} -->
	<h1 class="wp-block-heading has-display-font-size"><?php echo esc_html_x( 'Give readers a clear reason to continue.', 'Page intro heading', 'fieldnote' ); ?></h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"textColor":"slate","fontSize":"lead"} -->
	<p class="has-slate-color has-text-color has-lead-font-size"><?php echo esc_html_x( 'Replace this text in the editor with a concise explanation of the page and what readers will find next.', 'Page intro supporting text', 'fieldnote' ); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

