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
add_filter( 'themekit/shortcode/counter_class', 'konstruct_custom_shortcodes_class', 10, 3 );

/**
 * Register shortcode into Visual Composer
 */
add_action( 'vc_before_init', 'konstruct_counter_shortcode_params' );

/**
 * Register parameters for counter shortcode
 * 
 * @return  void
 */
function konstruct_counter_shortcode_params() {
	vc_map( array(
		'base'        => 'counter',
		'name'        => __( 'Konstruct: Counter', 'konstruct' ),
		'icon'        => 'konstruct-shortcode',
		'category'    => __( 'Konstruct', 'konstruct' ),
		'params'      => array(
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
				'type'             => 'textfield',
				'heading'          => __( 'Title', 'konstruct' ),
				'param_name'       => 'title'
			),

			array(
				'type'             => 'textfield',
				'heading'          => __( 'Value', 'konstruct' ),
				'param_name'       => 'value',
				'value'            => 0
			),

			array(
				'type'             => 'textfield',
				'heading'          => __( 'Prefix', 'konstruct' ),
				'param_name'       => 'prefix'
			),

			array(
				'type'             => 'textfield',
				'heading'          => __( 'Suffix', 'konstruct' ),
				'param_name'       => 'suffix'
			),

			array(
				'type'             => 'textfield',
				'heading'          => __( 'Duration', 'konstruct' ),
				'param_name'       => 'duration',
				'value'            => 1000
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
