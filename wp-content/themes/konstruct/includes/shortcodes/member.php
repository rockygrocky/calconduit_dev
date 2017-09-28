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
 * Register filter for append custom class name
 * that generated from visual-composer
 */
add_filter( 'themekit/shortcode/member_class', 'konstruct_custom_shortcodes_class', 10, 3 );
add_action( 'vc_before_init', 'konstruct_member_shortcode_params' );

function konstruct_member_shortcode_params() {
	/**
	 * Map the single member item
	 */
	vc_map( array(
		'base'        => 'member',
		'name'        => __( 'Konstruct: Team Member', 'konstruct' ),
		'icon'        => 'konstruct-shortcode',
		'category'    => __( 'Konstruct', 'konstruct' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Name', 'konstruct' ),
				'param_name'  => 'name'
			),

			array(
				'type'       => 'attach_image',
				'heading'    => __( 'Image', 'konstruct' ),
				'param_name' => 'image'
			),

			array(
				'type'             => 'textfield',
				'heading'          => __( 'Subtitle', 'konstruct' ),
				'param_name'       => 'subtitle',
			),

			array(
				'type'       => 'textarea',
				'heading'    => __( 'Content', 'konstruct' ),
				'param_name' => 'content'
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'Facebook URL', 'konstruct' ),
				'param_name' => 'facebook'
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'Twitter URL', 'konstruct' ),
				'param_name' => 'twitter'
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'LinkedIn URL', 'konstruct' ),
				'param_name' => 'linkedin'
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'Google+ URL', 'konstruct' ),
				'param_name' => 'google'
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'Extra Class', 'konstruct' ),
				'param_name' => 'class'
			),

			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show Social Icons On Hover', 'konstruct' ),
				'param_name' => 'hover_show_icons',
				'value'      => array(
					__( 'Yes, please', 'konstruct' ) => 'yes'
				)
			),

			array(
				'type' => 'css_editor',
				'param_name' => 'css',
				'group' => __( 'Design Options', 'konstruct' )
			)
		)
	) );
}



add_filter( 'themekit/shortcode/member_atts', 'konstruct_member_shortcode_atts' );

function konstruct_member_shortcode_atts( $atts ) {
	$atts['hover_show_icons'] = '';

	return $atts;
}



add_filter( 'themekit/shortcode/member_class', 'konstruct_member_shortcode_class', 10, 3 );

function konstruct_member_shortcode_class( $classes, $atts, $tag = '' ) {
	if ( $atts['hover_show_icons'] == 'yes' )
		$classes[] = 'hover';

	return $classes;
}
