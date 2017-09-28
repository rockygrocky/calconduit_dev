<?php
/**
 * WARNING: This file is part of the UI-Pack plugin. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

add_shortcode( 'openhours', 'themekit_shortcode_openhours' );

/**
 * Counter shortcode handle
 * 
 * @param   array  $atts  Shortcode attributes
 * @return  void
 */
function themekit_shortcode_openhours( $atts, $content = null ) {
	static $enqueued;

	$atts = shortcode_atts( apply_filters( 'themekit/shortcode/openhours_atts', array(
		'class'       => '',
		'css'         => '',
		
		'title'       => '',
		'description' => '',
		'icon'        => '',
		'image'       => '',

		'monday'      => '',
		'tuesday'     => '',
		'wednesday'   => '',
		'thursday'    => '',
		'friday'      => '',
		'saturday'    => '',
		'sunday'      => ''
	) ), $atts );

	$class = apply_filters( 'themekit/shortcode/openhours_class', array( 'openhours', $atts['class'] ), $atts );
	$markup = sprintf( '<div class="%s">', esc_attr( implode( ' ', $class ) ) );

	if ( ! empty( $atts['title'] ) )
		$markup.= sprintf( '<h3 class="title">%s</h3>', esc_html( $atts['title'] ) );

	if ( ! empty( $atts['description'] ) )
		$markup.= sprintf( '<div class="description">%s</div>', wp_kses_post( $atts['description'] ) );

	$markup.= '<ul class="hours-table">';
	$daynames = array(
		'monday'      => __( 'Monday', 'themekit' ),
		'tuesday'     => __( 'Tuesday', 'themekit' ),
		'wednesday'   => __( 'Wednesday', 'themekit' ),
		'thursday'    => __( 'Thursday', 'themekit' ),
		'friday'      => __( 'Friday', 'themekit' ),
		'saturday'    => __( 'Saturday', 'themekit' ),
		'sunday'      => __( 'Sunday', 'themekit' )
	);

	$icon = '';

	if ( ! empty( $atts['image'] ) ) {
		if ( is_numeric( $atts['image'] ) ) {
			$image_src = wp_get_attachment_image_src( $atts['image'], 'full' );
			$atts['image'] = array_shift( $image_src );
		}

		$alt  = ! empty($atts['title'])
			? $atts['title']
			: pathinfo( $atts['image'], PATHINFO_FILENAME );

		$icon = sprintf( '<span class="dayname-icon"><img src="%s" alt="%s" /></span>', esc_url( $atts['image'] ), esc_attr( $alt ) );
	}
	elseif ( ! empty( $atts['icon'] ) ) {
		$icon = sprintf( '<span class="dayname-icon"><i class="fa %s"></i></span>', esc_attr( $atts['icon'] ) );
	}

	foreach( array( 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' ) as $day ) {
		if ( ! empty( $atts[$day] ) ) {
			$dayname = sprintf( '%s <span class="dayname-text">%s</span>', $icon, $daynames[$day] );
			$markup.= sprintf( '
				<li class="%s">
					<strong class="dayname">%s</strong>
					<span class="hours">%s</span>
				</li>
			', $day, $dayname, esc_html( $atts[$day] ) );
		}
	}

	$markup.= '</ul>';
	$markup.= '</div>';

	// Enqueue shortcode assets
	wp_enqueue_script( 'themekit-shortcodes' );

	return $markup;
}
