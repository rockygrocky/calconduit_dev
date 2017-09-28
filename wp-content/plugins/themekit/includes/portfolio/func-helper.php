<?php
/**
 * WARNING: This file is part of the Padora theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

/**
 * Conditional function to determine active page is for simple
 * portfolio plugin
 * 
 * @return  boolean
 */
function is_themekit_portfolio() {
	return is_singular( 'portfolio' ) || is_post_type_archive( 'portfolio' ) ||
		   is_tax( 'portfolio-tag' ) || is_tax( 'portfolio-category' );
}



/**
 * Return TRUE when current page template are registered
 * to simple portfolio
 * 
 * @return  boolean
 */
function is_themekit_portfolio_page_template( $template = null ) {
	global $_themekit_page_templates;

	if ( ! is_array( $_themekit_page_templates ) )
		return false;

	if ( $template == null )
		$template = get_page_template_slug( get_queried_object_id() );

	return in_array( $template, $_themekit_page_templates );
}



/**
 * Register page template that will display content
 * from this plugin
 * 
 * @param   string  $template  Template file name
 * @return  void
 */
function themekit_portfolio_add_page_template( $template ) {
	global $_themekit_page_templates;

	if ( ! is_array( $_themekit_page_templates ) )
		$_themekit_page_templates = array();

	if ( ! in_array( $template, $_themekit_page_templates ) )
		array_push( $_themekit_page_templates, $template );
}



/**
 * Return currently post type
 * 
 * @return  strings
 */
function themekit_current_post_type() {
	global $post, $typenow, $current_screen;
	
	//we have a post so we can just get the post type from that
	if ( true == isset( $post ) && true == isset( $post->post_type ) )
		return $post->post_type;

	//check the global $typenow - set in admin.php
	elseif ( true == isset( $typenow ) )
		return $typenow;

	//check the global $current_screen object - set in sceen.php
	elseif ( true == isset( $current_screen ) && true == isset( $current_screen->post_type ) )
		return $current_screen->post_type;

	//lastly check the post_type querystring
	elseif ( true == isset( $_REQUEST['post_type'] ) )
		return sanitize_key( $_REQUEST['post_type'] );
	
	//we do not know the post type!
	return null;
}



/**
 * Locate template for this plugin
 * 
 * @param   array  $templates  Templates to be located
 * @param   array  $args       Arguments
 * 
 * @return  string
 */
function themekit_locate_template( $templates, $args = array() ) {
	$defaults = array(
		'once'     => true,
		'load'     => false,
		'fallback' => false
	);

	$params = array_merge( $defaults, $args );
	$template = locate_template( $templates );

	if ( $template == '' && $params['fallback'] )
		$template = $params['fallback'];

	if ( ! $params['load'] )
		return $template;

	if ( is_file( $template ) )
		load_template( $template, $params['once'] );
}



function themekit_portfolio_option( $name, $default = null, $post_id = null ) {
	global $_themekit_post_options;

	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	if ( ! is_array( $_themekit_post_options ) )
		$_themekit_post_options = array();

	if ( ! isset( $_themekit_post_options[$post_id] ) )
		$_themekit_post_options[$post_id] = apply_filters( 'themekit/portfolio/options', get_post_meta( $post_id, '_portfolio_options', true ), $post_id );

	return isset( $_themekit_post_options[$post_id][$name] )
		? $_themekit_post_options[$post_id][$name]
		: $default;
}



function themekit_prepare_post_object( $post, $addition = array() ) {
	$post->options = get_post_meta( $post->ID, '_portfolio_options', true );
	$post->addition = $addition;
	$post->attachments = array();

	if ( isset( $post->options['media'] ) && $media_files = json_decode( $post->options['media'], true ) ) {
		$post->attachments = $media_files;
	}
}
