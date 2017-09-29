<?php
/**
 * WARNING: This file is part of the Sparky framework. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

global $post;

$terms     = get_the_terms( $post->ID, 'portfolio-category' );
$classes   = array();

if ( $terms ) {
	foreach ( $terms as $term )
		$classes[] = "category-{$term->term_id}";
}

if ( themekit_portfolio_option( 'double_size_enabled' ) ) {
	$classes[] = 'double-size';
}

$featured_image = get_post_thumbnail_id();
$featured_image_size = 'medium';

if ( isset( $post->addition ) && isset( $post->addition['image_size'] ) ) {
	$featured_image_size = $post->addition['image_size'];
}

if ( empty( $featured_image ) ) {
	foreach( $post->attachments as $attachment ) {
		if ( $attachment['type'] == 'image' ) {
			$featured_image = $attachment['id'];
			break;
		}
	}
}
?>
<article <?php post_class( $classes ) ?>>
	<div class="entry-wrapper">
		<?php if ( ! empty( $featured_image ) ): ?>
			<div class="entry-cover">
				<?php list( $thumb_src, $thumb_width, $thumb_height ) = wp_get_attachment_image_src( $featured_image, $featured_image_size ); ?>
				<img src="<?php echo esc_attr( $thumb_src ) ?>" width="<?php echo esc_attr( $thumb_width ) ?>" height="<?php echo esc_attr( $thumb_height ) ?>" alt="<?php echo esc_attr( get_the_title() ) ?>" />

				<div class="entry-links">
					<a href="<?php the_permalink() ?>" class="readmore">
						<span><?php __( 'Read More', 'konstruct' ) ?></span>
					</a>

					<?php list( $src, $width, $height ) = wp_get_attachment_image_src( $featured_image, 'full' ); ?>
					<a href="<?php echo esc_attr( $src ) ?>" class="quickview" data-lightbox="prettyPhoto"  data-lightbox-gallery="portfolio-<?php echo esc_attr( get_the_ID() ) ?>">
						<span><?php __( 'Quick View', 'konstruct' ) ?></span>
					</a>
				</div>

				<?php foreach ( themekit_entry_media() as $attachment ):
					if ( isset( $attachment['id'] ) && $featured_image == $attachment['id'] )
						continue;
					?>

					<?php if ( $attachment['type'] == 'image' ):
						list( $src, $width, $height ) = wp_get_attachment_image_src( $attachment['id'], 'full' );
						?>
						<a href="<?php echo esc_attr( $src ) ?>" class="quickview" data-lightbox="prettyPhoto"  data-lightbox-gallery="portfolio-<?php echo esc_attr( get_the_ID() ) ?>"></a>
					<?php else: ?>
						<a href="<?php echo esc_url( $attachment['url'] ) ?>" class="quickview" data-lightbox="prettyPhoto"  data-lightbox-gallery="portfolio-<?php echo esc_attr( get_the_ID() ) ?>"></a>
					<?php endif ?>

				<?php endforeach ?>
			</div>
		<?php endif ?>

		<div class="entry-content">
			<h2 class="entry-title">
				<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
			</h2>

			<?php $location = themekit_portfolio_option( 'location' ) ?>
			<?php if ( ! empty( $location ) ): ?>
				<div class="entry-meta">
					<?php echo esc_html( $location ) ?>
				</div>
			<?php endif ?>
		</div>
	</div>
</article>
