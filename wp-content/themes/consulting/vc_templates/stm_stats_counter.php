<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if( ! wp_is_mobile() ){
}
wp_enqueue_script( 'countUp' );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$id = uniqid( 'counter_' );

if(empty($stats_style)) {
	$stats_style = '';
}

if(empty($color)) {
	$color = '';
} else {
	$color = 'style="color:'.$color.'"';
}

?>

<div class="stats_counter <?php echo $stat_counter_style; ?> <?php echo $alignment; ?> <?php echo esc_attr($stats_style); echo esc_attr( $css_class ); ?>" <?php echo $color; ?>>
	<div class="inner">
		<?php if( wp_is_mobile() ){ ?>
			<h3 class="no_stripe" id="<?php echo esc_attr( $id ); ?>" <?php echo $color; ?>>
				<?php echo esc_attr( $counter_value_pre ); ?>
				<?php echo esc_attr( $counter_value ); ?>
				<?php echo esc_attr( $counter_value_suf ); ?>
			</h3>
		<?php }else{ ?>
			<h3 class="no_stripe" id="<?php echo esc_attr( $id ); ?>" <?php echo $color; ?>>0</h3>
		<?php } ?>
		<?php if ( $title ) { ?>
			<div class="counter_title" <?php echo $color; ?>><?php echo esc_html( $title ); ?></div>
		<?php } ?>
        <?php if ( $description ) { ?>
            <div class="counter_description">
                <p><?php echo wp_kses( $description, array( 'br' => array() ) ); ?></p>
            </div>
        <?php } ?>
		<?php if( ! wp_is_mobile() ){ ?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					var <?php echo esc_attr( $id ); ?> = new countUp("<?php echo esc_attr( $id ); ?>", 0, <?php echo esc_attr( $counter_value ); ?>, 0, <?php echo esc_attr( $duration ); ?>, {
						useEasing : true,
						useGrouping: false,
						prefix : '<?php echo esc_js( $counter_value_pre ); ?>',
						suffix : '<?php echo esc_js( $counter_value_suf ); ?>'
					});
					$(window).scroll(function(){
						if( $("#<?php echo esc_attr( $id ); ?>").is_on_screen() ){
							<?php echo esc_attr( $id ); ?>.start();
						}
					});
				});
			</script>
		<?php } ?>
	</div>
</div>