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
    class WPBakeryShortCode_Testimonial_Slider extends WPBakeryShortCodesContainer {
    }
}

/**
 * Register filter for append custom class name
 * that generated from visual-composer
 */
add_filter( 'themekit/shortcode/testimonial_class', 'konstruct_custom_shortcodes_class', 10, 2 );
add_filter( 'themekit/shortcode/testimonial_slider_class', 'konstruct_custom_shortcodes_class', 10, 2 );
add_action( 'vc_before_init', 'konstruct_testimonial_shortcode_params' );

function konstruct_testimonial_shortcode_params() {
	/**
	 * Map the testimonial slider shortcode
	 */
	vc_map( array(
		'name'                    => __( 'Konstruct: Testimonial Slider', 'konstruct' ),
		'base'                    => 'testimonial_slider',
		'as_parent'               => array( 'only' => 'testimonial' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'content_element'         => true,
		'show_settings_on_create' => false,
		'category'                => __( 'Konstruct', 'konstruct' ),
		'params'                  => array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Slider mode', 'konstruct' ),
				'param_name' => 'mode',
				'value' => array(
					__( 'Horizontal', 'konstruct' ) => 'horizontal',
					__( 'Vertical', 'konstruct' ) => 'vertical'
				),
				'description' => __( 'Slides will be positioned horizontally (for horizontal swipes) or vertically (for vertical swipes)', 'konstruct' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Slider speed', 'konstruct' ),
				'param_name' => 'speed',
				'value' => '5000',
				'description' => __( 'Duration of animation between slides (in ms)', 'konstruct' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Slides per view', 'konstruct' ),
				'param_name' => 'slides_per_view',
				'value' => '1',
				'description' => __( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode. Supports also "auto" value, in this case it will fit slides depending on container\'s width. "auto" mode isn\'t compatible with loop mode.', 'konstruct' )
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Slider autoplay', 'konstruct' ),
				'param_name' => 'autoplay',
				'description' => __( 'Enables autoplay mode.', 'konstruct' ),
				'value' => array( __( 'Yes, please', 'konstruct' ) => 'yes' )
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Hide pagination control', 'konstruct' ),
				'param_name' => 'hide_control',
				'description' => __( 'If YES pagination control will be removed.', 'konstruct' ),
				'value' => array( __( 'Yes, please', 'konstruct' ) => 'yes' )
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Hide prev/next buttons', 'konstruct' ),
				'param_name' => 'hide_buttons',
				'description' => __( 'If "YES" prev/next control will be removed.', 'konstruct' ),
				'value' => array( __( 'Yes, please', 'konstruct' ) => 'yes' )
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Slider loop', 'konstruct' ),
				'param_name' => 'loop',
				'description' => __( 'Enables loop mode.', 'konstruct' ),
				'value' => array( __( 'Yes, please', 'konstruct' ) => 'yes' )
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
	 * Map the single testimonial item
	 */
	vc_map( array(
		'base'        => 'testimonial',
		'name'        => __( 'Konstruct: Testimonial', 'konstruct' ),
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
				'type'             => 'textfield',
				'heading'          => __( 'Company', 'konstruct' ),
				'param_name'       => 'company',
			),

			array(
				'type'             => 'textfield',
				'heading'          => __( 'Link', 'konstruct' ),
				'param_name'       => 'link'
			),

			array(
				'type'       => 'textarea',
				'heading'    => __( 'Content', 'konstruct' ),
				'param_name' => 'content'
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
