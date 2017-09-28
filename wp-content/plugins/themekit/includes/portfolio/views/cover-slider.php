<?php
/**
 * WARNING: This file is part of the Sparky framework. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

$image_size = apply_filters( 'themekit/portfolio/single_image_size', 'full', array(
	'type' => 'slider'
) );
?>

<div id="cover-slider-<?php esc_attr_e( get_the_ID() ) ?>" class="flexslider" data-animation-mode="<?php esc_attr_e( themekit_portfolio_option( 'slider_animation' ) ) ?>">
	<ul class="slides">
		<?php foreach ( themekit_entry_media() as $attachment ):
			if ( $attachment['type'] == 'image' ):
				list( $src, $width, $height ) = wp_get_attachment_image_src( $attachment['id'], $image_size ); ?>
				
				<li class="image-item">
					<img src="<?php echo esc_url( $src ) ?>" alt="<?php esc_attr_e( get_the_title() ) ?>" />
				</li>

			<?php else: ?>
				
				<li class="video-item">
					<?php echo wp_oembed_get( $attachment['url'] ) ?>
				</li>

			<?php endif ?>
		<?php endforeach ?>
	</ul>
</div>
