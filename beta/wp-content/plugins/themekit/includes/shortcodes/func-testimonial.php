<?php
/**
 * WARNING: This file is part of the UI-Pack plugin. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;


add_shortcode( 'testimonial', 'themekit_shortcode_testimonial' );
add_shortcode( 'testimonial_slider', 'themekit_shortcode_testimonial_slider' );

/**
 * Testimonial shortcode handle
 * 
 * @param   string  $atts  Shortcode attributes
 * @return  void
 */
function themekit_shortcode_testimonial( $atts, $content = null ) {
	$atts = shortcode_atts( apply_filters( 'themekit/shortcode/testimonial_atts', array(
		'class'    => '',
		'css'      => '',
		
		'name'     => '',
		'company'  => '',
		'subtitle' => '',
		'link'     => '',
		'image'    => ''
	) ), $atts );

	$testimonial_image = '';
	$author_info = array();

	$class = apply_filters( 'themekit/shortcode/testimonial_class', array( 'testimonial', $atts['class'] ), $atts );

	if ( ! empty( $atts['image'] ) ) {
		if ( is_numeric( $atts['image'] ) ) {
			if ( $image_src = wp_get_attachment_image_src( $atts['image'], 'full' ) ) {
				$atts['image'] = array_shift( $image_src );
			}
		}

		$class[] = 'has-image';
		$testimonial_image = sprintf( '
			<div class="testimonial-image">
				<img src="%s" alt="%s" />
			</div>
		', esc_attr( $atts['image'] ), esc_attr( $atts['name'] ) );
	}

	if ( ! empty( $atts['subtitle'] ) )
		$author_info[] = sprintf( '<span class="subtitle">%s</span>', wp_kses_post( $atts['subtitle'] ) );

	if ( ! empty( $atts['company'] ) ) {
		if ( ! empty( $atts['link'] ) )
			$author_info[] = sprintf( '<a href="%s" class="company">%s</a>', esc_url( $atts['link'] ), esc_html( $atts['company'] ) );
		else
			$author_info[] = sprintf( '<span class="company">%s</span>', esc_html( $atts['company'] ) );
	}

	// Enqueue shortcode assets
	wp_enqueue_script( 'themekit-shortcodes' );

	return sprintf( '
		<div class="%s">
			<div class="testimonial-content">
				<blockquote>
					%s
				</blockquote>
			</div>
			<div class="testimonial-meta">
				%s
				<div class="testimonial-author">
					<strong class="author-name">%s</strong>
					<div class="author-info">%s</div>
				</div>
			</div>
		</div>
	',

	esc_attr( implode( ' ', $class ) ),
	wp_kses_post( $content ),
	wp_kses_post( $testimonial_image ),
	esc_html( $atts['name'] ),
	implode( ' <span class="divider">-</span> ', $author_info ) );
}

/**
 * This function will be use to handle testimonial slider
 * shortcode
 * 
 * @param   string  $atts     Shortcode attributes
 * @param   string  $content  Shortcode content
 * @return  string
 */
function themekit_shortcode_testimonial_slider( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'mode'            => 'horizontal',
		'speed'           => '5000',
		'slides_per_view' => '1',
		'autoplay'        => 'yes',
		'hide_control'    => '',
		'hide_buttons'    => '',
		'loop'            => 'yes',
		'class'           => '',
		'css'             => ''
	), $atts );

	$config_id = uniqid( '_testimonialSlider_' );
	$config = $atts;

	unset( $config['class'] );
	unset( $config['css'] );

	// Enqueue shortcode assets
	wp_enqueue_script( 'themekit-shortcodes' );
	wp_localize_script( 'themekit-shortcodes', $config_id, $config );

	$class = apply_filters( 'themekit/shortcode/testimonial_slider_class', array( 'testimonial-slider', $atts['class'] ), $atts );

	return sprintf( '
		<div class="%s" data-config="%s">
			<div class="flexslider">
				<div class="slides">
					%s
				</div>
			</div>
		</div>
	', implode( ' ', $class ), esc_attr( trim( json_encode( $config ), '{ }' ) ), do_shortcode( $content ) );
}
