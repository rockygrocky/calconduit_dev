<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

// Ignore output the modal content element when it is disabled
if ( ! op_option( 'header_show_offcanvas', true ) ) return;
?>
<div id="site-off-canvas">
	<span class="close"></span>
	<div class="wrapper">
		<?php dynamic_sidebar( apply_filters( 'konstruct/off_canvas_sidebar', 'off-canvas' ) ); ?>
	</div>
</div>
<!-- /#site-off-canvas -->
