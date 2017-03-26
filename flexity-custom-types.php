<?php
/*
Plugin Name: Flexity Custom Types
Description: A plugin that will create custom post types.
Version: 1.0
Author: Stockware
Author URI: http://themeforest.net/user/stockware
License: GNU General Public License
*/


/**
 * Include Vafpress Framework
 */
require_once 'vafpress-framework/bootstrap.php';


function flexity_widget_scripts_styles() {
	wp_enqueue_style('zabuto_calendar', plugin_dir_url(__FILE__).'/css/zabuto_calendar.css', array(), null, 'all');
	wp_enqueue_script( 'zabuto_calendar', plugin_dir_url(__FILE__).'/js/zabuto_calendar.min.js', array( 'jquery' ), null, true);
}
add_action( 'wp_enqueue_scripts', 'flexity_widget_scripts_styles' );




function register_events_post_type() {
	$labels = array(
		'name'                => __( 'Events', 'flexity' ),
		'singular_name'       => __( 'Events', 'flexity' ),
		'menu_name'           => __( 'Events', 'flexity' ),
	);
	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-calendar',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor'
			)
	);
	register_post_type( 'events', $args );
}
add_action( 'init', 'register_events_post_type' );




function register_flexity_gallery_post_type() {
	$labels = array(
		'name'                => __( 'Gallery', 'flexity' ),
		'singular_name'       => __( 'Gallery', 'flexity' ),
		'menu_name'           => __( 'Gallery', 'flexity' ),
	);
	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-clipboard',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array('title', 'editor', 'thumbnail')
	);
	register_post_type( 'flexity_gallery', $args );
}
add_action( 'init', 'register_flexity_gallery_post_type' );



add_action('init', 'flexity_gallery_taxonomy');
function flexity_gallery_taxonomy(){
	// заголовки
	$labels = array(
		'name'              => 'Categories',
		'singular_name'     => 'Category',
	);
	// параметры
	$args = array(
		'public'                => true,
		'publicly_queryable'    => null,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_tagcloud'         => true,
		'hierarchical'          => true,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy,
		'capabilities'          => array(),
		'meta_box_cb'           => null,
		'show_admin_column'     => false,
		'_builtin'              => false,
		'show_in_quick_edit'    => null,
	);
	register_taxonomy('gallery_category', array('flexity_gallery'), $args );
}




include('widgets/widget-calendar.php');
include('widgets/widget-featured.php');
