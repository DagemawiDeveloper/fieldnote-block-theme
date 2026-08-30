<?php
/**
 * Theme setup and editor-focused enhancements.
 *
 * Fieldnote intentionally leaves layout and most presentation in theme.json.
 * PHP is used only where WordPress APIs provide clearer, reusable behavior.
 *
 * @package Fieldnote
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Configure editor styles and block-specific assets.
 *
 * @return void
 */
function fieldnote_setup() {
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'style.css', 'assets/css/editor.css' ) );

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_block_style(
		'core/button',
		array(
			'handle' => 'fieldnote-core-button',
			'src'    => get_theme_file_uri( 'assets/css/blocks/button.css' ),
			'path'   => get_theme_file_path( 'assets/css/blocks/button.css' ),
			'ver'    => $theme_version,
		)
	);
}
add_action( 'after_setup_theme', 'fieldnote_setup' );

/**
 * Group the bundled patterns into purposeful inserter categories.
 *
 * @return void
 */
function fieldnote_register_pattern_categories() {
	register_block_pattern_category(
		'fieldnote',
		array(
			'label' => __( 'Fieldnote editorial', 'fieldnote' ),
		)
	);

	register_block_pattern_category(
		'fieldnote-sections',
		array(
			'label' => __( 'Fieldnote sections', 'fieldnote' ),
		)
	);
}
add_action( 'init', 'fieldnote_register_pattern_categories' );
