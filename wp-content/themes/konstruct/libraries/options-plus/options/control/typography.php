<?php
/**
 * WARNING: This file is part of the OptionsPlus library. DO NOT edit
 * this file under any circumstances.
 */
namespace OptionsPlus\Options\Control;

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();


/**
 * This class will be present an colorpicker control
 */
class Typography extends \OptionsPlus\Options\Control
{
	/**
	 * The control type
	 * 
	 * @var  string
	 */
	public $type = 'typography';
	public $fields = array(
		'family', 'size', 'style', 'color'
	);

	private $titles;
	private static $localize_enqueued = false;

	public function __construct( $id, $args = array() ) {
		parent::__construct( $id, $args );

		$this->titles = array(
			'100'        => esc_html__( 'Thin 100', 'options-plus' ),
			'100italic'  => esc_html__( 'Thin 100 italic', 'options-plus' ),
			'200'        => esc_html__( 'Extra-light 200', 'options-plus' ),
			'200italic'  => esc_html__( 'Extra-light 200 italic', 'options-plus' ),
			'300'        => esc_html__( 'Light 300', 'options-plus' ),
			'300italic'  => esc_html__( 'Light 300 italic', 'options-plus' ),
			'400'        => esc_html__( 'Normal 400', 'options-plus' ),
			'400italic'  => esc_html__( 'Normal 400 italic', 'options-plus' ),
			'500'        => esc_html__( 'Medium 500', 'options-plus' ),
			'500italic'  => esc_html__( 'Medium 500 italic', 'options-plus' ),
			'600'        => esc_html__( 'Semi-bold 600', 'options-plus' ),
			'600italic'  => esc_html__( 'Semi-bold 600 italic', 'options-plus' ),
			'700'        => esc_html__( 'Bold 700', 'options-plus' ),
			'700italic'  => esc_html__( 'Bold 700 italic', 'options-plus' ),
			'800'        => esc_html__( 'Extra-bold 800', 'options-plus' ),
			'800italic'  => esc_html__( 'Extra-bold 800 italic', 'options-plus' ),
			'900'        => esc_html__( 'Ultra-bold 900', 'options-plus' ),
			'900itallic' => esc_html__( 'Ultra-bold 900 italic', 'options-plus' )
		);
	}

	/**
	 * Enqueue assets for this control
	 * 
	 * @return  void
	 */
	public function enqueue() {
		wp_enqueue_style( 'op-colpick' );
		wp_enqueue_style( 'op-chosen' );

		wp_enqueue_script( 'op-colpick' );
		wp_enqueue_script( 'op-chosen' );

		if ( ! self::$localize_enqueued ) {
			wp_localize_script( 'op-options-controls', '_opFontWeights', $this->titles );
			self::$localize_enqueued = true;
		}
	}
	
	/**
	 * Render the control markup
	 * 
	 * @return  void
	 */
	public function render_content() {
		global $_options_plus_fonts;

		$name = '_options-control-typography-' . $this->id;
		$values = $this->value();

		if ( isset( $_options_plus_fonts['system'][ $values['family'] ] ) )
			$font_weights = array_map( 'trim', explode( ',', $_options_plus_fonts['system'][$values['family']]['variants'] ) );
		elseif ( isset( $_options_plus_fonts['google'][ $values['family'] ] ) )
			$font_weights = array_map( 'trim', explode( ',', $_options_plus_fonts['google'][$values['family']]['variants'] ) );
		else
			$font_weights = array();
		?>
			<div class="options-control-inputs">
				<?php if ( in_array( 'family', $this->fields ) ): ?>
				<div class="options-control-chosen typography-font">
					<div class="options-control-title">
						<label for="<?php linethemes_esc_attr( $name ) ?>-family"><?php esc_html_e( 'Font Family', 'options-plus' ) ?></label>
					</div>
					<div class="options-control-inputs">
						<select name="op-options[<?php linethemes_esc_attr( $this->id ) ?>][family]" id="<?php linethemes_esc_attr( $name ) ?>-family">
							<optgroup label="<?php linethemes_esc_attr( 'System Fonts', 'options-plus' ) ?>">
								<?php foreach ( $_options_plus_fonts['system'] as $id => $font ): ?>
								<option value="<?php linethemes_esc_attr( $id ) ?>" data-variants="<?php linethemes_esc_attr( $font['variants'] ) ?>" <?php selected( $id, $values['family'] ) ?> ><?php linethemes_esc_html( $font['caption'] ) ?></option>
								<?php endforeach ?>
							</optgroup>
							<optgroup label="<?php linethemes_esc_attr( 'Google Fonts', 'options-plus' ) ?>">
								<?php foreach ( $_options_plus_fonts['google'] as $id => $font ): ?>
								<option value="<?php linethemes_esc_attr( $id ) ?>" data-variants="<?php linethemes_esc_attr( $font['variants'] ) ?>" <?php selected( $id, $values['family'] ) ?> ><?php linethemes_esc_html( $font['caption'] ) ?></option>
								<?php endforeach ?>
							</optgroup>
						</select>
					</div>
				</div>
				<!-- /family -->
				<?php endif ?>

				<?php if ( in_array( 'size', $this->fields ) ): ?>
				<div class="typography-size">
					<div class="options-control-title">
						<label for="<?php linethemes_esc_attr( $name ) ?>-size"><?php esc_html_e( 'Font Size (px)', 'options-plus' ) ?></label>
					</div>
					<div class="options-control-inputs">
						<input type="text" name="op-options[<?php linethemes_esc_attr( $this->id ) ?>][size]" value="<?php linethemes_esc_attr( $values['size'] ) ?>" id="<?php linethemes_esc_attr( $name ) ?>-size" />
					</div>
				</div>
				<!-- /size -->
				<?php endif ?>

				<?php if ( in_array( 'style', $this->fields ) ): ?>
				<div class="options-control-dropdown typography-style">
					<div class="options-control-title">
						<label><?php esc_html_e( 'Font Weight & Style', 'options-plus' ) ?></label>
					</div>
					<div class="options-control-inputs">
						<label>
							<span class="options-control-preview"></span>
							<select name="op-options[<?php linethemes_esc_attr( $this->id ) ?>][style]" id="<?php linethemes_esc_attr( $name ) ?>-style">
								<?php foreach ( $font_weights as $font_weight ): ?>
								<option value="<?php linethemes_esc_attr( $font_weight ) ?>" <?php selected( $font_weight, $values['style'] ) ?> >
									<?php
										if ( isset( $this->titles[$font_weight] ) )
											linethemes_esc_html( $this->titles[$font_weight] );
										else
											linethemes_esc_html( $font_weight );
									?>
								</option>
								<?php endforeach ?>
							</select>
						</label>
					</div>
				</div>
				<!-- /font-weight -->
				<?php endif ?>

				<?php if ( in_array( 'color', $this->fields ) ): ?>
				<div class="options-control-color-picker typography-color">
					<div class="options-control-title">
						<label><?php esc_html_e( 'Font Color', 'options-plus' ) ?></label>
					</div>
					<div class="options-control-inputs">
						<input type="text" id="<?php linethemes_esc_attr( $name ) ?>-color" name="op-options[<?php linethemes_esc_attr( $this->id ) ?>][color]" value="<?php linethemes_esc_attr( $values['color'] ) ?>" />
						<button type="button" class="options-control-preview" style="background-color: <?php linethemes_esc_attr( $values['color'] ) ?>;"></button>
						<div class="colorpicker-panel"></div>
					</div>
				</div>
				<?php endif ?>
			</div>
		
		<?php
	}
}
