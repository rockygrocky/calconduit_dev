<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

// Ignore ouput topbar when it isn't enabled
if ( ! op_option( 'topbar_enabled' ) ) return;

$available_icons = op_available_social_icons();
$social_links    = op_option( 'social_links' );

if ( ! isset( $social_links['__icons_ordering__'] ) ) {
	$social_links['__icons_ordering__'] = $available_icons['__icons_ordering__'];
}
?>
<div id="headerbar">
	<div class="wrapper">
		<div class="custom-info">
			<?php echo op_option( 'topbar_content' ) ?>
		</div>
		<!-- /.custom-info -->

		<?php if ( op_option( 'topbar_social_links_enabled' ) ): ?>
			<div class="social-links">
				<?php foreach ( $social_links['__icons_ordering__'] as $id ):
					if ( ! isset( $available_icons[$id] ) || ! isset( $social_links[$id] ) )
						continue;

					$link = $social_links[$id];
					$icon_class = $available_icons[$id]['icon_class'];
					?>
					<a href="<?php echo esc_url( $link ) ?>" target="_blank">
						<i class="fa <?php echo esc_attr( $icon_class ) ?>"></i>
					</a>
				<?php endforeach ?>
			</div>
			<!-- /.social-links -->
		<?php endif ?>
	</div>
	<!-- /.wrapper -->
</div>
<!-- /#headerbar -->