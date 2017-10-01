<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$css_class .= ' legend_position_' . $legend_position;

wp_enqueue_script( 'Chart' );

$chart_id = uniqid( 'chart_' );

$values        = (array) vc_param_group_parse_atts( $values );
$values_circle = (array) vc_param_group_parse_atts( $values_circle );

$x_values = explode( ';', trim( $x_values, ';' ) );

$canvas_style = array(
	'height' => '300',
	'width'  => '500'
);

if ( $height ) {
	$canvas_style['height'] = $height;
}

if ( $width ) {
	$canvas_style['width'] = $width;
}

$data = array(
	'labels'   => $x_values,
	'datasets' => array()
);

if ( $design == 'line' || $design == 'bar' ) {
	foreach ( $values as $k => $v ) {

		$color = $v['color'];
		$rgb   = vc_hex2rgb( $color );

		if ( $design == 'line' ) {
			$data['datasets'][] = array(
				'label'                => isset( $v['title'] ) ? $v['title'] : '',
				'fillColor'            => 'rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 0.2)',
				'strokeColor'          => 'rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 1)',
				'pointColor'           => 'rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 1)',
				'pointStrokeColor'     => '#fff',
				'pointHighlightFill'   => '#fff',
				'pointHighlightStroke' => 'rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 1)',
				'pointColor'           => $color,
				'data'                 => explode( ';', isset( $v['y_values'] ) ? trim( $v['y_values'], ';' ) : '' ),
			);
		} elseif ( $design == 'circle' ) {
			$data['datasets'][] = array(
				'label'      => isset( $v['title'] ) ? $v['title'] : '',
				'highlight'  => 'rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 0.75)',
				'color'      => $color,
				'pointColor' => $color,
				'data'       => explode( ';', isset( $v['y_values'] ) ? trim( $v['y_values'], ';' ) : '' ),
			);
		} else {
			$data['datasets'][] = array(
				'label'           => isset( $v['title'] ) ? $v['title'] : '',
				'fillColor'       => 'rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 0.8)',
				'strokeColor'     => 'rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 0)',
				'highlightFill'   => 'rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 1)',
				'highlightStroke' => 'rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 1)',
				'pointColor'      => $color,
				'data'            => explode( ';', isset( $v['y_values'] ) ? trim( $v['y_values'], ';' ) : '' ),
			);
		}
	}
} else {
	foreach ( $values_circle as $k => $v ) {

		$color = $v['color'];
		$rgb   = vc_hex2rgb( $color );

		$data['datasets'][] = array(
			'label'      => isset( $v['title'] ) ? $v['title'] : '',
			'highlight'  => 'rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 0.75)',
			'color'      => $color,
			'pointColor' => $color,
			'value'      => $v['value'],
		);
	}
}

?>
<?php if( $values && $x_values ): ?>
	<div class="stm_chart<?php echo esc_attr( $css_class ); ?>">
		<canvas id="<?php echo esc_attr($chart_id); ?>"></canvas>
		<?php if ( $legend ): ?>
				<ul class="chart-legend">
					<?php foreach ( $data['datasets'] as $v ) { ?>
						<?php $color = is_array( $v['pointColor'] ) ? current( $v['pointColor'] ) : $v['pointColor']; ?>
						<li><span style="background-color:<?php echo esc_attr( $color ); ?>;"></span><?php echo esc_html( $v['label'] ); ?></li>
					<?php } ?>
				</ul>
		<?php endif; ?>
		<script type="text/javascript">

			jQuery(window).on('load', function ($) {
				<?php if( $design == 'line' || $design == 'bar' ): ?>
				var ChartData_<?php echo esc_js( $chart_id ); ?> = <?php echo json_encode( $data ); ?>;
				<?php else: ?>
				var ChartData_<?php echo esc_js( $chart_id ); ?> = <?php echo json_encode( $data['datasets'] ); ?>;
				<?php endif; ?>
				var <?php echo esc_js( $chart_id ); ?> = jQuery("#<?php echo esc_js( $chart_id ); ?>").get(0).getContext("2d");
				<?php echo esc_js( $chart_id ); ?>.canvas.width = <?php echo esc_js( $canvas_style[ 'width' ] ); ?>;
				<?php echo esc_js( $chart_id ); ?>.canvas.height = <?php echo esc_js( $canvas_style[ 'height' ] ); ?>;
				<?php if( $design == 'line' ){ ?>
				new Chart(<?php echo esc_js( $chart_id ); ?>).Line(ChartData_<?php echo esc_js( $chart_id ); ?>, {
					responsive: false
				});
				<?php }elseif( $design == 'bar' ){ ?>
				new Chart(<?php echo esc_js( $chart_id ); ?>).Bar(ChartData_<?php echo esc_js( $chart_id ); ?>, {
					responsive: false
				});
				<?php }elseif( $design == 'pie' ){ ?>
				new Chart(<?php echo esc_js( $chart_id ); ?>).Pie(ChartData_<?php echo esc_js( $chart_id ); ?>, {
					responsive: false,
					segmentShowStroke: false
				});
				<?php }else{ ?>
				new Chart(<?php echo esc_js( $chart_id ); ?>).Doughnut(ChartData_<?php echo esc_js( $chart_id ); ?>, {
					responsive: false,
					barShowStroke : true
				});
				<?php } ?>
			});


		</script>
	</div>
<?php endif; ?>