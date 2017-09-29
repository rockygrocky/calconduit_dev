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
<nav id="site-navigator" class="<?php echo esc_attr( op_classes( 'navigator', 'konstruct/masthead_navigator_class' ) ) ?>"
	itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
	
	<?php
	/**
	 * Call actions before display primary menu
	 */
	do_action( 'konstruct/before_primary_menu', array( 'env' => 'desktop' ) );

	/**
	 * Display the primary menu
	 */
	wp_nav_menu( array(
		'theme_location'  => 'primary',
		'container'       => false,
		'menu_class'      => 'menu',
		'fallback_cb'     => false,
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0
	) );

	/**
	 * Call actions after display primary menu
	 */
	do_action( 'konstruct/after_primary_menu', array( 'env' => 'desktop' ) );
	?>

</nav>
