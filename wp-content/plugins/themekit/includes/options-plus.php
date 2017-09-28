<?php
/**
 * WARNING: This file is part of the ThemeKit plugin. DO NOT edit
 * this file under any circumstances.
 */
defined( 'ABSPATH' ) or exit;

// Ignore this file if option plus is loaded before
if ( function_exists( 'op_option' ) ) return;



if ( ! function_exists( 'themekit_options_plus_uri' ) ) {
	add_filter( 'op/directory_uri', 'themekit_options_plus_uri' );

	/**
	 * Return the URI that pointed to options-plus library
	 * 
	 * @return  string
	 */
	function themekit_options_plus_uri( $uri ) {
		return THEMEKIT_URL . 'includes/options-plus';
	}
}



if ( ! function_exists( 'themekit_options_plus_path' ) ) {
	add_filter( 'op/directory_path', 'themekit_options_plus_path' );

	/**
	 * Return the path that contains options-plus library
	 * 
	 * @return  string
	 */
	function themekit_options_plus_path( $path ) {
		return THEMEKIT_PATH . 'includes/options-plus';
	}
}



require_once dirname( __FILE__ ) . '/options-plus/loader.php';
