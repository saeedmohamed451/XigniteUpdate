<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
<div id="fullpage" class="content_wrapper">
<?php if( ! is_404() ): ?>
<?php
$consulting_config = consulting_config();
$logo_tmp_src = '';
if( !empty( $consulting_config['layout'] ) && $consulting_config['layout'] != 'layout_1' && $consulting_config['layout'] != 'layout_12' ) {
    $logo_tmp_src = $consulting_config['layout'] . '/';
}
$wc_cart_hide = get_theme_mod( 'wc_cart_hide', false );
$wc_topbar_cart_hide = get_theme_mod( 'wc_topbar_cart_hide', false );
?>
<header id="header">
<?php if ( empty( $_GET['hide_top_bar'] ) ): ?>
    <?php if ( get_theme_mod( 'top_bar', true ) ): ?>
        <div class="top_bar">
            <div class="container">
                <?php if( consulting_get_header_style() == 'header_style_6' ) : ?>
                    <?php if ( class_exists( 'WooCommerce' ) && empty( $wc_topbar_cart_hide ) ): ?>
                        <div class="cart_count_wrapper">
                            <a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="cart_count"><i class="stm-shopping-cart8"></i><?php get_template_part( 'partials/mini', 'cart' ); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if($consulting_config['layout'] == 'layout_19'): ?>
                        <?php if ( $socials = consulting_get_socials() ): ?>
                            <div class="header_socials">
                                <?php foreach ( $socials as $key => $val ): ?>
                                    <a target="_blank" href="<?php echo esc_html_e( $val ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php
                    if ( get_theme_mod( 'wpml_switcher', true ) ) {
                        if ( function_exists('icl_object_id') ) {
                            if ( get_theme_mod( 'wpml_switcher_style', true ) == 'wpml_default' ) {
                                do_action( 'wpml_add_language_selector' );
                            } else {
                                consulting_topbar_lang();
                            }
                        }
                    }

                    if(stm_check_layout('layout_16')) {
                        $top_bar_soc_hebrew = consulting_get_socials( 'top_bar_socials_l13' ); ?>
                        <div class="stm_top_bar_middle">
                    <?php } ?>
                    <ul class="top_bar_contacts">
                        <?php
                        $top_bar_contact_address = get_theme_mod('top_bar_contact_address', esc_html__( "1010 Avenue of the Moon New York, NY 10018 US.", 'consulting' ));
                        $top_bar_contact_address_icon = get_theme_mod('top_bar_contact_address_icon', 'stm-location-2');
                        $top_bar_contact_email = get_theme_mod('top_bar_contact_email', 'info@consultingwp.com');
                        $top_bar_contact_email_icon = get_theme_mod('top_bar_contact_email_icon', 'stm-email');
                        $top_bar_contact_phone = get_theme_mod('top_bar_contact_phone', __( "Call free: <strong>212 386 5575</strong>", 'consulting' ));
                        $top_bar_contact_phone_icon = get_theme_mod('top_bar_contact_phone_icon', 'stm-phone6');
                        ?>
                        <?php if ( !empty( $top_bar_contact_phone ) ): ?>
                            <li>
                                <i class="<?php echo esc_attr( $top_bar_contact_phone_icon ); ?>"></i>
                                <div class="top_bar_contacts_text"><?php _e( $top_bar_contact_phone, 'consulting' ); ?></div>
                            </li>
                        <?php endif; ?>
                        <?php if ( ! empty( $top_bar_contact_email ) ): ?>
                            <li>
                                <i class="<?php echo esc_attr( $top_bar_contact_email_icon ); ?>"></i>
                                <div class="top_bar_contacts_text"><a href="mailto:<?php echo esc_attr( $top_bar_contact_email ); ?>"><?php esc_html_e( $top_bar_contact_email, 'consulting' ); ?></a></div>
                            </li>
                        <?php endif; ?>
                        <?php if ( ! empty( $top_bar_contact_address ) ): ?>
                            <li>
                                <i class="<?php echo esc_attr( $top_bar_contact_address_icon ); ?>"></i>
                                <div class="top_bar_contacts_text"><?php _e( $top_bar_contact_address, 'consulting' ); ?></div>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <?php if(!empty($top_bar_soc_hebrew)): ?>
                        <ul class="stm_l16_top_socials">
                            <?php foreach($top_bar_soc_hebrew as $soc => $soc_link): ?>
                                <li>
                                    <a href="<?php echo esc_url($soc_link) ?>">
                                        <i class="fa fa-<?php echo $soc ?>"></i>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if(stm_check_layout('layout_16')) { ?>
                        </div>
                    <?php } ?>
                <?php elseif( consulting_get_header_style() == 'header_style_8' ) : ?>
                    <div class="logo media-left media-middle">
                        <?php if ( $logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_default.svg' ) ): ?>
                            <?php if(stm_check_layout('layout_16')){
                                $page_ID = consulting_page_id();
                                $header_inverse = get_post_meta( $page_ID, 'header_inverse', true );
                                if ( $header_inverse && $logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_default.svg' ) ): ?>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                                <?php elseif( $logo = get_theme_mod( 'dark_logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_dark.svg' ) ): ?>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                                <?php else: ?>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                                <?php endif;
                            } else { ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                            <?php } ?>
                        <?php else: ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                        <?php endif; ?>
                    </div>
                    <ul class="top_bar_contacts">
                        <?php
                        $top_bar_contact_address = get_theme_mod('top_bar_contact_address', esc_html__( "1010 Avenue of the Moon New York, NY 10018 US.", 'consulting' ));
                        $top_bar_contact_address_icon = get_theme_mod('top_bar_contact_address_icon', 'stm-location-2');
                        $top_bar_contact_email = get_theme_mod('top_bar_contact_email', 'info@consultingwp.com');
                        $top_bar_contact_email_icon = get_theme_mod('top_bar_contact_email_icon', 'stm-email');
                        $top_bar_contact_phone = get_theme_mod('top_bar_contact_phone', __( "Call free: <strong>212 386 5575</strong>", 'consulting' ));
                        $top_bar_contact_phone_icon = get_theme_mod('top_bar_contact_phone_icon', 'stm-phone6');
                        ?>
                        <?php if ( !empty( $top_bar_contact_phone ) ): ?>
                            <li>
                                <i class="<?php echo esc_attr( $top_bar_contact_phone_icon ); ?>"></i>
                                <div class="top_bar_contacts_text"><?php _e( $top_bar_contact_phone, 'consulting' ); ?></div>
                            </li>
                        <?php endif; ?>
                        <?php if ( ! empty( $top_bar_contact_email ) ): ?>
                            <li>
                                <i class="<?php echo esc_attr( $top_bar_contact_email_icon ); ?>"></i>
                                <div class="top_bar_contacts_text"><a href="mailto:<?php echo esc_attr( $top_bar_contact_email ); ?>"><?php esc_html_e( $top_bar_contact_email, 'consulting' ); ?></a></div>
                            </li>
                        <?php endif; ?>
                        <?php if ( ! empty( $top_bar_contact_address ) ): ?>
                            <li>
                                <i class="<?php echo esc_attr( $top_bar_contact_address_icon ); ?>"></i>
                                <div class="top_bar_contacts_text"><?php _e( $top_bar_contact_address, 'consulting' ); ?></div>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php else : ?>
                    <?php
                    if ( get_theme_mod( 'wpml_switcher', true ) ) {
                        if ( function_exists('icl_object_id') ) {
                            if ( get_theme_mod( 'wpml_switcher_style', true ) == 'wpml_default' ) {
                                do_action( 'wpml_add_language_selector' );
                            } else {
                                consulting_topbar_lang();
                            }
                        }
                    }
                    $top_bar_info = consulting_get_top_bar_info();
                    ?>
                    <div class="top_bar_info_wr">
                        <?php if(consulting_get_header_style() == 'header_style_4' && $consulting_config['layout'] == 'layout_13'): ?>
                            <?php
                            $stm_work_hours_l13 = get_theme_mod('stm_work_hours_l13', esc_html__('Mon - Sat 8.00 - 18.00. Sunday CLOSED', 'consulting'));
                            $stm_work_hours_l13_icon = get_theme_mod('stm_work_hours_l13_icon', 'fa fa-clock-o');
                            $top_bar_search_l13 = get_theme_mod('top_bar_search_l13', true);
                            $top_bar_soc = consulting_get_socials('top_bar_socials_l13');
                            ?>
                            <?php if($top_bar_search_l13): ?>
                                <div class="stm_top_bar_l13-search">
                                    <?php get_search_form(true); ?>
                                </div>
                            <?php endif; ?>
                            <div class="stm_top_bar_l13-center">
                                <?php if(!empty($stm_work_hours_l13)): ?>
                                    <div class="stm_top_bar_unit_l13">
                                        <i class="<?php echo esc_attr( $stm_work_hours_l13_icon ); ?>"></i>
                                        <span class="top_bar_contacts_text"><?php _e( $stm_work_hours_l13, 'consulting' ); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($top_bar_soc)): ?>
                                    <div class="header_socials">
                                        <?php foreach ( $top_bar_soc as $key => $val ): ?>
                                            <a target="_blank" href="<?php echo esc_html_e( $val ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <?php if(stm_check_layout('layout_18')): ?>
                                <?php
                                $header_l18_btn_text = get_theme_mod('header_l18_btn_text', '');
                                $header_l18_btn_link = get_theme_mod('header_l18_btn_link', '');
                                if(!empty($header_l18_btn_link) and !empty($header_l18_btn_text)):
                                    ?>
                                    <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-block vc_btn3-icon-left vc_btn3-color-theme_style_1" href="<?php esc_html_e($header_l18_btn_link, 'consulting'); ?>" title="<?php esc_html_e($header_l18_btn_text, 'consulting'); ?>">
                                        <i class="fa fa-chevron-left vc_btn3-icon"></i>
                                        <?php esc_html_e($header_l18_btn_text, 'consulting'); ?>
                                    </a>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ( count( $top_bar_info ) > 1 ): ?>
                                    <div class="top_bar_info_switcher">
                                        <div class="active">
                                            <span><?php esc_html_e( $top_bar_info[1]['office'], 'consulting' ); ?></span>
                                        </div>
                                        <ul>
                                            <?php foreach ( $top_bar_info as $key => $val ): ?>
                                                <li>
                                                    <a href="#top_bar_info_<?php echo esc_attr( $key ); ?>"><?php esc_html_e( $val['office'], 'consulting' ); ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ( $top_bar_info ): ?>
                                <?php foreach ( $top_bar_info as $key => $val ): ?>
                                    <ul class="top_bar_info" id="top_bar_info_<?php echo esc_attr( $key ); ?>"<?php if ( $key == 1 ) { echo ' style="display: block;"'; } ?>>
                                        <?php if ( ! empty( $val['address'] ) ): ?>
                                            <li>
                                                <i class="<?php echo esc_attr( $val['address_icon'] ); ?>"></i>
                                                <span><?php _e( $val['address'], 'consulting' ); ?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $val['hours'] ) ): ?>
                                            <li>
                                                <i class="<?php echo esc_attr( $val['hours_icon'] ); ?>"></i>
                                                <span><?php _e( $val['hours'], 'consulting' ); ?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ( !empty( $val['phone'] ) ): ?>
                                            <li>
                                                <i class="<?php echo esc_attr( $val['phone_icon'] ); ?>"></i>
                                                <span><?php _e( $val['phone'], 'consulting' ); ?></span>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php if(consulting_get_header_style() == 'header_style_5' and $consulting_config['layout'] == 'layout_14'):
    get_template_part('partials/headers/l14', 'hs5');
else: ?>
    <?php if( consulting_get_header_style() == '' || consulting_get_header_style() == 'header_style_1' || consulting_get_header_style() == 'header_style_3' || consulting_get_header_style() == 'header_style_4' ): ?>
        <div class="header_top clearfix">
            <div class="container">
                <?php if ( consulting_get_header_style() != 'header_style_4' && $socials = consulting_get_socials() ): ?>
                    <div class="header_socials">
                        <?php foreach ( $socials as $key => $val ): ?>
                            <a target="_blank" href="<?php echo esc_html_e( $val ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="logo">
                    <?php if ( consulting_get_header_style() != 'header_style_4' &&  $logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_default.svg' ) ): ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                    <?php elseif( consulting_get_header_style() == 'header_style_4' && $logo = get_theme_mod( 'dark_logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_dark.svg' ) ): ?>
                        <?php
                        $page_ID = consulting_page_id();
                        $header_inverse = get_post_meta( $page_ID, 'header_inverse', true );
                        $consulting_config = consulting_config();
                        ?>
                        <?php if( $consulting_config['layout'] == 'layout_6' ) : ?>
                            <?php
                            if( $header_inverse ) {
                                $logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/tmp/'.$logo_tmp_src.'logo_default.svg' );
                            }
                            ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                        <?php else : ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    <?php endif; ?>
                </div>
                <?php if(consulting_get_header_style() == 'header_style_4' and $consulting_config['layout'] == 'layout_13'): ?>
                    <?php if( $header_address = get_theme_mod( 'header_address', __( "1010 Avenue of the Moon\n<span>New York, NY 10018 US.</span>", 'consulting' ) ) ): ?>
                        <div class="icon_text clearfix">
                            <div class="icon"><i class="fa <?php echo esc_attr( get_theme_mod( 'header_address_icon', 'stm-pin_13' ) ); ?>"></i></div>
                            <div class="text">
                                <?php echo nl2br( $header_address ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if( $header_hours = get_theme_mod( 'header_working_hours', __( 'Write us <a href="mailto:info@consulting.com">info@consulting.com', 'consulting' ) ) ): ?>
                        <div class="icon_text middle clearfix">
                            <div class="icon"><i class="fa <?php echo esc_attr( get_theme_mod( 'header_working_hours_icon', 'stm-mail_13' ) ); ?>"></i></div>
                            <div class="text">
                                <?php echo nl2br( $header_hours ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if( consulting_get_header_style() == 'header_style_4' && $header_phone = get_theme_mod( 'header_phone', __( '<strong>212 386 5575</strong><span data-scroll-to="request-call-back>Request call back</span>>Request call back</span>', 'consulting' ) ) ): ?>
                        <div class="icon_text big last clearfix">
                            <div class="icon"><i class="fa <?php echo esc_attr( get_theme_mod( 'header_phone_icon', 'stm-phone_13' ) ); ?>"></i></div>
                            <div class="text"><?php echo nl2br( $header_phone ); ?></div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if( consulting_get_header_style() == 'header_style_4' && $header_phone = get_theme_mod( 'header_phone', __( "<strong>212 714 0177</strong>\n<span>Free call</span>", 'consulting' ) ) ): ?>
                        <div class="icon_text big clearfix">
                            <div class="icon"><i class="fa <?php echo esc_attr( get_theme_mod( 'header_phone_icon', 'fa-phone' ) ); ?>"></i></div>
                            <div class="text"><?php echo nl2br( $header_phone ); ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if( $header_hours = get_theme_mod( 'header_working_hours', __( "<strong>Mon - Sat 8.00 - 18.00</strong>\n<span>Sunday CLOSED</span>", 'consulting' ) ) ): ?>
                        <div class="icon_text clearfix">
                            <div class="icon"><i class="fa <?php echo esc_attr( get_theme_mod( 'header_working_hours_icon', 'fa-clock-o' ) ); ?>"></i></div>
                            <div class="text">
                                <?php _e($header_hours, 'consulting'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if( $header_address = get_theme_mod( 'header_address', __( "<strong>1010 Avenue of the Moon</strong><br/><span>New York, NY 10018 US.</span>", 'consulting' ) ) ): ?>
                        <div class="icon_text clearfix">
                            <div class="icon"><i class="fa <?php echo esc_attr( get_theme_mod( 'header_address_icon', 'fa-map-marker' ) ); ?>"></i></div>
                            <div class="text stm_st_address_1">
                                <?php _e($header_address, 'consulting'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="top_nav">
            <div class="container">
                <div class="top_nav_wrapper clearfix">
                    <?php
                    wp_nav_menu( array(
                            'theme_location' => 'consulting-primary_menu',
                            'container'      => false,
                            'depth'          => 4,
                            'menu_class'     => 'main_menu_nav'
                        )
                    );
                    ?>
                    <?php if( consulting_get_header_style() != 'header_style_4' && $header_phone = get_theme_mod( 'header_phone', __( "<strong>212 714 0177</strong>\n<span>Free call</span>", 'consulting' ) ) ): ?>
                        <div class="icon_text clearfix">
                            <div class="icon"><i class="fa <?php echo esc_attr( get_theme_mod( 'header_phone_icon', 'fa-phone' ) ); ?>"></i></div>
                            <div class="text"><?php echo nl2br( $header_phone ); ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if ( consulting_get_header_style() == 'header_style_4' ): ?>
                        <?php if( $consulting_config['layout'] == 'layout_2' ) : ?>
                            <div class="header_search">
                                <a class="js-open-search-box" href="#"><i class="fa fa-search"></i></a>
                                <div class="pop-search-box">
                                    <form method="get" class="pop-search-box_form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                        <input type="search" class="form-control" placeholder="<?php esc_attr_e( 'Search...', 'consulting' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if(consulting_get_header_style() == 'header_style_4' && $consulting_config['layout'] == 'layout_13' && class_exists( 'WooCommerce' ) && ! $wc_cart_hide ): ?>
                        <div class="header_socials">
                            <a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="cart_count"><i class="stm-cart_13"></i><?php get_template_part( 'partials/mini', 'cart' ); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if(consulting_get_header_style() == 'header_style_4' and $socials = consulting_get_socials() ): ?>
                        <div class="header_socials">
                            <?php foreach ( $socials as $key => $val ): ?>
                                <a target="_blank" href="<?php echo esc_html_e( $val ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php elseif( consulting_get_header_style() == 'header_style_2' ): ?>
        <div class="header_top clearfix">
            <div class="container">
                <div class="logo media-left media-middle">
                    <?php if ( $logo = get_theme_mod( 'dark_logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_dark.svg' ) ): ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                    <?php else: ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    <?php endif; ?>
                </div>
                <div class="top_nav media-body media-middle">
                    <?php if ( $socials = consulting_get_socials() ): ?>
                        <div class="header_socials">
                            <?php foreach ( $socials as $key => $val ): ?>
                                <a target="_blank" href="<?php echo esc_html_e( $val ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a>
                            <?php endforeach; ?>
                            <?php if ( class_exists( 'WooCommerce' ) && ! $wc_cart_hide ): ?>
                                <a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="cart_count"><i class="stm-cart-2"></i><?php get_template_part( 'partials/mini', 'cart' ); ?></a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <?php if ( class_exists( 'WooCommerce' ) && ! $wc_cart_hide ): ?>
                            <div class="header_socials">
                                <a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="cart_count"><i class="stm-cart-2"></i><?php get_template_part( 'partials/mini', 'cart' ); ?></a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="top_nav_wrapper clearfix">
                        <?php
                        wp_nav_menu( array(
                                'theme_location' => 'consulting-primary_menu',
                                'container'      => false,
                                'depth'          => 4,
                                'menu_class'     => 'main_menu_nav'
                            )
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif( consulting_get_header_style() == 'header_style_5' ) : ?>
        <div class="header_top clearfix">
            <div class="container">
                <?php if( $header_phone = get_theme_mod( 'header_phone', __( "<strong>212 714 0177</strong>\n<span>Free call</span>", 'consulting' ) ) ): ?>
                    <div class="info-text __phone-number">
                        <?php echo nl2br( $header_phone ); ?>
                    </div>
                <?php endif; ?>
                <?php
                if ( get_theme_mod( 'wpml_switcher', true ) ) {
                    if ( function_exists('icl_object_id') ) {
                        if ( get_theme_mod( 'wpml_switcher_style', true ) == 'wpml_default' ) {
                            do_action( 'wpml_add_language_selector' );
                        } else {
                            consulting_topbar_lang();
                        }
                    }
                }
                ?>
                <div class="logo">
                    <?php
                    $page_ID = consulting_page_id();
                    $header_inverse = get_post_meta( $page_ID, 'header_inverse', true );
                    ?>
                    <?php if ( $header_inverse && $logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_default.svg' ) ): ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                    <?php elseif( $logo = get_theme_mod( 'dark_logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_dark.svg' ) ): ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                    <?php else: ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="top_nav">
            <div class="container">
                <div class="top_nav_wrapper clearfix">
                    <?php
                    wp_nav_menu( array(
                            'theme_location' => 'consulting-primary_menu',
                            'container'      => false,
                            'depth'          => 4,
                            'menu_class'     => 'main_menu_nav'
                        )
                    );
                    ?>
                </div>
            </div>
        </div>

    <?php elseif( consulting_get_header_style() == 'header_style_6' ) : ?>

        <div class="header_top clearfix">
            <div class="container">
                <div class="header_top_wrapper">
                    <?php if(stm_check_layout('layout_19')): ?>
                        <div class="logo media-left media-middle">
                            <?php
                            $page_ID = consulting_page_id();
                            $header_inverse = get_post_meta( $page_ID, 'header_inverse', true );
                            ?>
                            <?php if ( $header_inverse && $logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_default.svg' ) ): ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                            <?php elseif( $logo = get_theme_mod( 'dark_logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_dark.svg' ) ): ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                            <?php else: ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="logo media-left media-middle">
                            <?php if ( $logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_default.svg' ) ): ?>
                                <?php if(stm_check_layout('layout_16')){
                                    $page_ID = consulting_page_id();
                                    $header_inverse = get_post_meta( $page_ID, 'header_inverse', true );
                                    if ( $header_inverse && $logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_default.svg' ) ): ?>
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                                    <?php elseif( $logo = get_theme_mod( 'dark_logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_dark.svg' ) ): ?>
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                                    <?php else: ?>
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                                    <?php endif;
                                } else { ?>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                                <?php } ?>
                            <?php else: ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="top_nav media-body media-middle">
                        <?php if(stm_check_layout('layout_16')): ?>
                            <?php
                            $header_l16_btn_text = get_theme_mod('header_l16_btn_text', '');
                            $header_l16_btn_link = get_theme_mod('header_l16_btn_link', '');
                            if(!empty($header_l16_btn_link) and !empty($header_l16_btn_text)):
                                ?>
                                <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-block vc_btn3-icon-left vc_btn3-color-theme_style_2" href="<?php esc_html_e($header_l16_btn_link, 'consulting'); ?>" title="<?php esc_html_e($header_l16_btn_text, 'consulting'); ?>">
                                    <?php esc_html_e($header_l16_btn_text, 'consulting'); ?>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="top_nav_wrapper clearfix">
                            <?php
                            wp_nav_menu( array(
                                    'theme_location' => 'consulting-primary_menu',
                                    'container'      => false,
                                    'depth'          => 4,
                                    'menu_class'     => 'main_menu_nav'
                                )
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif( consulting_get_header_style() == 'header_style_7' ) : ?>
        <?php
        $socials = consulting_get_socials();
        $header_side_class = '';
        if( !empty( $socials ) && is_array( $socials ) ) {
            $header_side_class .= ' has-socials';
        }
        ?>
        <div class="header_side clearfix<?php echo $header_side_class; ?>">
            <div class="container">
                <div class="header_side_wrapper">
                    <div class="logo">
                        <?php
                        if( $consulting_config['layout'] == 'layout_9' ) {
                            $logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_dark.svg' );
                        } else {
                            $logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_default.svg' );
                        }
                        ?>
                        <?php if ( $logo ): ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                        <?php else: ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="side_nav">
                        <div class="side_nav_wrapper clearfix">
                            <?php
                            wp_nav_menu( array(
                                    'theme_location' => 'consulting-primary_menu',
                                    'container'      => false,
                                    'depth'          => 4,
                                    'menu_class'     => 'main_menu_nav'
                                )
                            );
                            ?>
                        </div>
                    </div>
                    <?php if ( $socials = consulting_get_socials() ): ?>
                        <div class="header_socials">
                            <?php foreach ( $socials as $key => $val ): ?>
                                <a target="_blank" href="<?php echo esc_html_e( $val ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if( $copyright = get_theme_mod( 'header_copyright', __( "Theme by <a href='http://stylemixthemes.com/' target='_blank'>Stylemix Themes</a> <br>2016 &copy; All rights reserved.", 'consulting' ) ) ): ?>
                        <div class="header_copyright">
                            <?php _e( $copyright, 'consulting'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php elseif( consulting_get_header_style() == 'header_style_8' ) : ?>
        <?php
        $socials = consulting_get_socials();
        $header_side_class = '';
        if( !empty( $socials ) && is_array( $socials ) ) {
            $header_side_class .= ' has-socials';
        }
        ?>

        <div id="menu_toggle_button">
            <button></button>
        </div>
        <div class="header_side clearfix<?php echo $header_side_class; ?>">
            <div class="container">
                <div class="header_side_wrapper">
                    <div class="side_nav">
                        <div class="side_nav_wrapper clearfix">
                            <?php
                            wp_nav_menu( array(
                                    'theme_location' => 'consulting-primary_menu',
                                    'container'      => false,
                                    'depth'          => 4,
                                    'menu_class'     => 'main_menu_nav'
                                )
                            );
                            ?>
                        </div>
                        <?php
                            if ( get_theme_mod( 'wpml_switcher', true ) ) {
                                if ( function_exists('icl_object_id') ) {
                                    if ( get_theme_mod( 'wpml_switcher_style', true ) == 'wpml_default' ) {
                                        do_action( 'wpml_add_language_selector' );
                                    } else {
                                        consulting_topbar_lang();
                                    }
                                }
                            }
                        ?>
                    </div>
                    <div class="header_bottom_info_box">
                        <?php if ( $socials = consulting_get_socials() ): ?>
                            <div class="header_socials">
                                <?php foreach ( $socials as $key => $val ): ?>
                                    <a target="_blank" href="<?php echo esc_html_e( $val ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if( $copyright = get_theme_mod( 'header_copyright', __( "Theme by <a href='http://stylemixthemes.com/' target='_blank'>Stylemix Themes</a> <br>2016 &copy; All rights reserved.", 'consulting' ) ) ): ?>
                            <div class="header_copyright">
                                <?php _e( $copyright, 'consulting'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <div class="mobile_header">
        <div class="logo_wrapper clearfix">
            <div class="logo">
                <?php if ( $logo = get_theme_mod( 'dark_logo', get_template_directory_uri() . '/assets/images/tmp/'. $logo_tmp_src .'logo_dark.svg' ) ): ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr(get_theme_mod('logo_width')) ?>px; height: <?php echo esc_attr(get_theme_mod('logo_height')) ?>px;" alt="<?php bloginfo( 'name' ); ?>" /></a>
                <?php else: ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                <?php endif; ?>
            </div>
            <div id="menu_toggle">
                <button></button>
            </div>
        </div>
        <div class="header_info">
            <div class="top_nav_mobile">
                <?php
                wp_nav_menu( array(
                        'theme_location' => 'consulting-primary_menu',
                        'container'      => false,
                        'depth'          => 4,
                        'menu_class'     => 'main_menu_nav'
                    )
                );
                ?>
            </div>
            <?php
            $header_phone = get_theme_mod( 'header_phone', __( "<strong>212 714 0177</strong>\n<span>Free call</span>", 'consulting' ) );
            $header_hours = get_theme_mod( 'header_working_hours', __( "<strong>Mon - Sat 8.00 - 18.00</strong>\n<span>Sunday CLOSED</span>", 'consulting' ) );
            $header_address = get_theme_mod( 'header_address', __( "<strong>1010 Avenue of the Moon</strong>\n<span>New York, NY 10018 US.</span>", 'consulting' ) );
            if( !empty( $header_phone ) || !empty( $header_hours ) || !empty( $header_address ) ) : ?>
                <div class="icon_texts">
                    <?php if( $header_phone ): ?>
                        <div class="icon_text clearfix">
                            <div class="icon"><i class="fa <?php echo esc_attr( get_theme_mod( 'header_phone_icon', 'fa-phone' ) ); ?>"></i></div>
                            <div class="text">
                                <?php echo nl2br( $header_phone ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if( $header_hours ): ?>
                        <div class="icon_text clearfix">
                            <div class="icon"><i class="fa <?php echo esc_attr( get_theme_mod( 'header_working_hours_icon', 'fa-clock-o' ) ); ?>"></i></div>
                            <div class="text">
                                <?php echo nl2br( $header_hours ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if( $header_address ): ?>
                        <div class="icon_text clearfix">
                            <div class="icon"><i class="fa <?php echo esc_attr( get_theme_mod( 'header_address_icon', 'fa-map-marker' ) ); ?>"></i></div>
                            <div class="text">
                                <?php echo nl2br( $header_address ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
</header>
<div id="main" <?php if(get_theme_mod('footer_show_hide', false)): ?>class="footer_hide"<?php endif;?>>
    <?php get_template_part( 'partials/title_box' ); ?>
    <div class="container">
<?php endif; ?>