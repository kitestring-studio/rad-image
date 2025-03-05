<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rad_plugin_dependencies_met() {
	$required_plugins = array(
		'advanced-custom-fields-pro/acf.php',
	);

	$missing_plugins = array();

	foreach ( $required_plugins as $plugin ) {
		if ( ! is_plugin_active( $plugin ) ) {
			$missing_plugins[] = $plugin;
		}
	}

	if ( ! empty( $missing_plugins ) ) {
		add_action( 'admin_notices', function () use ( $missing_plugins ) {
			?>
			<div class="notice notice-error">
				<p><?php printf( __( 'The following plugins are required for the Image Viewer plugin to work: %s', 'rad_image' ), implode( ', ', $missing_plugins ) ); ?></p>
			</div>
			<?php
		} );

		return false;
	}

	return true;
}

function rad_acf_json_load_point( $paths ) {

	// remove original path (optional)
	unset( $paths[0] );

	$paths[] = RAD_PLUGIN_DIR . '/data';

	return $paths;
}

add_filter( 'acf/settings/load_json', 'rad_acf_json_load_point' );


function rad_acf_json_save_point( $path ) {

	return RAD_PLUGIN_DIR . '/data';
}

add_filter( 'acf/settings/save_json', 'rad_acf_json_save_point' );


/**
 * displays the rad_image shortcode as the content of the rad_image post type
 *
 * @param $content
 *
 * @return string|string[]|null
 */
function render_image_viewer_shortcode_in_content( $content ) {
	global $post;
	if ( doing_filter( 'get_the_excerpt' ) || ! is_singular( 'rad_image' ) /* || ! current_user_can( 'manage_options' ) &&*/ ) {
		return $content;
	}

	return do_shortcode( '[rad_image id=' . $post->ID . ']' );

}

add_filter( 'the_content', 'render_image_viewer_shortcode_in_content' );

/**
 * Creates rad_image "type" column
 *
 * @param $columns
 *
 * @return mixed
 */
function add_type_column( $columns ) {
	$columns['type'] = 'Viewer Type';

	return $columns;
}

add_filter( 'manage_rad_image_posts_columns', 'add_type_column' );

/**
 * Populates values in rad_image 'type' column
 *
 * @param $column
 * @param $post_id
 *
 * @return void
 */
function populate_type_column_data( $column, $post_id ) {
	if ( $column === 'type' ) {
		$type_value = get_field( 'type', $post_id );
		if ( $type_value ) {
			echo esc_html( $type_value );
		} else {
			echo '—'; // Display a placeholder if the field is empty.
		}
	}
}

add_action( 'manage_rad_image_posts_custom_column', 'populate_type_column_data', 10, 2 );

// add 'slug' column
function add_slug_column( $columns ) {
	$columns['slug'] = 'Slug';

	return $columns;
}

add_filter( 'manage_rad_image_posts_columns', 'add_slug_column', 1 );

/**
 * Populates values in rad_image 'slug' column
 *
 * @param $column
 * @param $post_id
 *
 * @return void
 */
function populate_slug_column_data( $column, $post_id ) {
	if ( $column === 'slug' ) {
		global $post;
		$slug_value = $post->post_name;
		if ( $slug_value ) {
			echo esc_html( $slug_value );
		} else {
			echo '—'; // Display a placeholder if the field is empty.
		}
	}
}

add_action( 'manage_rad_image_posts_custom_column', 'populate_slug_column_data', 10, 2 );
