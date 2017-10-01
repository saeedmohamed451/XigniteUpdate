<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$content = str_replace('[stm_event_lessons', '[stm_event_lessons stm_date_format="' . $stm_event_lesson_date_format . '" stm_time_format="' . $stm_event_lesson_time_format . '"', $content );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>

<div class="events_lessons_box">
    <?php echo wpb_js_remove_wpautop( $content ); ?>
</div>
