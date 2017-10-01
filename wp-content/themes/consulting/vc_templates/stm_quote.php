<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$image_size = '48x48';
$image = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $image_size ) );


?>

<div class="quote_box <?php echo esc_html( $box_color ); ?><?php echo esc_attr( $css_class ); ?>" style="color: <?php echo esc_attr( $box_color_custom ); ?>">
    <?php if( ! empty( $quote ) ): ?>
        <div class="quote">
            <?php echo wp_kses( $quote, array( 'br' => array() ) ); ?>
        </div>
    <?php endif; ?>
    <?php if( ! empty( $image['thumbnail'] ) ){ ?>
        <div class="stm_contact_image">
            <?php echo $image['thumbnail']; ?>
        </div>
    <?php } ?>
    <?php if( ! empty( $author_name ) || ! empty( $author_status ) ): ?>
        <div class="author_info">
            <div class="author_name">
                <?php echo esc_html( $author_name ); ?>
            </div>
            <div class="author_status">
                <?php echo esc_html( $author_status ); ?>
            </div>
        </div>
    <?php endif; ?>
</div>