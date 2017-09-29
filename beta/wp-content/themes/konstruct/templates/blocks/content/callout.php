<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

// Ignore output page callout section when it isn't available
if ( ! op_option( 'page_callout_enabled' ) ) return;
?>
<div id="page-callout">
	<div class="wrapper">
		<h2 class="callout-content"><?php echo op_option( 'page_callout_content' ) ?></h2>
		<!-- /.callout-content -->
		
		<div class="callout-toolbar">
			<a href="<?php echo esc_attr( op_option( 'page_callout_button_link' ) ) ?>" target="<?php echo esc_attr( op_option( 'page_callout_button_target' ) ) ?>" class="callout-button <?php echo esc_attr( op_option( 'page_callout_button_class' ) ) ?>">
				<?php echo op_option( 'page_callout_button_text' ) ?>
			</a>
		</div>
		<!-- /.callout-toolbar -->
	</div>
	<!-- /.wrapper -->
</div>
<!-- /#page-callout -->