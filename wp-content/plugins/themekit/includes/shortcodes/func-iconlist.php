<?php
/**
 * WARNING: This file is part of the UI-Pack plugin. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;


add_shortcode( 'iconlist', 'themekit_shortcode_iconlist' );
add_shortcode( 'iconlist_item', 'themekit_shortcode_iconlist_item' );

/**
 * Iconlist shortcode handle
 * 
 * @param   array  $atts  Shortcode attributes
 * @return  void
 */
function themekit_shortcode_iconlist( $atts, $content = null ) {
	$atts = shortcode_atts( apply_filters( 'themekit/shortcode/iconlist_atts', array(
		'class' => '',
		'css'   => '',
		
		// Icon style
		'icon'  => 'cog',
		'image' => ''
	) ), $atts );

	$class = apply_filters( 'themekit/shortcode/iconlist_class', array( 'iconlist', $atts['class'] ), $atts );
	$children = array();

	if ( preg_match_all( '/\[iconlist_item([^\]]+)\](.*?)\[\/iconlist_item\]/is', $content, $matches ) ) {
		foreach ( $matches[1] as $index => $attributes ) {
			$_attributes = shortcode_parse_atts( trim( $attributes ) );
			$_content = trim( $matches[2][$index] );

			if ( ! isset( $_attributes['icon'] ) && ! empty( $atts['icon'] ) )
				$_attributes['icon'] = $atts['icon'];

			if ( ! isset( $_attributes['image'] ) && ! empty( $atts['image'] ) )
				$_attributes['image'] = $atts['image'];

			$children[] = themekit_shortcode_iconlist_item( $_attributes, $_content );
		}
	}

	// Enqueue shortcode assets
	wp_enqueue_script( 'themekit-shortcodes' );

	return sprintf( '<ul class="iconlist %s">%s</ul>', esc_attr( implode( ' ', $class ) ), implode( '', $children ) );
}

function themekit_shortcode_iconlist_item( $atts, $content = null ) {
	$atts = shortcode_atts( apply_filters( 'themekit/shortcode/iconlist_item_atts', array(
		'class' => '',
		'css'   => '',
		
		// Icon style
		'icon'  => 'cog',
		'image' => ''
	) ), $atts );

	$class = apply_filters( 'themekit/shortcode/iconlist_item_class', array( $atts['class'] ), $atts );
	$icon = '';

	if ( ! empty( $atts['image'] ) ) {
		if ( is_numeric( $atts['image'] ) ) {
			$image_src = wp_get_attachment_image_src( $atts['image'], 'full' );
			$atts['image'] = array_shift( $image_src );
		}

		$alt  = ! empty($atts['title'])
			? $atts['title']
			: pathinfo( $atts['image'], PATHINFO_FILENAME );

		$icon = sprintf( '<img src="%s" alt="%s" />', esc_url( $atts['image'] ), esc_attr( $alt ) );
	}
	elseif ( ! empty( $atts['icon'] ) ) {
		$icon = sprintf( '<i class="fa fa-%s"></i>', esc_attr( $atts['icon'] ) );
		
	}

	$class = esc_attr( trim( implode( ' ', $class ) ) );
	if ( ! empty( $class ) )
		$class = "class=\"{$class}\"";

	// Enqueue shortcode assets
	wp_enqueue_script( 'themekit-shortcodes' );

	return sprintf( '<li %s>%s %s</li>',
		$class,
		$icon,
		$content
	);
}
