<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

// Action for remove default sections & controls in customizer
add_action( 'customize_register', 'konstruct_customize_init' );

// Initialize post options
add_action( 'admin_init', 'konstruct_post_options_init' );

// Initialize page options
add_action( 'admin_init', 'konstruct_page_options_init' );

// Migrate theme options after switched theme
add_action( 'after_switch_theme', 'konstruct_migrate_theme_options' );

// Override theme options for specific page
add_filter( 'op/prepare_options', 'konstruct_override_theme_options' );

add_filter( 'theme/customize-sections', 'konstruct_customize_sections' );

add_action( 'customize_controls_enqueue_scripts', 'konstruct_customize_assets' );



/**
 * Declare the function to register options container
 */
if ( ! function_exists( 'konstruct_customize_init' ) ) {
	/**
	 * Register the theme customize panels
	 * 
	 * @param   WP_Customize_Manager  $wp_customize  The theme customize manager object
	 * @return  void
	 */
	function konstruct_customize_init( $wp_customize ) {
		/**
		 * Register the customizer sections for the theme
		 */
		$sections = (array) apply_filters( 'theme/customize-sections', array() );
		$section_classes = array(
			'panel'   => 'WP_Customize_Panel',
			'section' => 'WP_Customize_Section'
		);

		foreach ( $sections as $id => $params ) {
			if ( isset( $params['type'] ) && isset( $section_classes[ $params['type'] ] ) ) {
				$class = $section_classes[ $params['type'] ];
				$type  = $params['type'];

				unset( $params['type'] );
				$wp_customize->{"add_{$type}"}( new $class( $wp_customize, $id, $params ) );
			}
		}


		$options = konstruct_customize_options_fields();
		$index = 0;

		foreach ( $options as $id => $params ) {
			$default = '';
			$params['priority'] = $index++;

			if ( isset( $params['default'] ) )    $default = $params['default'];
			if ( !isset( $params['settings'] ) )  $params['settings'] = $id;
			if ( !isset( $params['transport'] ) ) $params['transport'] = 'refresh';

			$class = \OptionsPlus\Options\Helper::recognize_control_class( $params['type'] );

			if ( $wp_customize->get_setting( $params['settings'] ) == null ) {
				// Register setting for this control
				$wp_customize->add_setting( $params['settings'], array(
					'default'           => $default,
					'transport'         => $params['transport'],
					'sanitize_callback' => array( $class, 'sanitize' )
				) );
			}

			$control = new \OptionsPlus\Customize\Control( $wp_customize, $id, $params );

			if ( $control->is_valid() ) {
				$wp_customize->add_control( $control );
			}
		}
	}
}



if ( ! function_exists( 'konstruct_customize_assets' ) ) {
	function konstruct_customize_assets() {
		wp_enqueue_style( 'op-customizer' );
		wp_enqueue_style( 'op-options-controls' );
		wp_enqueue_script( 'op-options-controls' );
	}
}



/**
 * Initialize options for this theme
 * 
 * @return  void
 */
function konstruct_customize_sections( $wp_customize ) {
	return array(
		'general' => array(
			'type'     => 'section',
			'title'    => __( 'General', 'konstruct' ),
			'priority' => 1
		),
		'header' => array(
			'type'     => 'section',
			'title'    => __( 'Header', 'konstruct' ),
			'priority' => 1
		),
		'footer' => array(
			'type'     => 'section',
			'title'    => __( 'Footer', 'konstruct' ),
			'priority' => 1
		),
		'layout' => array(
			'type'     => 'section',
			'title'    => __( 'Layout & Styles', 'konstruct' ),
			'priority' => 1
		),
		'typography' => array(
			'type'     => 'section',
			'title'    => __( 'Typography', 'konstruct' ),
			'priority' => 1
		),
		'blog' => array(
			'type'     => 'section',
			'title'    => __( 'Blog', 'konstruct' ),
			'priority' => 1
		),
		'portfolio' => array(
			'type'     => 'section',
			'title'    => __( 'Portfolio', 'konstruct' ),
			'priority' => 1
		),
		'woocommerce' => array(
			'type'     => 'section',
			'title'    => __( 'Woocommerce', 'konstruct' ),
			'priority' => 1
		),
		'under-construction' => array(
			'type'     => 'section',
			'title'    => __( 'Under Construction', 'konstruct' ),
			'priority' => 1
		)
	);
}



/**
 * Remove the built-in sections and controls
 * 
 * @param   WP_Customize_Manager  $customize  Customize manager object
 * @return  void
 */
function konstruct_remove_default_sections( $customize ) {
	foreach ( array( 'title_tagline', 'static_front_page', 'nav' ) as $id ) {
		if ( $section = $customize->get_section( $id ) ) {
			foreach ( $section->controls as $control )
				$customize->remove_control( $control->id );

			$customize->remove_section( $id );
		}
	}
}



/**
 * Register options for the post
 * 
 * @return  void
 */
function konstruct_post_options_init() {
	new \OptionsPlus\Metabox\Properties( 'post-options', array(
		'label'       => __( 'Post Options', 'konstruct' ),
		'post_types'  => 'post',
		'context'     => 'normal',
		'priority'    => 'high',
		'storage_key' => '_post_options',
		
		'show_tabs'   => false,
		'sections'    => array(
			'all' => array( 'title' => __( 'Post Options', 'konstruct' ) ) 
		),
		'options'     => konstruct_post_options_fields()
	) );
}



/**
 * Register options for the post
 * 
 * @return  void
 */
function konstruct_page_options_init() {
	new \OptionsPlus\Metabox\Properties( 'page-options', array(
		'label'       => __( 'Page Options', 'konstruct' ),
		'post_types'  => 'page',
		'context'     => 'normal',
		'priority'    => 'high',
		'storage_key' => '_page_options',

		'sections' => array(
			'general'   => array( 'title' => __( 'General', 'konstruct' ) ),
			'header'    => array( 'title' => __( 'Header', 'konstruct' ) ),
			'footer'    => array( 'title' => __( 'Footer', 'konstruct' ) ),
			'portfolio' => array( 'title' => __( 'Portfolio', 'konstruct' ) ),
			'blog'      => array( 'title' => __( 'Blog', 'konstruct' ) )
		),

		'options' => konstruct_page_options_fields()
	) );
}



/**
 * Callback function to migrate theme options
 * 
 * @return  void
 */
function konstruct_migrate_theme_options() {
	$default_options = konstruct_customize_default_options();
	$options = get_theme_mods();
	
	foreach ( $default_options as $id => $value ) {
		if ( ! isset( $options[$id] ) )
			set_theme_mod( $id, $value );
	}
}



function konstruct_override_page_options( &$options, $page_options ) {
	$overridable_options = array(
		'enable_custom_styles'         => array( 'scheme_color' ),
		'enable_custom_layout'         => array( 'layout_mode', 'boxed_background', 'sidebar_layout', 'sidebar_default' ),
		'enable_custom_page_header'    => array( 'pagetitle_enabled', 'custom_page_title', 'pagetitle_background' ),
		'enable_custom_topbar'         => array( 'topbar_enabled', 'topbar_textcolor', 'topbar_bgcolor', 'topbar_content', 'topbar_social_links_enabled' ),
		'enable_custom_header_style'   => array( 'header_style', 'header_sticky', 'header_dark_style', 'header_stick_dark_style', 'header_cart_menu', 'header_searchbox', 'header_show_offcanvas' ),
		'enable_custom_logo'           => array( 'logo_src', 'logo_sticky_src', 'logo_size', 'logo_margin' ),
		'enable_custom_navigator'      => array( 'onepage_nav_script' ),
		'enable_custom_page_callout'   => array( 'page_callout_textcolor', 'page_callout_background', 'page_callout_enabled', 'page_callout_content', 'page_callout_button_text', 'page_callout_button_target', 'page_callout_button_link', 'page_callout_button_class' ),
		'enable_custom_footer_widgets' => array( 'footer_widgets_enabled', 'footer_widgets_layout', 'footer_widgets_textcolor', 'footer_widgets_background' ),
		'enable_custom_footer'         => array( 'footer_copyright', 'footer_social_links_enabled' )
	);

	foreach ( get_registered_nav_menus() as $location => $description ) {
		$overridable_options['enable_custom_navigator'][] = "menu_location_{$location}";
	}

	if ( is_array( $page_options ) ) {
		foreach ( $overridable_options as $index => $names ) {
			if ( ! isset( $page_options[$index] ) || $page_options[$index] == false ) {
				foreach ( $names as $name ) {
					unset( $page_options[$name] );
				}
			}
		}

		foreach ( $page_options as $name => $value )
			$options[$name] = $value;

		// Override scheme color style for the page
		if ( isset( $page_options['enable_custom_styles'] ) && $page_options['enable_custom_styles'] == true ) {
			$options['scheme_styles'] = get_post_meta( get_the_ID(), '_page_styles', true );
		}
	}
}



/**
 * This action will be used to override global theme
 * options as a specific options from page
 * 
 * @param   array  $options  Global options
 * @return  array
 */
function konstruct_override_theme_options( $options ) {
	global $post;

	if ( is_admin() ) return $options;

	// Blog options
	if ( is_search() || ( current_post_type_is( 'post' ) && ( is_home() || is_archive() || is_single() ) ) ) {
		if ( is_single() ) {
			$options['sidebar_layout'] = $options['blog_single_sidebar_layout'];
			$options['sidebar_default'] = $options['blog_single_sidebar'];
		}
		else {
			if ( get_option( 'show_on_front' ) == 'page' ) {
				$blog_page_id = get_option( 'page_for_posts' );
				$page_options = get_post_meta( $blog_page_id, '_page_options', true );

				konstruct_override_page_options( $options, $page_options );
			}

			$options['pagetitle_enabled'] = $options['blog_page_title_enabled'];
			$options['sidebar_layout'] = $options['blog_archive_sidebar_layout'];
			$options['sidebar_default'] = $options['blog_archive_sidebar'];
		}
	}

	// Page options
	elseif ( is_page() ) {
		$page_options = get_post_meta( get_the_ID(), '_page_options', true );
		
		konstruct_override_page_options( $options, $page_options );

		// Blog Template
		if ( is_page_template( 'templates/blog.php' ) ) {
			$options['blog_archive_layout']              = $page_options['blog_archive_layout'];
			$options['blog_grid_columns']                = $page_options['blog_grid_columns'];
			$options['blog_archive_post_excepts_length'] = $page_options['blog_archive_post_excepts_length'];
			$options['blog_archive_show_post_meta']      = $page_options['blog_archive_show_post_meta'];
			$options['blog_archive_readmore']            = $page_options['blog_archive_readmore'];
			$options['blog_archive_readmore_text']       = $page_options['blog_archive_readmore_text'];
			$options['blog_archive_pagination_style']    = $page_options['blog_archive_pagination_style'];
			$options['blog_posts_per_page']              = $page_options['blog_posts_per_page'];
		}

		// Portfolio Template
		elseif ( is_page_template( 'templates/portfolio.php' ) ) {
			$options['blog_archive_pagination_style'] = $page_options['portfolio_archive_pagination_style'];
			$options['portfolio_archive_filter'] = $page_options['portfolio_archive_filter'];
		}
	}
	elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		if ( is_archive() ) {
			$options['sidebar_layout'] = $options['woo_archive_sidebar_layout'];
			$options['sidebar_default'] = $options['woo_archive_sidebar'];
		}
		else {
			$options['sidebar_layout'] = $options['woo_single_sidebar_layout'];
			$options['sidebar_default'] = $options['woo_single_sidebar'];
		}
	}
	// Portfolio options
	elseif ( function_exists( 'is_themekit_portfolio' ) && is_themekit_portfolio() ) {
		// Single options
		if ( is_singular( 'portfolio' ) ) {
			$options['sidebar_layout'] = $options['portfolio_single_sidebar_layout'];
			$options['sidebar_default'] = $options['portfolio_single_sidebar'];
		}
		else {
			$options['sidebar_layout'] = $options['portfolio_archive_sidebar_layout'];
			$options['sidebar_default'] = $options['portfolio_archive_sidebar'];
		}
	}

	return $options;
}
