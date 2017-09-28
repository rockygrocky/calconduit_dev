<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

$site_name     = get_bloginfo( 'name' );
$site_desc     = get_bloginfo( 'description' );
$home_url      = home_url();
$brand_classes = array( 'brand' );

if ( op_option( 'logo_image' ) == true ) {
	$brand_classes[] = 'has-logo';

	$logo_attrs  = array();
	$logo_width  = 0;
	$logo_height = 0;

	list( $logo_width, $logo_height ) = op_option( 'logo_size' );

	if ( $logo_width > 0 )
		$logo_attrs['width'] = intval( $logo_width );

	if ( $logo_height > 0 )
		$logo_attrs['height'] = intval( $logo_height );

	$logo_attrs['alt'] = $site_name;
	$site_name = sprintf( '<img src="%s" %s>',
		op_option( 'logo_src' ), 
		op_attributes( $logo_attrs )
	);

	if ( $logo_sticky = op_option( 'logo_sticky_src' ) ) {
		$brand_classes[] = 'has-sticky-logo';
		$logo_sticky_attrs = op_attributes( array(
			'class' => 'sticky-logo',
			'alt' => $logo_attrs['alt']
		) );

		$site_name.= sprintf( '<img src="%s" %s>',
			$logo_sticky, 
			$logo_sticky_attrs
		);
	}
}

if ( op_option( 'show_tagline', false ) ) {
	$brand_classes[] = 'has-tagline';
}

// Open .brand
printf( '<div%s>', op_attributes( array( 'id' => 'site-brand', 'class' => $brand_classes ), 'konstruct_brand_attrs' ) );

	// Open .brand > .logo
	printf( '<h1%s>', op_attributes( array( 'class' => 'logo', 'itemprop' => 'headline' ) ) );

		// Display the logo
		printf( '<a href="%s">%s</a>', $home_url, $site_name );

	// Close .brand > .logo
	print( '</h1>' );

	// Open .brand > .tagline
	if ( op_option( 'show_tagline', false ) )
		printf( '<p class="tagline" itemprop="description">%s</p>', $site_desc );

// Close .brand
print( '</div>' );
