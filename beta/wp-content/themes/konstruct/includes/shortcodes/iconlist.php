<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	/**
	 * Extended class to integrate testimonial slider with
	 * visual composer
	 */
    class WPBakeryShortCode_IconList extends WPBakeryShortCodesContainer {
    }
}

/**
 * Register filter for append custom class name
 * that generated from visual-composer
 */
add_filter( 'themekit/shortcode/iconlist_class', 'konstruct_custom_shortcodes_class', 10, 3 );
add_filter( 'themekit/shortcode/iconlist_item_class', 'konstruct_custom_shortcodes_class', 10, 3 );

/**
 * Register shortcode into Visual Composer
 */
add_action( 'vc_before_init', 'konstruct_iconlist_shortcode_params' );

function konstruct_iconlist_shortcode_params() {
	/**
	 * Map the iconlist slider shortcode
	 */
	vc_map( array(
		'name'                    => __( 'Konstruct: Icon List', 'konstruct' ),
		'base'                    => 'iconlist',
		'as_parent'               => array( 'only' => 'iconlist_item' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'content_element'         => true,
		'show_settings_on_create' => false,
		'category'    => __( 'Konstruct', 'konstruct' ),
		'params'                  => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'List Icon', 'konstruct' ),
				'param_name' => 'icon',
				'description' => __( 'Default icon for all items in the list', 'konstruct' )
			),
			array(
				'type' => 'attach_image',
				'heading' => __( 'List Image', 'konstruct' ),
				'param_name' => 'image',
				'description' => __( 'Default image for all items in the list', 'konstruct' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'konstruct' ),
				'param_name' => 'class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'konstruct' )
			),

			array(
				'type' => 'css_editor',
				'param_name' => 'css',
				'group' => __( 'Design Options', 'konstruct' )
			)
		),
		'js_view' => 'VcColumnView'
	) );

	/**
	 * Map the single iconlist_item item
	 */
	vc_map( array(
		'base'        => 'iconlist_item',
		'name'        => __( 'Konstruct: Icon List Item', 'konstruct' ),
		'icon'        => 'konstruct-shortcode',
		'category'    => __( 'Konstruct', 'konstruct' ),
		'as_child'    => array( 'only' => 'iconlist' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'List Icon', 'konstruct' ),
				'param_name' => 'icon',
				'description' => __( 'Default icon for all items in the list', 'konstruct' )
			),
			array(
				'type' => 'attach_image',
				'heading' => __( 'List Image', 'konstruct' ),
				'param_name' => 'image',
				'description' => __( 'Default image for all items in the list', 'konstruct' )
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Content', 'konstruct' ),
				'param_name' => 'content'
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Enable Icon Circle Style', 'konstruct' ),
				'param_name' => 'circle_style',
				'value' => array(
					__( 'Yes, please', 'konstruct' ) => 'yes'
				)
			),
			
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'konstruct' ),
				'param_name' => 'class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'konstruct' )
			),

			array(
				'type' => 'css_editor',
				'param_name' => 'css',
				'group' => __( 'Design Options', 'konstruct' )
			)
		)
	) );
}



add_filter( 'themekit/shortcode/iconlist_item_atts', 'konstruct_iconlist_shortcode_atts' );

function konstruct_iconlist_shortcode_atts( $atts ) {
	$atts['circle_style'] = '';

	return $atts;
}



add_filter( 'themekit/shortcode/iconlist_item_class', 'konstruct_iconlist_shortcode_class', 10, 2 );

function konstruct_iconlist_shortcode_class( $classes, $atts ) {
	if ( $atts['circle_style'] == 'yes' )
		$classes[] = 'circle';

	return $classes;
}
