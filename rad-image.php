<?php
/**
 * Plugin Name:     Image Viewer
 * Plugin URI:
 * Description:
 * Author:          Kitestring Studio
 * Author URI:      https://kitestring.studio
 * Text Domain:     rad_image
 * Domain Path:     /languages
 * Version:         0.1.6
 *
 * @package         Image_Viewer
 */

const RAD_VERSION = '0.1.6';

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'plugins_loaded', function () {
	if ( ! plugin_dependencies_met() ) {
		return;
	}

	//	require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
	require_once plugin_dir_path( __FILE__ ) . 'include/cpt.php';
	require_once plugin_dir_path( __FILE__ ) . 'include/acf.php';
	require_once plugin_dir_path( __FILE__ ) . 'include/class-rad-image-viewer.php';

	new RAD_Image_Viewer( RAD_VERSION );
}, 20 );

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


function plugin_dependencies_met() {
	$required_plugins = array(
		'advanced-custom-fields-pro/acf.php',
//		'simplelightbox/simplelightbox.php'
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


