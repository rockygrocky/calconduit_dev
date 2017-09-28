<?php
/**
 * WARNING: This file is part of the ThemeKit plugin. DO NOT edit
 * this file under any circumstances.
 */
defined( 'ABSPATH' ) or exit;


class ThemeKit_Settings
{
	private static $instance;

	/**
	 * Admin menu handler
	 * 
	 * @var  string
	 */
	private $menu;

	/**
	 * Return instance of ThemeKit_Settings
	 *
	 * @var  ThemeKit_Settings
	 */
	public static function instance() {
		if ( self::$instance == null )
			self::$instance = new self();

		return self::$instance;
	}

	/**
	 * Class constructor
	 */
	private function __construct() {
		if ( ! is_admin() ) return;

		add_action( 'admin_init' , array( $this , 'settings_init' ) );
		add_action( 'admin_init' , array( $this , 'settings_save' ) );
	}

	public function settings_init() {
		// Add a section to the permalinks page
		add_settings_section( 'themekit-portfolio-permalink', __( 'Portfolio permalink settings', 'themekit' ), array( $this, 'settings' ), 'permalink' );
	}

	/**
	 * Show the settings.
	 */
	public function settings() {
		$permalinks = get_option( 'themekit_portfolio_permalinks' );

		echo wpautop( __( 'These settings control the permalinks used for portfolios.', 'themekit' ) );
		?>

			<table class="form-table">
				<tbody>
					<tr>
						<th><label for="themekit_portfolio_base"><?php _e( 'Portfolio Base', 'themekit' ); ?></label></th>
						<td><input type="text" id="themekit_portfolio_base" name="themekit_portfolio_base" class="regular-text code" value="<?php if ( isset( $permalinks['portfolio_base'] ) ) esc_attr_e( $permalinks['portfolio_base'] ); ?>" placeholder="portfolio" /></td>
					</tr>

					<tr>
						<th><label for="themekit_portfolio_category_base"><?php _e( 'Category Base', 'themekit' ); ?></label></th>
						<td><input type="text" id="themekit_portfolio_category_base" name="themekit_portfolio_category_base" class="regular-text code" value="<?php if ( isset( $permalinks['category_base'] ) ) esc_attr_e( $permalinks['category_base'] ); ?>" placeholder="portfolio-category" /></td>
					</tr>

					<tr>
						<th><label for="themekit_portfolio_tag_base"><?php _e( 'Tag Base', 'themekit' ); ?></label></th>
						<td><input type="text" id="themekit_portfolio_tag_base" name="themekit_portfolio_tag_base" class="regular-text code" value="<?php if ( isset( $permalinks['tag_base'] ) ) esc_attr_e( $permalinks['tag_base'] ); ?>" placeholder="portfolio-tag" /></td>
					</tr>
				</tbody>
			</table>

		<?php
	}

	public function settings_save() {
		if ( isset( $_POST['themekit_portfolio_base'] ) &&
			 isset( $_POST['themekit_portfolio_category_base'] ) &&
			 isset( $_POST['themekit_portfolio_tag_base'] ) )
		{
			update_option( 'themekit_portfolio_permalinks', array(
				'portfolio_base' => untrailingslashit( strip_tags( $_POST['themekit_portfolio_base'] ) ),
				'category_base'  => untrailingslashit( strip_tags( $_POST['themekit_portfolio_category_base'] ) ),
				'tag_base'       => untrailingslashit( strip_tags( $_POST['themekit_portfolio_tag_base'] ) )
			) );
		}
	}
}

add_action( 'plugins_loaded', 
	array( 'ThemeKit_Settings', 'instance' )
);
