<div class="staff_bottom">
	<h4 class="no_stripe"><?php esc_html_e( 'contact details', 'consulting' ); ?></h4>
	<div class="infos">
		<div class="info">
			<?php if( $phone = get_post_meta( get_the_ID(), 'phone', true ) ): ?>
				<div class="phone">
					<i class="fa fa-phone"></i> <span><?php echo esc_html( $phone ); ?></span>
				</div>
			<?php endif; ?>
			<?php if( $email = get_post_meta( get_the_ID(), 'email', true ) ): ?>
				<div class="email">
					<i class="stm-envelope"></i> <span><a href="mailto:<?php echo antispambot( $email ); ?>"><?php echo antispambot( $email ); ?></a></span>
				</div>
			<?php endif; ?>
		</div>
		<?php if( $address = get_post_meta( get_the_ID(), 'address', true ) ): ?>
			<div class="info">
				<div class="address">
					<i class="stm-marker"></i> <span><?php echo wp_kses( $address, array( 'br' => array() ) ); ?></span>
				</div>
			</div>
		<?php endif; ?>
		<div class="info">
			<div class="socials">
				<p><?php esc_html_e( 'Social Profiles', 'consulting' ); ?></p>
				<ul>
					<?php if( $facebook = get_post_meta( get_the_ID(), 'facebook', true ) ): ?>
						<li><a class="social-facebook" href="<?php echo esc_url( $facebook ); ?>"><i class="fa fa-facebook"></i></a></li>
					<?php endif; ?>
					<?php if( $twitter = get_post_meta( get_the_ID(), 'twitter', true ) ): ?>
						<li><a class="social-twitter" href="<?php echo esc_url( $twitter ); ?>"><i class="fa fa-twitter"></i></a></li>
					<?php endif; ?>
					<?php if( $linkedin = get_post_meta( get_the_ID(), 'linkedin', true ) ): ?>
						<li><a class="social-linkedin" href="<?php echo esc_url( $linkedin ); ?>"><i class="fa fa-linkedin"></i></a></li>
					<?php endif; ?>
					<?php if( $google_plus = get_post_meta( get_the_ID(), 'google_plus', true ) ): ?>
						<li><a class="social-google-plus" href="<?php echo esc_url( $google_plus ); ?>"><i class="fa fa-google-plus"></i></a></li>
					<?php endif; ?>
					<?php if( $skype = get_post_meta( get_the_ID(), 'skype', true ) ): ?>
						<li><a class="social-skype" href="<?php echo $skype; ?>"><i class="fa fa-skype"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
</div>