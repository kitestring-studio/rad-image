<?php

function cptui_register_rad_image() {

	/**
	 * Post Type: Image Viewers.
	 */

	$labels = [
		"name"          => esc_html__( "Image Viewers", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Image Viewer", "custom-post-type-ui" ),
		"menu_name"     => esc_html__( "Image Viewer", "custom-post-type-ui" ),
	];

	$args = [
		"label"                 => esc_html__( "Image Viewers", "custom-post-type-ui" ),
		"labels"                => $labels,
		"description"           => "",
		"public"                => true,
		"publicly_queryable"    => true,
		"show_ui"               => true,
		"show_in_rest"          => false,
		"rest_base"             => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace"        => "wp/v2",
		"has_archive"           => false,
		"show_in_menu"          => true,
		"show_in_nav_menus"     => true,
		"delete_with_user"      => false,
		"exclude_from_search"   => true,
		"capability_type"       => "post",
		"map_meta_cap"          => true,
		"hierarchical"          => false,
		"can_export"            => true,
		"rewrite"               => [ "slug" => "rad_image", "with_front" => true ],
		"query_var"             => true,
		"menu_icon"             => "dashicons-images-alt2",
		"supports"              => [ "title" ],
		"show_in_graphql"       => false,
	];

	register_post_type( "rad_image", $args );
}

add_action( 'init', 'cptui_register_rad_image' );
