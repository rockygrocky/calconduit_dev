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
add_filter( 'themekit/shortcode/countdown_class', 'konstruct_custom_shortcodes_class', 10, 3 );

/**
 * Register shortcode into Visual Composer
 */
add_action( 'vc_before_init', 'konstruct_countdown_shortcode_params' );

/**
 * Register parameters for countdown shortcode
 *  
 * @return  void
 */
function konstruct_countdown_shortcode_params() {
	vc_map( array(
		'base'        => 'countdown',
		'name'        => __( 'Konstruct: Countdown', 'konstruct' ),
		'icon'        => 'konstruct-shortcode',
		'category'    => __( 'Konstruct', 'konstruct' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'End Time', 'konstruct' ),
				'param_name'  => 'time',
				'description' => __( 'Enter time format following: YYYY/MM/DD hh:mm:ss', 'konstruct' )
			),

			array(
				'type' => 'checkbox',
				'heading' => __( 'Hide Years', 'konstruct' ),
				'param_name' => 'hide_years',
				'value' => array( __( 'Yes, please', 'konstruct' ) => 'yes' )
			),

			array(
				'type' => 'checkbox',
				'heading' => __( 'Hide Months', 'konstruct' ),
				'param_name' => 'hide_months',
				'value' => array( __( 'Yes, please', 'konstruct' ) => 'yes' )
			),

			array(
				'type' => 'checkbox',
				'heading' => __( 'Hide Weeks', 'konstruct' ),
				'param_name' => 'hide_weeks',
				'value' => array( __( 'Yes, please', 'konstruct' ) => 'yes' )
			),

			array(
				'type' => 'checkbox',
				'heading' => __( 'Hide Days', 'konstruct' ),
				'param_name' => 'hide_days',
				'value' => array( __( 'Yes, please', 'konstruct' ) => 'yes' )
			),

			array(
				'type' => 'checkbox',
				'heading' => __( 'Hide Hours', 'konstruct' ),
				'param_name' => 'hide_hours',
				'value' => array( __( 'Yes, please', 'konstruct' ) => 'yes' )
			),

			array(
				'type' => 'checkbox',
				'heading' => __( 'Hide Minutes', 'konstruct' ),
				'param_name' => 'hide_minutes',
				'value' => array( __( 'Yes, please', 'konstruct' ) => 'yes' )
			),

			array(
				'type' => 'checkbox',
				'heading' => __( 'Hide Seconds', 'konstruct' ),
				'param_name' => 'hide_seconds',
				'value' => array( __( 'Yes, please', 'konstruct' ) => 'yes' )
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
