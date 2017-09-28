<?php
/**
 * WARNING: This file is part of the Sparky framework. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

$content_position = themekit_portfolio_option( 'content_position' );
$content_sticky = themekit_portfolio_option( 'content_sticky' );

$classes = array( 'portfolio-container', 'portfolio-single', "portfolio-content-{$content_position}" );

if ( ( $content_position == 'left' || $content_position == 'right' ) && $content_sticky )
	$classes[] = 'portfolio-content-sticky';

$classes = implode( ' ', $classes );
?>
<div class="<?php echo esc_attr( $classes ) ?>">
	<div class="portfolio-entries">
		<article class="portfolio-item">
			<div class="entry-wrapper">
				<div class="entry-cover cover-<?php echo esc_attr( themekit_portfolio_option( 'style' ) ) ?>">
					<?php themekit_entry_cover() ?>
				</div>

				<div class="entry-content">
					<div class="entry-details">
						<h3><?php _e( 'Project Details', 'konstruct' ) ?></h3>
						<ul class="entry-details-content">
							
								<li class="date">
									<strong><?php _e( 'Construction Date', 'konstruct' ) ?></strong>
									<?php if ( $date = themekit_portfolio_option( 'date' ) ): ?>
										<p><?php echo esc_html( $date ) ?></p>
									<?php else: ?>
										<p><?php the_date() ?></p>
									<?php endif ?>
								</li>

							<?php if ( $location = themekit_portfolio_option( 'location' ) ): ?>
								<li class="location">
									<strong><?php _e( 'Location', 'konstruct' ) ?></strong>
									<p><?php echo esc_html( $location ) ?></p>
								</li>
							<?php endif ?>

							<?php if ( $surface_area = themekit_portfolio_option( 'surface_area' ) ): ?>
								<li class="surface-area">
									<strong><?php _e( 'Surface Area', 'konstruct' ) ?></strong>
									<p><?php echo esc_html( $surface_area ) ?></p>
								</li>
							<?php endif ?>

							<?php if ( $investor = themekit_portfolio_option( 'investor' ) ): ?>
								<li class="investor">
									<strong><?php _e( 'Construction Investor', 'konstruct' ) ?></strong>
									<p><?php echo esc_html( $investor ) ?></p>
								</li>
							<?php endif ?>

							<?php if ( $value = themekit_portfolio_option( 'value' ) ): ?>
								<li class="value">
									<strong><?php _e( 'Value', 'konstruct' ) ?></strong>
									<p><?php echo esc_html( $value ) ?></p>
								</li>
							<?php endif ?>

							<?php if ( get_the_terms( get_the_ID(), 'portfolio-category' ) ): ?>
								<li class="categories">
									<strong><?php _e( 'Categories:', 'konstruct' ) ?></strong>
									<p><?php the_terms( get_the_ID(), 'portfolio-category', '', '<span class="divider">, </span>', '' ); ?></p>
								</li>
							<?php endif ?>
							
							<?php if ( get_the_terms( get_the_ID(), 'portfolio-tag' ) ): ?>
								<li class="tags">
									<strong><?php _e( 'Tags:', 'konstruct' ) ?></strong>
									<p><?php the_terms( get_the_ID(), 'portfolio-tag', '', '<span class="divider">, </span>', '' ); ?></p>
								</li>
							<?php endif ?>
						</ul>
					</div>

					<div class="entry-description">
						<h3><?php _e( 'Project Description', 'konstruct' ) ?></h3>
						<div class="entry-desc-content">
							<?php the_content() ?>
						</div>
					</div>
				</div>
			</div>
		</article>
	</div>
</div>
