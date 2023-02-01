<?php
/**
 * Plugin Name:     Image Viewer
 * Plugin URI:
 * Description:
 * Author:          Kitestring Studio
 * Author URI:      https://kitestring.studio
 * Text Domain:     rad_image
 * Domain Path:     /languages
 * Version:         0.1.4
 *
 * @package         Image_Viewer
 */

const RAD_VERSION = '0.1.4';

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

//require_once plugin_dir_path( __FILE__ ) . 'include/cpt.php';
//require_once plugin_dir_path( __FILE__ ) . 'include/acf.php';
require_once plugin_dir_path( __FILE__ ) . 'include/class-dicom-viewer.php';

if( function_exists('acf_add_local_field_group') ){
	new Dicom_Viewer(RAD_VERSION);
}

function qm( string $input) {
	do_action( 'qm/info', [$input] );

	return $input;
}

add_filter('acf/settings/load_json', 'rad_acf_json_load_point' );

function rad_acf_json_load_point( $paths ) {

	// remove original path (optional)
	unset($paths[0]);

	$paths[] = plugin_dir_path( __FILE__ ) . 'data';

	return $paths;
}

add_filter('acf/settings/save_json', 'rad_acf_json_save_point' );

function rad_acf_json_save_point( $path ) {

	return plugin_dir_path( __FILE__ ) . 'data';

}
