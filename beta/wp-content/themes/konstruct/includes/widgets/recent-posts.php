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
 * @package     Padora
 * @subpackage  Widgets
 */
class Konstruct_Recent_Posts extends konstruct_Widget
{
	public function __construct() {
		parent::__construct( 'konstruct_recent_posts', __( 'Konstruct: Recent Posts', 'konstruct' ), array(
				'description' => __( 'Your site\'s most recent Posts.', 'konstruct' )
			) );
	}

	/**
	 * Display widget to the frontend
	 * 
	 * @param   array  $args     Widget arguments
	 * @param   array $instance  Saved options from database
	 * 
	 * @return  void
	 */
	public function widget( $args, $instance ) {
		$params = array_merge( array(
			'class'        => '',
			'css'          => '',
			
			'title'        => __( 'Recent Posts', 'konstruct' ),
			'category'     => '',
			'tag'          => '',
			'layout'       => 'grid', // grid, masonry, list
			'grid_columns' => 3,
			'hide_content' => '',
			'content_length'    => 40,

			'hide_readmore' => '',
			'readmore_text' => __( 'Continue &rarr;', 'konstruct' ),
			
			'icon'         => 'post-thumbnail',
			'limit'        => 9,
			'offset'       => 0
		), $instance );

		if ( $params['hide_content'] === true )  $params['hide_content'] = 'yes';
		if ( $params['hide_readmore'] === true ) $params['hide_readmore'] = 'yes';

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'];
			echo apply_filters( 'widget_title', $instance['title'] );
			echo $args['after_title'];
		}

		unset( $params['title'] );
		echo themekit_shortcode_posts( $params );
		echo $args['after_widget'];
	}

	/**
	 * Setup options for this widget
	 * 
	 * @return  void
	 */
	protected function setup() {
		$this->sections['all'] = array(
			'title' => __( 'All Options', 'konstruct' )
		);
		
		$this->options = array(
			'title' => array(
				'type'    => 'text',
				'label'   => __( 'Widget Title', 'konstruct' ),
				'default' => __( 'Recent Posts', 'konstruct' ),
				'section' => 'all'
			),

			'category' => array(
				'type'    => 'checkboxes',
				'label'   => __( 'Filter By Categories', 'konstruct' ),
				'default' => array(),
				'section' => 'all',
				'choices' => array( $this, 'get_categories' )
			),

			'tag' => array(
				'type'    => 'text',
				'label'   => __( 'Filter By Tags', 'konstruct' ),
				'default' => '',
				'section' => 'all'
			),

			'layout' => array(
				'type'    => 'dropdown',
				'label'   => __( 'Layout', 'konstruct' ),
				'default' => 'list',
				'section' => 'all',
				'choices' => array(
					'grid'     => __( 'Grid', 'konstruct' ),
					'list'     => __( 'List', 'konstruct' ),
					'carousel' => __( 'Carousel', 'konstruct' )
				)
			),

			'grid_columns' => array(
				'type' => 'dropdown',
				'label' => __( 'Columns', 'konstruct' ),
				'default' => 1,
				'section' => 'all',
				'choices' => array(
					1 => __( '1 Column', 'konstruct' ),
					2 => __( '2 Columns', 'konstruct' ),
					3 => __( '3 Columns', 'konstruct' ),
					4 => __( '4 Columns', 'konstruct' )
				)
			),

			'offset' => array(
				'type'    => 'text',
				'label'   => __( 'Posts Offset', 'konstruct' ),
				'default' => 0,
				'section' => 'all'
			),

			'limit' => array(
				'type'    => 'text',
				'label'   => __( 'Limit', 'konstruct' ),
				'default' => 9,
				'section' => 'all'
			),

			'icon' => array(
				'type'    => 'dropdown',
				'label'   => __( 'Icon For Posts', 'konstruct' ),
				'default' => 1,
				'section' => 'all',
				'choices' => array(
					'post-thumbnail' => __( 'Post Thumbnail', 'konstruct' ),
					'post-date'      => __( 'Post Date', 'konstruct' ),
					'post-format'    => __( 'Post Format Icon', 'konstruct' )
				)
			),

			'hide_content' => array(
				'type'    => 'switcher',
				'label'   => __( 'Hide Post Content', 'konstruct' ),
				'default' => false,
				'section' => 'all'
			),

			'hide_readmore' => array(
				'type'    => 'switcher',
				'label'   => __( 'Hide Read More Link', 'konstruct' ),
				'default' => false,
				'section' => 'all'
			),

			'readmore_text' => array(
				'type'    => 'text',
				'label'   => __( 'Read More Text', 'konstruct' ),
				'default' => __( 'Continue &rarr;', 'konstruct' ),
				'section' => 'all'
			),

			'class' => array(
				'type'    => 'text',
				'label'   => __( 'Extra Classes', 'konstruct' ),
				'default' => '',
				'section' => 'all'
			),
		);
	}

	public function get_categories() {
		$categories     = array();
		$raw_categories = get_categories();

		foreach ( $raw_categories as $category ) {
			$categories[$category->slug] = $category->name;
		}

		return $categories;
	}
}
