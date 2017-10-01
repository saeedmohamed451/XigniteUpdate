<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

wp_enqueue_script( 'gmap' );
wp_enqueue_script( 'owl.carousel' );
wp_enqueue_style( 'owl.carousel' );

$owl_id     = uniqid( 'owl_' );
$owl_nav_id = uniqid( 'owl-nav-' );

$gmap_id = uniqid( 'stm-gmap-' );
$map_id = uniqid( 'map_' );

$map_style = array();

if(empty($el_class)) {
	$el_class = '';
}

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

?>
<?php if ( ! empty( $content ) ): ?>
	<div id="<?php echo esc_attr( $map_id ); ?>" class="<?php echo esc_attr($el_class); ?> stm_gmap_wrapper<?php echo esc_attr( $css_class ); ?>">
		<?php $google_api_key = get_theme_mod( 'google_api_key', false );
		if( current_user_can('administrator') && empty( $google_api_key ) ){ ?>
			<div class="alert alert-danger alert-dismissible fade in text-center">
				<button class="close" type="button" data-dismiss="alert">×</button>
				You need to enter your <strong>Google Maps API key</strong> under Appearance > Customize > Site Settings > Google API Settings.
			</div>
		<?php } ?>
		<div<?php echo( ( $map_style ) ? ' style="' . esc_attr( implode( ' ', $map_style ) ) . '"' : '' ); ?> id="<?php echo esc_attr( $gmap_id ); ?>" class="stm_gmap"></div>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				google.maps.event.addDomListener(window, 'load', init);
				var <?php echo esc_js( $map_id ); ?>, markers = [], gmarkers = [], <?php echo esc_js( $owl_id ); ?> = $("#<?php echo esc_js( $owl_id ); ?>"), default_marker_icon = '<?php echo esc_url( $marker ); ?>';
				$("#skin_color span").on('click', function () {
					for (var i = 0; i < gmarkers.length; i++) {
						if( $(this).attr('id') == 'skin_default' ){
							gmarkers[i].setIcon('<?php echo get_template_directory_uri(); ?>/assets/images/markers/map-marker-skin_default.png');
						}else{
							gmarkers[i].setIcon('<?php echo get_template_directory_uri(); ?>/assets/images/markers/map-marker-'+$(this).attr('id')+'.png');
						}
					}
				});
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
						zoomControlOptions: {
							position: google.maps.ControlPosition.LEFT_TOP
						},
						streetViewControl: false,
						scrollwheel: <?php echo esc_js( $disable_mouse_whell ); ?>,
						styles: mapStyles

					};
					var mapElement = document.getElementById('<?php echo esc_js( $gmap_id ); ?>');
					<?php echo esc_js( $map_id ); ?> = new google.maps.Map(mapElement, mapOptions);

					<?php echo esc_js( $owl_id ); ?>.on('initialized.owl.carousel', function () {
						consulting_setMarkers();
					});

					var owlRtl = false;

					if( $('body').hasClass('rtl') ) {
						owlRtl = true;
					}

					<?php echo esc_js( $owl_id ); ?>.owlCarousel({
						rtl: owlRtl,
						dotsContainer: '#<?php echo esc_js( $owl_nav_id ); ?>',
						items: 3,
						margin: 70,
                        loop: true,
						responsive: {
							0: {
								items: 1
							},
							768: {
								items: 2
							},
							992: {
								items: 3
							}
						},
						onTranslated: function () {
							consulting_setMarkers();
						}
					});
				}
				function consulting_setMarkers(){
					var latlngbounds = new google.maps.LatLngBounds();
					markers = [];
					<?php echo esc_js( $owl_id ); ?>.find('.owl-item.active').each(function (i) {
						markers.push([parseFloat($(this).find('.item').data('lat')), parseFloat($(this).find('.item').data('lng')), $(this).find('.item').data('title')]);
					});
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
		<div class="gmap_addresses">
			<div class="container">
				<div class="row">
					<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
						<div class="addresses_wr">
							<div class="addresses" id="<?php echo esc_attr( $owl_id ); ?>">
								<?php echo wpb_js_remove_wpautop( $content ); ?>
							</div>
						</div>
					</div>
					<div class="owl-dots-wr">
						<div class="owl-dots" id="<?php echo esc_attr( $owl_nav_id ); ?>"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>