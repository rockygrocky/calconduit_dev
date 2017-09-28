<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();



if ( ! function_exists( 'konstruct_portfolio_page_templates' ) ) {
	add_action( 'init', 'konstruct_portfolio_page_templates' );

	/**
	 * Register page templates for simple-portfolio plugin
	 * 
	 * @return  void
	 */
	function konstruct_portfolio_page_templates() {
		themekit_portfolio_add_page_template( 'templates/portfolio.php' );
	}
}



if ( ! function_exists( 'konstruct_portfolio_assets' ) ) {
	add_action( 'init', 'konstruct_portfolio_assets' );

	function konstruct_portfolio_assets() {
		// Deregister original assets
		wp_deregister_script( 'themekit-portfolio' );
		wp_register_script( 'themekit-portfolio', THEMEKIT_URL . '/assets/js/portfolio.js', array( 'konstruct-3rd' ), THEMEKIT_VERSION, true );
	}
}



if ( ! function_exists( 'konstruct_portfolio_show_filter' ) ) {
	add_filter( 'themekit/portfolio/show_the_filters', 'konstruct_portfolio_show_filter' );

	/**
	 * Return the flag to show/hide filters for portfolio
	 * 
	 * @return  boolean
	 */
	function konstruct_portfolio_show_filter() {
		return op_option( 'portfolio_archive_filter' );
	}
}



if ( ! function_exists( 'konstruct_portfolio_archive_image_size' ) ) {
	add_filter( 'themekit/portfolio/archive_image_size', 'konstruct_portfolio_archive_image_size' );

	/**
	 * Return the size of image for portfolio archive page
	 * 
	 * @param   string  $image_size  Original image size
	 * @return  string
	 */
	function konstruct_portfolio_archive_image_size( $image_size ) {
		switch ( op_option( 'portfolio_archive_layout' ) ) {
			case 'no-margin':
			case 'grid':
				$image_size = 'portfolio-medium-crop';
				break;
			
			case 'masonry':
				$image_size = 'portfolio-medium';
				break;
		}

		return $image_size;
	}
}



if ( ! function_exists( 'konstruct_portfolio_single_image_size' ) ) {
	add_filter( 'themekit/portfolio/single_image_size', 'konstruct_portfolio_single_image_size', 10, 2 );

	/**
	 * Return the size of image for portfolio single page
	 * 
	 * @param   string  $image_size  Original image size
	 * @param   mixed   $atts        Additional attributes
	 * @return  string
	 */
	function konstruct_portfolio_single_image_size( $size, $atts = null ) {
		switch ( $atts['type'] ) {
			case 'grid':
				$size = 'portfolio-medium';
				break;

			default:
				$size = 'portfolio-large';
				break;
		}

		return $size;
	}
}



if ( ! function_exists( 'konstruct_portfolio_shortcode_image_size' ) ) {
	add_filter( 'themekit/shortcode/portfolio_image_size', 'konstruct_portfolio_shortcode_image_size', 10, 2 );

	/**
	 * Return the size of image for portfolio shortcode
	 * 
	 * @param   string  $image_size  Original image size
	 * @param   mixed   $atts        Additional attributes
	 * @return  string
	 */
	function konstruct_portfolio_shortcode_image_size( $size, $atts ) {
		switch ( $atts['style'] ) {
			case 'no-margin':
			case 'grid':
				$size = 'portfolio-medium-crop';
				break;
			
			case 'masonry':
				$size = 'portfolio-medium';
				break;
		}

		return $size;
	}
}



if ( ! function_exists( 'konstruct_portfolio_details_properties' ) ) {
	add_filter( 'themekit/portfolio_details_properties', 'konstruct_portfolio_details_properties' );

	/**
	 * Custom properties for the portfolio item
	 * 
	 * @param   array  $properties  Item properties
	 * @return  array
	 */
	function konstruct_portfolio_details_properties( $properties ) {
		unset( $properties['client'] );
		unset( $properties['website'] );
		unset( $properties['project_url'] );

		$properties['date'] = array(
			'label'   => __( 'Construction Date', 'konstruct' ),
			'type'    => 'text',
			'section' => 'all'
		);

		$properties['location'] = array(
			'label'   => __( 'Location', 'konstruct' ),
			'type'    => 'text',
			'section' => 'all'
		);

		$properties['surface_area'] = array(
			'label'   => __( 'Surface Area', 'konstruct' ),
			'type'    => 'text',
			'section' => 'all'
		);

		$properties['investor'] = array(
			'label'   => __( 'Construction Investor', 'konstruct' ),
			'type'    => 'text',
			'section' => 'all'
		);

		$properties['value'] = array(
			'label'   => __( 'Value', 'konstruct' ),
			'type'    => 'text',
			'section' => 'all'
		);

		return $properties;
	}
}



if ( ! function_exists( 'konstruct_portfolio_breadcrumb' ) ) {
	add_filter( 'breadcrumb_trail_items', 'konstruct_portfolio_breadcrumb' );

	function konstruct_portfolio_breadcrumb( $items ) {
		if ( function_exists( 'is_themekit_portfolio' ) && is_themekit_portfolio() ) {
			if ( is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tag' ) ) {
				$home = array_shift( $items );
				
				array_unshift( $items, sprintf( '<a href="%s">%s</a>', get_post_type_archive_link( 'portfolio' ), op_option( 'portfolio_page_title' ) ) );
				array_unshift( $items, $home );
			}
			elseif ( is_post_type_archive( 'portfolio' ) ) {
				array_pop( $items );
				array_push( $items, op_option( 'portfolio_page_title' ) );
			}
			elseif ( is_singular( 'portfolio' ) ) {
				$home = array_shift( $items );
				$items = array();
				$items[] = $home;
				$items[] = sprintf( '<a href="%s">%s</a>', get_post_type_archive_link( 'portfolio' ), op_option( 'portfolio_page_title' ) );
				$items[] = get_the_title();
			}
		}

		return $items;
	}
}



if ( ! function_exists( 'konstruct_portfolio_init_query' ) ) {
	add_action( 'pre_get_posts', 'konstruct_portfolio_init_query' );

	function konstruct_portfolio_init_query( $query ) {
		if ( ! is_admin() && $query->is_main_query() &&
			 ( is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tag' ) ) ) {
			$query->set( 'posts_per_page', op_option( 'portfolio_posts_per_page', 10 ) );
			$query->set( 'orderby', op_option( 'portfolio_posts_order_by', 'date' ) );
			$query->set( 'order', op_option( 'portfolio_posts_order_direction', 'DESC' ) );
		}
	}
}
