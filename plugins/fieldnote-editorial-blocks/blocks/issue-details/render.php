<?php
/**
 * Server-rendered markup for the Issue Details block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Saved content, intentionally empty.
 * @var WP_Block $block      Block instance.
 *
 * @package FieldnoteEditorialBlocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$fieldnote_defaults = array(
	'eyebrow'     => __( 'Field journal / 2026', 'fieldnote-editorial-blocks' ),
	'issueNumber' => '08',
	'title'       => __( 'Notes from the edge', 'fieldnote-editorial-blocks' ),
	'summary'     => __( 'Patient technology, public spaces, and the quiet work behind lasting change.', 'fieldnote-editorial-blocks' ),
	'dateLabel'   => __( 'August 2026', 'fieldnote-editorial-blocks' ),
);
$fieldnote_values   = wp_parse_args( $attributes, $fieldnote_defaults );
$fieldnote_label    = sprintf(
	/* translators: 1: issue number, 2: issue title. */
	__( 'Issue %1$s: %2$s', 'fieldnote-editorial-blocks' ),
	$fieldnote_values['issueNumber'],
	wp_strip_all_tags( $fieldnote_values['title'] )
);
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'fieldnote-issue-details' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> aria-label="<?php echo esc_attr( $fieldnote_label ); ?>">
	<p class="fieldnote-issue-details__eyebrow"><?php echo esc_html( $fieldnote_values['eyebrow'] ); ?></p>
	<p class="fieldnote-issue-details__number" aria-hidden="true"><?php echo esc_html( $fieldnote_values['issueNumber'] ); ?></p>
	<h2 class="fieldnote-issue-details__title"><?php echo wp_kses_post( $fieldnote_values['title'] ); ?></h2>
	<p class="fieldnote-issue-details__summary"><?php echo esc_html( $fieldnote_values['summary'] ); ?></p>
	<p class="fieldnote-issue-details__date"><?php echo esc_html( $fieldnote_values['dateLabel'] ); ?></p>
</section>
