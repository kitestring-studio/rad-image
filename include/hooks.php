<?php


function rad_acf_json_load_point( $paths ) {
	// remove original path (optional)
	unset( $paths[0] );

	$paths[] = plugin_dir_path( __FILE__ ) . 'data';

	return $paths;
}

add_filter( 'acf/settings/load_json', 'rad_acf_json_load_point' );

function rad_acf_json_save_point( $path ) {
	return plugin_dir_path( __FILE__ ) . 'data';
}

add_filter( 'acf/settings/save_json', 'rad_acf_json_save_point' );

/**
 * prevent wordpress from creating alternate image resolutions for "rad_image" custom post type
 * @TODO add thumbnail size back in
 *
 * @param $sizes
 *
 * @return array|mixed
 */
function remove_image_sizes( $sizes ) {
	$post_id = (int) $_REQUEST['post_id'] ?? 0;

	if ( RAD_CPT_SLUG === get_post_type( $post_id ) ) {
		return array();
	}

	return $sizes;
}

add_filter( 'intermediate_image_sizes_advanced', 'remove_image_sizes', 1000 );

function wp_custom_upload_dir( $param ) {
	// Check if this is a rad_image post and if the images field is being used
	$post_id   = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
	$field_key = isset( $_POST['_acfuploader'] ) ? sanitize_text_field( $_POST['_acfuploader'] ) : '';
	if ( RAD_CPT_SLUG !== get_post_type( $post_id ) || 'field_638c863653019' !== $field_key ) { // @TODO remove hardcoded field key
		return $param;
	}

	// Set a custom upload directory
	$time          = current_time( 'mysql' );
	$y             = substr( $time, 0, 4 );
	$m             = substr( $time, 5, 2 );
	$param['path'] = $param['basedir'] . "/$y/$m/rad-$post_id";
	$param['url']  = $param['baseurl'] . "/$y/$m/rad-$post_id";

	return $param;
}

add_filter( 'upload_dir', 'wp_custom_upload_dir' );
