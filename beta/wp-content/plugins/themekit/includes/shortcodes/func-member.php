<?php
/**
 * WARNING: This file is part of the UI-Pack plugin. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;


add_shortcode( 'member', 'themekit_shortcode_member' );

/**
 * Testimonial shortcode handle
 * 
 * @param   string  $atts  Shortcode attributes
 * @return  void
 */
function themekit_shortcode_member( $atts, $content = null ) {
	$atts = shortcode_atts( apply_filters( 'themekit/shortcode/member_atts', array(
		'class'    => '',
		'css'      => '',
		
		'name'     => 'John Doe',
		'subtitle' => '',
		'image'    => '',

		'facebook' => '',
		'twitter'  => '',
		'linkedin' => '',
		'google'   => '',
		''
	) ), $atts );

	$member_image = '';
	$member_info = sprintf( '<h3 class="member-name">%s</h3>', esc_html( $atts['name'] ) );
	$class = apply_filters( 'themekit/shortcode/member_class', array( 'member', $atts['class'] ), $atts );

	if ( ! empty( $atts['image'] ) ) {
		if ( is_numeric( $atts['image'] ) && $images = wp_get_attachment_image_src( $atts['image'], 'full' ) )
			$atts['image'] = array_shift( $images );

		$class[] = 'has-image';
		$member_image = sprintf( '
			<div class="member-image">
				<img src="%s" alt="%s" />
			</div>
		', esc_attr( $atts['image'] ), esc_attr( $atts['name'] ) );
	}

	if ( ! empty( $atts['subtitle'] ) )
		$member_info.= sprintf( '<div class="member-subtitle">%s</div>', wp_kses_post( $atts['subtitle'] ) );

	$social_links = '';

	if ( ! empty( $atts['facebook'] ) )
		$social_links.= sprintf( ' <a href="%s" data-title="Facebook" class="facebook"><i class="fa fa-facebook"></i></a>', esc_url( $atts['facebook'] ) );

	if ( ! empty( $atts['twitter'] ) )
		$social_links.= sprintf( ' <a href="%s" data-title="Twitter" class="twitter"><i class="fa fa-twitter"></i></a>', esc_url( $atts['twitter'] ) );

	if ( ! empty( $atts['linkedin'] ) )
		$social_links.= sprintf( ' <a href="%s" data-title="LinkedIn" class="linkedin"><i class="fa fa-linkedin"></i></a>', esc_url( $atts['linkedin'] ) );

	if ( ! empty( $atts['google'] ) )
		$social_links.= sprintf( ' <a href="%s" data-title="Google Plus" class="google-plus"><i class="fa fa-google-plus"></i></a>', esc_url( $atts['google'] ) );

	if ( ! empty( $social_links ) )
		$social_links = sprintf( '<div class="social-links">%s</div>', $social_links );

	// Enqueue shortcode assets
	wp_enqueue_script( 'themekit-shortcodes' );
	
	return sprintf( '
		<div class="%s">
			%s
			<div class="member-info">
				%s
				<div class="member-desc">%s</div>
				%s
			</div>
		</div>
	', esc_attr( implode( ' ', $class ) ), $member_image, $member_info, $content, $social_links );
}
