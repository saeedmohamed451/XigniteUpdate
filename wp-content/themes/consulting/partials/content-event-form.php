<?php
$stm_event_count = get_post_meta( get_the_ID(), 'stm_event_count', true );
$event_attended = get_post_meta( get_the_ID(), 'event_attended', true );
if( $event_attended == '' ) {
    $event_attended = 0;
}
?>

<div class="event-members-box-table bordered">
    <div class="event-members-box-table-row">
        <div class="event-addtoany">
            <?php esc_html_e("SHARE", 'consulting'); ?> <?php echo do_shortcode('[addtoany]'); ?>
        </div>
    </div>
    <div class="event-members-box-table-row text-right">
        <?php
        // Date
        $stm_event_date_start = get_post_meta( get_the_ID(), 'stm_event_date_start', true );
        $stm_event_date_end = get_post_meta( get_the_ID(), 'stm_event_date_end', true );

        // Date Format
        if( !empty( $stm_event_date_start ) and !empty( $stm_event_date_end ) ) {
            $event_month_start = date_i18n('n', $stm_event_date_start);
            $event_month_end = date_i18n('n', $stm_event_date_end);
            $event_day_start = date_i18n('j', $stm_event_date_start);
            $event_day_end = date_i18n('j', $stm_event_date_end);
            $event_year_start = date_i18n('Y', $stm_event_date_end);
            $event_year_end = date_i18n('Y', $stm_event_date_end);
        }

        // Time - Number
        $stm_event_time_end = get_post_meta( get_the_ID(), 'stm_event_time_end', true );
        $stm_event_time_start = get_post_meta( get_the_ID(), 'stm_event_time_start', true );

        // Venue
        $stm_event_venue = get_post_meta( get_the_ID(), 'stm_event_venue', true);
        ?>

        <script type="text/javascript">(function () {
            if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
            if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
                s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
                var h = d[g]('body')[0];h.appendChild(s); }
            })();
            (function($) {
                "use strict";
                $(document).ready(function() {
                    $( ".addtocalendar .vc_general" ).click(function( event ) {
                        event.stopPropagation();
                        $(".atcb-list").slideDown();
                        $(".vc_general").addClass("vc_general-active");
                    });
                    $( window ).click(function() {
                        $(".atcb-list").slideUp();
                        $(".vc_general").removeClass("vc_general-active");
                    });
                    $( window ).scroll(function() {
                        $(".atcb-list").slideUp();
                        $(".vc_general").removeClass("vc_general-active");
                    });

                });

            })(jQuery);
        </script>
        <!-- Event data -->
        <?php if( !empty( $stm_event_date_start ) and !empty( $stm_event_date_end ) ) : ?>
        <div class="addtocalendar">
            <var class="atc_event">
                <var class="atc_date_start"><?php echo $event_year_start ?>-<?php echo $event_month_start ?>-<?php echo $event_day_start ?> <?php echo esc_html( $stm_event_time_start ); ?></var>
                <var class="atc_date_end"><?php echo $event_year_end ?>-<?php echo $event_month_end ?>-<?php echo $event_day_end ?> <?php echo esc_html( $stm_event_time_end ); ?></var>
                <var class="atc_timezone"><?php if( get_option('timezone_string') ) : ?><?php echo get_option('timezone_string'); ?><?php else : ?><?php esc_html_e( 'Europe/London', 'consulting' ); ?><?php endif; ?></var>
                <var class="atc_title"><?php the_title(); ?></var>
                <var class="atc_description"><?php echo esc_html(get_the_excerpt()); ?></var>
                <var class="atc_location"><?php if( !empty( $stm_event_venue ) ) : ?><?php echo esc_html( $stm_event_venue ); ?><?php else : ?><?php esc_html_e( 'Not indicated', 'consulting' ); ?><?php endif; ?></var>
            </var>
            <div class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-outline vc_btn3-color-theme_style_4"><?php esc_html_e('save event to calendar', 'consulting'); ?></div>
        </div>
        <?php endif; ?>
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
                    <a href="#event-form-box" class="vc_general scroll_to_event_form show_event_list_form vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-outline vc_btn3-color-theme_style_4">
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

<?php if( $event_attended < $stm_event_count || $stm_event_count == '' and date_i18n( 'Ymd', $stm_event_date_end ) > $today ) : ?>
<div id="event-form-box" class="event-members-box-wrap">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h4><?php esc_html_e("register", 'consulting'); ?></h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 required-info">
            <?php esc_html_e("* All fields are required", 'consulting'); ?>
        </div>
    </div>
    <form id="event-members-form" action="<?php echo esc_url( home_url('/') ); ?>" method="post">
        <div class="event-members-box">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <input name="name" type="text" placeholder="<?php esc_html_e( 'Name *', 'consulting' ); ?>" class="wpcf7-form-control" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <input name="email" type="email" placeholder="<?php esc_html_e( 'Email *', 'consulting' ); ?>" class="wpcf7-form-control" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <input name="phone" type="tel" placeholder="<?php esc_html_e( 'Phone *', 'consulting' ); ?>" class="wpcf7-form-control" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <input name="company" type="text" placeholder="<?php esc_html_e( 'Company Name *', 'consulting' ); ?>" class="wpcf7-form-control" />
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $recaptcha_enabled = get_theme_mod( 'enable_recaptcha', 0 );
                    $recaptcha_public_key = get_theme_mod( 'recaptcha_public_key' );
                    $recaptcha_secret_key = get_theme_mod( 'recaptcha_secret_key' );
                ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <?php if( $event_terms_conditions = get_theme_mod( 'event_terms_conditions', wp_kses( __( "I agree with the all additional <a href='http://stylemixthemes.com/' target='_blank'>Terms and Conditions</a>", 'consulting' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ) ) ): ?>
                        <div class="event_terms_conditions">
                            <input type="checkbox" id="event_terms_conditions" />
                            <label for="event_terms_conditions"><?php _e( $event_terms_conditions, 'consulting'); ?></label>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($recaptcha_enabled) and $recaptcha_enabled and !empty( $recaptcha_public_key ) and !empty( $recaptcha_secret_key ) ) : ?>
                        <div class="input-group">
                            <div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $recaptcha_public_key ); ?>" data-size="normal"></div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                    <div class="input-group">
                        <span class="stm-ajax-loader">
                            <i class="fa fa-refresh" aria-hidden="true"></i>
                        </span>
                        <button type="submit" class="button size-lg icon_left disabled" disabled><i class="fa fa-chevron-right"></i> <?php esc_html_e( "join", 'consulting' ); ?></button>
                    </div>
                </div>
            </div>
            <input name="event_member_id" type="hidden" value="<?php echo esc_attr(get_the_id()); ?>" />
            <div class="form__notice_information form__notice_success alert-modal alert alert-danger text-left">
                <?php esc_html_e( "You already has been joined the event.", 'consulting' ); ?>
            </div>
        </div>
    </form>
</div>
<?php endif; ?>
<?php if( $event_terms_conditions = get_theme_mod( 'event_terms_conditions', wp_kses( __( "I agree with the all additional <a href='http://stylemixthemes.com/' target='_blank'>Terms and Conditions</a>", 'consulting' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ) ) ): ?>
<?php wp_enqueue_script( 'stm_grecaptcha' ); ?>
<?php endif; ?>