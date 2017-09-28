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
 * Register filter for append custom class name
 * that generated from visual-composer
 */
add_filter( 'themekit/shortcode/posts_class', 'konstruct_custom_shortcodes_class', 10, 3 );
add_action( 'vc_before_init', 'konstruct_post_shortcode_params' );

function konstruct_post_shortcode_params() {
	/**
	 * Map the testimonial slider shortcode
	 */
	vc_map( array(
		'name'                    => __( 'Konstruct: Blog Posts', 'konstruct' ),
		'base'                    => 'posts',
		'params'                  => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Widget Title', 'konstruct' ),
				'param_name'  => 'title',
				'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'konstruct' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Category', 'konstruct' ),
				'param_name'  => 'category',
				'description' => __( 'Enter the category\'s slug that will be used to filter posts', 'konstruct' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Tag', 'konstruct' ),
				'param_name'  => 'tag',
				'description' => __( 'Enter the tag\'s slug that will be used to filter posts', 'konstruct' )
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Layout', 'konstruct' ),
				'param_name' => 'layout',
				'value'      => array(
					__( 'Grid', 'konstruct' ) => 'grid',
					__( 'List', 'konstruct' ) => 'list',
					__( 'Carousel', 'konstruct' ) => 'carousel'
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Grid Columns', 'konstruct' ),
				'param_name'  => 'grid_columns',
				'description' => __( 'The number of columns for grid and grid masonry layout', 'konstruct' ),
				'value'       => array(
					__( '1 Column', 'konstruct' ) => 1,
					__( '2 Columns', 'konstruct' ) => 2,
					__( '3 Columns', 'konstruct' ) => 3,
					__( '4 Columns', 'konstruct' ) => 4
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Limit', 'konstruct' ),
				'param_name'  => 'limit',
				'description' => __( 'The number of posts will be shown', 'konstruct' ),
				'value'       => 9
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Offset', 'konstruct' ),
				'param_name'  => 'offset',
				'description' => __( 'The number of posts to pass over', 'konstruct' ),
				'value'       => 0
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Icon For Posts', 'konstruct' ),
				'param_name' => 'icon',
				'value'      => array(
					__( 'Post Thumbnail', 'konstruct' ) => 'post-thumbnail',
					__( 'Post Format Icon', 'konstruct' ) => 'post-format',
					__( 'Post Date', 'konstruct' ) => 'post-date'
				)
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Hide Post Content', 'konstruct' ),
				'param_name' => 'hide_content',
				'value'      => array(
					__( 'Yes, please', 'konstruct' ) => 'yes'
				)
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Post Content Length', 'konstruct' ),
				'param_name' => 'content_length',
				'value'      => 40
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Hide Read More', 'konstruct' ),
				'param_name' => 'hide_readmore',
				'value'      => array(
					__( 'Yes, please', 'konstruct' ) => 'yes'
				)
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Read More Text', 'konstruct' ),
				'param_name' => 'readmore_text',
				'value'      => __( 'Continue &rarr;', 'konstruct' )
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'konstruct' ),
				'param_name'  => 'class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'konstruct' )
			),

			array(
				'type'       => 'css_editor',
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'konstruct' )
			)
		)
	) );
}
