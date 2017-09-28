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
add_filter( 'themekit/shortcode/imagebox_class', 'konstruct_custom_shortcodes_class', 10, 3 );

/**
 * Register shortcode into Visual Composer
 */
add_action( 'vc_before_init', 'konstruct_imagebox_shortcode_params' );

function konstruct_imagebox_shortcode_params() {
	vc_map( array(
		'base'        => 'imagebox',
		'name'        => __( 'Konstruct: Image Box', 'konstruct' ),
		'icon'        => 'konstruct-shortcode',
		'category'    => __( 'Konstruct', 'konstruct' ),
		'params'      => array(
			// Title
			array(
				'type'             => 'textfield',
				'heading'          => __( 'Title', 'konstruct' ),
				'param_name'       => 'title'
			),

			array(
				'type'             => 'textfield',
				'heading'          => __( 'Subtitle', 'konstruct' ),
				'param_name'       => 'subtitle'
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Title Tag', 'konstruct' ),
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
				'type'       => 'attach_image',
				'heading'    => __( 'Image', 'konstruct' ),
				'param_name' => 'image'
			),

			array(
				'type'       => 'textarea',
				'heading'    => __( 'Description', 'konstruct' ),
				'param_name' => 'content'
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'Link', 'konstruct' ),
				'param_name' => 'link'
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Link Target', 'konstruct' ),
				'param_name' => 'target',
				'value'      => array(
					'_self'   => __( '_self', 'konstruct' ),
					'_blank'  => __( '_blank', 'konstruct' ),
					'_parent' => __( '_parent', 'konstruct' ),
					'_top'    => __( '_top', 'konstruct' )
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
