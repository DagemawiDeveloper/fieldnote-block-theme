<?php
/**
 * Title: Story author profile
 * Slug: fieldnote/author-profile
 * Categories: fieldnote, about
 * Description: A reusable post-author panel with avatar, biography, and an editorial label.
 * Block Types: core/post-author
 * Viewport Width: 900
 */
?>
<!-- wp:group {"align":"wide","className":"fieldnote-byline","backgroundColor":"paper","style":{"border":{"color":"var:preset|color|line","radius":"0.45rem","style":"solid","width":"1px"},"spacing":{"margin":{"top":"var:preset|spacing|60"},"padding":{"bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50","top":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide fieldnote-byline has-border-color has-paper-background-color has-background" style="border-color:var(--wp--preset--color--line);border-style:solid;border-width:1px;border-radius:0.45rem;margin-top:var(--wp--preset--spacing--60);padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
	<!-- wp:paragraph {"className":"fieldnote-kicker","textColor":"moss"} -->
	<p class="fieldnote-kicker has-moss-color has-text-color"><?php echo esc_html_x( 'About the writer', 'Author profile label', 'fieldnote' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:post-author {"showAvatar":true,"avatarSize":80,"showBio":true,"byline":"Written by"} /-->
</div>
<!-- /wp:group -->
