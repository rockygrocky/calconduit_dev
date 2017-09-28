<?php
/**
 * WARNING: This file is part of the Konstruct theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

// Register filter for template wrapper
add_filter( 'template_include', 'Konstruct_TemplateWrapper::wrap', 99 );

/**
 * This helper function will return the path
 * to main template file
 * 
 * @return  string
 */
function konstruct_template_path() {
	return Konstruct_TemplateWrapper::$main_template;
}

/**
 * This utility class will be used for template
 * wrapper functionally
 */
class Konstruct_TemplateWrapper
{
	// Stores the full path to the main template file
	public static $main_template;

	// Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	public static $base;

	public function __construct( $template = 'layout.php' ) {
		$this->slug = basename( $template, '.php' );
		$this->templates = array( $template );

		if ( self::$base ) {
			$str = substr( $template, 0, -4 );
			array_unshift( $this->templates, sprintf( $str . '-%s.php', self::$base ) );
		}
	}

	public function __toString() {
		$this->templates = apply_filters( 'konstruct/wrap_' . $this->slug, $this->templates );
		return locate_template( $this->templates );
	}

	public static function wrap( $main ) {
		self::$main_template = $main;
		self::$base = basename( self::$main_template, '.php' );
		
		if ( self::$base === 'index' ) {
			self::$base = false;
		}
		
		return new Konstruct_TemplateWrapper();
	}
}
