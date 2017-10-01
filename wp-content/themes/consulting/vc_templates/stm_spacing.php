<?php
/* === VARIABLES === */
$spacing_type = '';
$lg_spacing = '';
$md_spacing = '';
$sm_spacing = '';
$xs_spacing = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* === ID === */
$spacing_id = uniqid("stm-spacing-");
?>
<div class="stm-spacing" id="<?php echo esc_attr( $spacing_id ); ?>"></div>
<script>
	(function($){
		"use strict";
		var spacingID = '<?php echo esc_js( $spacing_id ); ?>',
			  lgSpacing = '<?php echo esc_js( $lg_spacing ); ?>',
			  mdSpacing = '<?php echo esc_js( $md_spacing ); ?>',
			  smSpacing = '<?php echo esc_js( $sm_spacing ); ?>',
			  xsSpacing = '<?php echo esc_js( $xs_spacing ); ?>';

		function stmSpacing() {
			if ( window.matchMedia("(min-width: 1200px)").matches && lgSpacing ) {
				$( '#' + spacingID ).css ( "height", lgSpacing );
			} else if ( window.matchMedia("(max-width: 1199px) and (min-width: 992px )").matches && mdSpacing ) {
				$( '#' + spacingID ).css ( "height", mdSpacing );
			} else if ( window.matchMedia("(max-width: 991px) and (min-width: 768px )").matches && smSpacing ) {
				$( '#' + spacingID ).css ( "height", smSpacing );
			} else if ( window.matchMedia("(max-width: 767px)").matches && xsSpacing ) {
				$( '#' + spacingID ).css ( "height", xsSpacing );
			} else {
				$( '#' + spacingID ).css ( "height", "" );
			}
		}

		$(document).ready(function() {
			stmSpacing();
		});

		$(window).resize(function() {
			stmSpacing();
		});

	})(jQuery);
</script>

