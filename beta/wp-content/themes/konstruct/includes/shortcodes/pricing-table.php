<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

// Ignore register this shortcode when required
// plugin are not installed
if ( ! defined( 'PTP_PLUGIN_VERSION' ) ) return;

/**
 * Register filter for append custom class name
 * that generated from visual-composer
 */
add_filter( 'themekit/shortcode/pricing_table_class', 'konstruct_custom_shortcodes_class', 10, 3 );

/**
 * Register shortcode into Visual Composer
 */
add_action( 'vc_before_init', 'konstruct_pricing_table_shortcode_params' );

function konstruct_pricing_table_shortcode_params() {
	$tables = array();
	$query  = new WP_Query( array( 'post_type' => 'easy-pricing-table', 'nopaging' => true ) );

	while ( $query->have_posts() ) {
		$query->next_post();
		$tables[get_the_title( $query->post->ID )] = $query->post->ID;
	}

	vc_map( array(
		'base'        => 'pricing-table',
		'name'        => __( 'Konstruct: Pricing Table', 'konstruct' ),
		'icon'        => 'konstruct-shortcode',
		'category'    => __( 'Konstruct', 'konstruct' ),
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Table ID', 'konstruct' ),
				'param_name' => 'id',
				'value'      => $tables
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'konstruct' ),
				'param_name'  => 'class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'konstruct' )
			),

			array(
				'type'       => 'css_editor',
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'konstruct' )
			)
		)
	) );
}
