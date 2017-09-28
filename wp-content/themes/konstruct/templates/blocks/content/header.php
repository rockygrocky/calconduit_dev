<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

// Ignore output content header section when it isn't available
if ( ! op_option( 'pagetitle_enabled' ) ) return;
?>
<div id="page-header">
	<div class="wrapper">
		<?php get_template_part( 'templates/blocks/content/header', 'title' ) ?>
		<?php 

			if ( op_option( 'breadcrumb_enabled', true ) ):

				breadcrumb_trail( array(
					'separator'   => op_option( 'breadcrumb_separator', '/' ),
					'show_browse' => true,
					'labels'      => array(
						'browse'  => op_option( 'breadcrumb_prefix', __( 'You are here:', 'konstruct' ) ),
						'home'    => __( 'Home', 'konstruct' )
					)
				) );
			
			endif;

		?>
	</div>
	<!-- /.wrapper -->
</div>
<!-- /#page-header -->
