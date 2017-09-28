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
 * Register filter to add custom classes to
 * portfolio container
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
?>
<div class="content-inner">
	<?php themekit_portfolio_content() ?>

	<?php if ( is_singular( 'portfolio' ) ): ?>
		<?php get_template_part( 'templates/blocks/post/navigator' ) ?>
		<?php get_template_part( 'templates/blocks/portfolio/related' ) ?>
	<?php endif ?>
</div>
<?php get_template_part( 'templates/blocks/pagination' ) ?>
