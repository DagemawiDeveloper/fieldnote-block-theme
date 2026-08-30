<?php
/**
 * Title: Editorial callout
 * Slug: fieldnote/editorial-callout
 * Categories: fieldnote, call-to-action
 * Description: A content-only callout that protects layout while editors update its copy and destination.
 * Viewport Width: 1200
 */
?>
<!-- wp:group {"align":"wide","backgroundColor":"white","metadata":{"name":"Editorial callout"},"templateLock":"contentOnly","style":{"border":{"color":"var:preset|color|line","style":"solid","width":"1px"},"spacing":{"margin":{"top":"var:preset|spacing|60"},"padding":{"bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50","top":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group alignwide has-border-color has-white-background-color has-background" style="border-color:var(--wp--preset--color--line);border-style:solid;border-width:1px;margin-top:var(--wp--preset--spacing--60);padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
	<!-- wp:paragraph {"align":"center","className":"fieldnote-kicker","textColor":"terracotta-dark","style":{"typography":{"fontSize":"0.8rem","fontWeight":"700"}}} -->
	<p class="has-text-align-center fieldnote-kicker has-terracotta-dark-color has-text-color" style="font-size:0.8rem;font-weight:700"><?php echo esc_html_x( 'From the archive', 'Callout eyebrow text', 'fieldnote' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"textAlign":"center","fontSize":"large"} -->
	<h2 class="wp-block-heading has-text-align-center has-large-font-size"><?php echo esc_html_x( 'Good stories stay useful after publication day.', 'Callout heading', 'fieldnote' ); ?></h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center","textColor":"slate","fontSize":"lead"} -->
	<p class="has-text-align-center has-slate-color has-text-color has-lead-font-size"><?php echo esc_html_x( 'Use categories, search, and curated landing pages to help readers rediscover your best work.', 'Callout supporting text', 'fieldnote' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/archive"><?php echo esc_html_x( 'Explore the archive', 'Callout action', 'fieldnote' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
