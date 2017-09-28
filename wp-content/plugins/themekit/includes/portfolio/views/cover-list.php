<?php
/**
 * WARNING: This file is part of the Sparky framework. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;
?>

<ul class="media-list">
	<?php foreach ( themekit_entry_media() as $attachment ):
		if ( $attachment['type'] == 'image' ):
			list( $src, $width, $height ) = wp_get_attachment_image_src( $attachment['id'], 'full' ); ?>

			<li class="image-item">
				<a href="<?php echo esc_url( $src ) ?>" class="quickview" data-lightbox="prettyPhoto" data-lightbox-gallery="portfolio-<?php esc_attr_e( get_the_ID() ) ?>">
					<img src="<?php echo esc_url( $src ) ?>" alt="<?php esc_attr_e( get_the_title() ) ?>" />
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
