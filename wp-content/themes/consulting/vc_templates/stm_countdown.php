<?php
extract( shortcode_atts( array(
    'countdown' => '',
    'countdown_description' => '',
    'download_link' => '',
    'countdown_icon_position' => '',
    'css'   => ''
), $atts ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

wp_enqueue_script( 'countdown' );

$count = rand(0,999999);
?>


<?php if(!empty($countdown)): ?>
    <div class="countdown_box <?php echo esc_attr($css_class); ?>">
        <div class="stm_countdown" id="countdown_<?php echo esc_attr($count); ?>"></div>
        <script type="text/javascript">
            jQuery(function($){
                var flash = false;
                var ts = <?php echo strtotime($countdown) * 1000; ?>;
                if((new Date()) < ts){
                    $('#countdown_<?php echo esc_attr($count); ?>').countdown({
                        timestamp   : ts,
                        callback    : function(days, hours, minutes, seconds){
                            var summaryTime = days + hours+ minutes + seconds;
                            if(summaryTime == 0) {
                                $('#countdown_<?php echo esc_attr($count); ?>').html('<div class="countdown_ended h2">Time is up, sorry!</div>');
                            }
                        }
                    });
                } else {
                    $('#countdown_<?php echo esc_attr($count); ?>').html('<div class="countdown_ended h2">Time is up, sorry!</div>');
                }
            });
        </script>
        <?php if( $countdown_description ){ ?>
            <div class="countdown_description">
                <?php echo esc_html( $countdown_description ); ?>
            </div>
        <?php } ?>
        <?php if( $download_link ){ ?>
            <div class="stm-register-form">
                <form method="post">
                    <input type="hidden" name="redirect" value="disable">
                    <input class="user_validated_field" type="hidden" name="stm_nickname" value="1" />
                    <input type="hidden" name="stm_site_address" value="<?php echo site_url(); ?>" />
                    <input class="user_validated_field" type="hidden" name="stm_user_password" value="<?php echo wp_generate_password(); ?>" />
                    <input class="user_validated_field" type="hidden" name="stm_user_link" value="<?php echo esc_html( $download_link ); ?>" />

                    <input class="user_validated_field" type="email" name="stm_user_mail" placeholder="<?php esc_html_e('Enter your Email', 'consulting') ?>"/>

                    <button type="submit" class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-round vc_btn3-style-flat vc_btn3-color-theme_style_3 vc_btn3-icon-right" /><?php esc_html_e('Download now', 'consulting'); ?> <i style="font-size:12px;" class="vc_btn3-icon stm-stm14_right_arrow"></i></button>

                    <div class="stm-validation-message"></div>

                </form>
            </div>
        <?php } ?>
    </div>
<?php endif; ?>