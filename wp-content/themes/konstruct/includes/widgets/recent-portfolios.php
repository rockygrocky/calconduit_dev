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
class Konstruct_Recent_Portfolios extends konstruct_Widget
{
	public function __construct() {
		parent::__construct( 'konstruct_recent_portfolios', __( 'Konstruct: Recent Portfolios', 'konstruct' ), array(
				'description' => __( 'Your site\'s most recent Portfolios.', 'konstruct' )
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
		// Do not render the widget if function is not declared
		if ( ! function_exists( 'themekit_shortcode_portfolio' ) )
			return;

		$params = array_merge( array(
			'category'        => '',
			'tag'             => '',
			'style'           => 'grid',
			'columns'         => 4,
			'limit'           => 8,
			'enable_carousel' => 'no',
			'hide_filter'     => 'no',
			'css'             => '',
			'class'           => ''
		), $instance );

		if ( $params['enable_carousel'] == true ) $params['enable_carousel'] = 'yes';
		if ( $params['hide_filter'] == true ) $params['hide_filter'] = 'yes';

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'];
			echo apply_filters( 'widget_title', $instance['title'] );
			echo $args['after_title'];
		}

		echo themekit_shortcode_portfolio( $params );
		echo $args['after_widget'];
	}

	/**
	 * Setup options for this widget
	 * 
	 * @return  void
	 */
	protected function setup() {
		$this->sections['all'] = array( 'title' => __( 'All Options', 'konstruct' ) );
		$this->options = array(
			'title' => array(
				'type'    => 'text',
				'label'   => __( 'Widget Title', 'konstruct' ),
				'default' => __( 'Recent Portfolios', 'konstruct' ),
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

			'style' => array(
				'type'    => 'dropdown',
				'label'   => __( 'Style', 'konstruct' ),
				'default' => 'grid',
				'section' => 'all',
				'choices' => array(
					'grid'      => __( 'Grid', 'konstruct' ),
					'masonry'   => __( 'Grid Masonry', 'konstruct' ),
					'no-margin' => __( 'Grid No Margin', 'konstruct' )
				)
			),

			'columns' => array(
				'type' => 'dropdown',
				'label' => __( 'Columns', 'konstruct' ),
				'default' => 2,
				'section' => 'all',
				'choices' => array(
					2 => __( '2 Columns', 'konstruct' ),
					3 => __( '3 Columns', 'konstruct' ),
					4 => __( '4 Columns', 'konstruct' ),
					5 => __( '5 Columns', 'konstruct' )
				)
			),

			'limit' => array(
				'type'    => 'text',
				'label'   => __( 'Number Of Items', 'konstruct' ),
				'default' => 9,
				'section' => 'all'
			),

			'enable_carousel' => array(
				'type'    => 'switcher',
				'label'   => __( 'Show As Carousel', 'konstruct' ),
				'default' => false,
				'section' => 'all'
			),

			'hide_filter' => array(
				'type'    => 'switcher',
				'label'   => __( 'Hide Filter', 'konstruct' ),
				'default' => true,
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
		$raw_categories = get_terms( array( 'portfolio-category' ) );

		foreach ( $raw_categories as $category ) {
			$categories[$category->slug] = $category->name;
		}

		return $categories;
	}
}
