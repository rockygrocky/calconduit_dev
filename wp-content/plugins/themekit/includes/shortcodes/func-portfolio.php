<?php
/**
 * WARNING: This file is part of the Padora theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

// Register portfolio shortcode
add_shortcode( 'portfolio', 'themekit_shortcode_portfolio' );

/**
 * Handler function to render portfolio shortcode
 * 
 * @param   mixed   $atts     Shortcode attributes
 * @param   string  $content  Shortcode inner content
 * @return  stirng
 */
function themekit_shortcode_portfolio( $atts, $content = null ) {
	$atts = shortcode_atts( apply_filters( 'themekit/shortcode_default_atts', array(
			'category'        => '',
			'tag'             => '',
			'exclude'         => '',
			'style'           => 'grid',
			'columns'         => 4,
			'limit'           => 8,
			'enable_carousel' => 'no',
			'show_filter'     => 'yes',
			'css'             => '',
			'class'           => ''
		) ), $atts );

	if ( empty( $atts['enable_carousel'] ) ) $atts['enable_carousel'] = 'no';
	if ( empty( $atts['show_filter'] ) ) $atts['show_filter'] = 'no';

	$columns_translate = array(
		1 => 'one-column',
		2 => 'two-columns',
		3 => 'three-columns',
		4 => 'four-columns',
		5 => 'five-columns',
		6 => 'six-columns'
	);

	if ( apply_filters( 'themekit/shortcode/portfolio_enqueue_styles', true ) ) {
		// Shortcode assets
		wp_enqueue_style( 'themekit-owlcarousel' );
		wp_enqueue_style( 'themekit-isotope' );
	}

	if ( apply_filters( 'themekit/shortcode/portfolio_enqueue_scripts', true ) ) {
		wp_enqueue_script( 'themekit-owlcarousel' );
		wp_enqueue_script( 'themekit-portfolio' );
	}

	$args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => intval( $atts['limit'] ),
	);

	if ( ! empty( $atts['category'] ) ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'portfolio-category',
			'terms'    => $atts['category'],
			'field'    => 'slug',
			'operator' => 'IN'
		);
	}

	if ( ! empty( $atts['tag'] ) ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'portfolio-tag',
			'terms'    => $atts['tag'],
			'field'    => 'slug',
			'operator' => 'IN'
		);
	}

	$class = op_classes( array(
			'portfolio-container',
			"portfolio-{$atts['style']}",
			"portfolio-{$columns_translate[$atts['columns']]}"
		),
		'themekit/shortcode/portfolio_classes', array(
			'atts'    => $atts,
			'content' => $content
		)
	);
	
	if ( $atts['enable_carousel'] == 'yes' ) {
		$class->add( 'portfolio-carousel' );
		$atts['show_filter'] = 'no';
	}

	if ( ! empty( $atts['exclude'] ) ) {
		$exclude = $atts['exclude'];

		if ( ! is_array( $exclude ) )
			$exclude = explode( ',', $exclude );

		$args['post__not_in'] = $exclude;
	}

	$query = new WP_Query( $args );

	if ( $atts['show_filter'] == 'yes' && $atts['enable_carousel'] == 'no' ) {
		$categories = array();

		while ( $query->have_posts() ) {
			$query->next_post();

			if ( $terms = get_the_terms( $query->post->ID, 'portfolio-category' ) )
				foreach ( $terms as $term )
					$categories[ $term->term_id ] = $term;
		}

		$query->rewind_posts();
	}

	ob_start();
	?>

		<?php if ( $query->have_posts() ): ?>

			<div class="<?php esc_attr_e( (string) $class ) ?>">
				<?php if ( ! empty( $categories ) ): ?>
					<div class="portfolio-filters">
						<ul>
							<li data-filter="*" class="active"><a href="#"><?php _e( 'All', 'themekit' ) ?></a></li>
							<?php foreach ( $categories as $term ): ?>

								<li data-filter=".category-<?php esc_attr_e( $term->term_id ) ?>">
									<a href="<?php echo esc_url( get_term_link( $term ) ) ?>"><?php esc_html_e( $term->name ) ?></a>
								</li>
							
							<?php endforeach ?>
						</ul>
					</div>
				<?php endif ?>

				<div class="portfolio-entries">
					<div class="entries-wrapper">
						<?php
						// Run the loop
						while ( $query->have_posts() ):
							$query->the_post();

							themekit_prepare_post_object( $query->post, array(
								'image_size' => apply_filters( 'themekit/shortcode/portfolio_image_size', 'medium', $atts )
							) );

							themekit_locate_template( 'content-portfolio.php', array(
								'fallback' => THEMEKIT_PATH . '/includes/portfolio/views/content.php',
								'load' => true,
								'once' => false
							) );
						
						endwhile;
						?>
					</div>
				</div>
			</div>

		<?php endif ?>

	<?php
	wp_reset_postdata();

	return ob_get_clean();
}
