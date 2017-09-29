<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();


if ( ! class_exists( 'WooCommerce' ) )
	return;

// Disable default stylesheet of woocommerce
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
add_filter( 'woocommerce_show_page_title', '__return_false' );


if ( ! function_exists( 'konstruct_woocommerce_related_products_args' ) ) {
	add_filter( 'woocommerce_related_products_args', 'konstruct_woocommerce_related_products_args' );

	/**
	 * Return custom arguments to turn on/off related
	 * products section
	 * 
	 * @param   array  $args  Arguments
	 * @return  array
	 */
	function konstruct_woocommerce_related_products_args( $args ) {
		if ( op_option( 'woo_related_box_enabled' ) == false )
			return array();

		return $args;
	}
}



if ( ! function_exists( 'konstruct_woocommerce_output_related_products_args' ) ) {
	add_filter( 'woocommerce_output_related_products_args', 'konstruct_woocommerce_output_related_products_args' );

	/**
	 * Modify the number of products that will be appeared
	 * in related products section
	 * 
	 * @param   array  $args  Arguments
	 * @return  array
	 */
	function konstruct_woocommerce_output_related_products_args( $args ) {
		$args['posts_per_page'] = op_option( 'woo_related_products_count' );
		
		return $args;
	}
}



if ( ! function_exists( 'konstruct_woocommerce_remove_lightbox' ) ) {
	add_action( 'wp_enqueue_scripts', 'konstruct_woocommerce_remove_lightbox', 99 );

	/**
	 * Deregister all prettyPhoto styles and scripts
	 * 
	 * @return  void
	 */
	function konstruct_woocommerce_remove_lightbox() {
		// Styles
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

		// Scripts
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
		wp_dequeue_script( 'fancybox' );
		wp_dequeue_script( 'enable-lightbox' );
	}
}



if ( ! function_exists( 'konstruct_woocommerce_single_product_image_html' ) ) {
	add_filter('woocommerce_single_product_image_html', 'konstruct_woocommerce_single_product_image_html', 99, 1);
	add_filter('woocommerce_single_product_image_thumbnail_html', 'konstruct_woocommerce_single_product_image_html', 99, 1);

	/**
	 * @param   string  $html  HTML markup to be replaced
	 * @return  string
	 */
	function konstruct_woocommerce_single_product_image_html( $html ) {
		if ( preg_match( '/(.*)data-rel="([^\"]+)"(.*)/i', $html, $matches ) ) {
			if ( strtolower( $matches[2] ) == 'prettyphoto[product-gallery]' )
				$html = $matches[1] . 'data-lightbox="prettyPhoto" data-lightbox-gallery="product-gallery"' . $matches[3];
			else
				$html = $matches[1] . 'data-lightbox="prettyPhoto"' . $matches[3];
		}

		return $html;
	}
}



if ( ! function_exists( 'konstruct_woocommerce_products_per_page' ) ) {
	add_filter( 'loop_shop_per_page', 'konstruct_woocommerce_products_per_page', 20 );

	/**
	 * Return the number of how many products that will be
	 * displayed on archive page
	 * 
	 * @return  int
	 */
	function konstruct_woocommerce_products_per_page() {
		return op_option( 'woo_products_per_page', 10 );
	}
}



if ( ! function_exists( 'konstruct_woocommerce_add_to_cart_fragments' ) ) {
	add_filter( 'add_to_cart_fragments', 'konstruct_woocommerce_add_to_cart_fragments' );

	/**
	 * Register fragment markup that will respond in ajax request when add
	 * a product to cart
	 * 
	 * @param   array  $fragments  Fragments content
	 * @return  array
	 */
	function konstruct_woocommerce_add_to_cart_fragments( $fragments ) {
		$cart_items = \WooCommerce::instance()->cart->get_cart_contents_count();
		$fragments['script#shopping-cart-items-updater'] = sprintf( '
				<script id="shopping-cart-items-updater" type="text/javascript">
					( function( $ ) {
						"use strict";

						$( document ).trigger( \'woocommerce-cart-changed\', { items_count: %d } );
					} ).call( this, jQuery );
				</script>
			', $cart_items );

		return $fragments;
	}
}



if ( ! function_exists( 'konstruct_woocommerce_cart_items_updater' ) ) {
	add_action( 'wp_footer', 'konstruct_woocommerce_cart_items_updater' );

	/**
	 * Print markup that will be used as place holder
	 * for update cart items
	 * 
	 * @return  void
	 */
	function konstruct_woocommerce_cart_items_updater() {
		echo '<script id="shopping-cart-items-updater" type="text/javascript"></script>';
	}
}



if ( ! function_exists( 'konstruct_woocommerce_shop_thumbnail_image_size' ) ) {
	add_filter( 'woocommerce_get_image_size_shop_thumbnail', 'konstruct_woocommerce_shop_thumbnail_image_size' );

	function konstruct_woocommerce_shop_thumbnail_image_size( $size ) {
		$size['width'] = 90;
		$size['height'] = 90;

		return $size;
	}
}



if ( ! function_exists( 'konstruct_woocommerce_shop_catalog_image_size' ) ) {
	add_filter( 'woocommerce_get_image_size_shop_catalog', 'konstruct_woocommerce_shop_catalog_image_size' );

	function konstruct_woocommerce_shop_catalog_image_size( $size ) {
		$size['width']  = 600;
		$size['height'] = 600;
		$size['crop']   = true;

		return $size;
	}
}



if ( ! function_exists( 'konstruct_woocommerce_shop_single_image_size' ) ) {
	add_filter( 'woocommerce_get_image_size_shop_single', 'konstruct_woocommerce_shop_single_image_size' );

	function konstruct_woocommerce_shop_single_image_size( $size ) {
		$size['width'] = 600;
		$size['height'] = 600;

		return $size;
	}
}
