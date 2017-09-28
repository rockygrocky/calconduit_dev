<?php
/**
 * WARNING: This file is part of the SimplePortfolio plugin. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Plugin Name: ThemeKit By LineThemes
 * Plugin URI:  http://linethemes.com/
 * Description: The theme's components
 * Author:      LineThemes
 * Version:     1.0.9
 * Author URI: http://linethemes.com/
 */
defined( 'ABSPATH' ) or die();

define( 'THEMEKIT_VERSION', '1.0.7' );
define( 'THEMEKIT_PATH', plugin_dir_path( __FILE__ ) );
define( 'THEMEKIT_URL', plugin_dir_url( __FILE__ ) );

add_action( 'plugins_loaded', 'themekit_init' );

/**
 * Load the plugin translation files
 */
function themekit_init() {
	$domain = 'themekit';
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
	$path   = basename( __DIR__ ) . '/languages/';
	
	/**
	 * Load a .mo file into the text domain $domain.
	 */
	load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );

	/**
	 * Load a plugin's translated strings.
	 */
	load_plugin_textdomain( $domain, false, $path );
}

require_once THEMEKIT_PATH . '/includes/options-plus.php';
require_once THEMEKIT_PATH . '/includes/options-page.php';

// Portfolio
require_once THEMEKIT_PATH . '/includes/portfolio/func-setup.php';
require_once THEMEKIT_PATH . '/includes/portfolio/func-template.php';
require_once THEMEKIT_PATH . '/includes/portfolio/func-helper.php';
require_once THEMEKIT_PATH . '/includes/portfolio/settings.php';

// Member
require_once THEMEKIT_PATH . '/includes/member/func-setup.php';

if ( function_exists( 'visual_composer' ) ) {
	// Shortcodes
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-assets.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-countdown.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-counter.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-iconbox.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-iconlist.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-imagebox.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-member.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-openhours.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-posts.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-pricing-table.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-testimonial.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-portfolio.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-elements-carousel.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-team-members.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-posts-carousel.php';
	require_once THEMEKIT_PATH . '/includes/shortcodes/func-maps.php';
}
