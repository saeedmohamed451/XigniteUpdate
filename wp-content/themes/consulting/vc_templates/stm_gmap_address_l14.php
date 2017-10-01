<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>

<?php if(!empty($country) and !empty($title) and !empty($lng) and !empty($lat)): ?>
	<div
		class="single-loc"
		data-country="<?php echo esc_attr($country) ?>"
	    data-title="<?php echo esc_attr($title) ?>"
		data-lat="<?php echo esc_attr($lat) ?>"
		data-lng="<?php echo esc_attr($lng) ?>"
		></div>
<?php endif; ?>
