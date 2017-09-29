<?php
/**
 * @package     WordPress
 * @subpackage  Themes
 * @author      Binh Pham Thanh <binhpham@linethemes.com>
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

if ( ! class_exists( 'Vc_Manager' ) )
	return;

vc_set_shortcodes_templates_dir( get_template_directory() . '/templates/vc' );

if ( ! function_exists( 'konstruct_vs_params' ) ) {
	add_action( 'admin_init', 'konstruct_vs_params' );

	/**
	 * This action will register custom parameter for visual composer
	 * shortcodes
	 * 
	 * @return  void
	 */
	function konstruct_vs_params() {
		/**
		 * Row params
		 */
		vc_add_param( 'vc_row', array(
			'type'             => 'colorpicker',
			'heading'          => __( 'Font Color', 'konstruct' ),
			'param_name'       => 'font_color',
			'description'      => __( 'Select font color', 'konstruct' ),
			'edit_field_class' => 'vc_col-md-6 vc_column'
		) );

		vc_add_param( 'vc_row', array(
			'type'        => 'textfield',
			'heading'     => __( 'Row ID', 'konstruct' ),
			'param_name'  => 'el_id',
			'description' => __( 'Enter custom ID for this row', 'konstruct' ),
		) );

		vc_add_param( 'vc_row', array(
			'type'        => 'checkbox',
			'heading'     => __( 'Enable Content Width 100%', 'konstruct' ),
			'param_name'  => 'width_100',
			'value'       => array(
				__( 'Yes, please', 'konstruct' ) => 'yes'
			)
		) );

		vc_add_param( 'vc_row', array(
			'type'        => 'checkbox',
			'heading'     => __( 'Enable Background Parallax Effect', 'konstruct' ),
			'param_name'  => 'parallax_effect',
			'group'       => __( 'Design options', 'konstruct' ),
			'value'       => array(
				__( 'Yes, please', 'konstruct' ) => 'yes'
			)
		) );

		vc_add_param( 'vc_row', array(
			'type'        => 'textfield',
			'heading'     => __( 'Parallax Animation Speed', 'konstruct' ),
			'param_name'  => 'parallax_speed',
			'group'       => __( 'Design options', 'konstruct' ),
			'value'       => 4
		) );

		vc_add_param( 'vc_row', array(
			'type'        => 'textfield',
			'heading'     => __( 'Parallax X Offset', 'konstruct' ),
			'param_name'  => 'parallax_x',
			'group'       => __( 'Design options', 'konstruct' ),
			'value'       => 4
		) );

		vc_add_param( 'vc_row', array(
			'type'        => 'textfield',
			'heading'     => __( 'Parallax Y Offset', 'konstruct' ),
			'param_name'  => 'parallax_y',
			'group'       => __( 'Design options', 'konstruct' ),
			'value'       => 4
		) );

		/**
		 * Tabs params
		 */
		vc_add_param( 'vc_tabs', array(
			'type'        => 'dropdown',
			'heading'     => __( 'Tabs Style', 'konstruct' ),
			'param_name'  => 'style',
			'value'       => array(
				__( 'Tab Style 1', 'konstruct' ) => 'style_1',
				__( 'Tab Style 2', 'konstruct' ) => 'style_2'
			)
		) );

		vc_add_param( 'vc_tabs', array(
			'type'        => 'dropdown',
			'heading'     => __( 'Tabs Alignment', 'konstruct' ),
			'param_name'  => 'align',
			'value'       => array(
				__( 'Left', 'konstruct' ) => 'left',
				__( 'Center', 'konstruct' ) => 'center',
				__( 'Right', 'konstruct' ) => 'right'
			)
		) );

		/**
		 * Tour
		 */
		vc_add_param( 'vc_tour', array(
			'type'        => 'dropdown',
			'heading'     => __( 'Navigator Position', 'konstruct' ),
			'param_name'  => 'align',
			'value'       => array(
				__( 'Left', 'konstruct' ) => 'left',
				__( 'Right', 'konstruct' ) => 'right'
			)
		) );

		vc_add_param( 'vc_tour', array(
			'type'        => 'dropdown',
			'heading'     => __( 'Style', 'konstruct' ),
			'param_name'  => 'style',
			'value'       => array(
				__( 'Style 1', 'konstruct' ) => 'style_1',
				__( 'Style 2', 'konstruct' ) => 'style_2'
			)
		) );

		/**
		 * Accordion
		 */
		vc_add_param( 'vc_accordion', array(
			'type'        => 'dropdown',
			'heading'     => __( 'Style', 'konstruct' ),
			'param_name'  => 'style',
			'value'       => array(
				__( 'Style 1', 'konstruct' ) => 'style_1',
				__( 'Style 2', 'konstruct' ) => 'style_2'
			)
		) );

		/**
		 * Progress Bar
		 */
		vc_add_param( 'vc_progress_bar', array(
			'type'        => 'dropdown',
			'heading'     => __( 'Bars Style', 'konstruct' ),
			'param_name'  => 'style',
			'value'       => array(
				__( 'Style 1', 'konstruct' ) => 'style_1',
				__( 'Style 2', 'konstruct' ) => 'style_2'
			)
		) );

		/**
		 * Single Image
		 */
		vc_add_param( 'vc_single_image', array(
			'type'        => 'checkbox',
			'heading'     => __( 'Enable Lightbox For This Image', 'konstruct' ),
			'param_name'  => 'lightbox',
			'value'       => array(
				__( 'Yes, please', 'konstruct' ) => 'yes'
			)
		) );
	}
}



if ( ! function_exists( 'konstruct_vc_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'konstruct_vc_scripts', 999 );

	/**
	 * Unregister visual composer styles and scripts
	 * 
	 * @return  void
	 */
	function konstruct_vc_scripts() {
		wp_deregister_script( 'prettyphoto' );
		wp_deregister_style( 'prettyphoto' );
		wp_deregister_style( 'isotope' );
		wp_deregister_style( 'flexslider' );
		wp_deregister_style( 'waypoints' );
	}
}
