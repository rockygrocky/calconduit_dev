<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();


/**
 * Return the predefined background patterns
 *
 * @return  array
 */
function predefined_background_patterns() {
	static $patterns;

	if ( empty( $patterns ) || ! is_array( $patterns ) ) {
		$patterns = array();
		$template_directory = get_template_directory();
		$stylesheet_directory = get_stylesheet_directory();

		// Find background pattern from template's assets
		foreach( glob( $template_directory . '/assets/img/patterns/*' ) as $file ) {
			if ( is_dir( $file ) )
				continue;

			$patterns['parent_' . basename($file)] = \get_template_directory_uri() . '/assets/img/patterns/' . basename($file);
		}

		if ( $template_directory != $stylesheet_directory ) {
			if ( is_dir( $stylesheet_directory . '/assets/img/patterns' ) ) {
				// Find background patterns from child theme's assets
				foreach( glob( $stylesheet_directory . '/assets/img/patterns/*' ) as $file ) {
					if ( is_dir( $file ) )
						continue;

					$patterns['child_' . basename($file)] = \get_stylesheet_directory_uri() . '/assets/img/patterns/' . basename($file);
				}
			}
		}

		$patterns = apply_filters( 'konstruct/predefined_background_patterns', $patterns );
	}

	return $patterns;
}



/**
 * Return the built-in header styles for this theme
 *
 * @return  array
 */
function predefined_header_styles() {
	static $styles;

	if ( empty( $styles ) ) {
		$styles = apply_filters( 'konstruct/header_styles', array(
			'header-v1' => __( 'Classic', 'konstruct' ),
			'header-v2' => __( 'Center', 'konstruct' ),
			'header-v3' => __( 'Left', 'konstruct' ),
			'header-v4' => __( 'Modern', 'konstruct' ),
			'header-v5' => __( 'Transparent', 'konstruct' ),
			'header-v6' => __( 'Vertical', 'konstruct' ),
			'header-v7' => __( 'Fixed', 'konstruct' ),
			'header-v8' => __( 'Semi-Transparent', 'konstruct' )
		) );
	}

	return $styles;
}



/**
 * Return currently post type
 *
 * @return  strings
 */
function current_post_type_is( $post_type ) {
	return op_current_post_type() == $post_type;
}



/**
 * Retrieve all options for a post
 *
 * @param   int  $post_id  The post ID
 * @return  array
 */
function get_post_options( $post_id = null ) {
	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	return get_post_meta( $post_id, '_post_options', true );
}



/**
 * Retrieve all options for a page
 *
 * @param   int  $page_id  The page ID
 * @return  array
 */
function get_page_options( $page_id = null ) {
	if ( empty( $page_id ) )
		$page_id = get_the_ID();

	return get_post_meta( $page_id, '_page_options', true );
}



if ( ! function_exists( 'konstruct_upload_mimes' ) ) {
	add_filter( 'upload_mimes', 'konstruct_upload_mimes' );

	/**
	 * Register custom mime types for the theme
	 *
	 * @param   array  $mimes  List of mime types
	 * @return  array
	 */
	function konstruct_upload_mimes( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		$mimes['ico'] = 'image/x-icon';

		return $mimes;
	}
}



if ( ! function_exists( 'konstruct_favicon' ) ) {
	add_action( 'wp_head', 'konstruct_favicon' );

	/**
	 * Display the custom favicon setup for the theme
	 *
	 * @return  void
	 */
	function konstruct_favicon() {
		if ( $favicon = op_option( 'bookmark_icon' ) ) {
			printf( '<link rel="shortcut icon" href="%s" />', $favicon );
		}
	}
}



if ( ! function_exists( 'konstruct_under_construction_mode' ) ) {
	add_action( 'wp', 'konstruct_under_construction_mode' );

	/**
	 * This function will be check user permission and redirect to
	 * under construction page then under construction mode is turnned on
	 *
	 * @return  void
	 */
	function konstruct_under_construction_mode() {
		// We not check user permission in admin page
		if ( is_admin() ) return;

		// Check under construction is enabled and it is associated
		// to a page
		if ( op_option( 'under_construction_enabled', false ) && ( $page_id = op_option( 'under_construction_page_id', false ) ) ) {
			$allow_groups = op_option( 'under_construction_allowed', array() );
			$page_permalink = get_permalink( $page_id );

			// Force view permission for administrator
			if ( ! in_array( 'administrator', $allow_groups ) ) {
				array_unshift( $allow_groups, 'administrator' );
			}

			// Just do nothing if current page is assigned as under construction page
			if ( is_page( $page_id ) )
				return;

			// If user not logged in
			if ( ! is_user_logged_in() ) {
				wp_redirect( $page_permalink );
				exit;
			}

			// For logged in user
			else {
				$user = wp_get_current_user();
				$user_can_view = false;

				foreach ( $user->roles as $role ) {
					if ( in_array( $role, $allow_groups ) ) {
						$user_can_view = true;
						break;
					}
				}

				if ( ! $user_can_view ) {
					wp_redirect( $page_permalink );
					exit;
				}
			}
		}
	}
}



if ( ! function_exists( 'konstruct_custom_shortcodes_class' ) ) {
	/**
	 * Helper function to append custom css class that
	 * generated from VisualComposer for shortcode
	 *
	 * @param   array  $classes  Shortcode classes
	 * @param   array  $atts     Shortcode attributes
	 * @param   string $tag      Shortcode tag name
	 *
	 * @return  array
	 */
	function konstruct_custom_shortcodes_class( $classes, $atts = array(), $tag = '' ) {
		if ( function_exists( 'vc_shortcode_custom_css_class' ) && ! empty( $atts['css'] ) ) {
			$classes[] = vc_shortcode_custom_css_class( $atts['css'], ' ' );
		}

		return $classes;
	}
}



/**
 * The helper function to output the results of
 * the function esc_attr to the screen
 * 
 * @return  void
 */
function linethemes_esc_attr() {
	echo call_user_func_array( 'esc_attr', func_get_args() );
}


/**
 * The helper function to output the results of
 * the function esc_url to the screen
 * 
 * @return  void
 */
function linethemes_esc_url() {
	echo call_user_func_array( 'esc_url', func_get_args() );
}


/**
 * The helper function to output the results of
 * the function esc_html to the screen
 * 
 * @return  void
 */
function linethemes_esc_html() {
	echo call_user_func_array( 'esc_html', func_get_args() );
}


/**
 * The helper function to output the results of
 * the function wp_kses_post to the screen
 * 
 * @return  void
 */
function linethemes_kses_post() {
	echo call_user_func_array( 'wp_kses_post', func_get_args() );
}

