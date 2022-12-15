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
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once plugin_dir_path( __FILE__ ) . 'include/dicom-cpt.php';
require_once plugin_dir_path( __FILE__ ) . 'include/class-dicom-viewer.php';


new Dicom_Viewer();
