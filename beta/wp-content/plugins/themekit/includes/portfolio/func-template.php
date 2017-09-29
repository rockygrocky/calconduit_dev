<?php
/**
 * WARNING: This file is part of the Padora theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

/**
 * Show the portfolio entry cover
 * 
 * @return  void
 */
function themekit_entry_cover() {
	$cover_style = themekit_portfolio_option( 'style', 'list' );

	if ( in_array( $cover_style, array( 'list', 'slider', 'grid' ) ) ) {
		if ( count( themekit_entry_media() ) > 0 ) {
			themekit_locate_template( "portfolio-cover-{$cover_style}.php", array(
				'fallback' => THEMEKIT_PATH . "/includes/portfolio/views/cover-{$cover_style}.php",
				'load' => true,
				'once' => false
			) );
		}
	}
}



/**
 * Return all attached media files for an entry
 * 
 * @param   int  $id  Entry ID
 * @return  array
 */
function themekit_entry_media( $id = null ) {
	global $_themekit_entry_media;

	if ( ! is_array( $_themekit_entry_media ) )
		$_themekit_entry_media = array();

	if ( $id == null ) $id = get_the_ID();
	if ( ! isset( $_themekit_entry_media[$id] ) ) {
		$_themekit_entry_media[$id] = themekit_portfolio_option( 'media' );
		$_themekit_entry_media[$id] = json_decode( $_themekit_entry_media[$id], true );
	}

	return $_themekit_entry_media[$id];
}



/**
 * Dipslay plugin's content
 * 
 * @return  void
 */
function themekit_portfolio_content() {
	global $wp_query;

	if ( is_singular( 'portfolio' ) ) {
		// Run the loop
		while ( $wp_query->have_posts() ) {
			$wp_query->the_post();

			themekit_prepare_post_object( $wp_query->post );
			themekit_locate_template( 'content-portfolio-single.php', array(
				'fallback' => THEMEKIT_PATH . '/includes/portfolio/views/content-single.php',
				'load'     => true,
				'once'     => false
			) );
		}

		return;
	}

	/**
	 * Call actions before display portfolio archive content
	 */
	do_action( 'themekit/portfolio/initialize_post_query' );
	do_action( 'pre_get_posts', $wp_query );

	if ( $wp_query->have_posts() ):
		$classes = apply_filters( 'themekit/portfolio/archive_classes', array( 'portfolio-container' ) );

		if ( $show_filters = apply_filters( 'themekit/portfolio/show_the_filters', true ) ) {
			$categories = array();

			while ( $wp_query->have_posts() ) {
				$wp_query->next_post();

				if ( $terms = get_the_terms( $wp_query->post->ID, 'portfolio-category' ) )
					foreach ( $terms as $term )
						$categories[ $term->term_id ] = $term;
			}

			$wp_query->rewind_posts();
		}
		?>
		<div class="<?php esc_attr_e( implode( ' ', $classes ) ) ?>">

			<?php if ( ! empty( $categories ) && count( $categories ) > 0 && $wp_query->post_count > 1 ): ?>
				<div class="portfolio-filters">
					<ul>
						<li data-filter="*" class="active"><a href="#"><?php _e( 'All', 'themekit' ) ?></a></li>
						<?php foreach ( $categories as $term ): ?>

							<li data-filter=".category-<?php esc_attr_e( $term->term_id ) ?>">
								<a href="<?php echo get_term_link( $term ) ?>"><?php esc_html_e( $term->name ) ?></a>
							</li>
						
						<?php endforeach ?>
					</ul>
				</div>
			<?php endif ?>

			<div class="portfolio-entries">
				<div class="entries-wrapper">
					<?php
					/**
					 * Call actions before start the loop
					 */
					do_action( 'themekit/portfolio/above_post_loop' );

					// Run the loop
					while ( $wp_query->have_posts() ):
						$wp_query->the_post();

						themekit_prepare_post_object( $wp_query->post, array(
							'image_size' => apply_filters( 'themekit/portfolio/archive_image_size', 'medium' )
						) );

						themekit_locate_template( 'content-portfolio.php', array(
							'fallback' => THEMEKIT_PATH . '/includes/portfolio/views/content.php',
							'load' => true,
							'once' => false
						) );
					
					endwhile;

					/**
					 * Call actions after the loop
					 */
					do_action( 'themekit/portfolio/below_post_loop' );
					?>
				</div>
			</div>
		</div>

	<?php else:
		
		themekit_locate_template( 'no-portfolio-found.php', array(
			'fallback' => THEMEKIT_PATH . '/includes/portfolio/views/no-portfolio-found.php',
			'load' => true,
			'once' => false
		) );

	endif;
}
