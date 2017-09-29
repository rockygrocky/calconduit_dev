<?php
/**
 * WARNING: This file is part of the UI-Pack plugin. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Visual Composer integration
 */
if ( function_exists( 'vc_map' ) ) {
	add_action( 'vc_before_init', 'themekit_shortcode_elements_slider_map' );

	function themekit_shortcode_elements_slider_map() {
		vc_map( array(
			'name'                    => __( 'LineThemes: Elements Carousel', 'themekit' ),
			'base'                    => 'elements_carousel',
			'icon'                    => 'themekit-shortcode',
			'show_settings_on_create' => false,
			'is_container'            => true,
			'category'                => 'LineThemes',
			'js_view'                 => 'VcColumnView',
			'html_template'           => __DIR__ . '/templates/elements-carousel.php',
			'params'                  => array(
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Show Items', 'themekit' ),
					'description' => __( 'The maximum amount of items displayed at a time', 'themekit' ),
					'param_name'  => 'items',
					'value'       => array_combine( range( 1, 6 ), range( 1, 6 ) ),
					'std'         => 4
				),

				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Autoplay?', 'themekit' ),
					'param_name' => 'autoplay',
					'std'        => 'yes',
					'value'      => array(
						__( 'Yes', 'themekit' ) => 'yes',
						__( 'No', 'themekit' ) => 'no'
					)
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Stop On Hover?', 'themekit' ),
					'description' => __( 'Rewind speed in milliseconds', 'themekit' ),
					'param_name'  => 'hover_stop',
					'std'         => 'yes',
					'value'       => array(
						__( 'Yes', 'themekit' ) => 'yes',
						__( 'No', 'themekit' ) => 'no'
					)
				),

				array(
					'type'        => 'checkbox',
					'heading'     => __( 'Slider Controls', 'themekit' ),
					'param_name'  => 'controls',
					'std'         => 'navigation,rewind-navigation,pagination,pagination-numbers',
					'value'       => array(
						__( 'Navigation', 'themekit' )         => 'navigation',
						__( 'Rewind Navigation', 'themekit' )  => 'rewind-navigation',
						__( 'Pagination', 'themekit' )         => 'pagination',
						__( 'Pagination Numbers', 'themekit' ) => 'pagination-numbers'
					)
				),

				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Scroll Per Page?', 'themekit' ),
					'param_name' => 'scroll_page',
					'std'        => 'yes',
					'value'      => array(
						__( 'Yes', 'themekit' ) => 'yes',
						__( 'No', 'themekit' ) => 'no'
					)
				),

				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Allow Mouse Drag?', 'themekit' ),
					'param_name' => 'mouse_drag',
					'std'        => 'yes',
					'value'      => array(
						__( 'Yes', 'themekit' ) => 'yes',
						__( 'No', 'themekit' ) => 'no'
					)
				),

				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Allow Touch Drag?', 'themekit' ),
					'param_name' => 'touch_drag',
					'std'        => 'yes',
					'value'      => array(
						__( 'Yes', 'themekit' ) => 'yes',
						__( 'No', 'themekit' ) => 'no'
					)
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Extra Class', 'themekit' ),
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'themekit' ),
					'param_name'  => 'class'
				),

				// Speed options
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Autoplay Speed', 'themekit' ),
					'description' => __( 'Autoplay speed in milliseconds', 'themekit' ),
					'param_name'  => 'autoplay_speed',
					'group'       => __( 'Speed Options', 'themekit' ),
					'value'       => 5000
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Slide Speed', 'themekit' ),
					'description' => __( 'Slide speed in milliseconds', 'themekit' ),
					'param_name'  => 'slide_speed',
					'group' => __( 'Speed Options', 'themekit' ),
					'value'       => 200
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Pagination Speed', 'themekit' ),
					'description' => __( 'Pagination speed in milliseconds', 'themekit' ),
					'param_name'  => 'pagination_speed',
					'group' => __( 'Speed Options', 'themekit' ),
					'value'       => 200
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Rewind Speed', 'themekit' ),
					'description' => __( 'Rewind speed in milliseconds', 'themekit' ),
					'param_name'  => 'rewind_speed',
					'group' => __( 'Speed Options', 'themekit' ),
					'value'       => 200
				),

				// Responsive options
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Enable Responsive?', 'themekit' ),
					'param_name' => 'responsive',
					'group'      => __( 'Responsive Options', 'themekit' ),
					'std'        => 'yes',
					'value'      => array(
						__( 'Yes', 'themekit' ) => 'yes',
						__( 'No', 'themekit' ) => 'no'
					)
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Items On Tablet', 'themekit' ),
					'description' => __( 'The maximum amount of items displayed at a time on tablet device', 'themekit' ),
					'param_name'  => 'tablet_items',
					'group'       => __( 'Responsive Options', 'themekit' ),
					'value'       => array_combine( range( 1, 6 ), range( 1, 6 ) ),
					'std'         => 2
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Items On Mobile', 'themekit' ),
					'description' => __( 'The maximum amount of items displayed at a time on mobile device', 'themekit' ),
					'param_name'  => 'mobile_items',
					'group'       => __( 'Responsive Options', 'themekit' ),
					'value'       => array_combine( range( 1, 6 ), range( 1, 6 ) ),
					'std'         => 1
				),

				array(
					'type' => 'css_editor',
					'param_name' => 'css',
					'group' => __( 'Design Options', 'themekit' )
				)
			)
		) );
	}
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Elements_Carousel extends WPBakeryShortCodesContainer {
    }
}
