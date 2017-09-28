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
 * Assets management class
 */
class Konstruct_Assets
{
	/**
	 * Class instance handler
	 * 
	 * @var  konstruct_Advanced
	 */
	private static $instance;

	/**
	 * Initialize advanced theme settings section
	 * 
	 * @return  void
	 */
	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
			self::$instance->hooks();
		}

		return self::$instance;
	}

	/**
	 * Method to register actions/filters hooks
	 * 
	 * @return  void
	 */
	private function hooks() {
		add_action( 'init',   array( $this, 'register' ) );
		add_action( 'wp_enqueue_scripts',   array( $this, 'enqueue' ) );
		add_action( 'wp_enqueue_scripts',   array( $this, 'enqueue_fonts' ) );
		add_action( 'wp_enqueue_scripts',   array( $this, 'combine_fonts' ), 9999 );
		add_action( 'wp_enqueue_scripts',   array( $this, 'remove_unuse_assets' ), 9999 );
		add_action( 'wp_footer',            array( $this, 'print_custom_script' ) );
		add_action( 'customize_save_after', array( $this, 'compile_scheme_styles' ) );
		add_action( 'save_post',            array( $this, 'compile_page_styles' ) );

		// Register filters
		add_filter( 'content_width', array( $this, 'content_width' ) );

		/**
		 * Admin hooks
		 */
		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
		}
	}

	/**
	 * Register assets
	 * 
	 * @return  void
	 */
	public function register() {
		wp_register_style( 'konstruct-3rd', get_template_directory_uri() . '/assets/css/third-party.css', array(), KONSTRUCT_VERSION );
		wp_register_style( 'konstruct-fontawesome', get_template_directory_uri() . '/assets/3rd/font-awesome/css/font-awesome.min.css', array(), KONSTRUCT_VERSION );
		wp_register_style( 'konstruct-sidebars', get_template_directory_uri() . '/assets/admin/css/sidebars.css', array(), KONSTRUCT_VERSION );
		wp_register_style( 'konstruct-widgets', get_template_directory_uri() . '/assets/admin/css/widgets.css', array(), KONSTRUCT_VERSION );
		wp_register_style( 'konstruct-sample-data', get_template_directory_uri() . '/assets/admin/css/sample-data.css', array(), KONSTRUCT_VERSION );
		wp_register_style( 'konstruct', get_template_directory_uri() . '/assets/css/style.css', array( 'konstruct-3rd', 'konstruct-fontawesome' ), KONSTRUCT_VERSION );

		wp_register_script( 'konstruct-page-options', get_template_directory_uri() . '/assets/admin/js/page-options.js', array(), KONSTRUCT_VERSION, true );
		wp_register_script( 'konstruct-sidebars', get_template_directory_uri() . '/assets/admin/js/sidebars.js', array( 'jquery', 'op-options-controls' ), KONSTRUCT_VERSION, true );
		wp_register_script( 'konstruct-widgets', get_template_directory_uri() . '/assets/admin/js/widgets.js', array( 'jquery', 'op-options-controls' ), KONSTRUCT_VERSION, true );
		wp_register_script( 'konstruct-customizer-controls', get_template_directory_uri() . '/assets/admin/js/customizer-controls.js', array( 'jquery', 'op-options-controls', 'customize-base' ), KONSTRUCT_VERSION, true );
		wp_register_script( 'konstruct-customizer-preview', get_template_directory_uri() . '/assets/admin/js/customizer-preview.js', array( 'jquery', 'customize-preview' ), KONSTRUCT_VERSION, true );
		wp_register_script( 'konstruct-sample-data', get_template_directory_uri() . '/assets/admin/js/sample-data.js', array( 'jquery' ), KONSTRUCT_VERSION, true );
		
		wp_register_script( 'konstruct-3rd', get_template_directory_uri() . '/assets/js/theme-3rd.js', array( 'jquery' ), KONSTRUCT_VERSION, true );
		wp_register_script( 'konstruct', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery', 'konstruct-3rd' ), KONSTRUCT_VERSION, true );
	}

	/**
	 * Enqueue assets
	 * 
	 * @return  void
	 */
	public function enqueue() {
		global $wp_customize;

		/**
		 * Theme stylesheets
		 */
		wp_enqueue_style( 'konstruct' );

		if ( is_child_theme() ) {
			wp_enqueue_style( 'konstruct-child', get_stylesheet_uri() );
		}

		/**
		 * Theme scripts
		 */
		if ( op_option( 'blog_archive_layout' ) == 'masonry' ) {
			wp_enqueue_script( 'masonry' );
		}

		wp_enqueue_script( 'konstruct' );
		wp_localize_script( 'konstruct', '_themeConfig', $this->javascript_theme_config() );

		/**
		 * Customizer variables
		 */
		if ( $wp_customize ) {
			wp_localize_script( 'konstruct', '_customizeSettings', array(
				'home' => get_home_url(),
				'blog' => ( get_option( 'show_on_front' ) == 'posts' )
					? get_home_url()
					: get_permalink( get_option( 'page_for_posts' ) )
			) );
		}

		/**
		 * Comment script
		 */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		/**
		 * Generate inline styles for theme
		 */
		$inline_styles = $this->dynamic_styles();
		$inline_styles.= op_option( 'scheme_styles' );
		$inline_styles.= op_option( 'custom_css' );

		wp_add_inline_style( 'konstruct', $inline_styles );
	}

	/**
	 * Enqueue the google fonts
	 * 
	 * @return  void
	 */
	public function enqueue_fonts() {
		global $_options_plus_fonts;

		$body_font    = op_option( 'body_font' );
		$heading_font = op_option( 'heading_font' );
		$menu_font    = op_option( 'menu_font' );

		if ( isset( $_options_plus_fonts['google'][$body_font['family']] ) ||
			 isset( $_options_plus_fonts['google'][$heading_font['family']] ) ||
			 isset( $_options_plus_fonts['google'][$menu_font['family']] ) ) {

			$fonts   = array();
			$subsets = array( 'latin' );

			if ( isset( $_options_plus_fonts['google'][$body_font['family']] ) ) {
				$fonts[] = sprintf( '%s:%s',
					$body_font['family'],
					str_replace( ', ', ',', $_options_plus_fonts['google'][$body_font['family']]['variants'] )
				);
			}

			if ( isset( $_options_plus_fonts['google'][$heading_font['family']] ) ) {
				$fonts[] = sprintf( '%s:%s',
					$heading_font['family'],
					str_replace( ', ', ',', $_options_plus_fonts['google'][$heading_font['family']]['variants'] )
				);
			}

			if ( isset( $_options_plus_fonts['google'][$menu_font['family']] ) ) {
				$fonts[] = sprintf( '%s:%s',
					$menu_font['family'],
					str_replace( ', ', ',', $_options_plus_fonts['google'][$menu_font['family']]['variants'] )
				);
			}

			// Load subsets
			if ( op_option( 'cyrillic_subsets_enabled' ) )
				$subsets[] = 'cyrillic';
			if ( op_option( 'cyrillic_ext_subsets_enabled' ) )
				$subsets[] = 'cyrillic-ext';
			if ( op_option( 'greek_subsets_enabled' ) )
				$subsets[] = 'greek';
			if ( op_option( 'greek_ext_subsets_enabled' ) )
				$subsets[] = 'greek-ext';
			if ( op_option( 'vietnamese_subsets_enabled' ) )
				$subsets[] = 'vietnamese';
			if ( op_option( 'latin_ext_subsets_enabled' ) )
				$subsets[] = 'latin-ext';
			if ( op_option( 'devanagari_subsets_enabled' ) )
				$subsets[] = 'devanagari';

			wp_enqueue_style( 'konstruct-google-fonts', sprintf( '//fonts.googleapis.com/css?family=%s&subset=%s', implode( '|', $fonts ), implode( ',', $subsets ) ) );
		}
	}

	/**
	 * Combine all google fonts to a single URL
	 * 
	 * @return  void
	 */
	public function combine_fonts() {
		global $wp_styles;

		$families = array();
		$subsets  = array();

		foreach ( $wp_styles->queue as $id ) {
			$src = $wp_styles->registered[$id]->src;

			if ( strpos( $src, '//fonts.googleapis.com' ) !== false ) {
				parse_str( parse_url( $src, PHP_URL_QUERY ), $vars );

				if ( isset( $vars['family'] ) ) {
					$fonts = ( strpos( $vars['family'], '|' ) === false )
						? array( $vars['family'] ) : explode( '|', $vars['family'] );	

					foreach ( $fonts as $font ) {
						if ( strpos( $font, ':' ) !== false ) {
							list( $family, $sizes ) = explode( ':', $font );
						}
						else {
							$family = $font;
							$sizes  = '';
						}

						$sizes = array_filter( array_map( 'trim', explode( ',', $sizes ) ) );
						$families[$family] = ( isset( $families[$family] ) )
							? array_merge( $families[$family], $sizes ) : $sizes;

						$families[$family] = array_unique( $families[$family] );
					}
				}

				if ( isset( $vars['subset'] ) ) {
					$vars['subset'] = array_map( 'trim', explode( ',', $vars['subset'] ) );
					$subsets = array_merge( $subsets, $vars['subset'] );
				}

				$wp_styles->dequeue( $id );
			}
		}

		$_families = array();
		$_subsets  = implode( ',', $subsets );

		foreach ( $families as $font => $size )
			$_families[] = sprintf( '%s:%s', urlencode( $font ), implode( ',', $size ) );

		wp_enqueue_style( 'konstruct-combined-google-fonts',
			sprintf( '//fonts.googleapis.com/css?family=%s&subset=%s', implode( '|', $_families ), $_subsets ) );
	}

	/**
	 * Remove unusable assets
	 * 
	 * @return  void
	 */
	public function remove_unuse_assets() {
		wp_dequeue_style( 'prettyphoto' );
		wp_dequeue_script( 'prettyphoto' );
	}

	/**
	 * Print the custom script
	 * 
	 * @return  void
	 */
	public function print_custom_script() {
		$script = op_option( 'custom_js' );

		if ( ! empty( $script ) )
			printf( '<script type="text/javascript">%s</script>', $script );
	}

	/**
	 * Enqueue assets for admin
	 * 
	 * @return  void
	 */
	public function admin_enqueue() {
		global $pagenow;

		if ( current_post_type_is( 'page' ) && in_array( $pagenow, array( 'post-new.php', 'post.php' ) ) ) {
			wp_enqueue_script( 'konstruct-page-options' );
		}
	}

	/**
	 * Return the content width number
	 * 
	 * @return  int
	 */
	public function content_width() {
		return (int) op_option( 'content_width', 1110 );
	}

	/**
	 * Generate custom styles based on theme options
	 * 
	 * @return  string
	 */
	function dynamic_styles() {
		global $_options_plus_fonts;

		$styles = array();

		// Typography
		$heading_fontsize = op_option( 'heading_fontsize' );
		$heading_fontstyle = op_option( 'heading_font' );

		if ( isset( $heading_fontstyle['color'] ) )
			unset( $heading_fontstyle['color'] );

		$styles['body'] = op_typography_styles( op_option( 'body_font' ) );
		$styles['h1, h2, h3, h4, h5, h6'] = op_typography_styles( $heading_fontstyle );

		if ( is_array( $heading_fontsize ) ) {
			foreach ( $heading_fontsize as $index => $size ) {
				if ( $size == 0 ) continue;
				$styles['h' . ( $index + 1 )]['font-size'] = $size . 'px';
			}
		}

		// Menu Font
		$styles['#site-header .menu > li a'] = op_typography_styles( op_option( 'menu_font' ) );

		// Logo
		list( $logo_margin_top, $logo_margin_bottom ) = op_option( 'logo_margin', array( 0, 0 ) );
		$styles['#masthead .brand'] = array(
			'margin-top'    => sprintf( '%dpx', (int) $logo_margin_top ),
			'margin-bottom' => sprintf( '%dpx', (int) $logo_margin_bottom )
		);

		// Topbar styles
		$styles['#headerbar'] = array(
			'background-color' => op_option( 'topbar_bgcolor' ),
			'color' => op_option( 'topbar_textcolor' )
		);

		$predefined_patterns = predefined_background_patterns();

		// Boxed Style
		$styles['body.layout-boxed'] = op_background_styles( $predefined_patterns, op_option( 'boxed_background' ) );

		// Page Header
		$styles['#site-content #page-header'] = op_background_styles( $predefined_patterns, op_option( 'pagetitle_background' ) );
		$styles['#site-content #page-header']['color'] = op_option( 'pagetitle_textcolor' );
		$styles['#site-content #page-header .title'] = array(
			'color' => op_option( 'pagetitle_textcolor' )
		);

		// Page Callout
		$styles['#site-content #page-callout'] = array( 'background-color' => op_option( 'page_callout_background' ) );
		$styles['#site-content #page-callout .callout-content'] = array( 'color' => op_option( 'page_callout_textcolor' ) );

		// Page Footer
		$styles['#site-content #page-footer'] = op_background_styles( $predefined_patterns, op_option( 'footer_widgets_background' ) );
		$styles['#site-content #page-footer']['color'] = op_option( 'footer_widgets_textcolor' );

		// Layout Width
		$selector = '.wrapper,' .
					'body.page-fullwidth #page-body .wrapper .content-wrap .content .vc_row_wrap,' .
					'body.page-fullwidth #page-body #respond,' .
					'body.page-fullwidth #page-body .nocomments';

		$content_width = (int) op_option( 'content_width', 1110 );
		$styles[$selector] = array(
			'width' => "{$content_width}px"
		);

		$selector = 'body.layout-boxed #site-wrapper,' .
					'body.layout-boxed #site-wrapper #masthead-sticky,' .
					'body.layout-boxed #site-wrapper #masthead.header-v7';

		$masthead_width = $content_width + 100;
		$styles[$selector] = array(
			'width' => "{$masthead_width}px"
		);

		$selector = 'body.layout-boxed #site-wrapper,' .
					'body.layout-boxed #site-wrapper #masthead-sticky,' .
					'body.layout-boxed #site-wrapper #masthead.header-v7';

		$wrapper_width = $content_width + 250;
		$styles['.side-menu.layout-boxed #site-wrapper'] = array(
			'width' => "{$wrapper_width}px"
		);

		return str_replace(
				array( "\t", "\r\n", "\n" ),
				array( ' ', ' ', ' ' ),
				op_generate_styles( $styles )
			);
	}

	/**
	 * Generate the custom styles for scheme color
	 * 
	 * @param   string  $color  Color string that will be generated
	 * @return  string
	 */
	function compile_color_styles( $color ) {
		global $wp_filesystem;
		
		if ( ! empty( $color ) && WP_FileSystem() ) {
			require_once get_template_directory() . '/libraries/less/lessc.inc.php';

			$less     = new \Lessc();
			$less->setImportDir( get_template_directory() . '/assets/less' );
			$less->setVariables( array( 'scheme' => $color ) );
			$less->setFormatter( 'compressed' );
			
			return $less->compile(
					$wp_filesystem->get_contents( get_template_directory() . '/assets/less/color.less' )
				);
		}
	}

	/**
	 * Return the config parameters that will accessible by
	 * javascript
	 * 
	 * @return  array
	 */
	function javascript_theme_config() {
		$params = array(
			'stickyHeader'    => op_option( 'header_sticky' ),
			'responsiveMenu'  => true,
			'offCanvas'    => op_option( 'header_show_offcanvas', true ),
			'blogLayout'      => op_option( 'blog_archive_layout' ),

			// Pagination config
			'pagingStyle'     => op_option( 'blog_archive_pagination_style' ),
			'pagingContainer' => '#main-content > .main-content-wrap > .content-inner',
			'pagingNavigator' => '.navigation.paging-navigation.loadmore'
		);

		// Pagination container for search results page
		if ( is_search() ) {
			$params['pagingContainer'] = '#main-content > .main-content-wrap > .content-inner > .search-results';
		}

		// Pagination container for portfolio page
		if ( ( function_exists( 'is_themekit_portfolio' ) && is_themekit_portfolio() ) || is_page_template( 'templates/portfolio.php' ) ) {
			$params['pagingContainer'] = '#main-content > .main-content-wrap > .content-inner > .portfolio-container > .portfolio-entries > .entries-wrapper';
		}

		if ( is_page() ) {
			$page_options = get_post_meta( get_the_ID(), '_page_options', true );

			if ( is_array( $page_options ) && isset( $page_options['onepage_nav_script'] ) && $page_options['onepage_nav_script'] == true ) {
				$params['onepageNavigator'] = true;
			}
		}

		return apply_filters( 'konstruct/javascript_theme_config', $params );
	}

	/**
	 * Handler for customize_save action, we will compile scheme styles
	 * at this point
	 * 
	 * @param   WP_Customize_Manager  $customize  Customize object
	 * @return  void
	 */
	function compile_scheme_styles( $customize ) {
		set_theme_mod( 'scheme_styles',
				$this->compile_color_styles( $customize->get_setting( 'scheme_color' )->value() )
			);
	}

	/**
	 * Compile the page specific styles
	 * 
	 * @param   int  $post_id  The page ID
	 * @return  void
	 */
	function compile_page_styles( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		
		$post = get_post( $post_id );

		if ( $post->post_type == 'page' ) {
			$page_options = get_post_meta( $post_id, '_page_options', true );

			if ( isset( $page_options['enable_custom_styles'] ) && $page_options['enable_custom_styles'] == true ) {
				update_post_meta( $post_id, '_page_styles', $this->compile_color_styles( $page_options['scheme_color'] ) );
			}
		}
	}
}

/**
 * Initialize assets management
 */
konstruct_Assets::instance();
