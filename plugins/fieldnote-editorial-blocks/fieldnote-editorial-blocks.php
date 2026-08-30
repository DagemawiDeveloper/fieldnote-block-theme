<?php
/**
 * Plugin Name:       Fieldnote Editorial Blocks
 * Plugin URI:        https://github.com/DagemawiDeveloper/fieldnote-block-theme
 * Description:       Focused editorial blocks for the Fieldnote publishing system.
 * Version:           1.0.0
 * Requires at least: 7.1
 * Requires PHP:      7.4
 * Author:            Dagemawi Alemayehu
 * Author URI:        https://github.com/DagemawiDeveloper
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       fieldnote-editorial-blocks
 *
 * @package FieldnoteEditorialBlocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FIELDNOTE_EDITORIAL_BLOCKS_VERSION', '1.0.0' );
define( 'FIELDNOTE_EDITORIAL_BLOCKS_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Register each block from its metadata.
 *
 * Keeping the blocks in a companion plugin means posts remain portable when
 * a publication changes themes. The Fieldnote theme enhances their visuals,
 * but it is not required for the blocks to render correctly.
 *
 * @return void
 */
function fieldnote_editorial_blocks_register() {
	$block_directories = array(
		FIELDNOTE_EDITORIAL_BLOCKS_PATH . 'blocks/issue-details',
		FIELDNOTE_EDITORIAL_BLOCKS_PATH . 'blocks/lead-story',
	);

	foreach ( $block_directories as $block_directory ) {
		register_block_type( $block_directory );
	}
}
add_action( 'init', 'fieldnote_editorial_blocks_register' );

/**
 * Add a focused inserter category for editorial building blocks.
 *
 * @param array[] $categories Existing block categories.
 * @return array[]
 */
function fieldnote_editorial_blocks_category( $categories ) {
	return array_merge(
		array(
			array(
				'slug'  => 'fieldnote-editorial',
				'title' => __( 'Fieldnote editorial', 'fieldnote-editorial-blocks' ),
			),
		),
		$categories
	);
}
add_filter( 'block_categories_all', 'fieldnote_editorial_blocks_category' );

/**
 * Register compositions that demonstrate the blocks without coupling them to
 * the theme's bundled pattern collection.
 *
 * @return void
 */
function fieldnote_editorial_blocks_register_patterns() {
	register_block_pattern_category(
		'fieldnote-editorial-blocks',
		array(
			'label' => __( 'Fieldnote blocks', 'fieldnote-editorial-blocks' ),
		)
	);

	register_block_pattern(
		'fieldnote-editorial-blocks/issue-masthead',
		array(
			'title'         => __( 'Issue masthead', 'fieldnote-editorial-blocks' ),
			'description'   => __( 'Issue context beside a dynamically selected lead story.', 'fieldnote-editorial-blocks' ),
			'categories'    => array( 'fieldnote-editorial-blocks', 'featured' ),
			'viewportWidth' => 1440,
			'content'       => '<!-- wp:columns {"align":"wide","verticalAlignment":"stretch"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-stretch"><!-- wp:column {"verticalAlignment":"stretch","width":"36%"} -->
<div class="wp-block-column is-vertically-aligned-stretch" style="flex-basis:36%"><!-- wp:fieldnote/issue-details /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"stretch","width":"64%"} -->
<div class="wp-block-column is-vertically-aligned-stretch" style="flex-basis:64%"><!-- wp:fieldnote/lead-story {"layout":"stacked"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
		)
	);

	register_block_pattern(
		'fieldnote-editorial-blocks/lead-dispatch',
		array(
			'title'         => __( 'Lead dispatch', 'fieldnote-editorial-blocks' ),
			'description'   => __( 'A wide lead story selected from published posts.', 'fieldnote-editorial-blocks' ),
			'categories'    => array( 'fieldnote-editorial-blocks', 'posts' ),
			'viewportWidth' => 1280,
			'content'       => '<!-- wp:fieldnote/lead-story {"align":"wide"} /-->',
		)
	);
}
add_action( 'init', 'fieldnote_editorial_blocks_register_patterns' );
