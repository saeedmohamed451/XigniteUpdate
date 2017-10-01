<?php
$stm_event_count = get_post_meta( get_the_ID(), 'stm_event_count', true );
$event_attended = get_post_meta( get_the_ID(), 'event_attended', true );
if( $event_attended == '' ) {
    $event_attended = 0;
}
wp_enqueue_style( 'fancybox' );
wp_enqueue_script( 'fancybox' );

$eventId = get_the_ID();

?>

<div class="item">
    <input type="hidden" class="event-item-id" value="<?php echo esc_html($eventId); ?>" />
    <div class="item_wr">
        <div class="content">
            <h4><?php the_title(); ?></h4>
            <ul class="stm-event__meta">
                <?php if( $stm_event_date_start = get_post_meta( get_the_ID(), 'stm_event_date_start', true ) ) : ?>
                    <li>
                        <div class="event__calendar">
                            <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date_i18n( 'F j, Y', $stm_event_date_start ); ?>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if( $stm_event_time_text = get_post_meta( get_the_ID(), 'stm_event_time_text', true ) ) : ?>
                    <li>
                        <div class="event__time">
                            <i class="fa fa-clock-o"></i> <?php echo esc_html( $stm_event_time_text ); ?>
                        </div>
                    </li>
                <?php else: ?>
                    <?php
                    $stm_event_time_end = get_post_meta( get_the_ID(), 'stm_event_time_end', true );
                    $stm_event_time_start = get_post_meta( get_the_ID(), 'stm_event_time_start', true );
                    ?>
                    <?php if( !empty( $stm_event_time_start ) || !empty( $stm_event_time_end ) ) : ?>
                        <li>
                            <div class="event__time"><i class="fa fa-clock-o"></i>
                                <?php
                                if( $stm_event_time_start != '' && $stm_event_time_end != '' ) {
                                    echo esc_html( $stm_event_time_start ) . ' ' . esc_html__('to', 'consulting') . ' ' . esc_html( $stm_event_time_end );
                                } elseif( $stm_event_time_start == '' ) {
                                    echo esc_html( $stm_event_time_end );
                                } elseif( $stm_event_time_end == '' ) {
                                    echo esc_html( $stm_event_time_start );
                                }
                                ?>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if( $stm_event_venue = get_post_meta( get_the_ID(), 'stm_event_venue', true ) ) : ?>
                    <li>
                        <div class="event__venue">
                            <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html($stm_event_venue); ?>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <?php if ( has_post_thumbnail() ): ?>
            <?php
            if ( empty( $img_size ) ) {
                $img_size = 'consulting-image-825x408-croped';
            }

            $post_thumbnail = wpb_getImageBySize( array(
                'attach_id'  => get_post_thumbnail_id(),
                'thumb_size' => $img_size,
            ) );
            $post_thumbnail = $post_thumbnail['thumbnail'];
            ?>
            <div class="item_thumbnail">
                <?php echo $post_thumbnail; ?>
            </div>
        <?php endif; ?>
        <div class="event_read_more">
            <a class="button bordered icon_right" href="<?php the_permalink(); ?>">
                <?php esc_html_e( 'read more', 'consulting' ); ?>
                <i class="fa fa-chevron-right"></i>
            </a>
        </div>
        <div class="event_joining_count_box">
            <?php
                $stm_event_date_end = get_post_meta( get_the_ID(), 'stm_event_date_end', true );
                $today = date("Ymd");
            ?>
            <?php if( date_i18n( 'Ymd', $stm_event_date_end ) < $today ) : ?>
                <div class="event_joining">
                    <span class="vc_general disabled vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-outline vc_btn3-color-theme_style_4">
                        <?php esc_html_e( 'past event', 'consulting' ); ?>
                    </span>
                </div>
            <?php elseif( $event_attended < $stm_event_count || $stm_event_count == '' ) : ?>
                <div class="event_joining">
                    <a href="javascript:void(0);" class="vc_general show_event_list_form vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-outline vc_btn3-color-theme_style_4">
                        <?php esc_html_e( 'i am going', 'consulting' ); ?>
                    </a>
                </div>
            <?php else : ?>
                <div class="event_joining">
                <span class="vc_general disabled vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-outline vc_btn3-color-theme_style_4">
                    <?php esc_html_e( 'fully booked', 'consulting' ); ?>
                </span>
                </div>
            <?php endif; ?>
            <div class="event_joining_count">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <span class="event-attended-count"><?php echo esc_html( $event_attended ); ?></span>
            </div>
        </div>
    </div>
</div>
