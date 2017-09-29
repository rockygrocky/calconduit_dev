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
 * Base class for theme's widgets
 *
 * @package  Padora
 */
abstract class Konstruct_Widget extends WP_Widget
{
	protected $container;
	protected $sections = array();
	protected $options = array();

	protected $enqueue_styles = array(
		'admin' => array( 'konstruct-widgets' ),
		'front' => array()
	);

	protected $enqueue_scripts = array(
		'admin' => array( 'konstruct-widgets' ),
		'front' => array()
	);

	public function __construct( $id_base, $name, $widget_options = array(), $control_options = array() ) {
		parent::__construct( $id_base, $name, $widget_options, $control_options );

		$this->setup();
		$this->container = new \OptionsPlus\Options\Container( array(
			'sections'  => $this->sections,
			'controls'  => $this->options,
			'show_tabs' => false
		) );

		// Register action
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Enqueue required scripts and styles
	 * 
	 * @return  void
	 */
	public function enqueue( $hook = null ) {
		// Do enqueue for the backend
		if ( is_admin() && $hook == 'widgets.php' ) {
			foreach ( $this->enqueue_styles['admin'] as $id )  wp_enqueue_style( $id );
			foreach ( $this->enqueue_scripts['admin'] as $id ) wp_enqueue_script( $id );

			// Enqueue options-plus assets
			$this->container->enqueue();
		}
		// Do enqueue for the frontend
		else {
			foreach ( $this->enqueue_styles['front'] as $id )  wp_enqueue_style( $id );
			foreach ( $this->enqueue_scripts['front'] as $id ) wp_enqueue_script( $id );
		}
	}

	/**
	 * Generate options form for the widget
	 * 
	 * @param   array  $instance  Previously saved values from database.
	 * @return  void
	 */
	public function form( $instance ) {
		$this->container->bind( $instance );
		$this->container->render( array( 'output' => true ) );

		printf( '<input type="hidden" name="%s" id="%s" value="%s" class="op-encoded-options" />',
				esc_attr( $this->get_field_name( 'options' ) ),
				esc_attr( $this->get_field_id( 'options' ) ),
				esc_attr( $this->get_encoded_options( $instance ) )
			);
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see     WP_Widget::update()
	 *
	 * @param   array  $new_instance  Values just sent to be saved.
	 * @param   array  $old_instance  Previously saved values from database.
	 *
	 * @return  array
	 */
	public function update( $new_instance, $old_instance ) {
		$options = array();

		if ( isset( $new_instance['options'] ) ) {
			$new_options = (array) json_decode( $new_instance['options'], true );

			foreach ( $this->options as $id => $params ) {
				if ( $params['type'] == 'switcher' ) {
					$options[$id] = isset( $new_options[$id] );
					continue;
				}

				$options[$id] = isset( $new_options[$id] )
					? $new_options[$id]
					: $params['default'];
			}
		}

		return $options;
	}

	/**
	 * Return the encoded options that will set as value of hidden
	 * field
	 * 
	 * @param   array  $instance  All widget options
	 * @return  string
	 */
	private function get_encoded_options( $instance ) {
		return json_encode( $instance );
	}

	/**
	 * Setup the widgets options
	 * 
	 * @return  void
	 */
	abstract protected function setup();
}
