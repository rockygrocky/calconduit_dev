<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();


/**
 * Return array of fields that will be used to register
 * customizer options
 * 
 * @return  array
 */
function konstruct_customize_options_fields() {
	static $options;

	if ( ! empty( $options ) )
		return $options;

	$options = array();

	/**
	 * General controls
	 */
	$options['siteinfo_heading'] = array(
		'type'        => 'heading',
		'title'       => __( 'Site Information', 'konstruct' ),
		'description' => __( 'This section have basic information of your site, just change it to match with you need.', 'konstruct' ),
		'section'     => 'general',
		'class'       => 'no-border'
	);

	$options['site_name'] = array(
		'type'     => 'text',
		'label'    => __( 'Site Name', 'konstruct' ),
		'section'  => 'general',
		'settings' => 'blogname'
	);

	$options['site_desc'] = array(
		'type'     => 'text',
		'label'    => __( 'Site Tagline', 'konstruct' ),
		'section'  => 'general',
		'settings' => 'blogdescription'
	);

	$options['static_frontpage_heading'] = array(
		'type'        => 'heading',
		'section'     => 'general',
		'class'       => 'no-border',
		'title'       => __( 'Static Front Page', 'konstruct' ),
		'description' => __( 'Switch this option to use static page or posts page on the home', 'konstruct' )
	);

	$options['static_frontpage_enabled'] = array(
		'type'     => 'radio-buttons',
		'section'  => 'general',
		'settings' => 'show_on_front',
		'choices'  => array(
			'posts' => __( 'Posts', 'konstruct' ),
			'page'  => __( 'Static Page', 'konstruct' )
		)
	);

	$options['static_frontpage'] = array(
		'type'     => 'dropdown-pages',
		'section'  => 'general',
		'label'    => __( 'Front Page', 'konstruct' ),
		'settings' => 'page_on_front'
	);

	$options['posts_page'] = array(
		'type'     => 'dropdown-pages',
		'section'  => 'general',
		'label'    => __( 'Posts Page', 'konstruct' ),
		'settings' => 'page_for_posts'
	);

	$options['general_misc_heading'] = array(
		'type'        => 'heading',
		'section'     => 'general',
		'class'       => 'no-border',
		'title'       => __( 'Misc', 'konstruct' ),
		'description' => __( 'This section have options that allow to adding bookmark icon, social icons, ...', 'konstruct' )
	);

	$options['gotop_enabed'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Go Top Button', 'konstruct' ),
		'section' => 'general',
		'default' => true
	);

	// Site Icons
	$options['bookmark_icon'] = array(
		'type'    => 'media-picker',
		'label'   => __( 'Custom Favicon', 'konstruct' ),
		'section' => 'general',
		'default' => \get_template_directory_uri() . '/assets/img/favicon.ico'
	);

	$options['social_links'] = array(
		'type'    => 'social-icons',
		'label'   => __( 'Social Links', 'konstruct' ),
		'section' => 'general',
		'default' => array(
			'facebook' => 'https://facebook.com/thelinethemes',
			'twitter'  => 'https://twitter.com/linethemes'
		)
	);

	/**
	 * Styles
	 */
	$options['body_font_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'typography',
		'title'       => __( 'Body Font', 'konstruct' ),
		'description' => __( 'You can modify the font family, size, color, ... for global content.', 'konstruct' )
	);

	$options['body_font'] = array(
		'type'    => 'typography',
		'section' => 'typography',
		'default' => array(
			'family'      => 'Raleway',
			'size'        => 14,
			'style'       => '400',
			'color'       => '#333333'
		)
	);

	$options['heading_font_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'typography',
		'title'       => __( 'Heading Font', 'konstruct' ),
		'description' => __( 'You can modify the font options for your headings. h1, h2, h3, h4, ...', 'konstruct' )
	);

	$options['heading_font'] = array(
		'type'    => 'typography',
		'section' => 'typography',
		'fields'  => array( 'family', 'style' ),
		'default' => array(
			'family'      => 'Montserrat',
			'style'       => '400',
			'color'       => '#333333'
		)
	);

	$options['heading_fontsize'] = array(
		'type'    => 'dimension',
		'section' => 'typography',
		'class'   => 'no-label',
		'fields' => array(
			'h1' => __( 'H1 Font Size (px)', 'konstruct' ),
			'h2' => __( 'H2 Font Size (px)', 'konstruct' ),
			'h3' => __( 'H3 Font Size (px)', 'konstruct' ),
			'h4' => __( 'H4 Font Size (px)', 'konstruct' ),
			'h5' => __( 'H5 Font Size (px)', 'konstruct' ),
			'h6' => __( 'H6 Font Size (px)', 'konstruct' ),
		),
		'default' => array(
			0, 0, 0, 0, 0, 0
		)
	);

	$options['menu_font_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'typography',
		'title'       => __( 'Menu Font', 'konstruct' ),
		'description' => __( 'Select your custom font options for your main navigation menu.', 'konstruct' )
	);

	$options['menu_font'] = array(
		'type'    => 'typography',
		'section' => 'typography',
		'default' => array(
			'family' => 'Montserrat',
			'size'   => 14,
			'style'  => '400',
			'color'  => '#333333'
		)
	);

	$options['font_subsets_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'typography',
		'title'       => __( 'Font Subsets', 'konstruct' ),
		'description' => __( 'Sometime you need to load extra font subsets for another languages, this options will allow to do it.', 'konstruct' )
	);

	$options['cyrillic_subsets_enabled'] = array(
		'type'    => 'switcher',
		'section' => 'typography',
		'label'   => __( 'Cyrillic', 'konstruct' ),
		'default' => false
	);

	$options['cyrillic_ext_subsets_enabled'] = array(
		'type'    => 'switcher',
		'section' => 'typography',
		'label'   => __( 'Cyrillic Extended', 'konstruct' ),
		'default' => false
	);

	$options['greek_subsets_enabled'] = array(
		'type'    => 'switcher',
		'section' => 'typography',
		'label'   => __( 'Greek', 'konstruct' ),
		'default' => false
	);
	$options['greek_ext_subsets_enabled'] = array(
		'type'    => 'switcher',
		'section' => 'typography',
		'label'   => __( 'Greek Extended', 'konstruct' ),
		'default' => false
	);

	$options['vietnamese_subsets_enabled'] = array(
		'type'    => 'switcher',
		'section' => 'typography',
		'label'   => __( 'Vietnamese', 'konstruct' ),
		'default' => false
	);

	$options['latin_ext_subsets_enabled'] = array(
		'type'    => 'switcher',
		'section' => 'typography',
		'label'   => __( 'Latin Extended', 'konstruct' ),
		'default' => false
	);

	$options['devanagari_subsets_enabled'] = array(
		'type'    => 'switcher',
		'section' => 'typography',
		'label'   => __( 'Devanagari', 'konstruct' ),
		'default' => false
	);

	/**
	 * Layout controls
	 */
	$options['scheme_color_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'layout',
		'title'       => __( 'Scheme Color', 'konstruct' ),
		'description' => __( 'Select the color that will be used for theme color.', 'konstruct' )
	);

	$options['scheme_color'] = array(
		'type'    => 'color-picker',
		'label'   => __( 'Scheme Color', 'konstruct' ),
		'section' => 'layout',
		'default' => '#a0ce4e'
	);

	$options['layout_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'layout',
		'title'       => __( 'Layout', 'konstruct' ),
		'description' => __( 'Choose between a full or a boxed layout to set how your website\'s layout will look like.', 'konstruct' )
	);

	$options['layout_mode'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'Display Style', 'konstruct' ),
		'section' => 'layout',
		'choices' => array(
			'layout-wide'  => array(
				'src'     => \op_directory_uri() . '/assets/img/layout-wide.png',
				'tooltip' => __( 'Wide', 'konstruct' )
			),

			'layout-boxed'  => array(
				'src'     => \op_directory_uri() . '/assets/img/layout-boxed.png',
				'tooltip' => __( 'Boxed', 'konstruct' )
			),
		),
		'default' => 'layout-wide'
	);

	$options['boxed_background'] = array(
		'type'     => 'background',
		'label'    => __( 'Boxed Background', 'konstruct' ),
		'section'  => 'layout',
		'patterns' => predefined_background_patterns(),
		'default'  => array(
			'type'     => 'none',
			'pattern'  => 'none',
			'color'    => '#fff',
			'image'    => '',
			'repeat'   => 'repeat',
			'position' => 'top-left',
			'style'    => 'scroll'
		)
	);

	$options['content_width'] = array(
		'type'    => 'text',
		'label'   => __( 'Content Width', 'konstruct' ),
		'section' => 'layout',
		'default' => '1110px'
	);

	$options['sidebar_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'layout',
		'title'       => __( 'Sidebar', 'konstruct' ),
		'description' => __( 'Select the position of sidebar that you wish to display.', 'konstruct' )
	);
	$options['sidebar_layout'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'Sidebar Position', 'konstruct' ),
		'section' => 'layout',
		'choices' => array(
			'no-sidebar' => array(
				'src' => \op_directory_uri() . '/assets/img/no-sidebar.png',
				'tooltip' => __( 'No Sidebar', 'konstruct' )
			),
			'sidebar-left' => array(
				'src' => \op_directory_uri() . '/assets/img/sidebar-left.png',
				'tooltip' => __( 'Sidebar Left', 'konstruct' )
			),
			'sidebar-right' => array(
				'src' => \op_directory_uri() . '/assets/img/sidebar-right.png',
				'tooltip' => __( 'Sidebar Right', 'konstruct' )
			)
		),
		'default' => 'no-sidebar'
	);

	$options['sidebar_default'] = array(
		'type'    => 'dropdown-sidebars',
		'label'   => __( 'Default Sidebar', 'konstruct' ),
		'section' => 'layout',
		'default' => 'sidebar-primary'
	);
	// End layout
		
	$options['pagetitle_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'layout',
		'title'       => __( 'Page Title', 'konstruct' ),
		'description' => __( 'In this section you can turn on/off or modify style for the Page Title.', 'konstruct' )
	);
	$options['pagetitle_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Page Title', 'konstruct' ),
		'section' => 'layout',
		'default' => true
	);

	$options['pagetitle_background'] = array(
		'type'     => 'background',
		'section'  => 'layout',
		'label'    => __( 'Background', 'konstruct' ),
		'patterns' => predefined_background_patterns(),
		'default'  => array(
			'type'     => 'none',
			'pattern'  => 'none',
			'color'    => '#f2f2f2',
			'image'    => '',
			'repeat'   => 'repeat',
			'position' => 'top-left',
			'style'    => 'scroll'
		)
	);

	$options['pagetitle_textcolor'] = array(
		'type'    => 'color-picker',
		'section' => 'layout',
		'label'   => __( 'Text Color', 'konstruct' ),
		'default' => '#333333'
	);

	$options['breadcrumb_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Breadcrumb', 'konstruct' ),
		'section' => 'layout',
		'default' => true
	);

	$options['breadcrumb_prefix'] = array(
		'type'    => 'text',
		'label'   => __( 'Breadcrumb Prefix', 'konstruct' ),
		'section' => 'layout',
		'default' => __( 'You are here:', 'konstruct' )
	);

	$options['breadcrumb_separator'] = array(
		'type'    => 'text',
		'label'   => __( 'Breadcrumb Separator', 'konstruct' ),
		'section' => 'layout',
		'default' => '/'
	);

	/**
	 * Header
	 */
	$options['logo_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'header',
		'title'       => __( 'Custom Logo', 'konstruct' ),
		'description' => __( 'In this section You can upload your own custom logo, change the way your logo can be displayed', 'konstruct' )
	);

	// Logo options
	$options['logo_image'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Use Logo Image', 'konstruct' ),
		'section' => 'header',
		'default' => true
	);

	$options['show_tagline'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Display Site Tagline', 'konstruct' ),
		'section' => 'header',
		'default' => false
	);

	$options['logo_src'] = array(
		'type'    => 'media-picker',
		'label'   => __( 'Logo', 'konstruct' ),
		'section' => 'header',
		'default' => \get_template_directory_uri() . '/assets/img/logo.png'
	);

	$options['logo_sticky_src'] = array(
		'type'    => 'media-picker',
		'label'   => __( 'Stick Header Logo', 'konstruct' ),
		'section' => 'header',
		'default' => \get_template_directory_uri() . '/assets/img/logo.png'
	);

	$options['logo_size'] = array(
		'type'    => 'dimension',
		'label'   => __( 'Logo Size', 'konstruct' ),
		'section' => 'header',
		'fields'  => array(
			'width'  => __( 'Width (px)', 'konstruct' ),
			'height' => __( 'Height (px)', 'konstruct' )
		),
		'default' => array( 178, 50 )
	);

	$options['logo_margin'] = array(
		'type'    => 'dimension',
		'label'   => __( 'Logo Margin', 'konstruct' ),
		'section' => 'header',
		'fields'  => array(
			'top'    => __( 'Top (px)', 'konstruct' ),
			'bottom' => __( 'Bottom (px)', 'konstruct' )
		),
		'default' => array( 25, 25 )
	);

	$options['navigator_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'header',
		'title'       => __( 'Navigator', 'konstruct' ),
		'description' => __( 'Just select your menu that you wish assign it to the location on the theme', 'konstruct' )
	);

	// Navigator
	$menus     = wp_get_nav_menus();
	$locations = get_registered_nav_menus();

	$choices = array( 0 => __( '&dash; Select &dash;', 'konstruct' ) );

	if ( $menus ) {
		foreach ( $menus as $menu ) {
			$choices[ $menu->term_id ] = wp_html_excerpt( $menu->name, 40, '&hellip;' );
		}
	}

	foreach ( $locations as $location => $description ) {
		$menu_setting_id = "nav_menu_locations[{$location}]";

		$options["menu_location_{$location}"] = array(
			'label'    => $description,
			'section'  => 'header',
			'type'     => 'dropdown',
			'choices'  => $choices,
			'settings' => $menu_setting_id
		);
	}

	$options['header_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'header',
		'title'       => __( 'Header Style', 'konstruct' ),
		'description' => __( 'Change the header style, toggle sticky header feature and turn on/off extra menu icons', 'konstruct' )
	);

	$options['header_style'] = array(
		'type'    => 'dropdown',
		'section' => 'header',
		'label'   => __( 'Header Style', 'konstruct' ),
		'choices' => predefined_header_styles(),
		'default' => 'header-v1'
	);

	$options['header_sticky'] = array(
		'type'    => 'switcher',
		'section' => 'header',
		'label'   => __( 'Enable Sticky Header', 'konstruct' )
	);

	$options['header_cart_menu'] = array(
		'type'           => 'switcher',
		'section'        => 'header',
		'label'          => __( 'Show Cart Menu', 'konstruct' ),
		'theme_supports' => 'woocommerce',
		'default'        => true
	);

	$options['header_searchbox'] = array(
		'type'    => 'switcher',
		'section' => 'header',
		'label'   => __( 'Show Search Menu', 'konstruct' ),
		'default' => true
	);

	$options['header_show_offcanvas'] = array(
		'type'    => 'switcher',
		'section' => 'header',
		'label'   => __( 'Show Off-Canvas Menu', 'konstruct' ),
		'default' => true
	);

	$options['topbar_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'header',
		'title'       => __( 'Top Bar', 'konstruct' ),
		'description' => __( 'Turn on/off the top bar and change it styles', 'konstruct' )
	);
	$options['topbar_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Topbar', 'konstruct' ),
		'section' => 'header',
		'default' => true
	);

	$options['topbar_bgcolor'] = array(
		'type'    => 'color-picker',
		'label'   => __( 'Topbar Background', 'konstruct' ),
		'section' => 'header',
		'default' => '#1a6173'
	);

	$options['topbar_textcolor'] = array(
		'type'    => 'color-picker',
		'label'   => __( 'Topbar Text Color', 'konstruct' ),
		'section' => 'header',
		'default' => '#ffffff'
	);

	$options['topbar_content'] = array(
		'type'    => 'textarea',
		'label'   => __( 'Content', 'konstruct' ),
		'section' => 'header',
		'default' => __( '<i class="fa fa-phone"></i> Call Us Today! 1.555.555.555 <span class="spacer"></span> <i class="fa fa-envelope-o"></i> support@linethemes.com', 'konstruct' )
	);

	$options['topbar_social_links_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Social Links', 'konstruct' ),
		'section' => 'header',
		'default' => true
	);
	
	/**
	 * Footer
	 */
	$options['callout_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'footer',
		'title'       => __( 'Page Callout', 'konstruct' ),
		'description' => __( 'You can modify content and styles for the page callout section.', 'konstruct' )
	);

	$options['page_callout_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Page Callout', 'konstruct' ),
		'section' => 'footer',
		'default' => true
	);

	$options['page_callout_content'] = array(
		'type'    => 'textarea',
		'label'   => __( 'Content', 'konstruct' ),
		'section' => 'footer',
		'default' => __( 'Try building your website using our all powerful theme now!', 'konstruct' )
	);

	$options['page_callout_button_text'] = array(
		'type'    => 'text',
		'label'   => __( 'Button Text', 'konstruct' ),
		'section' => 'footer',
		'default' => __( 'Purchase Now', 'konstruct' )
	);

	$options['page_callout_button_link'] = array(
		'type'    => 'text',
		'label'   => __( 'Button Link', 'konstruct' ),
		'section' => 'footer',
		'default' => 'http://linethemes.com'
	);

	$options['page_callout_button_target'] = array(
		'type'    => 'dropdown',
		'label'   => __( 'Button Target', 'konstruct' ),
		'section' => 'footer',
		'choices' => array(
			'_blank' => __( 'New Window', 'konstruct' ),
			'_top'   => __( 'Same Window', 'konstruct' )
		),
		'default' => '_blank'
	);

	$options['page_callout_button_class'] = array(
		'type'    => 'text',
		'label'   => __( 'Button Addition Class', 'konstruct' ),
		'section' => 'footer',
		'default' => 'btn-outline'
	);

	$options['page_callout_background'] = array(
		'type'    => 'color-picker',
		'label'   => __( 'Background Color', 'konstruct' ),
		'section' => 'footer',
		'default' => '#eeeeee'
	);

	$options['page_callout_textcolor'] = array(
		'type'    => 'color-picker',
		'label'   => __( 'Text Color', 'konstruct' ),
		'section' => 'footer',
		'default' => '#ffffff'
	);

	$options['footer_widgets_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'footer',
		'title'       => __( 'Footer Widgets', 'konstruct' ),
		'description' => __( 'This section allow to change the layout and styles of footer widgets to match as you need.', 'konstruct' )
	);
	$options['footer_widgets_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Footer Widgets', 'konstruct' ),
		'section' => 'footer',
		'default' => true
	);

	$options['footer_widgets_layout'] = array(
		'type'    => 'widgets-layout',
		'label'   => __( 'Widgets Layout', 'konstruct' ),
		'max'     => 4,
		'section' => 'footer',
		'default' => array(
			'active' => 3,
			'layout' => array(
				array( 12 ),
				array( 6, 6 ),
				array( 4, 4, 4 ),
				array( 3, 3, 3, 3 )
			)
		)
	);

	$options['footer_widgets_background'] = array(
		'type'     => 'background',
		'section'  => 'footer',
		'label'    => __( 'Widgets Background', 'konstruct' ),
		'patterns' => predefined_background_patterns(),
		'default'  => array(
			'type'     => 'none',
			'pattern'  => 'none',
			'color'    => '#1a1a1a',
			'image'    => '',
			'repeat'   => 'repeat',
			'position' => 'top-left',
			'style'    => 'scroll'
		)
	);

	$options['footer_widgets_textcolor'] = array(
		'type'    => 'color-picker',
		'section' => 'footer',
		'label'   => __( 'Text Color', 'konstruct' ),
		'default' => '#666666'
	);

	$options['footer_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'footer',
		'title'       => __( 'Custom Footer', 'konstruct' ),
		'description' => __( 'You can change the copyright text, show/hide the social icons on the footer.', 'konstruct' )
	);

	$options['footer_social_links_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Social Links', 'konstruct' ),
		'section' => 'footer',
		'default' => true
	);

	$options['footer_copyright'] = array(
		'type'    => 'textarea',
		'label'   => __( 'Copyright', 'konstruct' ),
		'section' => 'footer',
		'default' => sprintf( __( 'Copyright &copy; 2014 <a href="%s" target="_blank">LineThemes</a>. All rights reserved', 'konstruct' ), 'http://linethemes.com' )
	);

	/**
	 * Blog
	 */
	$options['blog_page_title_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Page Title', 'konstruct' ),
		'section' => 'blog',
		'default' => true
	);

	$options['blog_page_title'] = array(
		'type'    => 'text',
		'label'   => __( 'Blog Page Title', 'konstruct' ),
		'section' => 'blog',
		'default' => __( 'Blog', 'konstruct' )
	);

	$options['blog_list_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'blog',
		'title'       => __( 'Blog List', 'konstruct' ),
		'description' => __( 'All options in this section will be used to make style for blog page.', 'konstruct' )
	);

	$options['blog_archive_sidebar_layout'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'List Sidebar Position', 'konstruct' ),
		'section' => 'blog',
		'choices' => array(
			'no-sidebar' => array(
				'src' => op_directory_uri() . '/assets/img/no-sidebar.png',
				'tooltip' => __( 'No Sidebar', 'konstruct' )
			),
			'sidebar-left' => array(
				'src' => op_directory_uri() . '/assets/img/sidebar-left.png',
				'tooltip' => __( 'Sidebar Left', 'konstruct' )
			),
			'sidebar-right' => array(
				'src' => op_directory_uri() . '/assets/img/sidebar-right.png',
				'tooltip' => __( 'Sidebar Right', 'konstruct' )
			)
		),
		'default' => 'sidebar-right'
	);

	$options['blog_archive_sidebar'] = array(
		'type'    => 'dropdown-sidebars',
		'section' => 'blog',
		'label'   => __( 'Blog List Sidebar', 'konstruct' ),
		'default' => 'sidebar-primary'
	);

	$options['blog_archive_layout'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'List Layout', 'konstruct' ),
		'section' => 'blog',
		'choices' => array(
			'medium' => array(
				'src' => op_directory_uri() . '/assets/img/blog-medium.png',
				'tooltip' => __( 'List Medium', 'konstruct' )
			),
			'large' => array(
				'src' => op_directory_uri() . '/assets/img/blog-large.png',
				'tooltip' => __( 'List Large', 'konstruct' )
			),
			'grid' => array(
				'src' => op_directory_uri() . '/assets/img/blog-grid.png',
				'tooltip' => __( 'Grid', 'konstruct' )
			),
			'masonry' => array(
				'src' => op_directory_uri() . '/assets/img/blog-masonry.png',
				'tooltip' => __( 'Grid Masonry', 'konstruct' )
			),
		),
		'default' => 'large'
	);

	$options['blog_grid_columns'] = array(
		'type'    => 'dropdown',
		'section' => 'blog',
		'label'   => __( 'Grid Columns', 'konstruct' ),
		'default' => 3,
		'choices' => array(
			2 => __( '2 Columns', 'konstruct' ),
			3 => __( '3 Columns', 'konstruct' ),
			4 => __( '4 Columns', 'konstruct' )
		)
	);

	$options['blog_archive_post_excepts'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Auto Post Excepts', 'konstruct' ),
		'section' => 'blog',
		'default' => false
	);

	$options['blog_archive_post_excepts_length'] = array(
		'type'    => 'text',
		'label'   => __( 'Post Excepts Length', 'konstruct' ),
		'section' => 'blog',
		'default' => 40
	);

	$options['blog_archive_show_post_meta'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Show Post Meta', 'konstruct' ),
		'section' => 'blog',
		'default' => true
	);

	$options['blog_archive_readmore'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Show Read More', 'konstruct' ),
		'section' => 'blog',
		'default' => true
	);

	$options['blog_archive_readmore_text'] = array(
		'type'    => 'text',
		'label'   => __( 'Read More Text', 'konstruct' ),
		'section' => 'blog',
		'default' => __( 'Continue Read &rarr;', 'konstruct' )
	);

	$options['blog_archive_pagination_style'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'Pagination Style', 'konstruct' ),
		'section' => 'blog',
		'default' => 'numeric',
		'choices' => array(
			'pager' => array(
				'src' => op_directory_uri() . '/assets/img/paging-pager.png',
				'tooltip' => __( 'Pager', 'konstruct' )
			),
			'numeric' => array(
				'src' => op_directory_uri() . '/assets/img/paging-numeric.png',
				'tooltip' => __( 'Numeric', 'konstruct' )
			),
			'pager-numeric' => array(
				'src' => op_directory_uri() . '/assets/img/paging-pager-numeric.png',
				'tooltip' => __( 'Pager & Numeric', 'konstruct' )
			),
			'loadmore' => array(
				'src' => op_directory_uri() . '/assets/img/paging-loadmore.png',
				'tooltip' => __( 'Load More', 'konstruct' )
			)
		)
	);

	$options['blog_posts_per_page'] = array(
		'type'     => 'spinner',
		'section'  => 'blog',
		'label'    => __( 'Posts Per Page', 'konstruct' ),
		'default'  => get_option( 'posts_per_page' )
	);

	$options['blog_single_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'blog',
		'title'       => __( 'Blog Single', 'konstruct' ),
		'description' => __( 'Also, you can change the style for blog single to make your site unique.', 'konstruct' )
	);
	
	$options['blog_single_sidebar_layout'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'Single Sidebar Position', 'konstruct' ),
		'section' => 'blog',
		'choices' => array(
			'no-sidebar' => array(
				'src' => op_directory_uri() . '/assets/img/no-sidebar.png',
				'tooltip' => __( 'No Sidebar', 'konstruct' )
			),
			'sidebar-left' => array(
				'src' => op_directory_uri() . '/assets/img/sidebar-left.png',
				'tooltip' => __( 'Sidebar Left', 'konstruct' )
			),
			'sidebar-right' => array(
				'src' => op_directory_uri() . '/assets/img/sidebar-right.png',
				'tooltip' => __( 'Sidebar Right', 'konstruct' )
			)
		),
		'default' => 'sidebar-right'
	);

	$options['blog_single_sidebar'] = array(
		'type'    => 'dropdown-sidebars',
		'section' => 'blog',
		'label'   => __( 'Blog Single Sidebar', 'konstruct' ),
		'default' => 'sidebar-primary'
	);

	$options['blog_post_navigator_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Show Post Navigator', 'konstruct' ),
		'section' => 'blog',
		'default' => true
	);

	$options['blog_post_navigator_sticky'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Post Navigator Sticky', 'konstruct' ),
		'section' => 'blog',
		'default' => false
	);

	$options['blog_author_box_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Show Author Box', 'konstruct' ),
		'section' => 'blog',
		'default' => true
	);

	$options['blog_related_box_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Show Related Posts', 'konstruct' ),
		'section' => 'blog',
		'default' => true
	);

	$options['blog_related_posts_style'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'Related Posts Style', 'konstruct' ),
		'section' => 'blog',
		'choices' => array(
			'list' => array(
				'src' => op_directory_uri() . '/assets/img/related-list.png',
				'tooltip' => __( 'Simple List', 'konstruct' )
			),
			'grid' => array(
				'src' => op_directory_uri() . '/assets/img/blog-grid.png',
				'tooltip' => __( 'Grid', 'konstruct' )
			),
			'masonry' => array(
				'src' => op_directory_uri() . '/assets/img/blog-masonry.png',
				'tooltip' => __( 'Masonry Grid', 'konstruct' )
			),
			'carousel' => array(
				'src' => op_directory_uri() . '/assets/img/related-slider.png',
				'tooltip' => __( 'Carousel', 'konstruct' )
			)
		),
		'default' => 'carousel'
	);

	$options['blog_related_posts_columns'] = array(
		'type'    => 'dropdown',
		'section' => 'blog',
		'label'   => __( 'Columns Of Related Posts', 'konstruct' ),
		'default' => 3,
		'choices' => array(
			2 => __( '2 Columns', 'konstruct' ),
			3 => __( '3 Columns', 'konstruct' ),
			4 => __( '4 Columns', 'konstruct' )
		)
	);

	$options['blog_related_posts_count'] = array(
		'type'    => 'spinner',
		'section' => 'blog',
		'label'   => __( 'Number Of Related Posts', 'konstruct' ),
		'min'     => 1,
		'default' => 4
	);

	/**
	 * Woocommerce
	 */
	if ( function_exists( 'is_woocommerce' ) ) {
		$options['woo_archive_heading'] = array(
			'type'        => 'heading',
			'section'     => 'woocommerce',
			'title'       => __( 'Products Listing', 'konstruct' ),
			'description' => __( 'This section is designed for only Woocommerce, it will be applied for page that listing all products.', 'konstruct' )
		);

		$options['woo_archive_sidebar_layout'] = array(
			'type'    => 'radio-images',
			'label'   => __( 'Sidebar Position', 'konstruct' ),
			'section' => 'woocommerce',
			'default' => 'no-sidebar',
			'choices' => array(
				'no-sidebar' => array(
					'src' => op_directory_uri() . '/assets/img/no-sidebar.png',
					'tooltip' => __( 'No Sidebar', 'konstruct' )
				),
				'sidebar-left' => array(
					'src' => op_directory_uri() . '/assets/img/sidebar-left.png',
					'tooltip' => __( 'Sidebar Left', 'konstruct' )
				),
				'sidebar-right' => array(
					'src' => op_directory_uri() . '/assets/img/sidebar-right.png',
					'tooltip' => __( 'Sidebar Right', 'konstruct' )
				)
			)
		);

		$options['woo_archive_sidebar'] = array(
			'type'    => 'dropdown-sidebars',
			'section' => 'woocommerce',
			'label'   => __( 'Sidebar', 'konstruct' ),
			'default' => 'sidebar-primary'
		);

		$options['woo_products_per_page'] = array(
			'type'    => 'spinner',
			'section' => 'woocommerce',
			'label'   => __( 'Products Per Page', 'konstruct' ),
			'default' => 10,
			'min'     => 1
		);

		$options['woo_details_heading'] = array(
			'type'        => 'heading',
			'section'     => 'woocommerce',
			'title'       => __( 'Product Details', 'konstruct' ),
			'description' => __( 'Like "Blog Single" section, you can change style for product details page.', 'konstruct' )
		);

		$options['woo_single_sidebar_layout'] = array(
			'type'           => 'radio-images',
			'label'          => __( 'Sidebar Position', 'konstruct' ),
			'section'        => 'woocommerce',
			'choices'        => array(
				'no-sidebar' => array(
					'src' => op_directory_uri() . '/assets/img/no-sidebar.png',
					'tooltip' => __( 'No Sidebar', 'konstruct' )
				),
				'sidebar-left' => array(
					'src' => op_directory_uri() . '/assets/img/sidebar-left.png',
					'tooltip' => __( 'Sidebar Left', 'konstruct' )
				),
				'sidebar-right' => array(
					'src' => op_directory_uri() . '/assets/img/sidebar-right.png',
					'tooltip' => __( 'Sidebar Right', 'konstruct' )
				)
			)
		);

		$options['woo_single_sidebar'] = array(
			'type'    => 'dropdown-sidebars',
			'section' => 'woocommerce',
			'label'   => __( 'Sidebar', 'konstruct' ),
			'default' => 'sidebar-primary'
		);

		$options['woo_related_box_enabled'] = array(
			'type'    => 'switcher',
			'label'   => __( 'Show Related Products', 'konstruct' ),
			'section' => 'woocommerce',
			'default' => true
		);

		$options['woo_related_products_count'] = array(
			'type'    => 'spinner',
			'section' => 'woocommerce',
			'label'   => __( 'Number Of Related Products', 'konstruct' ),
			'min'     => 1,
			'default' => 4
		);
	}

	/**
	 * Portfolio
	 */
	$options['portfolio_page_title_enabled'] = array(
		'type'    => 'switcher',
		'section' => 'portfolio',
		'label'   => __( 'Enable Page Title', 'konstruct' ),
		'default' => true
	);

	$options['portfolio_page_title'] = array(
		'type'    => 'text',
		'section' => 'portfolio',
		'label'   => __( 'Custom Page Title', 'konstruct' ),
		'default' => __( 'Portfolio', 'konstruct' )
	);

	$options['portfolio_list_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'portfolio',
		'title'       => __( 'Portfolio List', 'konstruct' ),
		'description' => __( 'Change options in this section to custom style for portfolio listing page.', 'konstruct' )
	);

	$options['portfolio_archive_sidebar_layout'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'List Sidebar Position', 'konstruct' ),
		'section' => 'portfolio',
		'choices' => array(
			'no-sidebar' => array(
				'src' => op_directory_uri() . '/assets/img/no-sidebar.png',
				'tooltip' => __( 'No Sidebar', 'konstruct' )
			),
			'sidebar-left' => array(
				'src' => op_directory_uri() . '/assets/img/sidebar-left.png',
				'tooltip' => __( 'Sidebar Left', 'konstruct' )
			),
			'sidebar-right' => array(
				'src' => op_directory_uri() . '/assets/img/sidebar-right.png',
				'tooltip' => __( 'Sidebar Right', 'konstruct' )
			)
		),
		'default' => 'sidebar-right'
	);

	$options['portfolio_archive_sidebar'] = array(
		'type'    => 'dropdown-sidebars',
		'section' => 'portfolio',
		'label'   => __( 'Portfolio List Sidebar', 'konstruct' ),
		'default' => 'sidebar-primary'
	);

	$options['portfolio_archive_layout'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'List Layout', 'konstruct' ),
		'section' => 'portfolio',
		'choices' => array(
			'grid' => array(
				'src' => op_directory_uri() . '/assets/img/blog-grid.png',
				'tooltip' => __( 'Grid', 'konstruct' )
			),
			'masonry' => array(
				'src' => op_directory_uri() . '/assets/img/blog-masonry.png',
				'tooltip' => __( 'Masonry Grid', 'konstruct' )
			),
			'no-margin' => array(
				'src' => op_directory_uri() . '/assets/img/portfolio-no-margin.png',
				'tooltip' => __( 'Grid No Margin', 'konstruct' )
			)
		),
		'default' => 'grid'
	);

	$options['portfolio_grid_columns'] = array(
		'type'    => 'dropdown',
		'section' => 'portfolio',
		'label'   => __( 'Grid Columns', 'konstruct' ),
		'default' => 3,
		'choices' => array(
			2 => __( '2 Columns', 'konstruct' ),
			3 => __( '3 Columns', 'konstruct' ),
			4 => __( '4 Columns', 'konstruct' ),
			5 => __( '5 Columns', 'konstruct' ),
		)
	);

	$options['portfolio_archive_filter'] = array(
		'type'    => 'switcher',
		'section' => 'portfolio',
		'label'   => __( 'Show Items Filter', 'konstruct' ),
		'default' => true
	);

	$options['portfolio_archive_pagination_style'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'Pagination Style', 'konstruct' ),
		'section' => 'portfolio',
		'default' => 'numeric',
		'choices' => array(
			'pager' => array(
				'src'     => op_directory_uri() . '/assets/img/paging-pager.png',
				'tooltip' => __( 'Pager', 'konstruct' )
			),
			'numeric' => array(
				'src'     => op_directory_uri() . '/assets/img/paging-numeric.png',
				'tooltip' => __( 'Numeric', 'konstruct' )
			),
			'pager-numeric' => array(
				'src'     => op_directory_uri() . '/assets/img/paging-pager-numeric.png',
				'tooltip' => __( 'Pager & Numeric', 'konstruct' )
			),
			'loadmore' => array(
				'src'     => op_directory_uri() . '/assets/img/paging-loadmore.png',
				'tooltip' => __( 'Load More', 'konstruct' )
			)
		)
	);

	$options['portfolio_posts_per_page'] = array(
		'type'     => 'spinner',
		'section'  => 'portfolio',
		'label'    => __( 'Posts Per Page', 'konstruct' ),
		'default'  => get_option( 'posts_per_page' )
	);

	$options['portfolio_posts_order_by'] = array(
		'type'     => 'dropdown',
		'section'  => 'portfolio',
		'label'    => __( 'Order By', 'konstruct' ),
		'default'  => 'date',
		'choices'  => array(
			'date'          => __( 'Date', 'konstruct' ),
			'ID'            => __( 'ID', 'konstruct' ),
			'author'        => __( 'Author', 'konstruct' ),
			'title'         => __( 'Title', 'konstruct' ),
			'modified'      => __( 'Modified', 'konstruct' ),
			'rand'          => __( 'Random', 'konstruct' ),
			'comment_count' => __( 'Comment count', 'konstruct' ),
			'menu_order'    => __( 'Menu order', 'konstruct' ),
		)
	);

	$options['portfolio_posts_order_direction'] = array(
		'type'     => 'dropdown',
		'section'  => 'portfolio',
		'label'    => __( 'Order Direction', 'konstruct' ),
		'default'  => 'DESC',
		'choices'  => array(
			'ASC'  => __( 'Ascending', 'konstruct' ),
			'DESC' => __( 'Descending', 'konstruct' )
		)
	);

	$options['portfolio_single_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'portfolio',
		'title'       => __( 'Single Portfolio', 'konstruct' ),
		'description' => __( 'Change the layout, sidebar, navigator, ... for the single portfolio page.', 'konstruct' )
	);
	
	$options['portfolio_single_sidebar_layout'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'Single Sidebar Position', 'konstruct' ),
		'section' => 'portfolio',
		'choices' => array(
			'no-sidebar' => array(
				'src'     => op_directory_uri() . '/assets/img/no-sidebar.png',
				'tooltip' => __( 'No Sidebar', 'konstruct' )
			),
			'sidebar-left' => array(
				'src'     => op_directory_uri() . '/assets/img/sidebar-left.png',
				'tooltip' => __( 'Sidebar Left', 'konstruct' )
			),
			'sidebar-right' => array(
				'src'     => op_directory_uri() . '/assets/img/sidebar-right.png',
				'tooltip' => __( 'Sidebar Right', 'konstruct' )
			)
		),
		'default' => 'sidebar-right'
	);

	$options['portfolio_single_sidebar'] = array(
		'type'    => 'dropdown-sidebars',
		'section' => 'portfolio',
		'label'   => __( 'Single Portfolio Sidebar', 'konstruct' ),
		'default' => 'sidebar-primary'
	);

	$options['portfolio_post_navigator_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Show Single Navigator', 'konstruct' ),
		'section' => 'portfolio',
		'default' => true
	);

	$options['portfolio_post_navigator_sticky'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Single Sticky Navigator', 'konstruct' ),
		'section' => 'portfolio',
		'default' => false
	);

	$options['portfolio_related_box_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Show Related Portfolios', 'konstruct' ),
		'section' => 'portfolio',
		'default' => true
	);

	$options['portfolio_related_style'] = array(
		'type'    => 'dropdown',
		'section' => 'portfolio',
		'label'   => __( 'Related Portfolio Style', 'konstruct' ),
		'default' => 'grid',
		'choices' => array(
			'grid'      => __( 'Grid', 'konstruct' ),
			'masonry'   => __( 'Grid Masonry', 'konstruct' ),
			'no-margin' => __( 'Grid No Margin', 'konstruct' ),
			'carousel'  => __( 'Carousel', 'konstruct' ),
			'carousel-no-margin'  => __( 'Carousel No Margin', 'konstruct' )
		)
	);

	$options['portfolio_related_columns_count'] = array(
		'type'    => 'dropdown',
		'section' => 'portfolio',
		'label'   => __( 'Columns Count', 'konstruct' ),
		'choices' => array(
			1 => __( '1 Column', 'konstruct' ),
			2 => __( '2 Columns', 'konstruct' ),
			3 => __( '3 Columns', 'konstruct' ),
			4 => __( '4 Columns', 'konstruct' ),
			5 => __( '5 Columns', 'konstruct' )
		),
		'default' => 4
	);
	
	$options['portfolio_related_posts_count'] = array(
		'type'    => 'spinner',
		'section' => 'portfolio',
		'label'   => __( 'Number Of Related Portfolios', 'konstruct' ),
		'min'     => 1,
		'default' => 4
	);

	/**
	 * Under Construction
	 */
	$options['under_construction_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Under Construction', 'konstruct' ),
		'section' => 'under-construction',
		'default' => false
	);

	$options['under_construction_page_id'] = array(
		'type'     => 'dropdown-pages',
		'section'  => 'under-construction',
		'label'    => __( 'Under Construction Page', 'konstruct' )
	);

	$options['under_construction_allowed'] = array(
		'type'    => 'checkboxes',
		'section' => 'under-construction',
		'label'   => __( 'Role-based Access Permission', 'konstruct' ),
		'choices' => function() {
			$choices = array();

			foreach ( get_editable_roles() as $id => $params )
				$choices[$id] = $params['name'];
			
			return $choices;
		},

		'default' => array( 'administrator', 'editor' )
	);

	return $options;
}



/**
 * Return the default options of the theme
 * 
 * @return  void
 */
function konstruct_customize_default_options() {
	$logo = trailingslashit( get_template_directory_uri() ) . 'assets/img/logo.png';
	$icon = trailingslashit( get_template_directory_uri() ) . 'assets/img/favicon.ico';

	return array (
		'gotop_enabed'  => true,
		'tracking_code' => '',
		'bookmark_icon' => $icon,
		'social_links'  =>  array (
			'twitter'     => 'https://twitter.com/linethemes',
			'facebook'    => 'https://facebook.com/thelinethemes',
			'google-plus' => '#',
			'pinterest'   => '#',
			'behance'     => '#'
		),
		'body_font' =>  array (
			'family' => 'Roboto',
			'size'   => 14,
			'style'  => 400,
			'color'  => '#888'
		),
		'heading_font' => array (
			'family' => 'Fjalla+One',
			'style'  => 400
		),
		'heading_fontsize' => array ( 36, 30, 24, 18, 14, 12 ),
		'menu_font'        =>  array (
			'family' => 'Fjalla+One',
			'size'   => 14,
			'style'  => 400,
			'color'  => '#333333'
		),
		'cyrillic_subsets_enabled'     => false,
		'cyrillic_ext_subsets_enabled' => false,
		'greek_subsets_enabled'        => false,
		'greek_ext_subsets_enabled'    => false,
		'vietnamese_subsets_enabled'   => false,
		'latin_ext_subsets_enabled'    => false,
		'devanagari_subsets_enabled'   => false,
		'scheme_color'                 => '#f1c40f',
		'layout_mode'                  => 'layout-wide',
		'boxed_background'             => array (
			'type'     => 'none',
			'pattern'  => 'none',
			'color'    => '#fff',
			'image'    => '',
			'repeat'   => 'repeat',
			'position' => 'top-left',
			'style'    => 'scroll'
		),
		'sidebar_layout'       => 'no-sidebar',
		'sidebar_default'      => 'sidebar-primary',
		'pagetitle_enabled'    => true,
		'pagetitle_background' => array (
			'color'    => '#f2f2f2',
			'type'     => 'custom',
			'pattern'  => 'none',
			'image'    => '',
			'repeat'   => 'repeat',
			'position' => 'top-left',
			'style'    => 'scroll'
		),
		'pagetitle_textcolor'         => '#333333',
		'breadcrumb_prefix'           => 'You are here:',
		'breadcrumb_separator'        => '/',
		'logo_image'                  => true,
		'show_tagline'                => false,
		'logo_src'                    => $logo,
		'logo_sticky_src'             => $logo,
		'logo_size'                   => array ( 197, 41 ),
		'logo_margin'                 => array ( 30, 29 ),
		'header_style'                => 'header-v4',
		'header_sticky'               => true,
		'header_cart_menu'            => false,
		'header_searchbox'            => false,
		'header_overlay_content'      => true,
		'topbar_enabled'              => false,
		'topbar_bgcolor'              => '#f4f4f4',
		'topbar_textcolor'            => '#333333',
		'topbar_content'              => '<i class="fa fa-phone"></i> Call Us Today!  001-123-456-7890<span class="spacer"></span><i class="fa fa-envelope-o"></i> support@linethemes.com',
		'topbar_social_links_enabled' => true,
		'page_callout_enabled'        => false,
		'page_callout_content'        => 'Providing personalized and high quality services.',
		'page_callout_button_text'    => 'Purchase Now',
		'page_callout_button_link'    => 'http://linethemes.com',
		'page_callout_button_target'  => '_blank',
		'page_callout_button_class'   => '',
		'page_callout_background'     => '#f1c40f',
		'page_callout_textcolor'      => '#fff',
		'footer_widgets_enabled'      => true,
		'footer_widgets_layout'       =>  array (
			'active' => 2,
			'layout' => array (
				array ( 12 ),
				array ( 6, 6 ),
				array ( 4, 4, 4 ),
				array ( 3, 3, 3, 3)
			)
		),
		'footer_widgets_background' => array (
			'color'    => '#2a2a2a',
			'type'     => 'custom',
			'pattern'  => 'none',
			'image'    => '',
			'repeat'   => 'no-repeat',
			'position' => 'center-center',
			'style'    => 'scroll',
		),
		'footer_widgets_textcolor'            => '#888',
		'footer_social_links_enabled'         => true,
		'footer_copyright'                    => 'Copyright &copy; 2014 <a href="http://linethemes.com" target="_blank">LineThemes</a>. All rights reserved',
		'blog_page_title_enabled'             => true,
		'blog_page_title'                     => 'Blog',
		'blog_archive_sidebar_layout'         => 'sidebar-right',
		'blog_archive_sidebar'                => 'sidebar-primary',
		'blog_archive_layout'                 => 'medium',
		'blog_grid_columns'                   => 2,
		'blog_archive_post_excepts'           => true,
		'blog_archive_post_excepts_striphtml' => true,
		'blog_archive_post_excepts_length'    => 150,
		'blog_archive_show_post_meta'         => true,
		'blog_archive_readmore'               => true,
		'blog_archive_readmore_text'          => 'Continue Read',
		'blog_archive_pagination_style'       => 'pager',
		'blog_posts_per_page'                 => 10,
		'blog_single_sidebar_layout'          => 'sidebar-right',
		'blog_single_sidebar'                 => 'sidebar-primary',
		'blog_post_navigator_enabled'         => true,
		'blog_post_navigator_sticky'          => false,
		'blog_author_box_enabled'             => true,
		'blog_related_box_enabled'            => true,
		'blog_related_posts_style'            => 'grid',
		'blog_related_posts_count'            => 3,
		'woo_archive_sidebar_layout'          => 'sidebar-left',
		'woo_archive_sidebar'                 => 'sidebar-0',
		'woo_single_sidebar_layout'           => 'sidebar-left',
		'woo_single_sidebar'                  => 'sidebar-0',
		'woo_related_box_enabled'             => true,
		'woo_related_box_style'               => 'slider',
		'woo_related_products_count'          => 3,
		'portfolio_page_title_enabled'        => true,
		'portfolio_page_title'                => 'Portfolio',
		'portfolio_archive_sidebar_layout'    => 'sidebar-right',
		'portfolio_archive_sidebar'           => 'sidebar-primary',
		'portfolio_archive_layout'            => 'masonry',
		'portfolio_grid_columns'              => 3,
		'portfolio_archive_filter'            => true,
		'portfolio_archive_pagination_style'  => 'numeric',
		'portfolio_posts_per_page'            => 10,
		'portfolio_single_sidebar_layout'     => 'no-sidebar',
		'portfolio_single_sidebar'            => 'sidebar-primary',
		'portfolio_post_navigator_enabled'    => true,
		'portfolio_post_navigator_sticky'     => false,
		'portfolio_related_box_enabled'       => true,
		'portfolio_related_posts_count'       => 4,
		'portfolio_related_columns_count'     => 4,
		'portfolio_posts_order_by'            => 'date',
		'portfolio_posts_order_direction'     => 'asc',
		'social_sharing_enabled'              => true,
		'social_sharing_layout'               => 'horizontal',
		'social_sharing_style'                => 'mini',
		'blog_list_sharing'                   => true,
		'blog_single_sharing'                 => true,
		'portfolio_list_sharing'              => true,
		'portfolio_single_sharing'            => true,
		'woocommerce_list_sharing'            => true,
		'woocommerce_single_sharing'          => true,
		'social_share_facebook'               => true,
		'social_share_twitter'                => true,
		'social_share_googleplus'             => true,
		'social_share_pinterest'              => true,
		'social_share_linkedin'               => true,
		'portfolio_archive_excerpt'           => false,
		'blog_related_posts_columns'          => 3,
		'portfolio_related_style'             => 'grid',
		'install_sample_data'                 => '',
		'under_construction_enabled'          => false,
		'under_construction_page_id'          => 0,
		'under_construction_allowed'          => array ( 'administrator' ),
		'woo_products_per_page'               => 9,
		'header_dark_style'                   => false,
		'header_stick_dark_style'             => '',
		'header_show_offcanvas'               => true,
		'content_width'                       => '1110px',
		'custom_css'                          => '',
		'custom_js'                           => '',
	);
}



/**
 * Return array of fields that will be used to register
 * options for the post
 * 
 * @return  array
 */
function konstruct_post_options_fields() {
	$options = array();
	$options['images_heading'] = array(
		'type'        => 'heading',
		'title'       => __( 'Gallery Images', 'konstruct' ),
		'description' => __( 'Add images to create a slider for this post, post format "Gallery" must be checked.', 'konstruct' ),
		'section'     => 'all'
	);

	$options['post_images'] = array(
		'type'        => 'media-list',
		'section'     => 'all',
		'media_types' => array( 'image' ),
		'default'     => array()
	);

	$options['video_heading'] = array(
		'type'        => 'heading',
		'section'     => 'all',
		'title'       => __( 'Video URL', 'konstruct' ),
		'description' => __( 'Add an URL that linked to a video, it can be Youtube, Vimeo, ... The added video will be displayed on top of the page.', 'konstruct' )
	);

	$options['post_video'] = array(
		'type'    => 'media-input',
		'section' => 'all',
		'library' => 'video',
		'default' => ''
	);

	$options['audio_heading'] = array(
		'type'        => 'heading',
		'section'     => 'all',
		'title'       => __( 'Audio URL', 'konstruct' ),
		'description' => __( 'This field will be applied when post format "Audio" is checked. A audio player will be displayed on top of the post.', 'konstruct' )
	);

	$options['post_audio'] = array(
		'type'    => 'media-input',
		'section' => 'all',
		'library' => 'audio',
		'default' => ''
	);

	$options['link_heading'] = array(
		'type'        => 'heading',
		'section'     => 'all',
		'title'       => __( 'External Link', 'konstruct' ),
		'description' => __( 'When post format "Link" is selected you need provide a link to this field.', 'konstruct' )
	);

	$options['post_link'] = array(
		'type'    => 'text',
		'section' => 'all',
		'default' => 'http://'
	);

	return $options;
}



/**
 * Return an array that used to declare options
 * for the page
 * 
 * @return  array
 */
function konstruct_page_options_fields() {
	global $wp_registered_sidebars;

	$patterns = predefined_background_patterns();
	$options  = array();
	$sidebars = array();

	// Retrieve all registered sidebars
	foreach( $wp_registered_sidebars as $params )
		$sidebars[$params['id']] = $params['name'];

	/**
	 * General
	 */
	$options['cover_heading'] = array(
		'type' => 'heading',
		'section' => 'general',
		'title' => __( 'Page Cover', 'konstruct' ),
		'description' => __( 'This is an special option, it allow to input any content as you wish. The entered content will be displayed on top of the page, page header will show at below.', 'konstruct' )
	);

	$options['page_cover_content'] = array(
		'type'    => 'editor',
		'section' => 'general',
		'default' => ''
	);

	$options['styles_heading'] = array(
		'type'        => 'heading',
		'section'     => 'general',
		'title'       => __( 'Styles', 'konstruct' ),
		'description' => __( 'Select the scheme color that will be applied for this page only.', 'konstruct' )
	);

	$options['enable_custom_styles'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Custom Styles', 'konstruct' ),
		'section' => 'general',
		'default' => false
	);

	$options['scheme_color'] = array(
		'type'    => 'color-picker',
		'label'   => __( 'Scheme Color', 'konstruct' ),
		'section' => 'general',
		'default' => op_option( 'scheme_color' )
	);

	$options['layout_heading'] = array(
		'type' => 'heading',
		'section' => 'general',
		'title' => __( 'Layout', 'konstruct' ),
		'description' => __( 'Choose between a full or a boxed layout to set how this page layout will look like.', 'konstruct' )
	);

	$options['enable_custom_layout'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Custom Layout', 'konstruct' ),
		'section' => 'general',
		'default' => false
	);

	$options['layout_mode'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'Display Style', 'konstruct' ),
		'section' => 'general',
		'default' => op_option( 'layout_mode' ),
		'choices' => array(
			'layout-wide'  => array(
				'src' => op_directory_uri() . '/assets/img/layout-wide.png',
				'tooltip' => __( 'Wide', 'konstruct' )
			),

			'layout-boxed'  => array(
				'src' => op_directory_uri() . '/assets/img/layout-boxed.png',
				'tooltip' => __( 'Boxed', 'konstruct' )
			),
		)
	);

	$options['boxed_background'] = array(
		'type'     => 'background',
		'label'    => __( 'Boxed Layout Background', 'konstruct' ),
		'section'  => 'general',
		'patterns' => $patterns,
		'default'  => op_option( 'boxed_background' )
	);

	// $options['sidebar_heading'] = array(
	// 	'type' => 'heading',
	// 	'section' => 'general',
	// 	'title' => __( 'Custom Sidebar', 'konstruct' ),
	// 	'description' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.', 'konstruct' )
	// );

	$options['sidebar_layout'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'Sidebar Position', 'konstruct' ),
		'section' => 'general',
		'default' => op_option( 'sidebar_layout' ),
		'choices' => array(
			'no-sidebar' => array(
				'src' => op_directory_uri() . '/assets/img/no-sidebar.png',
				'tooltip' => __( 'No Sidebar', 'konstruct' )
			),
			'sidebar-left' => array(
				'src' => op_directory_uri() . '/assets/img/sidebar-left.png',
				'tooltip' => __( 'Sidebar Left', 'konstruct' )
			),
			'sidebar-right' => array(
				'src' => op_directory_uri() . '/assets/img/sidebar-right.png',
				'tooltip' => __( 'Sidebar Right', 'konstruct' )
			)
		)
	);

	$options['sidebar_default'] = array(
		'type'    => 'dropdown-sidebars',
		'label'   => __( 'Custom Sidebar', 'konstruct' ),
		'section' => 'general',
		'default' => op_option( 'sidebar_default' )
	);
	
	/**
	 * Page Title
	 */
	$options['pagetitle_heading'] = array(
		'type'        => 'heading',
		'section'     => 'general',
		'title'       => __( 'Page Title', 'konstruct' ),
		'description' => __( 'In this section you can turn on/off or modify style for the Page Title.', 'konstruct' )
	);

	$options['enable_custom_page_header'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Custom Page Title', 'konstruct' ),
		'section' => 'general',
		'default' => false
	);

	$options['pagetitle_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Display Title Bar On This Page', 'konstruct' ),
		'section' => 'general',
		'default' => op_option( 'pagetitle_enabled' )
	);

	$options['pagetitle_background'] = array(
		'type'     => 'background',
		'label'    => __( 'Page Header Background', 'konstruct' ),
		'section'  => 'general',
		'patterns' => $patterns,
		'default'  => op_option( 'pagetitle_background' )
	);

	/**
	 * Header
	 */
	$options['topbar_heading'] = array(
		'type' => 'heading',
		'section' => 'header',
		'title' => __( 'Top Bar', 'konstruct' ),
		'description' => __( 'Turn on/off the top bar and change it styles.', 'konstruct' )
	);

	$options['enable_custom_topbar'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Custom Topbar', 'konstruct' ),
		'section' => 'header',
		'default' => false
	);

	$options['topbar_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Display Topbar On This Page', 'konstruct' ),
		'section' => 'header',
		'default' => op_option( 'topbar_enabled' )
	);

	$options['topbar_bgcolor'] = array(
		'type'    => 'color-picker',
		'label'   => __( 'Topbar Background', 'konstruct' ),
		'section' => 'header',
		'default' => op_option( 'topbar_bgcolor' )
	);

	$options['topbar_textcolor'] = array(
		'type'    => 'color-picker',
		'label'   => __( 'Topbar Text Color', 'konstruct' ),
		'section' => 'header',
		'default' => op_option( 'topbar_textcolor' )
	);

	$options['topbar_content'] = array(
		'type'    => 'textarea',
		'label'   => __( 'Content', 'konstruct' ),
		'section' => 'header',
		'default' => op_option( 'topbar_content' )
	);

	$options['topbar_social_links_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Social Links', 'konstruct' ),
		'section' => 'header',
		'default' => op_option( 'topbar_social_links_enabled' )
	);

	$options['header_style_heading'] = array(
		'type'        => 'heading',
		'section'     => 'header',
		'title'       => __( 'Custom Header', 'konstruct' ),
		'description' => __( 'Change the header style, toggle sticky header feature and turn on/off extra menu icons.', 'konstruct' )
	);

	$options['enable_custom_header_style'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Custom Header', 'konstruct' ),
		'section' => 'header',
		'default' => false
	);

	$options['header_style'] = array(
		'type'    => 'dropdown',
		'section' => 'header',
		'label'   => __( 'Header Style', 'konstruct' ),
		'default' => op_option( 'header_style' ),
		'choices' => predefined_header_styles()
	);

	$options['header_sticky'] = array(
		'type'    => 'switcher',
		'section' => 'header',
		'label'   => __( 'Enable Sticky Header', 'konstruct' )
	);

	$options['header_cart_menu'] = array(
		'type'    => 'switcher',
		'section' => 'header',
		'label'   => __( 'Show Cart Menu', 'konstruct' ),
		'default' => op_option( 'header_cart_menu' )
	);

	$options['header_searchbox'] = array(
		'type'    => 'switcher',
		'section' => 'header',
		'label'   => __( 'Show Search Menu', 'konstruct' ),
		'default' => op_option( 'header_searchbox' )
	);

	$options['header_show_offcanvas'] = array(
		'type'    => 'switcher',
		'section' => 'header',
		'label'   => __( 'Show Off-Canvas Menu', 'konstruct' ),
		'default' => op_option( 'header_show_offcanvas' )
	);

	$options['logo_heading'] = array(
		'type'        => 'heading',
		'section'     => 'header',
		'title'       => __( 'Custom Logo', 'konstruct' ),
		'description' => __( 'In this section You can upload your own custom logo, change the way your logo can be displayed.', 'konstruct' )
	);

	$options['enable_custom_logo'] = array(
		'type'    => 'switcher',
		'section' => 'header',
		'label'   => __( 'Enable Custom Logo', 'konstruct' ),
		'default' => false
	);

	$options['logo_src'] = array(
		'type'    => 'media-picker',
		'label'   => __( 'Logo', 'konstruct' ),
		'section' => 'header',
		'default' => op_option( 'logo_src' )
	);

	$options['logo_sticky_src'] = array(
		'type'    => 'media-picker',
		'label'   => __( 'Logo For Sticky Header', 'konstruct' ),
		'section' => 'header',
		'default' => op_option( 'logo_sticky_src' )
	);

	$options['logo_size'] = array(
		'type'    => 'dimension',
		'label'   => __( 'Logo Size', 'konstruct' ),
		'section' => 'header',
		'fields'  => array(
			'width'  => __( 'Width (px)', 'konstruct' ),
			'height' => __( 'Height (px)', 'konstruct' )
		),
		'default' => op_option( 'logo_size' )
	);

	$options['logo_margin'] = array(
		'type'    => 'dimension',
		'label'   => __( 'Logo Margin', 'konstruct' ),
		'section' => 'header',
		'fields'  => array(
			'top'    => __( 'Top (px)', 'konstruct' ),
			'bottom' => __( 'Bottom (px)', 'konstruct' )
		),
		'default' => op_option( 'logo_margin' )
	);

	$options['navigator_heading'] = array(
		'type'        => 'heading',
		'section'     => 'header',
		'title'       => __( 'Navigator', 'konstruct' ),
		'description' => __( 'Just select your menu that you wish assign it to the location on the theme.', 'konstruct' )
	);

	$options['enable_custom_navigator'] = array(
		'type'    => 'switcher',
		'section' => 'header',
		'label'   => __( 'Enable Custom Navigator', 'konstruct' ),
		'default' => false
	);

	// Navigator
	$menus     = wp_get_nav_menus();
	$locations = get_registered_nav_menus();

	if ( $menus ) {
		$choices = array( 0 => __( '&dash; Select &dash;', 'konstruct' ) );
		foreach ( $menus as $menu ) {
			$choices[ $menu->term_id ] = wp_html_excerpt( $menu->name, 40, '&hellip;' );
		}

		$asigned_locations = op_option( 'nav_menu_locations' );

		foreach ( $locations as $location => $description ) {
			$menu_setting_id = "nav_menu_locations[{$location}]";

			$options["menu_location_{$location}"] = array(
				'label'   => $description,
				'section' => 'header',
				'type'    => 'dropdown',
				'choices' => $choices,
				'default' => isset( $asigned_locations[$location] ) ? $asigned_locations[$location] : 0
			);
		}
	}

	$options['onepage_nav_script'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Load One Page Navigator Script', 'konstruct' ),
		'section' => 'header',
		'default' => false
	);

	/**
	 * Footer
	 */
	$options['callout_heading'] = array(
		'type'        => 'heading',
		'section'     => 'footer',
		'title'       => __( 'Page Callout', 'konstruct' ),
		'description' => __( 'You can modify content and styles for the page callout section.', 'konstruct' )
	);

	$options['enable_custom_page_callout'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Custom Page Callout', 'konstruct' ),
		'section' => 'footer',
		'default' => false
	);

	$options['page_callout_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Display Callout Section On This Page', 'konstruct' ),
		'section' => 'footer',
		'default' => op_option( 'page_callout_enabled' )
	);

	$options['page_callout_content'] = array(
		'type'    => 'textarea',
		'label'   => __( 'Callout Content', 'konstruct' ),
		'section' => 'footer',
		'default' => op_option( 'page_callout_content' )
	);

	$options['page_callout_button_text'] = array(
		'type'    => 'text',
		'label'   => __( 'Callout Button Text', 'konstruct' ),
		'section' => 'footer',
		'default' => op_option( 'page_callout_button_text' )
	);

	$options['page_callout_button_link'] = array(
		'type'    => 'text',
		'label'   => __( 'Callout Button Link', 'konstruct' ),
		'section' => 'footer',
		'default' => op_option( 'page_callout_button_link' )
	);

	$options['page_callout_button_target'] = array(
		'type'    => 'dropdown',
		'label'   => __( 'Button Target', 'konstruct' ),
		'section' => 'footer',
		'choices' => array(
			'_blank' => __( 'New Window', 'konstruct' ),
			'_top'   => __( 'Same Window', 'konstruct' )
		),
		'default' => op_option( 'page_callout_button_target' )
	);

	$options['page_callout_button_class'] = array(
		'type'    => 'text',
		'label'   => __( 'Button Addition Class', 'konstruct' ),
		'section' => 'footer',
		'default' => op_option( 'page_callout_button_class' )
	);

	$options['page_callout_background'] = array(
		'type'    => 'color-picker',
		'label'   => __( 'Background Color', 'konstruct' ),
		'section' => 'footer',
		'default' => op_option( 'page_callout_background' )
	);

	$options['page_callout_textcolor'] = array(
		'type'    => 'color-picker',
		'label'   => __( 'Text Color', 'konstruct' ),
		'section' => 'footer',
		'default' => op_option( 'page_callout_textcolor' )
	);

	$options['footer_widgets_heading'] = array(
		'type'        => 'heading',
		'section'     => 'footer',
		'title'       => __( 'Footer Widgets', 'konstruct' ),
		'description' => __( 'This section allow to change the layout and styles of footer widgets to match as you need.', 'konstruct' )
	);

	$options['enable_custom_footer_widgets'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Custom Footer Widgets', 'konstruct' ),
		'section' => 'footer',
		'default' => false
	);

	$options['footer_widgets_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Display Footer Widgets On This Page', 'konstruct' ),
		'section' => 'footer',
		'default' => op_option( 'footer_widgets_enabled' )
	);

	$options['footer_widgets_layout'] = array(
		'type'    => 'widgetslayout',
		'label'   => __( 'Footer Widgets Layout', 'konstruct' ),
		'max'     => 4,
		'section' => 'footer',
		'default' => op_option( 'footer_widgets_layout' )
	);

	$options['footer_widgets_background'] = array(
		'type'     => 'background',
		'section'  => 'footer',
		'label'    => __( 'Widgets Background', 'konstruct' ),
		'patterns' => predefined_background_patterns(),
		'default'  => op_option( 'footer_widgets_background' )
	);

	$options['footer_widgets_textcolor'] = array(
		'type'    => 'color-picker',
		'section' => 'footer',
		'label'   => __( 'Text Color', 'konstruct' ),
		'default' => op_option( 'footer_widgets_textcolor' )
	);

	$options['footer_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'footer',
		'title'       => __( 'Custom Footer', 'konstruct' ),
		'description' => __( 'You can change the copyright text, show/hide the social icons on the footer.', 'konstruct' )
	);

	$options['enable_custom_footer'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Enable Custom Footer Content', 'konstruct' ),
		'section' => 'footer',
		'default' => false
	);

	$options['footer_social_links_enabled'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Display Social Links On This Page', 'konstruct' ),
		'section' => 'footer',
		'default' => op_option( 'footer_social_links_enabled' )
	);

	$options['footer_copyright'] = array(
		'type'    => 'textarea',
		'label'   => __( 'Copyright', 'konstruct' ),
		'section' => 'footer',
		'default' => op_option( 'footer_copyright' )
	);

	/**
	 * Portfolio
	 */
	$options['portfolio_list_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'portfolio',
		'title'       => __( 'Portfolio', 'konstruct' ),
		'description' => __( 'Change options in this section to custom style for portfolio listing page.', 'konstruct' )
	);

	$options['portfolio_archive_layout'] = array(
		'label'   => __( 'List Layout', 'konstruct' ),
		'type'    => 'radio-images',
		'section' => 'portfolio',
		'choices' => array(
			'grid' => array(
				'src' => op_directory_uri() . '/assets/img/blog-grid.png',
				'tooltip' => __( 'Grid', 'konstruct' )
			),
			'masonry' => array(
				'src' => op_directory_uri() . '/assets/img/blog-masonry.png',
				'tooltip' => __( 'Masonry Grid', 'konstruct' )
			),
			'no-margin' => array(
				'src' => op_directory_uri() . '/assets/img/portfolio-no-margin.png',
				'tooltip' => __( 'Grid No Margin', 'konstruct' )
			)
		),
		'default' => 'grid'
	);

	$options['portfolio_grid_columns'] = array(
		'type'    => 'dropdown',
		'section' => 'portfolio',
		'label'   => __( 'Grid Columns', 'konstruct' ),
		'default' => 3,
		'choices' => array(
			2 => __( '2 Columns', 'konstruct' ),
			3 => __( '3 Columns', 'konstruct' ),
			4 => __( '4 Columns', 'konstruct' ),
			5 => __( '5 Columns', 'konstruct' )
		)
	);

	$options['portfolio_archive_filter'] = array(
		'type'    => 'switcher',
		'section' => 'portfolio',
		'label'   => __( 'Show Portoflio Filter', 'konstruct' ),
		'default' => true
	);

	$options['portfolio_archive_pagination_style'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'Pagination Style', 'konstruct' ),
		'section' => 'portfolio',
		'default' => 'numeric',
		'choices' => array(
			'pager' => array(
				'src' => op_directory_uri() . '/assets/img/paging-pager.png',
				'tooltip' => __( 'Pager', 'konstruct' )
			),
			'numeric' => array(
				'src' => op_directory_uri() . '/assets/img/paging-numeric.png',
				'tooltip' => __( 'Numeric', 'konstruct' )
			),
			'pager-numeric' => array(
				'src' => op_directory_uri() . '/assets/img/paging-pager-numeric.png',
				'tooltip' => __( 'Pager & Numeric', 'konstruct' )
			),
			'loadmore' => array(
				'src' => op_directory_uri() . '/assets/img/paging-loadmore.png',
				'tooltip' => __( 'Load More', 'konstruct' )
			)
		)
	);

	$options['portfolio_posts_per_page'] = array(
		'type'     => 'spinner',
		'section'  => 'portfolio',
		'label'    => __( 'Posts Per Page', 'konstruct' ),
		'default'  => get_option( 'posts_per_page' )
	);

	$options['portfolio_posts_order_by'] = array(
		'type'     => 'dropdown',
		'section'  => 'portfolio',
		'label'    => __( 'Order By', 'konstruct' ),
		'default'  => 'date',
		'choices'  => array(
			'date'          => __( 'Date', 'konstruct' ),
			'ID'            => __( 'ID', 'konstruct' ),
			'author'        => __( 'Author', 'konstruct' ),
			'title'         => __( 'Title', 'konstruct' ),
			'modified'      => __( 'Modified', 'konstruct' ),
			'rand'          => __( 'Random', 'konstruct' ),
			'comment_count' => __( 'Comment count', 'konstruct' ),
			'menu_order'    => __( 'Menu order', 'konstruct' ),
		)
	);

	$options['portfolio_posts_order_direction'] = array(
		'type'     => 'dropdown',
		'section'  => 'portfolio',
		'label'    => __( 'Order Direction', 'konstruct' ),
		'default'  => 'DESC',
		'choices'  => array(
			'ASC'  => __( 'Ascending', 'konstruct' ),
			'DESC' => __( 'Descending', 'konstruct' )
		)
	);

	/**
	 * Blog Options
	 */
	$options['blog_list_heading'] = array(
		'type'        => 'heading',
		'class'       => 'no-border',
		'section'     => 'blog',
		'title'       => __( 'Blog', 'konstruct' ),
		'description' => __( 'All options in this section will be used to make style for blog page.', 'konstruct' )
	);

	$options['blog_archive_layout'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'List Layout', 'konstruct' ),
		'section' => 'blog',
		'choices' => array(
			'medium' => array(
				'src' => op_directory_uri() . '/assets/img/blog-medium.png',
				'tooltip' => __( 'List Medium', 'konstruct' )
			),
			'large' => array(
				'src' => op_directory_uri() . '/assets/img/blog-large.png',
				'tooltip' => __( 'List Large', 'konstruct' )
			),
			'grid' => array(
				'src' => op_directory_uri() . '/assets/img/blog-grid.png',
				'tooltip' => __( 'Grid', 'konstruct' )
			),
			'masonry' => array(
				'src' => op_directory_uri() . '/assets/img/blog-masonry.png',
				'tooltip' => __( 'Grid Masonry', 'konstruct' )
			),
		),
		'default' => 'large'
	);

	$options['blog_grid_columns'] = array(
		'type'    => 'dropdown',
		'section' => 'blog',
		'label'   => __( 'Grid Columns', 'konstruct' ),
		'default' => 3,
		'choices' => array(
			2 => __( '2 Columns', 'konstruct' ),
			3 => __( '3 Columns', 'konstruct' ),
			4 => __( '4 Columns', 'konstruct' )
		)
	);

	$options['blog_archive_post_excepts'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Auto Post Excepts', 'konstruct' ),
		'section' => 'blog',
		'default' => false
	);

	$options['blog_archive_post_excepts_length'] = array(
		'type'    => 'text',
		'label'   => __( 'Post Excepts Length', 'konstruct' ),
		'section' => 'blog',
		'default' => 40
	);

	$options['blog_archive_show_post_meta'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Show Post Meta', 'konstruct' ),
		'section' => 'blog',
		'default' => true
	);

	$options['blog_archive_readmore'] = array(
		'type'    => 'switcher',
		'label'   => __( 'Show Read More', 'konstruct' ),
		'section' => 'blog',
		'default' => true
	);

	$options['blog_archive_readmore_text'] = array(
		'type'    => 'text',
		'label'   => __( 'Read More Text', 'konstruct' ),
		'section' => 'blog',
		'default' => __( 'Continue Read &rarr;', 'konstruct' )
	);

	$options['blog_archive_pagination_style'] = array(
		'type'    => 'radio-images',
		'label'   => __( 'Pagination Style', 'konstruct' ),
		'section' => 'blog',
		'default' => 'numeric',
		'choices' => array(
			'pager' => array(
				'src' => op_directory_uri() . '/assets/img/paging-pager.png',
				'tooltip' => __( 'Pager', 'konstruct' )
			),
			'numeric' => array(
				'src' => op_directory_uri() . '/assets/img/paging-numeric.png',
				'tooltip' => __( 'Numeric', 'konstruct' )
			),
			'pager-numeric' => array(
				'src' => op_directory_uri() . '/assets/img/paging-pager-numeric.png',
				'tooltip' => __( 'Pager & Numeric', 'konstruct' )
			),
			'loadmore' => array(
				'src' => op_directory_uri() . '/assets/img/paging-loadmore.png',
				'tooltip' => __( 'Load More', 'konstruct' )
			)
		)
	);

	$options['blog_posts_per_page'] = array(
		'type'     => 'spinner',
		'section'  => 'blog',
		'label'    => __( 'Posts Per Page', 'konstruct' ),
		'default'  => get_option( 'posts_per_page' )
	);
	
	return $options;
}
