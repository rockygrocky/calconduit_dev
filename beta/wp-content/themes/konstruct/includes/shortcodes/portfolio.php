<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

add_action( 'vc_before_init', 'konstruct_portfolio_shortcode_params' );

function konstruct_portfolio_shortcode_params() {
	vc_map( array(
		'base'        => 'portfolio',
		'icon'        => 'konstruct-shortcode',
		'name'        => __( 'Konstruct: Portfolio', 'konstruct' ),
		'category'    => __( 'Konstruct', 'konstruct' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Category', 'konstruct' ),
				'param_name'  => 'category'
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Style', 'konstruct' ),
				'param_name' => 'style',
				'value' => array(
					__( 'Grid', 'konstruct' )           => 'grid',
					__( 'Grid Masonry', 'konstruct' )   => 'masonry',
					__( 'Grid No Margin', 'konstruct' ) => 'no-margin'
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Grid Columns', 'konstruct' ),
				'param_name' => 'columns',
				'value'      => array(
					__( '2 Columns', 'konstruct' ) => 2,
					__( '3 Columns', 'konstruct' ) => 3,
					__( '4 Columns', 'konstruct' ) => 4,
					__( '5 Columns', 'konstruct' ) => 5
				)
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number Of Items', 'konstruct' ),
				'param_name' => 'limit',
				'value'      => 8
			),

			array(
				'type' => 'checkbox',
				'heading' => __( 'Enable Carousel Mode', 'konstruct' ),
				'param_name' => 'enable_carousel',
				'value' => array( __( 'Yes, please', 'konstruct' ) => 'yes' )
			),

			array(
				'type' => 'dropdown',
				'heading' => __( 'Show Filter', 'konstruct' ),
				'param_name' => 'show_filter',
				'description' => __( 'If "YES" portfolio filter will be shown.', 'konstruct' ),
				'value' => array(
					__( 'Yes, please', 'konstruct' ) => 'yes',
					__( 'No', 'konstruct' ) => 'no'
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
