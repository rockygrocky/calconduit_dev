<?php
$original_atts = $atts;
$atts = shortcode_atts( array(
	'widget_title'   => '',
	'categories'     => '',
	'limit'          => 9,
	'offset'         => 0,
	'thumbnail_size' => 'full',
	'lightbox'       => 'yes',
	'link'           => 'no',
	'readmore'       => 'yes',
	'readmore_text'  => '',
	'order'          => 'date',
	'direction'      => 'DESC',
	'class'          => '',
	'css'            => ''
), $atts );

// Remove attribute "class" from origial attributes
if ( isset( $original_atts['class'] ) ) unset( $original_atts['class'] );
if ( isset( $original_atts['css'] ) )   unset( $original_atts['css'] );

// Santinize the shortcode attributes
$atts['limit']  = abs( (int) $atts['limit'] );
$atts['limit']  = max( 1, $atts['limit']);
$atts['offset'] = abs( (int) $atts['offset'] );
$atts['lightbox']       = $atts['lightbox'] == 'yes';
$atts['readmore']       = $atts['readmore'] == 'yes';

// Santinize categories
$atts['categories'] = explode( ',', $atts['categories'] );
$atts['categories'] = array_map( 'trim', $atts['categories'] );
$atts['categories'] = array_filter( $atts['categories'] );

if ( ! in_array( $atts['order'], array( 'date', 'ID', 'author', 'title', 'modified', 'rand', 'comment_count', 'menu_order' ) ) )
	$atts['order'] = 'date';

if ( ! in_array( $atts['direction'], array( 'ASC', 'DESC' ) ) )
	$atts['order'] = 'DESC';

// Begin build post type query
$args = array(
	'post_type'      => 'member',
	'posts_per_page' => $atts['limit'],
	'offset'         => $atts['offset'],
	'orderby'        => $atts['order'],
	'order'          => $atts['direction']
);

if ( ! empty( $atts['categories'] ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'member-category',
			'field'    => 'term_id',
			'terms'    => $atts['categories']
		)
	);
}

$query = new WP_Query( $args );

// Start output the carousel
if ( $query->have_posts() ):
	$classes = array( 'team-members-carousel' );
	$classes[] = $atts['class'];
	$classes[] = vc_shortcode_custom_css_class( $atts['css'], ' ' );
?>
	<!-- BEGIN: .team-members-carousel -->
	<div class="<?php esc_attr_e( join( ' ', $classes ) ) ?>">
		
		<?php if ( ! empty( $atts['widget_title'] ) ): ?>
			<h3 class="widget-title"><?php esc_html_e( $atts['widget_title'] ) ?></h3>
		<?php endif ?>

		<?php
		
			/**
			 * Start output buffering to catching
			 * generated markup
			 */
			ob_start();

		?>
		<?php
			while ( $query->have_posts() ):
				$query->the_post();

				$metadata = get_post_meta( get_the_ID(), '_member_options', true );
				$social_links = trim( $metadata['social_links'], '"' );
				$social_links = json_decode( $social_links, true );
				$available_icons = op_available_social_icons();
			?>
			
			<article <?php post_class() ?>>
				<?php if ( has_post_thumbnail() ): ?>
					
					<div class="member-image">
						
						<?php

							/**
							 * Preparing the post thumbnail
							 */
							$image = wpb_getImageBySize( array( 'post_id' => get_the_ID(), 'thumb_size' => $atts['thumbnail_size'] ) );
							$image_large = $image['p_img_large'];

							if ( $atts['lightbox'] ):
								printf( '<a href="%s" data-lightbox="prettyPhoto">%s</a>', $image_large[0], $image['thumbnail'] );
							else:
								print( $image['thumbnail'] );
							endif;
						?>

					</div>

				<?php endif ?>
				
				<div class="member-detail">
					<h3 class="member-name"><?php the_title() ?></h3>

					<?php if ( ! empty( $metadata['subtitle'] ) ): ?>
						<p class="member-subtitle">
							<?php esc_html_e( $metadata['subtitle'] ) ?>
						</p>
					<?php endif ?>

					<ul class="member-meta">
						<?php if ( ! empty( $metadata['phone'] ) ): ?>
						<li class="member-phone">
							<span><?php _e( 'Tel:', 'tomjerry' ) ?></span>
							<?php esc_html_e( $metadata['phone'] ) ?>
						</li>
						<?php endif ?>

						<?php if ( ! empty( $metadata['email'] ) ): ?>
						<li class="member-email">
							<a href="mailto:<?php esc_attr_e( $metadata['email'] ) ?>">
								<?php esc_html_e( $metadata['email'] ) ?>
							</a>
						</li>
						<?php endif ?>

						<?php if ( is_array( $social_links ) && isset( $social_links['__icons_ordering__'] ) ): ?>
							<li class="social-links">
								<?php foreach ( $social_links['__icons_ordering__'] as $id ):
									if ( ! isset( $available_icons[$id] ) || ! isset( $social_links[$id] ) )
										continue;

									$link = $social_links[$id];
									$icon_class = $available_icons[$id]['icon_class'];
									?>
									<a href="<?php echo esc_url( $link ) ?>" target="_blank">
										<i class="fa <?php esc_attr_e( $icon_class ) ?>"></i>
									</a>
								<?php endforeach ?>
							</li>
						<?php endif ?>
					</ul>

					<div class="member-category">
						<h3><?php _e( 'Area of practice', 'tomjerry' ) ?></h3>
						<ul>
							<?php the_terms( get_the_ID(), 'member-category', '<li>', '</li><li>', '</li>' ) ?>
						</ul>
					</div>

					<div class="more-link">
						<a href="<?php the_permalink() ?>"><?php _e( 'View Profile', 'tomjerry' ) ?></a>
					</div>
				</div>
			</article>

		<?php
			// End the post loop
			endwhile;

			/**
			 * We need reset post data to ensure
			 * not conflict with other code
			 */
			wp_reset_postdata();

			/**
			 * Render the shortcode "elements_carousel" to
			 * display generated markup in a carousel
			 */
			echo visual_composer()
				->getShortcode( 'elements_carousel' )
				->render( $original_atts, ob_get_clean() );
		?>
	</div>
	<!-- END: .team-members-carousel -->
<?php endif ?>
