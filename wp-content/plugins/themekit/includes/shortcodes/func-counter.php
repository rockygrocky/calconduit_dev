<?php
/**
 * WARNING: This file is part of the UI-Pack plugin. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;


add_shortcode( 'counter', 'themekit_shortcode_counter' );

/**
 * Counter shortcode handle
 * 
 * @param   array  $atts  Shortcode attributes
 * @return  void
 */
function themekit_shortcode_counter( $atts, $content = null ) {
	$atts = shortcode_atts( apply_filters( 'themekit/shortcode/counter_atts', array(
		'class'    => '',
		'css'      => '',
		
		'icon'     => '',
		'image'    => '',
		'value'    => 100,
		'title'    => '',
		
		'duration' => 1000,
		'prefix'   => '',
		'suffix'   => ''
	) ), $atts );

	$class = apply_filters( 'themekit/shortcode/counter_class', array( 'counter', $atts['class'] ), $atts );
	$markup_image = '';

	if ( ! empty( $atts['image'] ) ) {
		if ( is_numeric( $atts['image'] ) ) {
			$image_src = wp_get_attachment_image_src( $atts['image'], 'full' );
			$atts['image'] = array_shift( $image_src );
		}

		$markup_image = sprintf( '<img src="%s" alt="%s" />', $atts['image'], $atts['title'] );
	}
	elseif ( ! empty( $atts['icon'] ) ) {
		$markup_image = sprintf( '<i class="fa %s"></i>', $atts['icon'] );
	}

	$markup = sprintf( '<div class="%s">', implode( ' ', $class ) );

	if ( ! empty( $markup_image ) )
		$markup.= sprintf( '<div class="counter-image">%s</div>', $markup_image );

	$markup.= sprintf( '
		<div class="counter-content">
			<span class="counter-prefix">%3$s</span>
			<span class="counter-value" data-duration="%2$s">%1$d</span>
			<span class="counter-suffix">%4$s</span>
		</div>
	', $atts['value'], $atts['duration'], $atts['prefix'], $atts['suffix'] );

	if ( ! empty( $atts['title'] ) )
		$markup.= sprintf( '<div class="counter-title">%s</div>', $atts['title'] );

	$markup.= '</div>';

	// Enqueue shortcode assets
	wp_enqueue_script( 'themekit-shortcodes' );

	return $markup;
}
