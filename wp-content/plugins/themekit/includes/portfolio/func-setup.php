<?php
/**
 * WARNING: This file is part of the Padora theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();


add_action( 'init', 'themekit_setup_post_type' );

/**
 * Setup portfolio post type and it own taxonomies
 * 
 * @return  void
 */
function themekit_setup_post_type() {
	if ( ! current_theme_supports( 'themekit-portfolio' ) )
		return;

	$default_permalinks = array(
		'portfolio_base' => 'portfolio',
		'category_base'  => 'portfolio-category',
		'tag_base'       => 'portfolio-tag'
	);
	$permalinks = array_merge( $default_permalinks,
		get_option( 'themekit_portfolio_permalinks', array() ) );
	
	register_post_type( 'portfolio', array(
		'labels'             => array(
			'name'               => __( 'Portfolios', 'themekit' ),
			'singular_name'      => __( 'Portfolio', 'themekit' ),
			'add_new'            => __( 'Add New', 'themekit' ),
			'add_new_item'       => __( 'Add New Portfolio', 'themekit' ),
			'edit'               => __( 'Edit', 'themekit' ),
			'edit_item'          => __( 'Edit Portfolio', 'themekit' ),
			'new_item'           => __( 'New Portfolio', 'themekit' ),
			'all_items'          => __( 'All Portfolios', 'themekit' ),
			'view'               => __( 'View Portfolio', 'themekit' ),
			'view_item'          => __( 'View Portfolio', 'themekit' ),
			'search_items'       => __( 'Search Portfolios', 'themekit' ),
			'not_found'          => __( 'No Portfolio Found', 'themekit' ),
			'not_found_in_trash' => __( 'No Portfolio Found In Trash', 'themekit' ),
			'parent_item_colon'  => '' /* text for parent types */
		),
		'description'        => __( 'Create a portfolio item', 'themekit' ),
		'public'             => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'publicly_queryable' => true,
		/* queries can be performed on the front end */
		'has_archive'        => true,
		'rewrite'            => array(
			'slug' => $permalinks['portfolio_base']
		),
		'show_in_nav_menus'  => true,
		'menu_icon'          => 'dashicons-format-gallery',
		'hierarchical'       => false,
		'query_var'          => true,
		/* Sets the query_var key for this post type. Default: true - set to $post_type */
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			// 'excerpt'
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
	register_taxonomy( 'portfolio-category', 'portfolio', array(
		'labels'            => array(
			'name'              => _x( 'Portfolio Categories', 'taxonomy general name', 'themekit' ),
			'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'themekit' ),
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
			'slug' => $permalinks['category_base']
		),
	) );

	/**
	 * Register tag taxonomy
	 */
	register_taxonomy( 'portfolio-tag', 'portfolio', array(
		'labels'            => array(
			'name'              => _x( 'Portfolio Tags', 'taxonomy general name', 'themekit' ),
			'singular_name'     => _x( 'Portfolio Tag', 'taxonomy singular name', 'themekit' ),
			'search_items'      => __( 'Search Tags', 'themekit' ),
			'all_items'         => __( 'All Tags', 'themekit' ),
			'edit_item'         => __( 'Edit Tag', 'themekit' ),
			'update_item'       => __( 'Update Tag', 'themekit' ),
			'add_new_item'      => __( 'Add New Tag', 'themekit' ),
			'new_item_name'     => __( 'New Tag Name', 'themekit' ),
			'menu_name'         => __( 'Tags', 'themekit' )
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'rewrite'           => array(
			'slug' => $permalinks['tag_base']
		),
	) );
}



add_action( 'init', 'themekit_register_assets', 5 );

/**
 * Register the plugin's assets
 * 
 * @return  void
 */
function themekit_register_assets() {
	wp_register_script( 'themekit-portfolio', THEMEKIT_URL . '/assets/js/portfolio.js', array(
			'isotope',
			'jquery-flexslider',
			'jquery-fitvids'
		),
		THEMEKIT_VERSION, true
	);

	wp_register_script( 'themekit-portfolio-admin', THEMEKIT_URL . '/assets/admin/js/portfolio.js', array( 'op-options-controls' ), THEMEKIT_VERSION, true );
}



add_action( 'wp_enqueue_scripts', 'themekit_enqueue_assets', 15 );

/**
 * Enqueue the plugin's assets
 * 
 * @return  void
 */
function themekit_enqueue_assets() {
	global $pagenow;

	if ( ! is_admin() && ( is_themekit_portfolio() || is_themekit_portfolio_page_template() ) ) {
		if ( apply_filters( 'themekit/portfolio/enqueue_styles', true ) ) {
			wp_enqueue_style( 'jquery-nivolightbox' );
			wp_enqueue_style( 'jquery-nivolightbox-default' );
		}

		if ( apply_filters( 'themekit/portfolio/enqueue_scripts', true ) ) {
			if ( is_singular() ) {
				if ( themekit_portfolio_option( 'style' ) == 'grid' )
					wp_enqueue_script( 'masonry' );
				
				elseif ( themekit_portfolio_option( 'style' ) == 'slider' )
					wp_localize_script( 'themekit-portfolio', '_portfolioSlider', array(
						'animation'       => themekit_portfolio_option( 'slider_animation', 'slide' )
					) );
			}

			wp_enqueue_script( 'themekit-portfolio' );
		}
	}
	elseif ( is_admin() && ( $pagenow == 'post-new.php' || $pagenow == 'post.php' ) &&
			 op_current_post_type() == 'portfolio' ) {
		
		wp_enqueue_script( 'themekit-portfolio-admin' );
	}
}



add_action( 'admin_init', 'themekit_initialize_options' );

/**
 * Register options for portfolio post type
 * 
 * @return  void
 */
function themekit_initialize_options() {
	global $_themekit_portfolio_properties;

	$options = array();
	$options['media_heading'] = array(
		'type'        => 'heading',
		'section'     => 'all',
		'title'       => __( 'Cover Images/Videos', 'themekit' ),
		'description' => __( 'All added images or videos will be displayed on the portfolio cover.', 'themekit' )
	);

	$options['media'] = array(
		'type'    => 'media-list',
		'section' => 'all',
	);

	$options['style'] = array(
		'type'    => 'radio-images',
		'section' => 'all',
		'label'   => __( 'Cover Style', 'themekit' ),
		'default' => 'list',
		'choices' => array(
			'list'   => array(
				'src'     => op_directory_uri() . '/assets/img/list.png',
				'tooltip' => __( 'List', 'themekit' )
			),
			'slider' => array(
				'src'     => op_directory_uri() . '/assets/img/slider.png',
				'tooltip' => __( 'Slider', 'themekit' )
			),
			'grid'   => array(
				'src'     => op_directory_uri() . '/assets/img/portfolio-no-margin.png',
				'tooltip' => __( 'Grid', 'themekit' )
			)
		)
	);

	$options['slider_animation'] = array(
		'type'    => 'radio-buttons',
		'section' => 'all',
		'label'   => __( 'Animation Type', 'themekit' ),
		'default' => 'fade',
		'choices' => array(
			'fade' => __( 'Fade', 'themekit' ),
			'slide' => __( 'Slide', 'themekit' )
		)
	);

	$options['grid_columns'] = array(
		'type'    => 'spinner',
		'section' => 'all',
		'label'   => __( 'Grid Columns', 'themekit' ),
		'default' => 3,
		'min'     => 2,
		'max'     => 6
	);

	$options['content_layout_heading'] = array(
		'type'        => 'heading',
		'title'       => __( 'Content Layout', 'themekit' ),
		'description' => __( 'Select the layout for portfolio content to match as you need.', 'themekit' ),
		'section'     => 'all'
	);

	$options['content_position'] = array(
		'type'    => 'radio-images',
		'section' => 'all',
		'label'   => __( 'Content Position', 'themekit' ),
		'default' => 'left',
		'choices' => array(
			'left' => array(
				'src'     => op_directory_uri() . '/assets/img/left-content.png',
				'tooltip' => __( 'Content Left', 'themekit' )
			),
			'right' => array(
				'src'     => op_directory_uri() . '/assets/img/right-content.png',
				'tooltip' => __( 'Content Right', 'themekit' )
			),
			'fullwidth' => array(
				'src'     => op_directory_uri() . '/assets/img/full-content.png',
				'tooltip' => __( 'Content Full Width', 'themekit' )
			)
		)
	);

	$options['content_sticky'] = array(
		'type'    => 'switcher',
		'section' => 'all',
		'label'   => __( 'Enable Content Sticky', 'themekit' ),
		'default' => false
	);

	$options['details_heading'] = array(
		'type'        => 'heading',
		'section'     => 'all',
		'title'       => __( 'Details Information', 'themekit' ),
		'description' => __( 'Provide extra information for this portfolio.', 'themekit' )
	);

	$detail_options = array();
	$detail_options['client'] = array(
		'type'    => 'text',
		'label'   => __( 'Client', 'themekit' ),
		'section' => 'all'
	);

	$detail_options['website'] = array(
		'type'    => 'text',
		'label'   => __( 'Website', 'themekit' ),
		'section' => 'all',
		'default' => 'http://'
	);

	$detail_options['project_url'] = array(
		'type'    => 'text',
		'label'   => __( 'Project URL', 'themekit' ),
		'section' => 'all',
		'default' => 'http://'
	);

	$options = array_merge( $options, apply_filters( 'themekit/portfolio_details_properties', $detail_options ) );

	$_themekit_portfolio_properties = new \OptionsPlus\Metabox\Properties( 'portfolio-options', array(
		'label'       => __( 'Portfolio Options', 'themekit' ),
		'post_types'  => 'portfolio',
		'context'     => 'normal',
		'priority'    => 'high',
		'storage_key' => '_portfolio_options',
		'show_tabs'   => false,
		'sections'    => array(
			'all' => array( 'title' => __( 'Portfolio Options', 'themekit' ) ) 
		),
		'options'     => apply_filters( 'themekit/portfolio_item_properties', $options )
	) );
}



add_filter( 'template_include', 'themekit_template_include' );

/**
 * Return the path for portfolio template
 * 
 * @param   string  $template  Template path
 * @return  string
 */
function themekit_template_include( $template ) {
	if ( is_themekit_portfolio() ) {

		if ( $wrapper = themekit_locate_template( 'portfolio.php' ) )
			return $wrapper;

		if ( is_singular() ) {
			$item = get_queried_object();
			$templates = array(
				'single-portfolio-' . $item->slug . '.php',
				'single-portfolio.php'
			);

			return themekit_locate_template( $templates, array(
				'fallback' => THEMEKIT_PATH . '/includes/portfolio/views/wrapper.php'
			) );
		}
		elseif ( is_post_type_archive( 'portfolio' ) ) {
			return themekit_locate_template( array( 'archive-portfolio.php' ), array(
				'fallback' => THEMEKIT_PATH . '/includes/portfolio/views/wrapper.php'
			) );
		}
		elseif ( is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tag' )  ) {
			$term = get_queried_object();
			$templates = array(
				'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php',
				'taxonomy-' . $term->taxonomy . '.php'
			);

			return themekit_locate_template( $templates, array(
				'fallback' => THEMEKIT_PATH . '/includes/portfolio/views/wrapper.php'
			) );
		}
	}

	return $template;
}