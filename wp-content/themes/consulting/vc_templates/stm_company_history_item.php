<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<li>
	<div class="year"><?php echo esc_html( $year ); ?></div>
	<div class="sep"></div>
	<div class="company_history_text">
		<h4 class="no_stripe"><?php echo esc_html( $title ); ?></h4>
		<?php echo wpb_js_remove_wpautop( $description, true ); ?>
	</div>
</li>