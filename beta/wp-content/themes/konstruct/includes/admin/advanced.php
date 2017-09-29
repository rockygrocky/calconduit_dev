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
 * This class will be present the advanced settings page
 * that will allow user compose custom styles & scripts
 */
class Konstruct_Advanced
{
	/**
	 * Class instance handler
	 * 
	 * @var  konstruct_Advanced
	 */
	private static $instance;

	/**
	 * The options container
	 * 
	 * @var  \OptionsPlus\Options\Container
	 */
	private $container;

	/**
	 * Initialize advanced theme settings section
	 * 
	 * @return  void
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
		if ( ! is_admin() )
			return;
		
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'wp_ajax_save_advanced_settings', array( $this, 'save' ) );

		$this->container = new \OptionsPlus\Options\Container( array(
			'show_tabs' => false,
			'sections' => array(
				'all' => array( 'title' => __( 'Custom CSS', 'konstruct' ) )
			),
			'controls' => array(
				'custom_css_heading' => array(
					'type'        => 'heading',
					'title'       => __( 'Custom CSS', 'konstruct' ),
					'section'     => 'all'
				),

				'custom_css' => array(
					'type'    => 'code',
					'mode'    => 'css',
					'section' => 'all'
				),

				'custom_js_heading' => array(
					'type'        => 'heading',
					'title'       => __( 'Custom Javascript', 'konstruct' ),
					'section'     => 'all'
				),

				'custom_js' => array(
					'type'    => 'code',
					'mode'    => 'javascript',
					'section' => 'all'
				)
			)
		) );
	}

	/**
	 * Register admin menu
	 * 
	 * @return  void
	 */
	public function admin_menu() {
		add_theme_page( __( 'Advanced Settings', 'konstruct' ),
						__( 'Advanced', 'konstruct' ),
						'edit_theme_options', 'advanced-settings', array( $this, 'admin_page' ) );
	}

	/**
	 * Render the admin page
	 * 
	 * @return  void
	 */
	public function admin_page() {
		$this->container->bind( array(
				'custom_css' => op_option( 'custom_css' ),
				'custom_js'  => op_option( 'custom_js' )
			) );
		?>

			<div class="wrap">
				<div id="advanced-settings">
					<h2><?php _e( 'Advanced Theme Settings', 'konstruct' ) ?></h2>
					<?php $this->notices() ?>

					<form method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ) ?>?action=save_advanced_settings">
						<?php $this->container->render( array( 'output' => true ) ) ?>

						<p class="form-actions">
							<button type="submit" id="save-options" class="button button-primary"><?php _e( 'Save Settings', 'konstruct' ) ?></button>
						</p>
					</form>
				</div>
			</div>

		<?php
	}

	/**
	 * Enqueue script for sample data installation page
	 * 
	 * @return  void
	 */
	public function enqueue( $page ) {
		if ( $page == 'appearance_page_advanced-settings' ) {
			$this->container->enqueue();

			wp_enqueue_style( 'konstruct-settings' );
		}
	}

	/**
	 * Save form data
	 * 
	 * @return  void
	 */
	public function save() {
		$redirect_location = admin_url( 'themes.php' ) . '?page=advanced-settings';

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['op-options'] ) ) {
			foreach ( $_POST['op-options'] as $name => $value )
				set_theme_mod( $name, stripslashes_deep( $value ) );

			$redirect_location.= '&message=1';
		}

		wp_redirect( $redirect_location );
		exit;
	}

	/**
	 * Display message after save custom style and script
	 * 
	 * @return  void
	 */
	public function notices() {
		if ( isset( $_REQUEST['message'] ) && $_REQUEST['message'] ) {
			?>

				<div class="updated">
					<p><?php _e( 'Updated!', 'konstruct' ); ?></p>
				</div>

			<?php
		}
	}
}

/**
 * Initialize advanced section
 */
konstruct_Advanced::instance();
