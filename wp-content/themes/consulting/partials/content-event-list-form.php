<?php
$stm_event_count = get_post_meta( get_the_ID(), 'stm_event_count', true );
$event_attended = get_post_meta( get_the_ID(), 'event_attended', true );
if( $event_attended == '' ) {
    $event_attended = 0;
}
?>

<?php if( $event_attended < $stm_event_count || $stm_event_count == '' ) : ?>
<div id="event-form-box" class="event-members-box-wrap">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h4><?php esc_html_e("register", 'consulting'); ?></h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 required-info">
            <?php esc_html_e("* All fields are required", 'consulting'); ?>
        </div>
        <div class="notice__hide">&times;</div>
    </div>
    <form id="event-members-form" action="<?php echo esc_url( home_url('/') ); ?>" method="post">
        <div class="event-members-box">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <input name="name" type="text" placeholder="Name *" class="wpcf7-form-control" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <input name="email" type="email" placeholder="Email *" class="wpcf7-form-control" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <input name="phone" type="tel" placeholder="Phone *" class="wpcf7-form-control" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <input name="company" type="text" placeholder="Company Name *" class="wpcf7-form-control" />
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
            <input name="event_member_id" type="hidden" class="event_member_id" value="" />
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