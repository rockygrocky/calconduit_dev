<?php
/**
 * WARNING: This file is part of the Padora theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();


add_action( 'init', 'themekit_member_post_type' );

/**
 * Setup member post type and it own taxonomies
 * 
 * @return  void
 */
function themekit_member_post_type() {
	if ( ! current_theme_supports( 'themekit-members' ) )
		return;

	register_post_type( 'member', array(
		'labels'             => array(
			'name'               => __( 'Team Members', 'themekit' ),
			'singular_name'      => __( 'Member', 'themekit' ),
			'add_new'            => __( 'Add New', 'themekit' ),
			'add_new_item'       => __( 'Add New Member', 'themekit' ),
			'edit'               => __( 'Edit', 'themekit' ),
			'edit_item'          => __( 'Edit Member', 'themekit' ),
			'new_item'           => __( 'New Member', 'themekit' ),
			'all_items'          => __( 'All Members', 'themekit' ),
			'view'               => __( 'View Member', 'themekit' ),
			'view_item'          => __( 'View Member', 'themekit' ),
			'search_items'       => __( 'Search Members', 'themekit' ),
			'not_found'          => __( 'No Member Found', 'themekit' ),
			'not_found_in_trash' => __( 'No Member Found In Trash', 'themekit' ),
			'parent_item_colon'  => '' /* text for parent types */
		),
		'description'        => __( 'Create a member item', 'themekit' ),
		'public'             => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'publicly_queryable' => true,
		/* queries can be performed on the front end */
		'has_archive'        => true,
		'rewrite'            => array(
			'slug' => 'member'
		),
		'show_in_nav_menus'  => true,
		'menu_icon'          => 'dashicons-groups',
		'hierarchical'       => false,
		'query_var'          => true,
		/* Sets the query_var key for this post type. Default: true - set to $post_type */
		'supports' => array(
			'title',
			'editor',
			'thumbnail'
		),
		'capabilities' => array(
			'edit_post'         => 'edit_pages',
			'read_post'         => 'edit_pages',
			'delete_post'       => 'edit_pages',
			'edit_posts'        => 'edit_pages',
			'edit_others_posts' => 'edit_pages',
			'publish_posts'     => 'edit_pages',
			'read_private_posts'=> 'edit_pages',

			'read'                  => 'edit_pages',
			'delete_posts'          => 'edit_pages',
			'delete_private_posts'  => 'edit_pages',
			'delete_published_posts'=> 'edit_pages',
			'delete_others_posts'   => 'edit_pages',
			'edit_private_posts'    => 'edit_pages',
			'edit_published_posts'  => 'edit_pages',
		),
	) );

	/**
	 * Register category taxonomy
	 */
	register_taxonomy( 'member-category', 'member', array(
		'labels'            => array(
			'name'              => _x( 'Member Categories', 'taxonomy general name', 'themekit' ),
			'singular_name'     => _x( 'Member Category', 'taxonomy singular name', 'themekit' ),
			'search_items'      => __( 'Search Categories', 'themekit' ),
			'all_items'         => __( 'All Categories', 'themekit' ),
			'parent_item'       => __( 'Parent Category', 'themekit' ),
			'parent_item_colon' => __( 'Parent Category:', 'themekit' ),
			'edit_item'         => __( 'Edit Category', 'themekit' ),
			'update_item'       => __( 'Update Category', 'themekit' ),
			'add_new_item'      => __( 'Add New Category', 'themekit' ),
			'new_item_name'     => __( 'New Category Name', 'themekit' ),
			'menu_name'         => __( 'Categories', 'themekit' )
		),
		'public'            => true,
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'rewrite'           => array(
			'slug' => 'member-category'
		),
	) );
}



add_action( 'admin_init', 'themekit_member_options' );

/**
 * Register options for member post type
 * 
 * @return  void
 */
function themekit_member_options() {
	global $_themekit_member_properties;

	$options = array();
	$options['subtitle'] = array(
		'type'    => 'text',
		'label'   => __( 'Subtitle', 'themekit' ),
		'section' => 'all'
	);

	$options['email'] = array(
		'type'    => 'text',
		'label'   => __( 'Email', 'themekit' ),
		'section' => 'all'
	);

	$options['phone'] = array(
		'type'    => 'text',
		'label'   => __( 'Phone Number', 'themekit' ),
		'section' => 'all'
	);

	$options['social_links'] = array(
		'type'    => 'social-icons',
		'label'   => __( 'Social Links', 'themekit' ),
		'section' => 'all',
		'default' => array()
	);

	$_themekit_member_properties = new \OptionsPlus\Metabox\Properties( 'member-options', array(
		'label'       => __( 'Member Information', 'themekit' ),
		'post_types'  => 'member',
		'context'     => 'normal',
		'priority'    => 'high',
		'storage_key' => '_member_options',
		'show_tabs'   => false,
		'sections'    => array(
			'all' => array( 'title' => __( 'Member Information', 'themekit' ) ) 
		),
		'options'     => apply_filters( 'themekit/member_info_options', $options )
	) );
}
