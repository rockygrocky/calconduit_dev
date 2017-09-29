<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */
defined( 'ABSPATH' ) or exit;

// Ignore this file if option plus is loaded before
if ( function_exists( 'op_option' ) ) return;



if ( ! function_exists( 'konstruct_options_plus_uri' ) ) {
	add_filter( 'op/directory_uri', 'konstruct_options_plus_uri' );

	/**
	 * Return the URI that pointed to options-plus library
	 * 
	 * @return  string
	 */
	function konstruct_options_plus_uri( $uri ) {
		return get_template_directory_uri() . '/libraries/options-plus';
	}
}



if ( ! function_exists( 'konstruct_options_plus_path' ) ) {
	add_filter( 'op/directory_path', 'konstruct_options_plus_path' );

	/**
	 * Return the path that contains options-plus library
	 * 
	 * @return  string
	 */
	function konstruct_options_plus_path( $path ) {
		return get_template_directory() . '/libraries/options-plus';
	}
}



require_once trailingslashit( get_template_directory() ) . 'libraries/options-plus/loader.php';
