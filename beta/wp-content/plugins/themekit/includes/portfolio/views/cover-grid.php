<?php
/**
 * WARNING: This file is part of the Sparky framework. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

$column_classes = array(
	1 => 'one-column',
	2 => 'two-columns',
	3 => 'three-columns',
	4 => 'four-columns',
	5 => 'five-columns',
	6 => 'six-columns'
);

$grid_columns = themekit_portfolio_option( 'grid_columns', 3 );
$image_size   = apply_filters( 'themekit/portfolio/single_image_size', 'full', array(
	'type'    => 'grid',
	'columns' => $grid_columns
) );

$classes = array( 'media-grid' );
$classes[] = isset( $column_classes[$grid_columns] )
	? $column_classes[$grid_columns]
	: $column_classes[3];
?>

<ul class="<?php esc_attr_e( join( ' ', $classes ) ) ?>">
	<?php foreach ( themekit_entry_media() as $attachment ):
		if ( $attachment['type'] == 'image' ):
			list( $src_full, $width_full, $height_full ) = wp_get_attachment_image_src( $attachment['id'], 'full' );
			list( $src_thumb, $width_thumb, $height_thumb ) = wp_get_attachment_image_src( $attachment['id'], $image_size );
			?>
				
				<li class="image-item">
					<a href="<?php echo esc_url( $src_full ) ?>" class="quickview" data-lightbox="prettyPhoto" data-lightbox-gallery="portfolio-<?php esc_attr_e( get_the_ID() ) ?>">
						<img src="<?php echo esc_url( $src_thumb ) ?>" width="<?php esc_attr_e( $width_thumb ) ?>" height="<?php esc_attr_e( $height_thumb ) ?>" alt="<?php esc_attr_e( get_the_title() ) ?>" />
					</a>
				</li>

		<?php else: ?>

			<li class="video-item">
				<a href="<?php echo esc_url( $attachment['url'] ) ?>" class="quickview" data-lightbox="prettyPhoto" data-lightbox-gallery="portfolio-<?php esc_attr_e( get_the_ID() ) ?>"></a>
				<?php echo wp_oembed_get( $attachment['url'] ) ?>
			</li>

		<?php endif ?>
	<?php endforeach ?>
</ul>
