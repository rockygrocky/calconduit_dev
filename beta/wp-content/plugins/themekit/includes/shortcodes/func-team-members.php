<?php
/**
 * WARNING: This file is part of the UI-Pack plugin. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

add_action( 'admin_init', 'themekit_shortcode_team_members_params' );
add_shortcode( 'team_members_carousel', 'themekit_shortcode_team_members_carousel' );

function themekit_shortcode_team_members_carousel( $atts, $content = '' ) {
	ob_start();

	if ( $template = locate_template( array( 'templates/shortcodes/team-members-carousel.php' ) ) )
		include $template;
	else
		include __DIR__ . '/templates/team-members-carousel.php';

	return ob_get_clean();
}

function themekit_shortcode_team_members_params() {
	$terms = get_terms( 'member-category' );
	$values = array();

	if ( is_array( $terms ) ) {
		foreach ( $terms as $term )
			$values[] = array( 'label' => $term->name, 'value' => $term->term_id );
	}

	vc_map( array(
		'name'          => __( 'LineThemes: Team Members Carousel', 'themekit' ),
		'base'          => 'team_members_carousel',
		'icon'          => 'themekit-shortcode',
		'category'      => 'LineThemes',
		'params'        => array(
			// General tab
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Widget Title', 'themekit' ),
				'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'themekit' ),
				'param_name'  => 'widget_title'
			),

			array(
				'type'        => 'autocomplete',
				'heading'     => __( 'Categories', 'themekit' ),
				'description' => __( 'If you want to narrow output, enter category names here. Note: Only listed categories will be included.', 'themekit' ),
				'param_name'  => 'categories',
				'settings'    => array(
					'multiple'       => true,
					'sortable'       => true,
					'min_length'     => 1,
					'no_hide'        => true,
					'unique_values'  => true,
					'display_inline' => true,
					'values'         => $values
				)
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Limit', 'themekit' ),
				'description' => __( 'The number of posts will be shown', 'themekit' ),
				'param_name'  => 'limit',
				'value'       => 9
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Offset', 'themekit' ),
				'description' => __( 'The number of posts to pass over', 'themekit' ),
				'param_name'  => 'offset',
				'value'       => 0
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Thumbnail Size', 'themekit' ),
				'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'themekit' ),
				'param_name'  => 'thumbnail_size'
			),

			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Enable Lightbox', 'themekit' ),
				'description' => __( 'If select "YES", the lightbox will be open when clicked to the image', 'themekit' ),
				'param_name'  => 'lightbox',
				'std'         => 'no',
				'value'       => array(
					__( 'Yes', 'themekit' ) => 'yes',
					__( 'No', 'themekit' ) => 'no'
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Link to post?', 'themekit' ),
				'param_name' => 'link',
				'std'        => 'yes',
				'value'      => array(
					__( 'Yes', 'themekit' ) => 'yes',
					__( 'No', 'themekit' ) => 'no'
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Read more', 'themekit' ),
				'description' => __( 'Select "YES" to show the read more link', 'themekit' ),
				'param_name' => 'readmore',
				'std'        => 'yes',
				'value'      => array(
					__( 'Yes', 'themekit' ) => 'yes',
					__( 'No', 'themekit' ) => 'no'
				)
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Read more text', 'themekit' ),
				'description' => __( 'Custom text for the read more link', 'themekit' ),
				'param_name'  => 'readmore_text',
				'value'       => __( 'View Profile', 'themekit' )
			),

			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order By', 'themekit' ),
				'description' => __( 'Select how to sort retrieved posts.', 'themekit' ),
				'param_name'  => 'order',
				'std'         => 'date',
				'value'       => array(
					__( 'Date', 'themekit' )          => 'date',
					__( 'ID', 'themekit' )            => 'ID',
					__( 'Author', 'themekit' )        => 'author',
					__( 'Title', 'themekit' )         => 'title',
					__( 'Modified', 'themekit' )      => 'modified',
					__( 'Random', 'themekit' )        => 'rand',
					__( 'Comment count', 'themekit' ) => 'comment_count',
					__( 'Menu order', 'themekit' )    => 'menu_order'
				)
			),

			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order Direction', 'themekit' ),
				'description' => __( 'Designates the ascending or descending order.', 'themekit' ),
				'param_name'  => 'direction',
				'std'         => 'DESC',
				'value'       => array(
					__( 'Ascending', 'themekit' )          => 'ASC',
					__( 'Descending', 'themekit' )            => 'DESC'
				)
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra Class', 'themekit' ),
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'themekit' ),
				'param_name'  => 'class'
			),

			// Carousel Options
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Show Items', 'themekit' ),
				'description' => __( 'The maximum amount of items displayed at a time', 'themekit' ),
				'param_name'  => 'items',
				'group'       => __( 'Carousel Options', 'themekit' ),
				'value'       => array_combine( range( 1, 6 ), range( 1, 6 ) ),
				'std'         => 4
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Autoplay?', 'themekit' ),
				'param_name' => 'autoplay',
				'group'      => __( 'Carousel Options', 'themekit' ),
				'std'        => 'yes',
				'value'      => array(
					__( 'Yes', 'themekit' ) => 'yes',
					__( 'No', 'themekit' ) => 'no'
				)
			),

			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Stop On Hover?', 'themekit' ),
				'description' => __( 'Rewind speed in milliseconds', 'themekit' ),
				'param_name'  => 'hover_stop',
				'group'       => __( 'Carousel Options', 'themekit' ),
				'std'         => 'yes',
				'value'       => array(
					__( 'Yes', 'themekit' ) => 'yes',
					__( 'No', 'themekit' ) => 'no'
				)
			),

			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Slider Controls', 'themekit' ),
				'param_name'  => 'controls',
				'group'       => __( 'Carousel Options', 'themekit' ),
				'std'         => 'navigation,rewind-navigation,pagination,pagination-numbers',
				'value'       => array(
					__( 'Navigation', 'themekit' )         => 'navigation',
					__( 'Rewind Navigation', 'themekit' )  => 'rewind-navigation',
					__( 'Pagination', 'themekit' )         => 'pagination',
					__( 'Pagination Numbers', 'themekit' ) => 'pagination-numbers'
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Scroll Per Page?', 'themekit' ),
				'param_name' => 'scroll_page',
				'group'       => __( 'Carousel Options', 'themekit' ),
				'std'        => 'yes',
				'value'      => array(
					__( 'Yes', 'themekit' ) => 'yes',
					__( 'No', 'themekit' ) => 'no'
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Allow Mouse Drag?', 'themekit' ),
				'param_name' => 'mouse_drag',
				'group'      => __( 'Carousel Options', 'themekit' ),
				'std'        => 'yes',
				'value'      => array(
					__( 'Yes', 'themekit' ) => 'yes',
					__( 'No', 'themekit' ) => 'no'
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Allow Touch Drag?', 'themekit' ),
				'param_name' => 'touch_drag',
				'group'      => __( 'Carousel Options', 'themekit' ),
				'std'        => 'yes',
				'value'      => array(
					__( 'Yes', 'themekit' ) => 'yes',
					__( 'No', 'themekit' ) => 'no'
				)
			),

			// Speed
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Autoplay Speed', 'themekit' ),
				'description' => __( 'Autoplay speed in milliseconds', 'themekit' ),
				'param_name'  => 'autoplay_speed',
				'group'       => __( 'Speed', 'themekit' ),
				'value'       => 5000
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Slide Speed', 'themekit' ),
				'description' => __( 'Slide speed in milliseconds', 'themekit' ),
				'param_name'  => 'slide_speed',
				'group' => __( 'Speed', 'themekit' ),
				'value'       => 200
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Pagination Speed', 'themekit' ),
				'description' => __( 'Pagination speed in milliseconds', 'themekit' ),
				'param_name'  => 'pagination_speed',
				'group' => __( 'Speed', 'themekit' ),
				'value'       => 200
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( 'Rewind Speed', 'themekit' ),
				'description' => __( 'Rewind speed in milliseconds', 'themekit' ),
				'param_name'  => 'rewind_speed',
				'group' => __( 'Speed', 'themekit' ),
				'value'       => 200
			),

			// Responsive
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Enable Responsive?', 'themekit' ),
				'param_name' => 'responsive',
				'group'      => __( 'Responsive', 'themekit' ),
				'std'        => 'yes',
				'value'      => array(
					__( 'Yes', 'themekit' ) => 'yes',
					__( 'No', 'themekit' ) => 'no'
				)
			),

			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Items On Tablet', 'themekit' ),
				'description' => __( 'The maximum amount of items displayed at a time on tablet device', 'themekit' ),
				'param_name'  => 'tablet_items',
				'group'       => __( 'Responsive', 'themekit' ),
				'value'       => array_combine( range( 1, 6 ), range( 1, 6 ) ),
				'std'         => 2
			),

			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Items On Mobile', 'themekit' ),
				'description' => __( 'The maximum amount of items displayed at a time on mobile device', 'themekit' ),
				'param_name'  => 'mobile_items',
				'group'       => __( 'Responsive', 'themekit' ),
				'value'       => array_combine( range( 1, 6 ), range( 1, 6 ) ),
				'std'         => 1
			),

			array(
				'type' => 'css_editor',
				'param_name' => 'css',
				'group' => __( 'Design Options', 'themekit' )
			)
		)
	) );
}
