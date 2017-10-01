<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>

<div class="project_info<?php echo esc_attr( $css_class . ' ' . $style ); ?>">
	<?php if ( $title ) { ?>
		<h4><?php echo esc_html( $title ); ?></h4>
	<?php } ?>
	<?php if ( ! empty( $content ) ) { ?>
		<div class="project_info_wr">
			<table>
				<?php echo wpb_js_remove_wpautop( $content ); ?>
			</table>
		</div>
	<?php } ?>
</div>