<div class="about_vacantion">
	<?php if ( $department = get_post_meta( get_the_ID(), 'department', true ) ): ?>
		<div class="info">
			<div class="icon">
				<i class="fa fa-suitcase"></i>
			</div>
			<div class="text">
				<?php esc_html_e( 'Department:', 'consulting' ); ?>
				<strong><?php echo esc_html( $department ); ?></strong>
			</div>
		</div>
	<?php endif; ?>
	<?php if ( $location = get_post_meta( get_the_ID(), 'location', true ) ): ?>
		<div class="info">
			<div class="icon">
				<i class="fa fa-map-marker"></i>
			</div>
			<div class="text">
				<?php esc_html_e( 'Project Location(s):', 'consulting' ); ?>
				<strong><?php echo esc_html( $location ); ?></strong>
			</div>
		</div>
	<?php endif; ?>
	<?php if ( $education = get_post_meta( get_the_ID(), 'education', true ) ): ?>
		<div class="info">
			<div class="icon">
				<i class="fa fa-graduation-cap"></i>
			</div>
			<div class="text">
				<?php esc_html_e( 'Education:', 'consulting' ); ?>
				<strong><?php echo esc_html( $education ); ?></strong>
			</div>
		</div>
	<?php endif; ?>
	<?php if ( $compensation = get_post_meta( get_the_ID(), 'compensation', true ) ): ?>
		<div class="info">
			<div class="icon">
				<i class="fa fa-credit-card"></i>
			</div>
			<div class="text">
				<?php esc_html_e( 'Compensation:', 'consulting' ); ?>
				<strong><?php echo esc_html( $compensation ); ?></strong>
			</div>
		</div>
	<?php endif; ?>
</div>