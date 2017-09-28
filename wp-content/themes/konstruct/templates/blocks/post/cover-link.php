<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

global $_post_options, $_post_thumbnail_size;

$post_link = $_post_options['post_link'];

if ( empty( $post_link ) || ! filter_var( $post_link, FILTER_VALIDATE_URL ) )
	$post_link = get_permalink();

if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
	if ( is_singular() ) {
		printf( '<div class="entry-cover">%s</div>', get_the_post_thumbnail() );
	}
	else {
		printf( '<div class="entry-cover"><a href="%s">%s</a></div>', $post_link, get_the_post_thumbnail( get_the_ID(), $_post_thumbnail_size ) );
	}
}
