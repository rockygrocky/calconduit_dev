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
 * Radio Images control
 */
class RadioImages extends \OptionsPlus\Options\Control
{
	public $type = 'radio-images';
	public $choices = array();

	public function render_content() {
		if ( empty( $this->choices ) )
			return;

		$name = '_options-radio-images-' . $this->id;
		?>
		
			<div class="options-control-field">
				<?php foreach ( $this->choices as $value => $params ): ?>

					<label>
						<input type="radio" value="<?php linethemes_esc_attr( $value ) ?>" name="op-options[<?php linethemes_esc_attr( $this->id ) ?>]" <?php checked( $this->value(), $value ) ?> />
						<span data-tooltip="<?php linethemes_esc_attr( $params['tooltip'] ) ?>">
							<img src="<?php esc_url_e( $params['src'] ) ?>" alt="<?php linethemes_esc_attr( $value ) ?>" />
						</span>
					</label>

				<?php endforeach ?>

			</div>
			
		<?php
	}
}
