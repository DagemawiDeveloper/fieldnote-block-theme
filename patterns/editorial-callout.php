<?php
/**
 * Title: Editorial note
 * Slug: fieldnote/editorial-callout
 * Categories: fieldnote-sections, call-to-action
 * Description: A content-only editor’s note with a numbered margin label and one action.
 * Viewport Width: 1200
 */
?>
<!-- wp:group {"align":"wide","backgroundColor":"paper","metadata":{"name":"Editorial note"},"templateLock":"contentOnly","style":{"border":{"color":"var:preset|color|line","radius":"0.45rem","style":"solid","width":"1px"},"spacing":{"margin":{"top":"var:preset|spacing|70"},"padding":{"bottom":"var:preset|spacing|60","left":"var:preset|spacing|60","right":"var:preset|spacing|60","top":"var:preset|spacing|60"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide has-border-color has-paper-background-color has-background" style="border-color:var(--wp--preset--color--line);border-style:solid;border-width:1px;border-radius:0.45rem;margin-top:var(--wp--preset--spacing--70);padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"verticalAlignment":"top"} -->
	<div class="wp-block-columns are-vertically-aligned-top">
		<!-- wp:column {"verticalAlignment":"top","width":"20%"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:20%">
			<!-- wp:paragraph {"className":"fieldnote-issue-number","textColor":"clay"} -->
			<p class="fieldnote-issue-number has-clay-color has-text-color">01</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"fieldnote-kicker","textColor":"graphite"} -->
			<p class="fieldnote-kicker has-graphite-color has-text-color"><?php echo esc_html_x( 'Editor’s note', 'Callout label', 'fieldnote' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"top","width":"80%"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:80%">
			<!-- wp:heading {"fontSize":"heading-2"} -->
			<h2 class="wp-block-heading has-heading-2-font-size"><?php echo esc_html_x( 'The best stories begin with patient attention.', 'Callout heading', 'fieldnote' ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"graphite","fontSize":"lead"} -->
			<p class="has-graphite-color has-text-color has-lead-font-size"><?php echo esc_html_x( 'Fieldnote is designed for work that needs context, room, and a clear point of view—not another race through the feed.', 'Callout supporting text', 'fieldnote' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"fieldnote-arrow-link","style":{"typography":{"fontWeight":"700"}}} -->
			<p class="fieldnote-arrow-link" style="font-weight:700"><a href="/about"><?php echo esc_html_x( 'Read our editorial principles →', 'Callout action', 'fieldnote' ); ?></a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
