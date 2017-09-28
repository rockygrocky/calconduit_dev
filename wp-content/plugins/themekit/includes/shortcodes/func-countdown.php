<?php
/**
 * WARNING: This file is part of the UI-Pack plugin. DO NOT edit
 * this file under any circumstances.
 */
if ( ! defined( 'ABSPATH' ) )
	exit;


add_shortcode( 'countdown', 'themekit_shortcode_countdown' );

/**
 * Counter shortcode handle
 * 
 * @param   array  $atts  Shortcode attributes
 * @return  void
 */
function themekit_shortcode_countdown( $atts, $content = null ) {
	static $enqueued;

	$atts = shortcode_atts( apply_filters( 'themekit/shortcode/countdown_atts', array(
		'class'        => '',
		'css'          => '',
		
		'time'         => '',
		'hide_years'   => '',
		'hide_months'  => '',
		'hide_weeks'    => '',
		'hide_days'    => '',
		'hide_hours'   => '',
		'hide_minutes' => '',
		'hide_seconds' => ''
	) ), $atts );

	$hidden = array();

	if ( $atts['hide_years'] == 'yes' )
		$hidden[] = 'year';

	if ( $atts['hide_months'] == 'yes' )
		$hidden[] = 'month';

	if ( $atts['hide_weeks'] == 'yes' )
		$hidden[] = 'week';

	if ( $atts['hide_days'] == 'yes' )
		$hidden[] = 'day';

	if ( $atts['hide_hours'] == 'yes' )
		$hidden[] = 'hour';

	if ( $atts['hide_minutes'] == 'yes' )
		$hidden[] = 'minute';

	if ( $atts['hide_seconds'] == 'yes' )
		$hidden[] = 'second';

	if ( $enqueued != true ) {
		wp_localize_script( 'themekit-shortcodes', '_countdownLocalize', array(
			'years'   => __( 'Years', 'themekit' ),
			'year'    => __( 'Year', 'themekit' ),
			'months'  => __( 'Months', 'themekit' ),
			'month'   => __( 'Month', 'themekit' ),
			'weeks'    => __( 'Weeks', 'themekit' ),
			'week'     => __( 'Week', 'themekit' ),
			'days'    => __( 'Days', 'themekit' ),
			'day'     => __( 'Day', 'themekit' ),
			'hours'   => __( 'Hours', 'themekit' ),
			'hour'    => __( 'Hour', 'themekit' ),
			'minutes' => __( 'Minutes', 'themekit' ),
			'minute'  => __( 'Minute', 'themekit' ),
			'seconds' => __( 'Seconds', 'themekit' ),
			'second'  => __( 'Second', 'themekit' )
		) );

		$enqueued = true;
	}

	$class = apply_filters( 'themekit/shortcode/countdown_class', array( 'countdown', $atts['class'] ), $atts );

	// Enqueue shortcode assets
	wp_enqueue_script( 'themekit-shortcodes' );

	return sprintf( '<div class="%s" data-time="%s" data-hidden="%s"></div>',
		esc_attr( implode( ' ', $class ) ),
		esc_attr( $atts['time'] ),
		esc_attr( implode( ',', $hidden ) )
	);
}
