<?php

$link = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$css_class .= ' cols_' . $posts_per_row;

$link = vc_build_link( $link );
if( $link['url'] ) {
    if( empty( $link['target'] ) ) {
        $link['target'] = '_self';
    }
}

?>

<div class="stm_portfolio_info <?php echo esc_html( $style ); ?><?php echo esc_attr( $css_class ); ?>">
    <div class="stm_portfolio_info_row <?php echo esc_html( $alignment ); ?>">
        <?php if( $portfolio_client ){ ?>
        <div class="item">
            <div class="portfolio_info_title"><?php if( $show_title_icons ){ ?><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php } ?><?php esc_html_e( 'Client', 'consulting' ); ?></div>
            <div class="portfolio_info_description"><?php echo esc_html( $portfolio_client ); ?></div>
        </div>
        <?php } ?>
        <?php if( $portfolio_date ){ ?>
        <div class="item">
            <div class="portfolio_info_title"><?php if( $show_title_icons ){ ?><i class="fa fa-calendar" aria-hidden="true"></i> <?php } ?><?php esc_html_e( 'Date', 'consulting' ); ?></div>
            <div class="portfolio_info_description"><?php echo esc_html( $portfolio_date ); ?></div>
        </div>
        <?php } ?>
        <?php if( $portfolio_services ){ ?>
        <div class="item">
            <div class="portfolio_info_title"><?php if( $show_title_icons ){ ?><i class="fa fa-life-ring" aria-hidden="true"></i> <?php } ?><?php esc_html_e( 'Services', 'consulting' ); ?></div>
            <div class="portfolio_info_description"><?php echo esc_html( $portfolio_services ); ?></div>
        </div>
        <?php } ?>
        <?php if(!empty( $link['url']) and !empty($link['title']) ): ?>
        <div class="item">
            <div class="portfolio_info_title"><?php if( $show_title_icons ){ ?><i class="fa fa-globe" aria-hidden="true"></i> <?php } ?><?php esc_html_e( 'Website', 'consulting' ); ?></div>
            <div class="portfolio_info_description"><a href="<?php echo esc_html( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a> <i class="stm-rectangle"></i></div>
        </div>
        <?php endif; ?>
        <?php if( $portfolio_role ){ ?>
        <div class="item">
            <div class="portfolio_info_title"><?php if( $show_title_icons ){ ?><i class="fa fa-briefcase" aria-hidden="true"></i> <?php } ?><?php esc_html_e( 'Our Role', 'consulting' ); ?></div>
            <div class="portfolio_info_description"><?php echo esc_html( $portfolio_role ); ?></div>
        </div>
        <?php } ?>
        <?php if( $facebook || $twitter || $instagram || $google_plus || $youtube ): ?>
        <div class="item">
            <ul class="socials">
                <?php if( $facebook ): ?>
                    <li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank" class="social-facebook"><i class="fa fa-facebook"></i></a></li>
                <?php endif; ?>
                <?php if( $twitter ): ?>
                    <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank" class="social-twitter"><i class="fa fa-twitter"></i></a></li>
                <?php endif; ?>
                <?php if( $instagram ): ?>
                    <li><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" class="social-instagram"><i class="fa fa-instagram"></i></a></li>
                <?php endif; ?>
                <?php if( $google_plus ): ?>
                    <li><a href="<?php echo esc_url( $google_plus ); ?>" target="_blank" class="social-google-plus"><i class="fa fa-google-plus"></i></a></li>
                <?php endif; ?>
                <?php if( $youtube ): ?>
                    <li><a href="<?php echo esc_attr( $youtube ); ?>" class="social-youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</div>