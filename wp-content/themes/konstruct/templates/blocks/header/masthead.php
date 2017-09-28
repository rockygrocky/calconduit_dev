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
<div id="masthead" class="<?php echo esc_attr( op_option( 'header_style' ) ) ?>">
	<div class="wrapper">
		<?php get_template_part( 'templates/blocks/header/brand' ) ?>
		<?php get_template_part( 'templates/blocks/header/navigator' ) ?>
		<?php get_template_part( 'templates/blocks/header/navigator', 'mobile' ) ?>
	</div>
</div>