<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

global $_post_thumbnail_size;

if ( post_password_required() || is_attachment() || ! has_post_thumbnail() )
	return;

if ( is_singular() ) {
	printf( '<div class="entry-cover">%s</div>', get_the_post_thumbnail() );
}
else {
	printf( '<div class="entry-cover"><a href="%s">%s</a></div>',
		esc_url( apply_filters( 'the_permalink', get_permalink() ) ),
		get_the_post_thumbnail( get_the_ID(), $_post_thumbnail_size ) );
}
