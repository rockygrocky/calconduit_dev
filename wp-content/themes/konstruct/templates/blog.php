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
 * Template Name: Blog
 */

query_posts( array(
	'post_type' => 'post',
	'posts_per_page' => op_option( 'blog_posts_per_page' ),
	'paged' => get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1
) );
?>

<?php if ( have_posts() ): ?>
	<div class="content-inner">
		<?php while ( have_posts() ): the_post(); ?>
			<?php get_template_part( 'templates/blocks/post', get_post_format() ) ?>
		<?php endwhile ?>
	</div>
	<?php get_template_part( 'templates/blocks/pagination' ) ?>
<?php else: ?>
	<div class="content-inner">
		<?php get_template_part( 'templates/blocks/post/empty' ) ?>
	</div>
<?php endif ?>

<?php wp_reset_postdata(); ?>
<?php wp_reset_query(); ?>