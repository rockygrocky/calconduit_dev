<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'el_id'           => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'parallax_effect' => '',
    'parallax_speed'  => 4,
    'parallax_x'  => 0,
    'parallax_y'  => 0,
    'css' => '',
    'width_100' => ''
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class  = $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row ' . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$style     = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
$parallax  = '';

if ( $parallax_effect == 'yes' ) {
	$parallax = ' data-parallax-speed="' . $parallax_speed . '"';
    $parallax.= ' data-parallax-x="' . $parallax_x . '" data-parallax-y="' . $parallax_y . '"';
	$css_class .= ' parallax';
}

if ( $width_100 == 'yes' ) {
    $css_class .= ' full';
}

$id = !empty( $el_id ) ? 'id="' . $el_id . '"' : '';
$output .= '<div '. $id .' class="'.$css_class.'"'.$style . $parallax .'>';
$output .= '<div class="vc_row_wrap">';
$output .= '<div class="vc_row_content">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>';
$output .= '</div>';
$output .= '</div>'.$this->endBlockComment('row');

echo $output;