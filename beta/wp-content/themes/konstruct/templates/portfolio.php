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
 * Template Name: Portfolio
 */
add_filter( 'themekit/portfolio/archive_classes', 'konstruct_portfolio_archive_class' );

function konstruct_portfolio_archive_class( $classes ) {
	$column_translate = array(
		2 => 'portfolio-two-columns',
		3 => 'portfolio-three-columns',
		4 => 'portfolio-four-columns',
		5 => 'portfolio-five-columns'
	);

	$classes[] = 'portfolio-' . op_option( 'portfolio_archive_layout', 'grid' );
	$classes[] = $column_translate[ op_option( 'portfolio_grid_columns' ) ];

	return $classes;
}

add_action( 'themekit/portfolio/initialize_post_query', 'konstruct_portfolio_initialize_post_query' );

function konstruct_portfolio_initialize_post_query() {
	query_posts( array(
		'post_type'      => 'portfolio',
		'posts_per_page' => op_option( 'portfolio_posts_per_page' ),
		'paged'          => max( 1, get_query_var( 'paged' ) ),
		'orderby'        => op_option( 'portfolio_posts_order_by', 'date' ),
		'order'          => op_option( 'portfolio_posts_order_direction', 'DESC' )
	) );
}
?>
<div class="content-inner">
	<?php themekit_portfolio_content() ?>
</div>
<?php get_template_part( 'templates/blocks/pagination' ) ?>
<?php wp_reset_query() ?>
