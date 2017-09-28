<?php
/**
 * WARNING: This file is part of the UI-Pack plugin. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;


add_shortcode( 'maps', 'themekit_shortcode_maps' );

function themekit_shortcode_maps( $atts, $content ) {
	$atts = shortcode_atts( array(
		'address'     => '44 Quan Nhân, Trung Hoà, Hanoi, Vietnam',
		'style'       => 'default',
		'zoomlevel'   => 12,
		'zoomable'    => 'yes',
		'type'        => 'roadmap',
		'show_marker' => 'yes',
		'draggable'   => 'yes',
		'height'      => 300
	), $atts );

	$atts['zoomable'] = $atts['zoomable'] == 'yes';
	$atts['show_marker'] = $atts['show_marker'] == 'yes';
	$atts['draggable'] = $atts['draggable'] == 'yes';

	wp_enqueue_script( 'themekit-maps' );

	return sprintf( '<div id="%s" class="google-maps" data-config="%s" data-locations="%s" style="height: %dpx"></div>',
				uniqid( 'google-maps-' ),
				esc_attr( json_encode( $atts ) ),
				esc_attr( json_encode( explode( "\n", strip_tags( $content ) ) ) ),
				(int) $atts['height']
			);
}


if ( function_exists( 'vc_map' ) ) {
	add_action( 'vc_before_init', 'themekit_shortcode_maps_vc' );

	function themekit_shortcode_maps_vc() {
		vc_map( array(
			'base'        => 'maps',
			'name'        => __( 'LineThemes: Google Maps', 'themekit' ),
			'icon'        => 'themekit-shortcode',
			'category'    => __( 'LineThemes', 'themekit' ),
			'params'      => array(
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Maps Type', 'themekit' ),
					'description' => __( 'Select the Maps type', 'themekit' ),
					'param_name'  => 'type',
					'value'       => array(
						'ROADMAP'   => 'roadmap',
						'SATELLITE' => 'satellite',
						'HYBRID'    => 'hybrid',
						'TERRAIN'   => 'terrain'
					)
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Maps Style', 'themekit' ),
					'description' => __( 'Select style for the Maps', 'themekit' ),
					'param_name'  => 'style',
					'value'       => array(
						'Default'          => 'default',
						'Subtle Grayscale' => 'subtle-grayscale',
						'Pale Dawn'        => 'pale-dawn',
						'Blue Water'       => 'blue-warter',
						'Light Monochrome' => 'light-monochrome'
					)
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Address', 'themekit' ),
					'param_name'  => 'address',
					'description' => sprintf( __( 'Enter you address that will show at the center of the Maps', 'themekit' ), 'http://fontawesome.io/icons/' )
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Zoom Level', 'themekit' ),
					'param_name'  => 'zoomlevel',
					'description' => __( 'Select the default zoom level for the Maps', 'themekit' ),
					'value'       => array_combine( range( 1, 24 ), range( 1, 24 ) )
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Enable Zoom On Mouse Scroll', 'themekit' ),
					'description' => __( 'If select "yes", the maps will zoom in/out when user scroll the mouse', 'themekit' ),
					'param_name'  => 'zoomable',
					'value'       => array(
						__( 'No' )  => 'no',
						__( 'Yes' ) => 'yes'
					)
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Enable Draggable', 'themekit' ),
					'param_name'  => 'draggable',
					'value'       => array(
						__( 'No' )  => 'no',
						__( 'Yes' ) => 'yes'
					)
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Show The Marker', 'themekit' ),
					'param_name'  => 'show_marker',
					'value'       => array(
						__( 'No' )  => 'no',
						__( 'Yes' ) => 'yes'
					)
				),

				array(
					'type'       => 'textfield',
					'heading'    => __( 'Height', 'themekit' ),
					'param_name' => 'height',
					'value'      => 300
				),

				array(
					'type'        => 'textarea',
					'heading'     => __( 'Locations', 'themekit' ),
					'description' => __( 'Enter you locations(one per line) that will show on the Maps', 'themekit' ),
					'param_name'  => 'content'
				)
			)
		) );
	}
}
