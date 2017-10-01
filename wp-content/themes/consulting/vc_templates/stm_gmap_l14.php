<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

wp_enqueue_script( 'gmap' );

$gmap_id = uniqid( 'stm-gmap-' );
$map_id = uniqid( 'map_' );

$map_style = array();

if ( $map_height ) {
	$map_style['height'] = 'height: ' . $map_height . ';';
}

if ( $disable_mouse_whell == 'disable' ) {
	$disable_mouse_whell = 'false';
} else {
	$disable_mouse_whell = 'true';
}

$consulting_config = consulting_config();
$marker_id = '';

if( $consulting_config['layout'] != 'layout_1' && $consulting_config['layout'] != 'layout_12' ) {
	$marker_id = $consulting_config['layout'] . '_';
}

if( ! $marker ){
	if ( get_theme_mod( 'frontend_customizer' ) ) {
		if( ! empty( $_COOKIE['site_style'] ) ){
			$marker = get_template_directory_uri() . '/assets/images/markers/map-marker-' . $_COOKIE['site_style'] . '.png';
		} else {
			$marker = get_template_directory_uri() . '/assets/images/markers/map-marker-'. $marker_id .'skin_default.png';
		}
	} else {
		$marker = get_template_directory_uri() . '/assets/images/markers/map-marker-'. $marker_id .'skin_default.png';
	}
}else{
	$marker = wp_get_attachment_image_url( $marker, 'full' );
}

if(!empty($content)) {
	$adds = explode(']', $content);

	if(!empty($adds)) {
		foreach($adds as $key => $add) {
			$adds[$key] = shortcode_parse_atts(str_replace(array('[', ']'), '', $add));
		}
		$adds = array_filter($adds);
	}

	$addresses = array();

	foreach($adds as $key => $add) {
		if(empty($addresses[sanitize_text_field($add['country'])])) {
			$addresses[ sanitize_text_field( $add['country'] ) ] = array(
				'label' => $add['country'],
				'offices' => array()
			);
		}
		$addresses[ sanitize_text_field( $add['country'] ) ]['offices'][] =  $add;
	}
}

?>

<?php if ( ! empty( $addresses ) ): ?>
	<div id="<?php echo esc_attr( $map_id ); ?>" class="stm_gmap_wrapper stm_gmap_wrapper_l14<?php echo esc_attr( $css_class ); ?>">
		<div class="container">
			<div class="row">
				<?php if(!empty($map_title)): ?>
					<div class="col-md-6 col-sm-6">
						<div class="vc_custom_heading">
							<h1 style="font-size: 36px;"><?php echo esc_attr($map_title); ?></h1>
						</div>
					</div>
				<?php endif; ?>
				<div class="col-md-6 col-sm-6">
					<div class="addresses">
						<script type="text/javascript">
							var stm_markers_filter = <?php echo json_encode($adds) ?>;
						</script>
						<?php echo wpb_js_remove_wpautop( $content ); ?>
						<div class="row">
							<div class="col-md-6 col-sm-6 stm_select_country_unit">
								<select class="stm_select_country">
									<option value=""><?php esc_html_e('Select a country&hellip;', 'consulting'); ?></option>
									<?php foreach($addresses as $key_add => $address): ?>
										<option value="<?php echo esc_attr($key_add) ?>"><?php echo esc_attr($address['label']); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-6 col-sm-6 stm_select_office_unit">
								<select class="stm_select_office">
									<option value=""><?php esc_html_e('Select a state&hellip;', 'consulting'); ?></option>
									<?php foreach($addresses as $key_add => $address): ?>
										<?php if(!empty($address['offices'])): ?>
											<?php foreach($address['offices'] as $office_key => $office): ?>
												<option data-country="<?php echo esc_attr($address['label']); ?>" value="<?php echo esc_attr($office_key); ?>"><?php echo esc_attr($office['title']); ?></option>
											<?php endforeach; ?>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div<?php echo( ( $map_style ) ? ' style="' . esc_attr( implode( ' ', $map_style ) ) . '"' : '' ); ?> id="<?php echo esc_attr( $gmap_id ); ?>" class="stm_gmap"></div>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			var stm_markers = [];
			$.each(stm_markers_filter, function(index, value){
				if(typeof(value) == 'object') {
					if(typeof(value.country) !== 'undefined' && typeof(stm_markers[value.country]) === 'undefined') {
						stm_markers[value.country] = [];
					}
					if(typeof(value.lng) !== 'undefined' && typeof(value.title) !== 'undefined' && typeof(value.lat) !== 'undefined') {
						stm_markers[value.country].push({
							'title': value.title,
							'lat': value.lat,
							'lng': value.lng
						});
					}
				}
			});

			google.maps.event.addDomListener(window, 'load', init);
			var <?php echo esc_js( $map_id ); ?>, markers = [], gmarkers = [], default_marker_icon = '<?php echo esc_url( $marker ); ?>';
			function init() {

				var mapStyles = [
					{
						"featureType": "administrative",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#444444"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "all",
						"stylers": [
							{
								"color": "#f2f2f2"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "all",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"lightness": 45
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"color": "#6c98e1"
							},
							{
								"visibility": "on"
							}
						]
					}
				];

				<?php if( !empty( $gmap_style ) ) : ?>
				mapStyles = <?php echo rawurldecode(base64_decode(strip_tags($gmap_style))); ?>;
				<?php endif; ?>

				var mapOptions = {
					zoom: <?php echo esc_js( $map_zoom ); ?>,
					streetViewControl: false,
					scrollwheel: <?php echo esc_js( $disable_mouse_whell ); ?>,
					styles: mapStyles
				};
				var mapElement = document.getElementById('<?php echo esc_js( $gmap_id ); ?>');
				<?php echo esc_js( $map_id ); ?> = new google.maps.Map(mapElement, mapOptions);
				consulting_setMarkers();

			}

			$('#<?php echo esc_js($map_id) ?> select.stm_select_country').select2().on('change', function(){
				var currentCountry = $(this).val();
				$('select.stm_select_office option').each(function(){
					$(this).removeAttr('disabled');
				})
				if(currentCountry !== '') {
					$('select.stm_select_office option').each(function () {
						var office_val = $(this).val();
						var office_country = $(this).attr('data-country');
						if (office_val !== '') {
							if (currentCountry !== office_country) {
								$(this).attr('disabled', 'disabled');
							}
						}
					});
				}
				$('select.stm_select_office').select2({width: '100%', minimumResultsForSearch: '-1'});
				$('select.stm_select_office').select2("val", "");
				consulting_setMarkers();
			});

			$('#<?php echo esc_js($map_id) ?> select.stm_select_office').select2().on('change', function(){
				consulting_setMarkers();
			});

			function consulting_setMarkers(){
				var latlngbounds = new google.maps.LatLngBounds();
				markers = [];

				var $stm_select_country = $('.stm_select_country').val();
				var $stm_select_office = $('.stm_select_office').val();

				if($stm_select_country == '' && $stm_select_office == '') {
					$('.single-loc').each(function(){
						markers.push(
							[
								parseFloat($(this).data('lat')),
								parseFloat($(this).data('lng')),
								$(this).data('title')
							]
						);
					});
				} else if($stm_select_office !== '') {
					var country = $('.stm_select_office').find(':selected').data('country');
					var setPin = stm_markers[country][$stm_select_office];
					markers.push(
						[
							parseFloat(setPin['lat']),
							parseFloat(setPin['lng']),
							setPin['title']
						]
					);
				} else if($stm_select_country !== '') {
					$('.single-loc[data-country="'+ $stm_select_country +'"]').each(function(){
						markers.push(
							[
								parseFloat($(this).data('lat')),
								parseFloat($(this).data('lng')),
								$(this).data('title')
							]
						);
					});
				}

				for (i = 0; i < gmarkers.length; i++) {
					gmarkers[i].setMap(null);
				}
				for (var i = 0; i < markers.length; i++) {
					var marker_array = markers[i];
					marker = new google.maps.Marker({
						position: {lat: marker_array[0], lng: marker_array[1]},
						icon: default_marker_icon,
						map: <?php echo esc_js( $map_id ); ?>,
						title: marker_array[2]
					});
					latlngbounds.extend(new google.maps.LatLng(marker_array[0], marker_array[1]));
					gmarkers.push( marker );
					addInfoWindow( marker, marker_array[2], marker_array[0] );
				}
				<?php echo esc_js( $map_id ); ?>.fitBounds(latlngbounds);

				if( markers.length === 1 ) {
					var listener = google.maps.event.addListener(<?php echo esc_js( $map_id ); ?>, "idle", function() {
						<?php echo esc_js( $map_id ); ?>.setZoom(<?php echo esc_js( $map_zoom ); ?>);
						google.maps.event.removeListener(listener);
					});
				}
			}

			function addInfoWindow(marker, title, lat) {

				var infowindow = new google.maps.InfoWindow({
					content: '<h6>' + title + '</h6>',
					pixelOffset: new google.maps.Size(0,20)
				});

				google.maps.event.addListener(marker, 'mouseover', function () {
					infowindow.open(<?php echo esc_js( $map_id ); ?>, marker);
					$('[data-lat="'+ lat +'"]').addClass("focused");
				});

				google.maps.event.addListener(marker, 'mouseout', function () {
					infowindow.close(<?php echo esc_js( $map_id ); ?>, marker);
					$('[data-lat="'+ lat +'"]').removeClass("focused");
				});

				$(".item").on("mouseenter", function() {
					if( parseFloat(marker.getPosition().lat()) === parseFloat($(this).data('lat')) ) {
						infowindow.open(<?php echo esc_js( $map_id ); ?>, marker);
					}
				});

				$(".item").on("mouseleave", function() {
					if( parseFloat(marker.getPosition().lat()) === parseFloat($(this).data('lat')) ) {
						infowindow.close(<?php echo esc_js( $map_id ); ?>, marker);
					}
				});
			}


		});
	</script>
<?php endif; ?>