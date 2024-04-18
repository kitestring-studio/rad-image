<?php
/**
 * Plugin Name:     Image Viewer
 * Plugin URI:
 * GitHub Plugin URI: https://github.com/kitestring-studio/rad-image
 * Description:
 * Author:          Kitestring Studio
 * Author URI:      https://kitestring.studio
 * Text Domain:     rad_image
 * Domain Path:     /languages
 * Version:         2.0.4
 * License:         GPL-2.0+
 *
 * @package         Image_Viewer
 */

const RAD_VERSION    = '2.0.4';
const RAD_CPT_SLUG   = 'rad_image'; // @TODO pass into constructor
const RAD_PLUGIN_DIR = __DIR__;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once plugin_dir_path( __FILE__ ) . 'include/hooks.php';
add_action( 'plugins_loaded', function () {
	if ( ! rad_plugin_dependencies_met() ) {
		return;
	}

	require_once plugin_dir_path( __FILE__ ) . 'include/cpt.php';
	require_once plugin_dir_path( __FILE__ ) . 'include/acf.php';
	require_once plugin_dir_path( __FILE__ ) . 'include/class-rad-image-viewer.php';

	add_action('wp_enqueue_scripts', 'enqueue_fancybox_script' );

	new RAD_Image_Viewer( RAD_VERSION );
}, 20 );



function enqueue_fancybox_script() {
	$a=1;
	?>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			console.log("fancybox")
			Fancybox.bind('[data-fancybox]', {
				compact: false
			});
		});
	</script>
	<?php
}

