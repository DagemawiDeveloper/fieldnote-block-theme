<?php
/**
 * Seed a disposable WordPress Playground instance with representative content.
 *
 * This file is loaded only by blueprint.json. It is intentionally kept out of
 * both installable ZIP files and never runs in a normal theme or plugin setup.
 *
 * @package Fieldnote
 * @subpackage Demo
 */

require_once '/wordpress/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

if ( '1.0.1' === get_option( 'fieldnote_demo_seed_version' ) ) {
	return;
}

/**
 * Download a repository image and add it to the media library.
 *
 * @param string $filename Repository filename.
 * @param string $title    Attachment title.
 * @return int Attachment ID, or zero when networking is unavailable.
 */
function fieldnote_demo_import_image( $filename, $title ) {
	$url      = 'https://raw.githubusercontent.com/DagemawiDeveloper/fieldnote-block-theme/main/demo/media/' . rawurlencode( $filename );
	$tempfile = download_url( $url, 30 );

	if ( is_wp_error( $tempfile ) ) {
		return 0;
	}

	$file = array(
		'name'     => sanitize_file_name( $filename ),
		'tmp_name' => $tempfile,
	);
	$id   = media_handle_sideload( $file, 0, $title );

	if ( is_wp_error( $id ) ) {
		wp_delete_file( $tempfile );
		return 0;
	}

	return (int) $id;
}

/**
 * Build article body blocks from three concise sections.
 *
 * @param string $opening Opening paragraph.
 * @param string $middle  Supporting paragraph.
 * @param string $closing Closing paragraph.
 * @return string Serialized block content.
 */
function fieldnote_demo_story_content( $opening, $middle, $closing ) {
	return sprintf(
		'<!-- wp:paragraph {"fontSize":"lead"} --><p class="has-lead-font-size">%1$s</p><!-- /wp:paragraph -->

<!-- wp:heading --><h2 class="wp-block-heading">What becomes visible</h2><!-- /wp:heading -->

<!-- wp:paragraph --><p>%2$s</p><!-- /wp:paragraph -->

<!-- wp:quote --><blockquote class="wp-block-quote"><!-- wp:paragraph --><p>Good fieldwork does not remove uncertainty. It makes uncertainty legible enough to act on.</p><!-- /wp:paragraph --></blockquote><!-- /wp:quote -->

<!-- wp:heading --><h2 class="wp-block-heading">A practical next step</h2><!-- /wp:heading -->

<!-- wp:paragraph --><p>%3$s</p><!-- /wp:paragraph -->',
		esc_html( $opening ),
		esc_html( $middle ),
		esc_html( $closing )
	);
}

/**
 * Find a post by exact title without relying on deprecated convenience APIs.
 *
 * @param string $title     Post title.
 * @param string $post_type Post type.
 * @return WP_Post|null
 */
function fieldnote_demo_find_post_by_title( $title, $post_type = 'post' ) {
	$query = new WP_Query(
		array(
			'fields'                 => 'ids',
			'no_found_rows'          => true,
			'post_status'            => 'any',
			'post_type'              => $post_type,
			'posts_per_page'         => 1,
			'suppress_filters'       => true,
			'title'                  => $title,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		)
	);

	return $query->posts ? get_post( $query->posts[0] ) : null;
}

update_option( 'blogname', 'Fieldnote' );
update_option( 'blogdescription', 'Reporting, essays, and practical notes from people paying attention.' );
update_option( 'posts_per_page', 9 );
update_option( 'default_comment_status', 'closed' );
update_option( 'timezone_string', 'Africa/Addis_Ababa' );

$administrator = get_user_by( 'id', 1 );
if ( $administrator ) {
	wp_update_user(
		array(
			'ID'           => $administrator->ID,
			'display_name' => 'Mara Bello',
			'first_name'   => 'Mara',
			'last_name'    => 'Bello',
			'description'  => 'Mara reports on civic systems, public technology, and the small decisions that shape everyday life.',
		)
	);
}

$second_author = get_user_by( 'login', 'elias-rowe' );
if ( ! $second_author ) {
	$second_author_id = wp_insert_user(
		array(
			'user_login'   => 'elias-rowe',
			'user_email'   => 'elias@example.invalid',
			'user_pass'    => wp_generate_password( 28, true, true ),
			'display_name' => 'Elias Rowe',
			'first_name'   => 'Elias',
			'last_name'    => 'Rowe',
			'description'  => 'Elias writes about landscape, care infrastructure, and the craft of patient observation.',
			'role'         => 'author',
		)
	);
	$second_author    = is_wp_error( $second_author_id ) ? null : get_user_by( 'id', $second_author_id );
}

$category_names = array( 'Cities', 'Environment', 'Fieldwork', 'Health', 'Technology' );
$categories     = array();
foreach ( $category_names as $category_name ) {
	$category_term = term_exists( $category_name, 'category' );
	if ( ! $category_term ) {
		$category_term = wp_insert_term( $category_name, 'category' );
	}
	if ( ! is_wp_error( $category_term ) ) {
		$categories[ $category_name ] = (int) ( is_array( $category_term ) ? $category_term['term_id'] : $category_term );
	}
}

$image_ids = array(
	fieldnote_demo_import_image( 'quiet-systems.png', 'Quiet systems' ),
	fieldnote_demo_import_image( 'civic-rhythm.png', 'Civic rhythm' ),
	fieldnote_demo_import_image( 'field-method.png', 'Field method' ),
	fieldnote_demo_import_image( 'threshold-lines.png', 'Threshold lines' ),
);
$image_ids = array_values( array_filter( $image_ids ) );

$stories = array(
	array(
		'title'    => 'The quiet systems behind trustworthy public data',
		'category' => 'Technology',
		'excerpt'  => 'Reliability is often invisible. We followed the safeguards that keep a public dataset useful after the launch day excitement has passed.',
		'body'     => array(
			'A public dashboard can look complete while the system underneath it remains fragile. The durable work happens in validation rules, careful handoffs, and the habit of asking what a number cannot show.',
			'Teams that earn trust treat provenance, correction, and failure recovery as product features. They leave a trail that another person can inspect instead of asking users to trust a polished surface.',
			'Start by documenting one high-risk data path from collection to publication. Mark each transformation, owner, and recovery point. The exercise quickly reveals where confidence is assumed rather than demonstrated.',
		),
	),
	array(
		'title'    => 'What a public square teaches us about belonging',
		'category' => 'Cities',
		'excerpt'  => 'Three blocks, four entrances, and hundreds of small choices reveal how a place quietly tells people whether they are welcome.',
		'body'     => array(
			'Belonging is designed in details: a shaded seat, a path wide enough for two people, a crossing that does not punish a slower pace. None is dramatic alone, but together they establish who a place expects.',
			'Observation changes the design conversation. Instead of debating a plan in the abstract, teams can study where people pause, which routes they avoid, and how the space changes between morning and evening.',
			'Before proposing another object, spend an hour recording movements and interruptions. The most useful intervention may be removing friction rather than adding a landmark.',
		),
	),
	array(
		'title'    => 'Field notes from a clinic moving care closer',
		'category' => 'Health',
		'excerpt'  => 'A neighborhood clinic redesigned its intake around the journey patients actually make—not the workflow its software assumed.',
		'body'     => array(
			'The clinic began with a simple question: where does a visit become difficult? Staff traced the journey from the first phone call through transport, registration, consultation, and follow-up.',
			'The resulting changes were modest but connected. Fewer repeated questions, clearer appointment messages, and one responsible contact reduced uncertainty more effectively than a larger portal redesign.',
			'Map the patient journey using real recent cases, including the exceptions. Improvements become easier to prioritize when the team sees where time, information, and responsibility are repeatedly lost.',
		),
	),
	array(
		'title'    => 'A map is a promise, not the territory',
		'category' => 'Fieldwork',
		'excerpt'  => 'Good route planning begins when the neat polygon meets weather, access, local knowledge, and the pace of real field teams.',
		'body'     => array(
			'A route plan is useful because it reduces ambiguity, but it becomes dangerous when its precision is mistaken for certainty. Roads close, boundaries shift, and a short distance on screen can be a difficult hour on foot.',
			'The strongest field teams treat the map as a shared hypothesis. They record deviations, explain why they occurred, and let tomorrow’s plan learn from today’s conditions.',
			'Give every route a clear fallback and a simple way to report blocked access. The quality of the feedback loop matters more than the apparent perfection of the initial line.',
		),
	),
	array(
		'title'    => 'Designing tools that make room for judgment',
		'category' => 'Technology',
		'excerpt'  => 'A useful system guides repeatable work without pretending every meaningful decision can be reduced to a dropdown.',
		'body'     => array(
			'Software becomes brittle when it treats an edge case as user failure. In complex work, exceptions often contain the most important information, especially when conditions change faster than policy.',
			'Good tools combine structure with an accountable escape hatch. They make the normal path obvious, preserve context around deviations, and show who made a judgment without turning the interface into surveillance.',
			'Review the places where users keep notes outside the system. Those workarounds are evidence of missing context, not merely resistance to process.',
		),
	),
	array(
		'title'    => 'The long repair: restoring a river one season at a time',
		'category' => 'Environment',
		'excerpt'  => 'Restoration work is measured in seasons, relationships, and repeated maintenance—not only in the photograph taken after planting day.',
		'body'     => array(
			'The visible intervention took one weekend. The repair took years. Local crews returned after storms, replaced failed plantings, and adjusted barriers as the river revealed new patterns.',
			'Long-term stewardship changes what success means. A project is not finished when funding ends; it is stable when knowledge, responsibility, and resources can continue without the original team.',
			'Pair every restoration metric with an owner and a future observation date. The calendar is part of the design, not an administrative afterthought.',
		),
	),
	array(
		'title'    => 'Small signals from a changing neighborhood',
		'category' => 'Cities',
		'excerpt'  => 'Before the statistics arrive, change appears in handwritten signs, altered routines, and the services people stop finding nearby.',
		'body'     => array(
			'Neighborhood change is often described after it becomes undeniable. Residents notice it earlier through rent conversations, longer journeys, and the disappearance of places that once held informal support networks.',
			'Quantitative indicators matter, but they arrive with delay and flatten different experiences into one trend line. Field observation helps explain what the line means and who is carrying the cost.',
			'Create a recurring walk with the same route and questions. Consistency turns scattered impressions into a record that can be compared, challenged, and acted upon.',
		),
	),
	array(
		'title'    => 'When the dashboard is not the decision',
		'category' => 'Technology',
		'excerpt'  => 'The best analytics surface a question and its uncertainty; they do not replace the accountable person who must choose what happens next.',
		'body'     => array(
			'Dashboards are powerful because they compress. That strength also removes context. A clean average can hide a failing region, a delayed source, or a group whose experience was never collected.',
			'Mature teams pair each decision metric with provenance, freshness, and a way to inspect the distribution beneath it. They know when a confident display is supported by uncertain evidence.',
			'For every executive metric, write the decision it informs and the conditions under which it should not be used. If the answer is unclear, the dashboard is presenting information without responsibility.',
		),
	),
	array(
		'title'    => 'Why patient reporting still matters',
		'category' => 'Fieldwork',
		'excerpt'  => 'Fast collection is useful. Patient reporting is what makes a dataset defensible when conditions, people, and assumptions change.',
		'body'     => array(
			'The fastest route through fieldwork is rarely the most informative. Trust takes time: explaining purpose, listening for ambiguity, and recording enough context to understand an answer later.',
			'Patient collection does not mean avoiding technology. It means using technology to reduce repetitive effort while protecting the moments that require human attention and local judgment.',
			'Add one quality checkpoint that asks whether the record makes sense in context, not only whether required fields are complete. Completion and credibility are different properties.',
		),
	),
);

$base_time = strtotime( '2026-08-30 09:00:00' );
foreach ( $stories as $index => $story ) {
	$existing = fieldnote_demo_find_post_by_title( $story['title'] );
	if ( $existing ) {
		continue;
	}

	$author_id       = ( $second_author && 1 === $index % 2 ) ? $second_author->ID : 1;
	$created_post_id = wp_insert_post(
		array(
			'post_author'   => $author_id,
			'post_category' => array( $categories[ $story['category'] ] ),
			'post_content'  => fieldnote_demo_story_content( $story['body'][0], $story['body'][1], $story['body'][2] ),
			'post_date'     => gmdate( 'Y-m-d H:i:s', $base_time - ( $index * DAY_IN_SECONDS ) ),
			'post_excerpt'  => $story['excerpt'],
			'post_status'   => 'publish',
			'post_title'    => $story['title'],
			'post_type'     => 'post',
			'tags_input'    => array( 'Field notes', 'Issue 08' ),
		),
		true
	);

	if ( ! is_wp_error( $created_post_id ) && $image_ids ) {
		set_post_thumbnail( $created_post_id, $image_ids[ $index % count( $image_ids ) ] );
	}
}

$demo_pages = array(
	'editorial-blocks' => array(
		'title'   => 'Editorial Blocks',
		'content' => '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} --><div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70)"><!-- wp:paragraph {"className":"fieldnote-kicker","textColor":"clay-dark"} --><p class="fieldnote-kicker has-clay-dark-color has-text-color">Fieldnote 1.0 / Block lab</p><!-- /wp:paragraph --><!-- wp:heading {"level":1,"fontSize":"display"} --><h1 class="wp-block-heading has-display-font-size">Editorial controls, rendered with care.</h1><!-- /wp:heading --><!-- wp:paragraph {"textColor":"graphite","fontSize":"lead"} --><p class="has-graphite-color has-text-color has-lead-font-size">These optional dynamic blocks keep content behavior in a companion plugin while the theme remains lightweight and portable.</p><!-- /wp:paragraph --></div><!-- /wp:group --><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} --><div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"stretch"} --><div class="wp-block-columns are-vertically-aligned-stretch"><!-- wp:column {"verticalAlignment":"stretch","width":"36%"} --><div class="wp-block-column is-vertically-aligned-stretch" style="flex-basis:36%"><!-- wp:fieldnote/issue-details /--></div><!-- /wp:column --><!-- wp:column {"verticalAlignment":"stretch","width":"64%"} --><div class="wp-block-column is-vertically-aligned-stretch" style="flex-basis:64%"><!-- wp:fieldnote/lead-story {"layout":"stacked"} /--></div><!-- /wp:column --></div><!-- /wp:columns --></div><!-- /wp:group --><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} --><div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:fieldnote/lead-story {"imagePosition":"right","eyebrow":"Selected from the journal"} /--></div><!-- /wp:group -->',
	),
	'about'            => array(
		'title'   => 'About Fieldnote',
		'content' => '<!-- wp:heading {"level":1,"fontSize":"display"} --><h1 class="wp-block-heading has-display-font-size">Reporting made to last.</h1><!-- /wp:heading --><!-- wp:paragraph {"fontSize":"lead"} --><p class="has-lead-font-size">Fieldnote is a fictional independent publication created to demonstrate a native WordPress editorial system.</p><!-- /wp:paragraph -->',
	),
	'newsletter'       => array(
		'title'   => 'The Field Letter',
		'content' => '<!-- wp:heading {"level":1,"fontSize":"display"} --><h1 class="wp-block-heading has-display-font-size">One useful letter, occasionally.</h1><!-- /wp:heading --><!-- wp:paragraph {"fontSize":"lead"} --><p class="has-lead-font-size">A demonstration signup page for the Fieldnote portfolio project. No form data is collected in Playground.</p><!-- /wp:paragraph -->',
	),
	'privacy'          => array(
		'title'   => 'Privacy',
		'content' => '<!-- wp:heading {"level":1,"fontSize":"display"} --><h1 class="wp-block-heading has-display-font-size">Privacy</h1><!-- /wp:heading --><!-- wp:paragraph --><p>This disposable demonstration installs no analytics, trackers, or remote font services.</p><!-- /wp:paragraph -->',
	),
	'accessibility'    => array(
		'title'   => 'Accessibility',
		'content' => '<!-- wp:heading {"level":1,"fontSize":"display"} --><h1 class="wp-block-heading has-display-font-size">Accessibility</h1><!-- /wp:heading --><!-- wp:paragraph --><p>Fieldnote is designed around visible focus, semantic landmarks, resilient layouts, reduced motion, strong contrast, and readable print output.</p><!-- /wp:paragraph -->',
	),
);

foreach ( $demo_pages as $slug => $demo_page ) {
	if ( get_page_by_path( $slug ) ) {
		continue;
	}
	wp_insert_post(
		array(
			'post_content' => $demo_page['content'],
			'post_name'    => $slug,
			'post_status'  => 'publish',
			'post_title'   => $demo_page['title'],
			'post_type'    => 'page',
		)
	);
}

$hello = get_page_by_path( 'hello-world', OBJECT, 'post' );
if ( $hello ) {
	wp_delete_post( $hello->ID, true );
}
$sample = get_page_by_path( 'sample-page', OBJECT, 'page' );
if ( $sample ) {
	wp_delete_post( $sample->ID, true );
}

global $wp_rewrite;
$wp_rewrite->set_permalink_structure( '/stories/%postname%/' );
$wp_rewrite->flush_rules();

update_option( 'fieldnote_demo_seed_version', '1.0.1' );
