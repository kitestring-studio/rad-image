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

	$paths[] = plugin_dir_path( __FILE__ ) . 'data';

	return $paths;
}

add_filter( 'acf/settings/load_json', 'rad_acf_json_load_point' );


function rad_acf_json_save_point( $path ) {

	return plugin_dir_path( __FILE__ ) . 'data';
}

add_filter( 'acf/settings/save_json', 'rad_acf_json_save_point' );
