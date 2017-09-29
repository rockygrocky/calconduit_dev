<?php
/**
 * WARNING: This file is part of the UI-Pack plugin. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

add_action( 'admin_init', 'themekit_shortcode_imagebox_params' );
add_shortcode( 'imagebox', 'themekit_shortcode_imagebox' );


function themekit_shortcode_imagebox( $atts, $content = '' ) {
	ob_start();

	if ( $template = locate_template( 'templates/shortcodes/imagebox.php' ) ) {
		include $template;
	}
	else {
		include __DIR__ . '/templates/imagebox.php';
	}

	return ob_get_clean();
}

function themekit_shortcode_imagebox_params() {
	vc_map( array(
		'name'          => __( 'LineThemes: Image Box', 'themekit' ),
		'base'          => 'imagebox',
		'icon'          => 'themekit-shortcode',
		'category'      => 'LineThemes'
	) );

	vc_map_update( 'imagebox', array(
		'params'      => array(
			// Title
			array(
				'type'             => 'textfield',
				'heading'          => __( 'Title', 'themekit' ),
				'param_name'       => 'title'
			),

			array(
				'type'             => 'textfield',
				'heading'          => __( 'Subtitle', 'themekit' ),
				'param_name'       => 'subtitle'
			),

			array(
				'type'       => 'textarea',
				'heading'    => __( 'Description', 'themekit' ),
				'param_name' => 'content'
			),

			array(
				'type'       => 'attach_image',
				'heading'    => __( 'Image', 'themekit' ),
				'param_name' => 'image'
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'Image Size', 'themekit' ),
				'param_name' => 'image_size',
				'value'      => 'full'
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'Link', 'themekit' ),
				'param_name' => 'link'
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Link Target', 'themekit' ),
				'param_name' => 'target',
				'value'      => array(
					'_self'   => __( '_self', 'themekit' ),
					'_blank'  => __( '_blank', 'themekit' ),
					'_parent' => __( '_parent', 'themekit' ),
					'_top'    => __( '_top', 'themekit' )
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Show Link As Button?', 'themekit' ),
				'param_name' => 'show_button',
				'std'        => 'no',
				'value'      => array(
					__( 'Yes', 'themekit' ) => 'yes',
					__( 'No', 'themekit' )  => 'no'
				)
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'Button Text', 'themekit' ),
				'param_name' => 'button_text',
				'value'      => __( 'Continue', 'themekit' )
			),

			array(
				'type'       => 'textfield',
				'heading'    => __( 'Extra Class', 'themekit' ),
				'param_name' => 'class'
			),

			array(
				'type' => 'css_editor',
				'param_name' => 'css',
				'group' => __( 'Design Options', 'themekit' )
			)
		)
	) );
}
