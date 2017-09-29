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
add_filter( 'themekit/shortcode/iconbox_class', 'konstruct_custom_shortcodes_class', 10, 3 );

/**
 * Register shortcode into Visual Composer
 */
add_action( 'vc_before_init', 'konstruct_iconbox_shortcode_params' );

/**
 * Register parameters for iconbox shortcode
 * 
 * @return  void
 */
function konstruct_iconbox_shortcode_params() {
	vc_map( array(
		'base'        => 'iconbox',
		'name'        => __( 'Konstruct: Icon Box', 'konstruct' ),
		'icon'        => 'konstruct-shortcode',
		'category'    => __( 'Konstruct', 'konstruct' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Icon', 'konstruct' ),
				'param_name'  => 'icon',
				'description' => sprintf( __( 'FontAwesome Icon name. <a href="%s" target="blank">Full list of icons</a>', 'konstruct' ), 'http://fontawesome.io/icons/' )
			),

			// Title
			array(
				'type'             => 'textfield',
				'heading'          => __( 'Title', 'konstruct' ),
				'param_name'       => 'title',
				'edit_field_class' => 'vc_col-md-6 vc_column'
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Title Element Tag', 'konstruct' ),
				'param_name' => 'tag',
				'value'      => array(
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6'
				)
			),

			array(
				'type'       => 'textarea',
				'heading'    => __( 'Content', 'konstruct' ),
				'param_name' => 'content'
			),

			array(
				'type'       => 'attach_image',
				'heading'    => __( 'Image', 'konstruct' ),
				'param_name' => 'image',
				'description' => __( 'Select image to replace the icon', 'konstruct' )
			),

			array(
				'type' => 'textfield',
				'heading' => __( 'Read More Link', 'konstruct' ),
				'param_name' => 'link',
				'description' => __( 'Enter custom url for read more button', 'konstruct' )
			),

			array(
				'type' => 'textfield',
				'heading' => __( 'Read More Text', 'konstruct' ),
				'param_name' => 'text',
				'description' => __( 'Enter custom text for read more button', 'konstruct' ),
				'value' => __( 'more...', 'konstruct' )
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Icon Position', 'konstruct' ),
				'param_name' => 'icon_position',
				'value' => array(
					__( 'Top', 'konstruct' ) => 'top',
					__( 'Left', 'konstruct' ) => 'left',
					__( 'Left Inline', 'konstruct' ) => 'inline-left',
					__( 'Right', 'konstruct' ) => 'right'
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Icon Style', 'konstruct' ),
				'param_name' => 'icon_style',
				'value' => array(
					__( 'Default', 'konstruct' )         => '',
					__( 'Circle', 'konstruct' )          => 'circle',
					__( 'Circle Outline', 'konstruct' )  => 'circle-outlined',
					__( 'Rounded', 'konstruct' )         => 'rounded',
					__( 'Rounded Outline', 'konstruct' ) => 'outlined',
					__( 'Square', 'konstruct' )          => 'square',
					__( 'Square Outline', 'konstruct' )  => 'square-outlined'
				)
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'Extra Class', 'konstruct' ),
				'param_name' => 'class'
			),

			array(
				'type' => 'css_editor',
				'param_name' => 'css',
				'group' => __( 'Design Options', 'konstruct' )
			)
		)
	) );
}



add_filter( 'themekit/shortcode/iconbox_atts', 'konstruct_iconbox_shortcode_atts' );

function konstruct_iconbox_shortcode_atts( $atts ) {
	$atts['icon_position'] = '';
	$atts['icon_style']    = '';

	return $atts;
}



add_filter( 'themekit/shortcode/iconbox_class', 'konstruct_iconbox_shortcode_class', 10, 3 );

function konstruct_iconbox_shortcode_class( $classes, $atts, $tag = '' ) {
	$classes[] = $atts['icon_position'];
	$classes[] = $atts['icon_style'];

	return $classes;
}
