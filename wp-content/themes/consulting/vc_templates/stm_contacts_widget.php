<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$css_class .= ' ' . $class;
$css_class .= ' ' . $style;
?>


<div class="stm_contacts_widget<?php echo esc_attr( $css_class ); ?>">

	<?php if( $style == 'style_2' ) : ?>

		<ul>
			<?php if( $phone ): ?>
				<li class="phone">
					<div class="icon"><i class="fa fa-phone"></i></div>
					<div class="text"><strong><?php echo esc_attr( $phone ); ?></strong></div>
				</li>
			<?php endif; ?>
			<?php if( $email ): ?>
				<li class="mail">
					<div class="icon"><i class="fa fa-envelope"></i></div>
					<div class="text"><a href="mailto:<?php echo antispambot( $email ); ?>"><?php echo antispambot( $email ); ?></a></div>
				</li>
			<?php endif; ?>
		</ul>

	<?php elseif( $style == 'style_3' ) : ?>

		<ul>
			<?php if( $phones ): ?>
				<li>
					<div class="icon"><i class="stm-icon stm-phone-11"></i></div>
					<?php
						$phones_arr = explode( ';', $phones );
						$phones_count = count( $phones_arr );
						$phones_showed = 0;
					?>
					<?php if( !empty( $phones_arr ) && $phones_count > 0 ) : ?>
						<div class="text">
							<?php foreach( $phones_arr as $phone_number ) : $phones_showed++; ?>
								<a href="tel:<?php echo esc_attr( str_replace(' ', '', $phone_number) ); ?>"><?php esc_html_e( $phone_number ); ?></a><?php echo ( ( $phones_count > $phones_showed ) ? '<br>' : ''); ?>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</li>
			<?php endif; ?>
			<?php if( $email ): ?>
				<li>
					<div class="icon"><i class="stm-icon stm-envelope-11"></i></div>
					<div class="text"><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></div>
				</li>
			<?php endif; ?>
			<?php if( $address ): ?>
				<li>
					<div class="icon"><i class="stm-icon stm-pin-11"></i></div>
					<div class="text"><?php echo wp_kses_post( $address ); ?></div>
				</li>
			<?php endif; ?>
			<?php if( $schedule ): ?>
				<li>
					<div class="icon"><i class="stm-icon stm-clock6"></i></div>
					<div class="text"><?php echo wp_kses_post( $schedule ); ?></div>
				</li>
			<?php endif; ?>
		</ul>
	<?php else: ?>

        <?php if( $title ): ?>
            <h4 class="no_stripe"><?php echo esc_attr( $title ); ?></h4>
        <?php endif; ?>
        <ul>
            <?php if( $address ): ?>
                <li>
                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                    <div class="text"><?php echo wp_kses( $address, array( 'br' => array() ) ); ?></div>
                </li>
            <?php endif; ?>
            <?php if( $phone ): ?>
                <li>
                    <div class="icon"><i class="fa fa-phone"></i></div>
                    <div class="text">
                        <?php echo esc_attr( $phone ); ?>
                        <?php if( $phone_two ): ?>
                            <br /><?php echo esc_attr( $phone_two ); ?>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endif; ?>
            <?php if( $fax ){ ?>
                <li>
                    <div class="icon"><i class="fa fa-fax"></i></div>
                    <div class="text">
                        <?php echo esc_attr( $fax ); ?>
                    </div>
                </li>
            <?php } ?>
            <?php if( $email ): ?>
                <li>
                    <div class="icon"><i class="fa fa-envelope"></i></div>
                    <div class="text"><a href="mailto:<?php echo antispambot( $email ); ?>"><?php echo antispambot( $email ); ?></a></div>
                </li>
            <?php endif; ?>
            <?php if( $schedule ): ?>
                <li>
                    <div class="icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                    <div class="text"><?php echo wp_kses_post( $schedule ); ?></div>
                </li>
            <?php endif; ?>
        </ul>
        <?php if( $facebook || $twitter || $linkedin || $google_plus || $skype ): ?>
            <ul class="socials">
                <?php if( $facebook ): ?>
                    <li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank" class="social-facebook"><i class="fa fa-facebook"></i></a></li>
                <?php endif; ?>
                <?php if( $twitter ): ?>
                    <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank" class="social-twitter"><i class="fa fa-twitter"></i></a></li>
                <?php endif; ?>
                <?php if( $linkedin ): ?>
                    <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" class="social-linkedin"><i class="fa fa-linkedin"></i></a></li>
                <?php endif; ?>
                <?php if( $google_plus ): ?>
                    <li><a href="<?php echo esc_url( $google_plus ); ?>" target="_blank" class="social-google-plus"><i class="fa fa-google-plus"></i></a></li>
                <?php endif; ?>
                <?php if( $skype ): ?>
                    <li><a href="skype:<?php echo esc_attr( $skype ); ?>" class="social-skype"><i class="fa fa-skype"></i></a></li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>

	<?php endif; ?>

</div>