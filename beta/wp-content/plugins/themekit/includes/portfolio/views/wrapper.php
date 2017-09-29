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
 * Get the theme header
 */
get_header( 'portfolio' );

/**
 * Call actions before display the main content of
 * the portfolio
 */
do_action( 'themekit/portfolio/above_content' );

/**
 * Output the module's content
 */
themekit_portfolio_content();

/**
 * Call actions before display the main content of
 * the portfolio
 */
do_action( 'themekit/portfolio/below_content' );

/**
 * Get the theme footer
 */
get_footer( 'portfolio' );
