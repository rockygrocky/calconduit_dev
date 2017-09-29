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
?>
<div class="<?php esc_attr_e( implode( ' ', $classes ) ) ?>">
	<div class="portfolio-entries">
		<article class="portfolio-item">
			<div class="entry-wrapper">
				<div class="entry-cover cover-<?php esc_attr_e( themekit_portfolio_option( 'style' ) ) ?>">
					<?php themekit_entry_cover() ?>
				</div>

				<div class="entry-content">
					<div class="entry-description">
						<h3><?php _e( 'Project Description', 'sp' ) ?></h3>
						<div class="entry-desc-content">
							<?php the_content() ?>
						</div>
					</div>

					<div class="entry-details">
						<h3><?php _e( 'Project Details', 'sp' ) ?></h3>
						<ul class="entry-details-content">
							<?php if ( get_the_terms( get_the_ID(), 'portfolio-category' ) ): ?>
								
								<li class="categories">
									<strong><?php _e( 'Categories:', 'sp' ) ?></strong>
									<p><?php the_terms( get_the_ID(), 'portfolio-category', '', '<span class="divider">, </span>', '' ); ?></p>
								</li>

							<?php endif ?>
							
							<?php if ( get_the_terms( get_the_ID(), 'portfolio-tag' ) ): ?>
								
								<li class="tags">
									<strong><?php _e( 'Tags:', 'sp' ) ?></strong>
									<p><?php the_terms( get_the_ID(), 'portfolio-tag', '', '<span class="divider">, </span>', '' ); ?></p>
								</li>

							<?php endif ?>
							
							<?php if ( themekit_portfolio_option( 'client', false ) ): ?>

								<li class="client">
									<strong><?php _e( 'Client:', 'sp' ) ?></strong>
									<?php if ( filter_var( themekit_portfolio_option( 'website' ), FILTER_VALIDATE_URL ) ): ?>
										<p><a href="<?php echo themekit_portfolio_option( 'website' ) ?>" target="_blank"><?php echo themekit_portfolio_option( 'client' ) ?></a></p>
									<?php else: ?>
										<p><?php esc_html_e( themekit_portfolio_option( 'client' ) ) ?></p>
									<?php endif ?>
								</li>

							<?php endif ?>

							<?php if ( themekit_portfolio_option( 'project_url', false ) && filter_var( themekit_portfolio_option( 'project_url', false ), FILTER_VALIDATE_URL ) ): ?>

								<li class="project-url">
									<strong><?php _e( 'Project URL:', 'sp' ) ?></strong>
									<p><a href="<?php echo esc_url( themekit_portfolio_option( 'project_url' ) ) ?>" target="_blank"><?php _e( 'View Project', 'sp' ) ?></a></p>
								</li>

							<?php endif ?>
						</ul>
					</div>
				</div>
			</div>
		</article>
	</div>
</div>
