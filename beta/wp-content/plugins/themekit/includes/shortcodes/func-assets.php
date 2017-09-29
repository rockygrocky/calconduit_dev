<?php
/**
 * WARNING: This file is part of the UI-Pack plugin. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

if ( ! function_exists( 'themekit_shortcode_register_assets' ) ) {
	add_action( 'init', 'themekit_shortcode_register_assets' );

	/**
	 * Register all needed scripts & styles for the plugin
	 * 
	 * @return  void
	 */
	function themekit_shortcode_register_assets() {
		wp_register_style( 'themekit-shortcodes-3rd', THEMEKIT_URL . '/assets/css/shortcodes-3rd.css', array(), THEMEKIT_VERSION );
		wp_register_style( 'themekit-shortcodes', THEMEKIT_URL . '/assets/css/shortcodes.css', array( 'themekit-shortcodes-3rd' ), THEMEKIT_VERSION );

		wp_register_script( 'themekit-shortcodes-3rd', THEMEKIT_URL . '/assets/js/shortcodes-3rd.js', array( 'jquery' ), THEMEKIT_VERSION, true );
		wp_register_script( 'themekit-shortcodes', THEMEKIT_URL . '/assets/js/shortcodes.js', array( 'themekit-shortcodes-3rd' ), THEMEKIT_VERSION, true );

		if ( $settings = get_option( 'themekit_settings' ) ) {
			wp_register_script( 'themekit-maps-api', '//maps.google.com/maps/api/js?sensor=false&v=3.7&key=' . $settings['maps_api'], array(), false, true );
			wp_register_script( 'themekit-maps', THEMEKIT_URL . '/assets/js/maps.js', array( 'jquery', 'themekit-maps-api' ), THEMEKIT_VERSION, true );
		}
	}
}



if ( ! function_exists( 'themekit_shortcode_enqueue_assets' ) ) {
	add_action( 'wp_enqueue_scripts', 'themekit_shortcode_enqueue_assets' );

	/**
	 * Enqueue styles for the plugin
	 * 
	 * @return void
	 */
	function themekit_shortcode_enqueue_assets() {
		if ( apply_filters( 'themekit_enqueue_shortcodes_style', true ) ) {
			wp_enqueue_style( 'themekit-shortcodes' );
		}
	}
}
