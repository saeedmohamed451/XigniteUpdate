<div class="item">
    <div class="item_wr">
        <div class="content">
            <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
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
    </div>
</div>