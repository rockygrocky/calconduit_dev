<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

if ( ! function_exists( 'breadcrumb_trail' ) )
	require_once trailingslashit( get_template_directory() ) . 'libraries/breadcrumb-trail/breadcrumb-trail.php';

if ( ! function_exists( 'konstruct_breadcrumb_items' ) ) {
	add_filter( 'breadcrumb_trail_items', 'konstruct_breadcrumb_items', 10, 2 );

	/**
	 * Add breadcrumb item when post title is empty
	 * 
	 * @param   array  $items  Breadcrumb items
	 * @param   array  $args   Arguments
	 * @return  array
	 */
	function konstruct_breadcrumb_items( $items, $args ) {
		if ( is_singular() ) {
			$post = get_post();
			
			if ( empty( $post->post_title ) ) {
				$items[] = get_the_title();
			}
		}

		return $items;
	}
}
