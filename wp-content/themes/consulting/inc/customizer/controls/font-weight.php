<?php
if ( ! class_exists( 'STM_Customizer_Font_Weight_Control' ) ) {

	class STM_Customizer_Font_Weight_Control extends WP_Customize_Control {

		public $type = 'stm-font-weight';

		public function render_content() {


			$weights = array(
				'100'       => esc_html__( 'Ultra Light', 'consulting' ),
				'100italic' => esc_html__( 'Ultra Light Italic', 'consulting' ),
				'200'       => esc_html__( 'Light', 'consulting' ),
				'200italic' => esc_html__( 'Light Italic', 'consulting' ),
				'300'       => esc_html__( 'Book', 'consulting' ),
				'300italic' => esc_html__( 'Book Italic', 'consulting' ),
				'400'       => esc_html__( 'Regular', 'consulting' ),
				'400italic' => esc_html__( 'Regular Italic', 'consulting' ),
				'500'       => esc_html__( 'Medium', 'consulting' ),
				'500italic' => esc_html__( 'Medium Italic', 'consulting' ),
				'600'       => esc_html__( 'Semi-Bold', 'consulting' ),
				'600italic' => esc_html__( 'Semi-Bold Italic', 'consulting' ),
				'700'       => esc_html__( 'Bold', 'consulting' ),
				'700italic' => esc_html__( 'Bold Italic', 'consulting' ),
				'800'       => esc_html__( 'Extra Bold', 'consulting' ),
				'800italic' => esc_html__( 'Extra Bold Italic', 'consulting' ),
				'900'       => esc_html__( 'Ultra Bold', 'consulting' ),
				'900italic' => esc_html__( 'Ultra Bold Italic', 'consulting' )
			);


			$input_args = array(
				'type'    => 'select',
				'label'   => $this->label,
				'name'    => '',
				'id'      => $this->id,
				'value'   => $this->value(),
				'link'    => $this->get_link(),
				'options' => $weights
			);

			?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'stm-', '', $this->type ) ); ?>">

				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<div class="stm-form-item">
					<div class="stm-font-weight-wrapper">
						<?php stm_input( $input_args ); ?>
					</div>
				</div>

				<?php if ( '' != $this->description ) : ?>
					<div class="description customize-control-description">
						<?php echo esc_html( $this->description ); ?>
					</div>
				<?php endif; ?>

			</div>
			<?php
		}
	}
}