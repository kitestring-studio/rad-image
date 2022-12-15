<?php

function cptui_register_my_cpts() {

	/**
	 * Post Type: DICOM Viewer.
	 */

	$labels = [
		"name" => esc_html__( "DICOM Viewer", "twentytwentythree" ),
		"singular_name" => esc_html__( "dicom-viewer", "twentytwentythree" ),
	];

	$args = [
		"label" => esc_html__( "DICOM Viewer", "twentytwentythree" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "dicom", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-images-alt2",
		"supports" => [ "title", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "dicom", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

function cptui_register_my_cpts_dicom() {

	/**
	 * Post Type: DICOM Viewer.
	 */

	$labels = [
		"name" => esc_html__( "DICOM Viewer", "twentytwentythree" ),
		"singular_name" => esc_html__( "dicom-viewer", "twentytwentythree" ),
	];

	$args = [
		"label" => esc_html__( "DICOM Viewer", "twentytwentythree" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "dicom", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-images-alt2",
		"supports" => [ "title", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "dicom", $args );
}

add_action( 'init', 'cptui_register_my_cpts_dicom' );
