<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();



if ( ! function_exists( 'konstruct_theme_setup' ) ) {
	add_action( 'after_setup_theme', 'konstruct_theme_setup' );

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @return  void
	 */
	function konstruct_theme_setup() {
		// Make theme available for translation
		load_theme_textdomain( 'konstruct', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Title tag support
		add_theme_support( 'title-tag' );

		// Add theme menu location
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'konstruct' )
		) );

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'status', 'video', 'audio' ) );

		// Enable support for HTML5 markup.
		add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', 'gallery', 'caption' ) );

		// Enable woocommerce support
		add_theme_support( 'woocommerce' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'themekit-portfolio' );

		// Blog Images
		add_image_size( 'small', 50, 50, true );
		add_image_size( 'blog-medium', 555, 0, false );
		add_image_size( 'blog-medium-crop', 555, 312, true );

		add_image_size( 'blog-large', 1110, 0, false );
		add_image_size( 'blog-large-crop', 1110, 624, true );

		// Portfolio Images
		add_image_size( 'portfolio-medium', 555, 0, false );
		add_image_size( 'portfolio-medium-crop', 555, 415, true );

		add_image_size( 'portfolio-large', 1110, 0, false );
		add_image_size( 'portfolio-large-crop', 1110, 830, true );
	}
}



if ( ! function_exists( 'konstruct_register_sidebars' ) ) {
	add_action( 'widgets_init', 'konstruct_register_sidebars' );

	/**
	 * Register widgets area
	 * 
	 * @return  void
	 */
	function konstruct_register_sidebars() {
		register_sidebar( array(
			'name'          => __( 'Primary Sidebar', 'konstruct' ),
			'id'            => 'sidebar-primary',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Off-Canvas Sidebar', 'konstruct' ),
			'id'            => 'off-canvas',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Footer Sidebars
		register_sidebar( array(
			'name'          => __( 'Footer Sidebar #1', 'konstruct' ),
			'id'            => 'footer-1',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Sidebar #2', 'konstruct' ),
			'id'            => 'footer-2',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Sidebar #3', 'konstruct' ),
			'id'            => 'footer-3',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Sidebar #4', 'konstruct' ),
			'id'            => 'footer-4',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}



if ( ! function_exists( 'konstruct_register_widgets' ) ) {
	add_action( 'widgets_init', 'konstruct_register_widgets' );

	/**
	 * Register theme's built-in widgets
	 * 
	 * @return  void
	 */
	function konstruct_register_widgets() {
		register_widget( 'konstruct_Recent_Posts' );
		register_widget( 'konstruct_Recent_Portfolios' );
	}
}



if ( ! function_exists( 'konstruct_third_party_plugins' ) ) {
	/**
	 * Return an array that contains the list of recommendation plugins
	 * that will work with this theme
	 * 
	 * @return  array
	 */
	function konstruct_third_party_plugins() {
		return array(
			// This is an example of how to include a plugin pre-packaged with a theme.
			array(
				'name'               => 'ThemeKit By LineThemes',
				'slug'               => 'themekit',
				'source'             => 'http://demo.linethemes.com/plugins.php?id=themekit',
				'required'           => true,
				'version'            => '1.0.8',
				'force_activation'   => true,
				'force_deactivation' => false,
				'external_url'       => '',
			),

			array(
				'name'               => 'WPBakery Visual Composer',
				'slug'               => 'js_composer',
				'source'             => 'http://demo.linethemes.com/plugins.php?id=js_composer',
				'required'           => true,
				'version'            => '4.9',
				'force_activation'   => true,
				'force_deactivation' => false,
				'external_url'       => '',
			),

			array(
				'name'               => 'Revolution Slider',
				'slug'               => 'revslider',
				'source'             => 'http://demo.linethemes.com/plugins.php?id=revslider',
				'required'           => true,
				'version'            => '5.1.5',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => '',
			),

			array(
				'name'               => 'Contact Form 7',
				'slug'               => 'contact-form-7',
				'required'           => false
			),

			array(
				'name'               => 'WooCommerce',
				'slug'               => 'woocommerce',
				'required'           => false
			)
		);
	}
}



if ( ! function_exists( 'konstruct_register_plugins' ) ) {
	add_action( 'tgmpa_register', 'konstruct_register_plugins' );

	/**
	 * Register third-party plugins
	 * 
	 * @return  void
	 */
	function konstruct_register_plugins() {
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'default_path' => '',                      // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'konstruct' ),
				'menu_title'                      => __( 'Install Plugins', 'konstruct' ),
				'installing'                      => __( 'Installing Plugin: %s', 'konstruct' ), // %s = plugin name.
				'oops'                            => __( 'Something went wrong with the plugin API.', 'konstruct' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'konstruct' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'konstruct' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'konstruct' ), // %s = dashboard link.
				'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);

		tgmpa( konstruct_third_party_plugins(), $config );
	}
}



if ( ! function_exists( 'konstruct_exclude_pages_from_search' ) ) {
	add_filter( 'pre_get_posts', 'konstruct_exclude_pages_from_search', 99 );

	/**
	 * This filter will remove post type "page" from
	 * search query
	 * 
	 * @param   WP_Query  $query  Search query object
	 * @return  WP_Query
	 */
	function konstruct_exclude_pages_from_search( $query ) {
		if ( ! is_admin() && is_search() && $query->is_search ) {
			$post_types = get_post_types( array( 'public' => true ) );

			// Remove post type "page" from search
			unset( $post_types['page'] );

			// Set post type for search query
			$query->set( 'post_type', array_values( $post_types ) );
		}
		
		return $query;
	}
}



add_filter( 'widget_text', 'do_shortcode' );
