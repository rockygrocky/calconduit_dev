<?php
/**
 * WARNING: This file is part of the UI-Pack plugin. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;


add_shortcode( 'iconbox', 'themekit_shortcode_iconbox' );

/**
 * Iconbox shortcode handle
 * 
 * @param   array  $atts  Shortcode attributes
 * @return  void
 */
function themekit_shortcode_iconbox( $atts, $content = null ) {
	$atts = shortcode_atts( apply_filters( 'themekit/shortcode/iconbox_atts', array(
		'class' => '',
		
		// Icon style
		'icon'  => 'cog',
		'image' => '',
		
		// Box style
		'title' => __( 'Untitled', 'sparky' ),
		'tag'   => 'h3',
		
		'link'  => '',
		'text'  => '',
		
		'css'   => ''
	) ), $atts );

	$class = apply_filters( 'themekit/shortcode/iconbox_class', array( 'iconbox', $atts['class'] ), $atts );

	if ( ! empty( $atts['image'] ) ) {
		$icon = false;

		if ( is_numeric( $atts['image'] ) && $image_src = wp_get_attachment_image_src( $atts['image'], 'full' ) ) {
			$atts['image'] = array_shift( $image_src );

			$alt  = ! empty($atts['title'])
				? $atts['title']
				: pathinfo( $atts['image'], PATHINFO_FILENAME );

			$icon = sprintf( '<img src="%s" alt="%s" />', esc_url( $atts['image'] ), esc_attr( $alt ) );
		}
	}
	elseif ( ! empty( $atts['icon'] ) ) {
		$icon = sprintf( '<i class="fa %s"></i>', esc_attr( $atts['icon'] ) );
		
	}
	else {
		$icon = false;
	}

	$box_icon = $icon ? sprintf( '<div class="box-icon">%s</div>', $icon ) : '';
	$box_readmore = '';

	if ( ! empty( $atts['link'] ) && ! empty( $atts['text'] ) ) {
		$box_readmore = sprintf( '
			<p class="box-readmore">
				<a href="%s">%s</a>
			</p>', esc_url( $atts['link'] ), esc_html( $atts['text'] ) );
	}

	// Enqueue shortcode assets
	wp_enqueue_script( 'themekit-shortcodes' );

	return sprintf( '<div class="%2$s">
		<div class="box-header">
			%1$s
			<%4$s class="box-title">%3$s</%4$s>
		</div>
		<div class="box-content">
			%5$s
			%6$s
		</div>
	</div>', $box_icon, esc_attr( implode( ' ', $class ) ), esc_html( $atts['title'] ), $atts['tag'], $content, $box_readmore );
}
