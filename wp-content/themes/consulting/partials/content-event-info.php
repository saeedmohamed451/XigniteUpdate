<?php
$stm_event_count = get_post_meta( get_the_ID(), 'stm_event_count', true );
$event_attended = get_post_meta( get_the_ID(), 'event_attended', true );
if( $event_attended == '' ) {
    $event_attended = 0;
}
?>

<h2><?php consulting_page_title(); ?></h2>
<?php if ( has_post_thumbnail() ): ?>
    <?php
    $post_thumbnail = wpb_getImageBySize( array(
        'attach_id'  => get_post_thumbnail_id(),
        'thumb_size' => 'full',
    ) );
    $post_thumbnail = $post_thumbnail['thumbnail'];
    ?>
    <div class="item_thumbnail">
        <?php echo $post_thumbnail; ?>
    </div>
<?php endif; ?>
<div class="event_info_table">
    <div class="event_info">
        <?php
        // Date
        $stm_event_date_start = get_post_meta( get_the_ID(), 'stm_event_date_start', true );
        $stm_event_date_end = get_post_meta( get_the_ID(), 'stm_event_date_end', true );

        // Time - Number
        $stm_event_time_end = get_post_meta( get_the_ID(), 'stm_event_time_end', true );
        $stm_event_time_start = get_post_meta( get_the_ID(), 'stm_event_time_start', true );

        // Time - Text
        $stm_event_time_text = get_post_meta( get_the_ID(), 'stm_event_time_text', true )
        ?>
        <?php if( !empty( $stm_event_date_start ) || !empty( $stm_event_time_start ) || !empty( $stm_event_time_text ) ) : ?>
            <ul class="event-info__datetime" style="min-width: 134px;">
                <?php
                $stm_event_month_start = date_i18n('F', $stm_event_date_start);
                $stm_event_month_end = date_i18n('F', $stm_event_date_end);
                $stm_event_day_start = date_i18n('j', $stm_event_date_start);
                $stm_event_day_end = date_i18n('j', $stm_event_date_end);
                $stm_event_year_start = date_i18n('Y', $stm_event_date_end);
                $stm_event_year_end = date_i18n('Y', $stm_event_date_end);
                $stm_event_date = '';

                if( $stm_event_month_start === $stm_event_month_end ) {
                    $stm_event_date .= $stm_event_month_start;
                    if( $stm_event_day_start < $stm_event_day_end ) {
                        $stm_event_date .= ' ' . $stm_event_day_start . ' &ndash; ' . $stm_event_day_end;
                    } else {
                        $stm_event_date .= ' ' .$stm_event_day_start;
                    }
                    $stm_event_date .= ', ' . $stm_event_year_start;
                } else {
                    $stm_event_date .= $stm_event_month_start . ' ' . $stm_event_day_start;
                    $stm_event_date .= ' - ' . $stm_event_month_end . ' ' . $stm_event_day_end;
                    $stm_event_date .= ', ' . $stm_event_year_start;
                }

                $stm_event_tel = get_post_meta( get_the_ID(), 'stm_event_tel', true );
                ?>
                <?php if( !empty( $stm_event_date ) ) : ?>
                    <li><i class="fa fa-calendar" aria-hidden="true"></i>  <?php echo esc_html( $stm_event_date ); ?></li>
                <?php endif; ?>
                <?php if( !empty( $stm_event_time_text ) ) : ?>
                    <li><i class="fa fa-clock-o"></i> <?php echo esc_html( $stm_event_time_text ); ?></li>
                <?php else: ?>
                    <?php if( !empty( $stm_event_time_start ) || !empty( $stm_event_time_end ) ) : ?>
                        <li><i class="fa fa-clock-o"></i> <?php echo (( $stm_event_time_end ) ? esc_html( $stm_event_time_start . ' ' . esc_html__('to', 'consulting') . ' ' . $stm_event_time_end ) : esc_html( $stm_event_time_start ) ); ?></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="event_info">
        <ul>
            <?php if( $stm_event_venue = get_post_meta( get_the_ID(), 'stm_event_venue', true ) ) : ?>
                <li>
                    <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html( $stm_event_venue ); ?>
                </li>
            <?php endif; ?>
            <?php if( !empty( $stm_event_tel ) ) : ?>
                <li>
                    <?php if( !empty( $stm_event_tel ) ) : $stm_event_tel = explode( ';', $stm_event_tel ); ?>
                        <?php foreach( $stm_event_tel as $stm_event_tel_val ) : ?>
                            <i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_attr( $stm_event_tel_val ); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <?php
    $today = date("Ymd");
    ?>
    <?php if( $event_attended < $stm_event_count || $stm_event_count == '' and date_i18n( 'Ymd', $stm_event_date_end ) > $today ) : ?>
    <div class="event_info text-right">
        <a href="#event-form-box" class="vc_general scroll_to_event_form vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-icon-right vc_btn3-color-theme_style_3" href="<?php the_permalink(); ?>">
            <?php esc_html_e( 'join now', 'consulting' ); ?>
            <i class="vc_btn3-icon fa fa-chevron-right"></i>
        </a>
    </div>
    <?php endif; ?>
</div>