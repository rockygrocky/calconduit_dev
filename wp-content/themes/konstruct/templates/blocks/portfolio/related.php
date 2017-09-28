<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

if ( ! op_option( 'portfolio_related_box_enabled' ) ||
	 ! function_exists( 'themekit_shortcode_portfolio' ) )
	return;

$atts = array(
	'style'           => op_option( 'portfolio_related_style', 'grid' ),
	'columns'         => (int) op_option( 'portfolio_related_columns_count', 4 ),
	'limit'           => (int) op_option( 'portfolio_related_posts_count', 4 ),
	'show_filter'     => 'no'
);

if ( $tags = get_the_terms( get_the_ID(), 'portfolio-tag' ) ) {
	$atts['tag'] = array_values( wp_list_pluck( $tags, 'slug' ) );
}
elseif ( $categories = get_the_terms( get_the_ID(), 'portfolio-category' ) ) {
	$atts['category'] = array_values( wp_list_pluck( $categories, 'slug' ) );
}

if ( $atts['style'] == 'carousel' ) {
	$atts['style'] = 'grid';
	$atts['enable_carousel'] = 'yes';
}
elseif ( $atts['style'] == 'carousel-no-margin' ) {
	$atts['style'] = 'no-margin';
	$atts['enable_carousel'] = 'yes';
}

$atts['exclude'] = get_the_ID();
?>

<section class="box related-portfolios">
	<div class="box-wrapper">
		<h3 class="box-title"><span><?php _e( 'Related Portfolio', 'konstruct' ) ?></span></h3>
		<div class="box-content"><?php echo themekit_shortcode_portfolio( $atts ) ?></div>
	</div>
</section>
