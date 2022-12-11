<?php
/**
 * Plugin Name:     DICOM Viewer KS
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          Kitestring Studio
 * Author URI:      https://kitestring.studio
 * Text Domain:     dicom-viewer-plugin
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Dicom_Viewer_Plugin
 */

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Or using acfe/init
function custom_post_type_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'id' => '',
		),
		$atts,
		'custom_post_type'
	);

	$post_id = $atts['id'];

	// Get the custom post type object.
	$post = get_post( $post_id );

	// Check if the post exists.
	if ( ! $post ) {
		return '';
	}

	// Get the post type.
	$post_type = $post->post_type;

	// Check if the post type is the custom post type.
	if ( 'dicom' !== $post_type ) {
		return '';
	}

	// Get the ACF fields.
	$image_set_title = get_field( 'image_set_title', $post_id );
	$images = get_field( 'images', $post_id );

	// make an array from ihe ID property of each array element in $images
	$images_array = array_map(function($image) {
		return $image['ID'];
	}, $images);

	// convert the array to a string
	$images_list = implode(',', $images_array);

	$images_urls = array_map(function($image) {
		return $image['url'];
	}, $images);
	$image_urls_list = implode(',', $images_urls);

	// Create the output.
	$output = '';
	$output .= '<h2>' . esc_html( $image_set_title ) . '</h2>';

	// create a gallery shortcode using the list of image IDs
//	$output .= '[gallery ids="' . $images_list . '" link=file]';

//	$output .= do_shortcode('[dcm src="' . $image_urls_list . '"]');


	return $output;
}

function dicom_shortcode_func( $atts) {
	$atts = shortcode_atts(
		array(
			'id' => '',
		),
		$atts,
		'custom_post_type'
	);

	$post_id = $atts['id'];

	$image_set_title = get_field( 'image_set_title', $post_id );
	$images = get_field( 'images', $post_id );
	$image_count = count($images);
}

add_shortcode( 'dicom', 'dicom_shortcode_func' );

function dicom_viewer_enqueue_scripts() {
	if ( is_singular( 'dicom' ) ) {
		$plugin_root_url = plugin_dir_url( __FILE__ );
		wp_enqueue_script( 'keyshotxr', $plugin_root_url . 'assets/js/KeyShotXR.js', array(), '1.0' );
		wp_enqueue_script( 'keyshot-init', $plugin_root_url . 'assets/js/keyshot_init.js', array(), '1.0', true );

		// get the post ID
		$post_id = get_the_ID();

		$image_array = get_field( 'images', $post_id );
		$image_count = count($image_array);

		$dynamic_data = array(
			'image_set_count' => $image_count
		);
		wp_localize_script( 'keyshot-init', 'dicom_viewer_data', $dynamic_data );
	}
}
add_action( 'wp_enqueue_scripts', 'dicom_viewer_enqueue_scripts' );

