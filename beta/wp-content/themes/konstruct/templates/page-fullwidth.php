<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

/**
 * Template Name: Page - Fullwidth
 */
?>
<div class="content-inner">
	<?php while ( have_posts() ): the_post(); ?>
		<?php the_content() ?>
	<?php endwhile ?>
</div>
<!-- /.content-inner -->
