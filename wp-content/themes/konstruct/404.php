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
<div class="content-inner">
	<div class="heading-404">
		<img src="<?php echo esc_attr( trailingslashit( get_template_directory_uri() ) ) ?>assets/img/404.png" alt="404" />
		<?php // _e( '404', 'konstruct' ) ?>
	</div>
	<div class="content-404">
		<h3><?php _e( 'Looks Like Something Went Wrong!', 'konstruct' ) ?></h3>
		<p><?php _e( 'The page you were looking for is not here. Maybe you want to perform a search?', 'konstruct' ); ?></p>

		<?php get_search_form(); ?>

	</div>
</div>
<!-- /.content-inner -->