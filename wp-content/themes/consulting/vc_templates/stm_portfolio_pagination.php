<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$link      = vc_build_link( $link );

$previous_post = get_previous_post();
$next_post = get_next_post();

?>

<?php if ( is_singular('stm_portfolio') ) : ?>
<div class="post_links_box <?php if (empty( $next_post ) || empty( $previous_post )): ?>full_width<?php endif; ?> <?php echo esc_html( $style ); ?><?php echo esc_attr( $css_class ); ?>">
    <?php if( 'style_1' === $style ) : ?>
        <?php if (!empty( $previous_post )): ?>
            <div class="previous_post_link">
                <a href="<?php echo get_permalink( $previous_post->ID ); ?>">
                    <span class="post_links_info">
                        <span class="post_link_thumbnail">
                            <?php if ( has_post_thumbnail() ): ?>
                            <?php echo get_the_post_thumbnail( $previous_post->ID, 'thumbnail' ); ?>
                            <?php else: ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/tmp/placeholder.gif' ); ?>" alt="" />
                            <?php endif; ?>
                            <span class="post_link_thumbnail_box"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                        </span>
                        <span class="post_link_title"><?php echo $previous_post->post_title; ?></span>
                    </span>
                </a>
            </div>
        <?php endif; ?>
        <?php if( $show_button ) : ?>
            <div class="archive_button <?php if (empty( $next_post )): ?>right<?php endif; ?>">
                <?php if ( ! empty( $link['url'] ) ): ?>
                <?php  if ( ! $link['target'] ) { $link['target'] = '_self'; } ?>
                    <a href="<?php echo esc_url( $link['url'] ) ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="vc_general portfolio_btn vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-theme_style_2"><i class="stm-grid vc_btn3-icon"></i> <?php echo esc_attr( $link['title'] ) ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty( $next_post )): ?>
            <div class="next_post_link">
                <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                    <span class="post_links_info">
                        <span class="post_link_title"><?php echo $next_post->post_title; ?></span>
                        <span class="post_link_thumbnail">
                            <?php if ( has_post_thumbnail() ): ?>
                                <?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ); ?>
                            <?php else: ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/tmp/placeholder.gif' ); ?>" alt="" />
                            <?php endif; ?>
                            <span class="post_link_thumbnail_box"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                        </span>
                    </span>
                </a>
            </div>
        <?php endif; ?>
    <?php elseif( 'style_2' === $style ) : ?>
        <?php if (!empty( $previous_post )): ?>
            <div class="previous_post_link">
                <a href="<?php echo get_permalink( $previous_post->ID ); ?>" class="vc_general portfolio_btn vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-theme_style_2"><i class="fa fa-chevron-left vc_btn3-icon" aria-hidden="true"></i> <?php esc_html_e( 'previous', 'consulting' ); ?></a>
            </div>
        <?php endif; ?>
        <?php if( $show_button ) : ?>
            <div class="archive_button <?php if (empty( $next_post )): ?>right<?php endif; ?>">
                <?php if ( ! empty( $link['url'] ) ): ?>
                    <?php  if ( ! $link['target'] ) { $link['target'] = '_self'; } ?>
                    <a href="<?php echo esc_url( $link['url'] ) ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="vc_general portfolio_btn vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-theme_style_2"><i class="stm-grid vc_btn3-icon"></i> <?php echo esc_attr( $link['title'] ) ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty( $next_post )): ?>
            <div class="next_post_link">
                <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="vc_general portfolio_btn vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-icon-right vc_btn3-color-theme_style_2"><?php esc_html_e( 'next', 'consulting' ); ?> <i class="fa fa-chevron-right vc_btn3-icon" aria-hidden="true"></i></a>
            </div>
        <?php endif; ?>
    <?php elseif( 'style_3' === $style ) : ?>
        <?php if (!empty( $previous_post )): ?>
            <div class="previous_post_link">
                <a href="<?php echo get_permalink( $previous_post->ID ); ?>">
                    <span class="post_links_info">
                        <span class="post_link_thumbnail">
                            <?php if ( has_post_thumbnail() ): ?>
                                <?php echo get_the_post_thumbnail( $previous_post->ID, 'thumbnail' ); ?>
                            <?php else: ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/tmp/placeholder.gif' ); ?>" alt="" />
                            <?php endif; ?>
                            <span class="post_link_thumbnail_box"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                        </span>
                        <span class="post_link_title"><?php echo $previous_post->post_title; ?></span>
                    </span>
                </a>
                <div class="post_link_text"><?php esc_html_e( 'previous', 'consulting' ); ?></div>
            </div>
        <?php endif; ?>
        <?php if( $show_button ) : ?>
            <div class="archive_button <?php if (empty( $next_post )): ?>right<?php endif; ?>">
                <?php if ( ! empty( $link['url'] ) ): ?>
                    <?php  if ( ! $link['target'] ) { $link['target'] = '_self'; } ?>
                    <a href="<?php echo esc_url( $link['url'] ) ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="portfolio_btn"><i class="stm-grid vc_btn3-icon"></i></a>
                <?php endif; ?>
            </div>
        <?php endif;?>
        <?php if (!empty( $next_post )): ?>
            <div class="next_post_link">
                <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                    <span class="post_links_info">
                        <span class="post_link_title"><?php echo $next_post->post_title; ?></span>
                        <span class="post_link_thumbnail">
                            <?php if ( has_post_thumbnail() ): ?>
                                <?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ); ?>
                            <?php else: ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/tmp/placeholder.gif' ); ?>" alt="" />
                            <?php endif; ?>
                            <span class="post_link_thumbnail_box"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                        </span>
                    </span>
                </a>
                <div class="post_link_text"><?php esc_html_e( 'next', 'consulting' ); ?></div>
            </div>
        <?php endif; ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $( ".previous_post_link, .next_post_link" )
                .mouseenter(function() {
                    $(this).find(".post_link_text").animate({opacity: "0"}, 100);
                })
                .mouseleave(function() {
                    $(this).find(".post_link_text").animate({opacity: "1"}, 100);
                });
            });
        </script>
    <?php endif; ?>
</div>
<?php endif; ?>