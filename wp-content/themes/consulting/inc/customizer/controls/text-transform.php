<?php
if ( ! class_exists( 'STM_Customizer_Text_Transform_Control' ) ) {

	class STM_Customizer_Text_Transform_Control extends WP_Customize_Control {

		public $type = 'stm-text-transform';

		public function render_content() {


			$transform = array(
				'capitalize'       => esc_html__( 'Capitalize', 'consulting' ),
				'lowercase' => esc_html__( 'Lowercase', 'consulting' ),
				'uppercase'       => esc_html__( 'Uppercase', 'consulting' ),
				'none' => esc_html__( 'Normal', 'consulting' )
			);


			$input_args = array(
				'type'    => 'select',
				'label'   => $this->label,
				'name'    => '',
				'id'      => $this->id,
				'value'   => $this->value(),
				'link'    => $this->get_link(),
				'options' => $transform
			);

			?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'stm-', '', $this->type ) ); ?>">

				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<div class="stm-form-item">
					<div class="stm-text-transform-wrapper">
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