<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();
?>
<!DOCTYPE html>
<html <?php language_attributes() ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">

		<?php if ( version_compare( get_bloginfo( 'version' ), '4.1', '<' ) ): ?>
			<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php endif ?>

		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />

		<?php wp_head() ?>
	</head>
	<body <?php body_class() ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
		<?php do_action( 'get_header' ) ?>
		<?php do_action( 'konstruct/above_site_wrapper' ) ?>

		<?php $page_options = get_post_meta( get_the_ID(), '_page_options', true ) ?>

		<div id="site-wrapper">
			<?php if ( is_array( $page_options ) && ! empty( $page_options['page_cover_content'] ) ): ?>
				<?php do_action( 'konstruct/above_site_cover' ) ?>

				<div id="site-cover">
					<?php echo do_shortcode( $page_options['page_cover_content'] ) ?>
				</div>
				<!-- /#site-cover -->
				
				<?php do_action( 'konstruct/below_site_cover' ) ?>
			<?php endif ?>

			<?php do_action( 'konstruct/above_site_header' ) ?>

			<div id="site-header">
				<?php get_template_part( 'templates/blocks/header/topbar' ) ?>
				<?php get_template_part( 'templates/blocks/header/masthead', op_option( 'header_style' ) ) ?>
			</div>
			<!-- /#site-header -->

			<?php do_action( 'konstruct/below_site_header' ) ?>
			<?php do_action( 'konstruct/above_site_content' ) ?>
			
			<div id="site-content">
				<?php get_template_part( 'templates/blocks/content/header' ) ?>
				<?php do_action( 'konstruct/above_page_body' ) ?>

				<div id="page-body">
					<div class="wrapper">
						<?php do_action( 'konstruct/above_content_wrap' ) ?>

						<div class="content-wrap">
							<?php do_action( 'konstruct/above_main_content' ) ?>
						
							<main id="main-content" class="content" role="main" itemprop="mainContentOfPage">
								<div class="main-content-wrap">
									<?php include konstruct_template_path() ?>
								</div>
							</main>
							<!-- /#main-content -->
						
							<?php do_action( 'konstruct/below_main_content' ) ?>
							<?php get_sidebar() ?>
						</div>
						<!-- /.content-wrap -->
						
						<?php do_action( 'konstruct/below_content_wrap' ) ?>
					</div>
					<!-- /.wrapper -->
				</div>
				<!-- /#page-body -->

				<?php do_action( 'konstruct/below_page_body' ) ?>
				<?php get_template_part( 'templates/blocks/content/callout' ) ?>
				<?php get_template_part( 'templates/blocks/content/widgets' ) ?>
			</div>
			<!-- /#site-content -->
			
			<?php do_action( 'konstruct/below_site_content' ) ?>
			<?php do_action( 'konstruct/above_site_footer' ) ?>
			<div id="site-footer">
				<div class="wrapper">
					<?php get_template_part( 'templates/blocks/footer/social-links' ) ?>
					<?php get_template_part( 'templates/blocks/footer/copyright' ) ?>
				</div>
				<!-- /.wrapper -->
			</div>
			<!-- /#site-footer -->
		</div>
		<!-- /#site-wrapper -->

		<?php if ( op_option( 'gotop_enabed' ) ): ?>
			<div class="goto-top"><a href="#top"><?php _e( 'Goto Top', 'konstruct' ) ?></a></div>
		<?php endif ?>

		<?php do_action( 'konstruct/below_site_wrapper' ) ?>
		<?php get_template_part( 'templates/blocks/header/off-canvas' ) ?>
		<?php wp_footer() ?>
	</body>
</html>