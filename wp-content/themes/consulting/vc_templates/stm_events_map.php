<?php
/** Variables **/
$height = '';
$zoom = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$map_id = uniqid('stm_map_');

$map_style = array();

if ( $map_height ) {
    $map_style['height'] = 'height: ' . $map_height . ';';
}

$latitude = get_post_meta( get_the_ID(), 'stm_event_map_lat', true );
$longitude = get_post_meta( get_the_ID(), 'stm_event_map_lng', true );

if( empty( $zoom ) ) {
    $zoom = '14';
}

/** Styles **/
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>
<div class="stm-events_map<?php echo esc_attr( $css_class ); ?>">
    <script type="text/javascript">
        <?php $google_api_key = get_theme_mod( 'google_api_key' ); ?>
        var mapId = '<?php echo esc_js( $map_id ); ?>',
            mapLat = '<?php echo esc_js( $latitude ); ?>',
            mapLng = '<?php echo esc_js( $longitude ); ?>',
            mapZoom = <?php echo esc_js( $zoom ); ?>;

        function initialize_map_<?php echo esc_js( $map_id ); ?>() {
            var myLatlng = new google.maps.LatLng( mapLat, mapLng );
            var mapOptions = {
                zoom: mapZoom,
                navigationControl: false,
                scrollwheel: false,
                mapTypeControl: false,
                center: myLatlng
            };

            var map = new google.maps.Map(document.getElementById( mapId ), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                animation: google.maps.Animation.DROP
            });

        }

        function loadScript() {
            var script = document.createElement("script");
            script.type = "text/javascript";
            <?php if( !empty($google_api_key) ) { ?>
            script.src = "https://maps.googleapis.com/maps/api/js?key=<?php echo $google_api_key ?>&v=3.exp&signed_in=true&callback=initialize_map_"+mapId+"&language=en";
            <?php } else { ?>
            script.src = "https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&callback=initialize_map_"+mapId+"&language=en";
            <?php } ?>
            document.body.appendChild(script);
        }

        window.onload = loadScript;

    </script>
    <div class="stm-map__canvas" id="<?php echo esc_attr( $map_id ); ?>" <?php echo( ( $map_style ) ? ' style="' . esc_attr( implode( ' ', $map_style ) ) . '"' : '' ); ?>></div>
</div>