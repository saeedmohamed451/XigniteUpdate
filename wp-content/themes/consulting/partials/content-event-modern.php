<div class="item">
    <div class="item_wr">
        <div class="content">
            <div class="stm_events_modern_row">
                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            </div>
            <?php if( $stm_event_speakers = get_post_meta( get_the_ID(), 'stm_event_speakers', true ) ) : ?>
                <div class="stm_events_modern_row">
                    <?php if( !empty( $stm_event_speakers )) : ?>
                        <?php $stm_event_speakers = explode(',', $stm_event_speakers); ?>
                        <?php foreach ($stm_event_speakers as $stm_event_speaker) : ?>
                            <?php if( !empty( $stm_event_speaker )) : ?>
                            <div class="event_speaker_row">
                                <div class="event_speaker_thumbnail">
                                    <?php
                                    if ( empty( $img_size ) ) {
                                        $img_size = 'consulting-image-80x80-croped';
                                    }
                                    $post_thumbnail = wpb_getImageBySize( array(
                                        'attach_id'  => get_post_thumbnail_id($stm_event_speaker),
                                        'thumb_size' => $img_size,
                                    ) );
                                    $post_thumbnail = $post_thumbnail['thumbnail'];
                                    ?>
                                    <?php echo $post_thumbnail; ?>
                                </div>
                                <div class="event_speaker_content">
                                    <?php if( $stm_event_venues = get_post_meta( $stm_event_speaker, 'department', true ) ) : ?>
                                        <div class="event_speaker_description"><?php echo esc_html($stm_event_venues); ?></div>
                                    <?php endif; ?>
                                    <div class="event_speaker_name">
                                        <a href="<?php the_permalink($stm_event_speaker); ?>"><?php echo get_the_title($stm_event_speaker); ?></a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if( $stm_event_date_start = get_post_meta( get_the_ID(), 'stm_event_date_start', true ) ) : ?>
                <div class="stm_events_modern_row">
                    <div class="event__calendar">
                        <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date_i18n( 'F j, Y', $stm_event_date_start ); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if( $stm_event_venue = get_post_meta( get_the_ID(), 'stm_event_venue', true ) ) : ?>
                <div class="stm_events_modern_row">
                    <div class="event__venue">
                        <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html($stm_event_venue); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>