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
add_filter( 'themekit/shortcode/openhours_class', 'konstruct_custom_shortcodes_class', 10, 3 );

/**
 * Register shortcode into Visual Composer
 */
add_action( 'vc_before_init', 'konstruct_openhours_shortcode_params' );

function konstruct_openhours_shortcode_params() {
	vc_map( array(
		'base'        => 'openhours',
		'name'        => __( 'Konstruct: Open Hours', 'konstruct' ),
		'icon'        => 'konstruct-shortcode',
		'category'    => __( 'Konstruct', 'konstruct' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Title', 'konstruct' ),
				'param_name'  => 'title'
			),

			array(
				'type'        => 'textarea',
				'heading'     => __( 'Description', 'konstruct' ),
				'param_name'  => 'description'
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Icon', 'konstruct' ),
				'param_name'  => 'icon',
				'description' => sprintf( __( 'FontAwesome Icon name. <a href="%s" target="blank">Full list of icons</a>', 'konstruct' ), 'http://fontawesome.io/icons/' )
			),

			array(
				'type'       => 'attach_image',
				'heading'    => __( 'Image', 'konstruct' ),
				'param_name' => 'image',
				'description' => __( 'Select image to replace the icon', 'konstruct' )
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Monday', 'konstruct' ),
				'param_name'  => 'monday'
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Tuesday', 'konstruct' ),
				'param_name'  => 'tuesday'
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Wednesday', 'konstruct' ),
				'param_name'  => 'wednesday'
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Thursday', 'konstruct' ),
				'param_name'  => 'thursday'
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Friday', 'konstruct' ),
				'param_name'  => 'friday'
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Saturday', 'konstruct' ),
				'param_name'  => 'saturday'
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Sunday', 'konstruct' ),
				'param_name'  => 'sunday'
			),

			array(
				'type' => 'css_editor',
				'param_name' => 'css',
				'group' => __( 'Design Options', 'konstruct' )
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'Extra Class', 'konstruct' ),
				'param_name' => 'class'
			)
		)
	) );
}
