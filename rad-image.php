<?php
/**
 * Plugin Name:     Image Viewer
 * Plugin URI:
 * GitHub Plugin URI: https://github.com/kitestring-studio/git-updater
 * Description:
 * Author:          Kitestring Studio
 * Author URI:      https://kitestring.studio
 * Text Domain:     rad_image
 * Domain Path:     /languages
 * Version:         0.1.7
 *
 * @package         Image_Viewer
 */

const RAD_VERSION = '0.1.7';
const RAD_CPT_SLUG = 'rad_image'; // @TODO pass into constructor

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'plugins_loaded', function () {
	if ( ! rad_plugin_dependencies_met() ) {
		return;
	}

	//	require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
	require_once plugin_dir_path( __FILE__ ) . 'include/cpt.php';
	require_once plugin_dir_path( __FILE__ ) . 'include/acf.php';
	require_once plugin_dir_path( __FILE__ ) . 'include/hooks.php';
	require_once plugin_dir_path( __FILE__ ) . 'include/class-rad-image-viewer.php';

	new RAD_Image_Viewer( RAD_VERSION );
}, 20 );

