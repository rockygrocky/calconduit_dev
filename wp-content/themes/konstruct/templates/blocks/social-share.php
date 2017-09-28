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
<div class="social-share layout-<?php echo esc_attr( op_option( 'social_sharing_layout' ) ) ?> style-<?php echo esc_attr( op_option( 'social_sharing_style' ) ) ?>">
	<?php if ( $box_title = op_option( 'social_sharing_heading' ) ): ?>
		<h3><?php echo wp_kses( $box_title ) ?></h3>
	<?php endif ?>

	<ul>
		<?php if ( op_option( 'social_share_facebook' ) ): ?>
		<li class="share-facebook">
			<a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>">
				<i class="fa fa-facebook"></i>
			</a>
		</li>
		<?php endif ?>

		<?php if ( op_option( 'social_share_twitter' ) ): ?>
		<li class="share-twitter">
			<a href="http://twitter.com/share?text=<?php the_title() ?>&url=<?php the_permalink() ?>">
				<i class="fa fa-twitter"></i>
			</a>
		</li>
		<?php endif ?>

		<?php if ( op_option( 'social_share_googleplus' ) ): ?>
		<li class="share-googleplus">
			<a href="https://plus.google.com/share?url=<?php the_permalink() ?>">
				<i class="fa fa-google-plus"></i>
			</a>
		</li>
		<?php endif ?>
		
		<?php if ( op_option( 'social_share_pinterest' ) ): ?>
		<li class="share-pinterest">
			<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>">
				<i class="fa fa-pinterest"></i>
			</a>
		</li>
		<?php endif ?>

		<?php if ( op_option( 'social_share_linkedin' ) ): ?>
		<li class="share-linkedin">
			<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title() ?>">
				<i class="fa fa-linkedin"></i>
			</a>
		</li>
		<?php endif ?>
	</ul>
</div>