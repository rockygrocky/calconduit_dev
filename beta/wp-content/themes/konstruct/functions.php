<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */
defined( 'ABSPATH' ) or exit;
define( 'KONSTRUCT_VERSION', '1.1.1' );

$GLOBALS['revSliderAsTheme'] = true;
$GLOBALS['lsAutoUpdateBox']  = false;


if ( ! function_exists( 'konstruct_requirement_check' ) ):
	add_action( 'after_switch_theme', 'konstruct_requirement_check', 10, 2 );

	/**
	 * Check the theme requirements
	 */
	function konstruct_requirement_check( $name, $theme ) {
	    if ( version_compare( PHP_VERSION, '5.3', '<' ) ):
			add_action( 'admin_notices', 'konstruct_requirement_notice' );

			function konstruct_requirement_notice() {
				printf( '<div class="error"><p>%s</p></div>',
					__( 'Sorry! Your server does not meet the minimum requirements, please upgrade PHP version to 5.3 or higher', 'mountain' ) );
			}

			// Switch back to previous theme
			switch_theme( $theme->stylesheet );
		endif;
	}
endif;



if ( version_compare( PHP_VERSION, '5.3', '>=' ) ):
	/**
	 * Override visual-composer classes
	 */
	add_filter( 'vc_path_filter', function( $path ) {
		$file = basename( $path );

		if  ( file_exists( __DIR__ . '/includes/integrate/vc-updater/' . $file ) )
			$path = __DIR__ . '/includes/integrate/vc-updater/' . $file;

		return $path;
	} );

	// Plugin Activation
	require_once trailingslashit( get_template_directory() ) . 'libraries/plugin-activation/plugin-activation.php';

	// Core
	require_once trailingslashit( get_template_directory() ) . 'includes/options-plus.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/helpers.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/template.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/assets.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/wrapper.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/widget.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/breadcrumb.php';

	// Theme admin
	require_once trailingslashit( get_template_directory() ) . 'includes/admin/sample-data.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/admin/advanced.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/admin/sidebars.php';

	// Theme widgets
	require_once trailingslashit( get_template_directory() ) . 'includes/widgets/recent-portfolios.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/widgets/recent-posts.php';

	// Third-party integration
	require_once trailingslashit( get_template_directory() ) . 'includes/integrate/visual-composer.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/integrate/woocommerce.php';

	// Theme options
	require_once trailingslashit( get_template_directory() ) . 'includes/options-definition.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/options.php';

	// Theme setup
	require_once trailingslashit( get_template_directory() ) . 'includes/bootstrap.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/structure.php';

	// Plugin Integration
	if ( defined( 'THEMEKIT_VERSION' ) ) {
		// Disable style of shortcode plugin
		add_filter( 'themekit_enqueue_shortcodes_style', '__return_false' );

		require_once trailingslashit( get_template_directory() ) . 'includes/portfolio.php';
		require_once trailingslashit( get_template_directory() ) . 'includes/shortcodes/iconbox.php';
		require_once trailingslashit( get_template_directory() ) . 'includes/shortcodes/iconlist.php';
		require_once trailingslashit( get_template_directory() ) . 'includes/shortcodes/testimonial.php';
		require_once trailingslashit( get_template_directory() ) . 'includes/shortcodes/member.php';
		require_once trailingslashit( get_template_directory() ) . 'includes/shortcodes/imagebox.php';
		require_once trailingslashit( get_template_directory() ) . 'includes/shortcodes/counter.php';
		require_once trailingslashit( get_template_directory() ) . 'includes/shortcodes/countdown.php';
		require_once trailingslashit( get_template_directory() ) . 'includes/shortcodes/openhours.php';
		require_once trailingslashit( get_template_directory() ) . 'includes/shortcodes/portfolio.php';
		require_once trailingslashit( get_template_directory() ) . 'includes/shortcodes/posts.php';
		require_once trailingslashit( get_template_directory() ) . 'includes/shortcodes/pricing-table.php';
	}
endif;
