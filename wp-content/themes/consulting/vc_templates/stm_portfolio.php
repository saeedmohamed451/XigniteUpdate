<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
	'post_type'      => 'stm_portfolio',
	'posts_per_page' => $posts_per_page,
    'paged' 		 => $paged
);

if ( $category != 'all' ) {
    $args['stm_portfolio_category'] = $category;
}

$portfolio = new WP_Query( $args );

$count_posts = wp_count_posts( 'stm_portfolio' );
$published_posts = $count_posts->publish;

wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'packery' );
wp_enqueue_script( 'imagesloaded' );
?>

<?php if ( $portfolio->have_posts() ): ?>
    <div class="stm_portfolio_grid<?php echo esc_attr( $css_class ); ?>">
        <?php while ( $portfolio->have_posts() ): $portfolio->the_post(); ?>
            <?php get_template_part( 'partials/content', 'portfolio' ); ?>
            <?php $post_cat = wp_get_post_terms( get_the_ID(), 'stm_portfolio_category' ); ?>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
    <?php if ( $category != 'all' ) : ?>
        <?php if( $load_more_enable && $posts_per_page < $post_cat[0]->count ) : ?>
            <div class="portfolio_btn_box">
                <div class="portfolio_btn_loading vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-theme_style_2"><?php esc_html_e( 'loading...', 'consulting' ); ?></div>
                <a href="#" data-page="1" data-load="<?php echo intval($posts_per_page); ?>" data-category="<?php echo esc_html($category); ?>" class="portfolio_load_more_btn vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-theme_style_2"><i class="fa fa-refresh vc_btn3-icon" aria-hidden="true"></i> <?php esc_html_e( 'load more', 'consulting' ); ?></a>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <?php if( $load_more_enable && $posts_per_page < $published_posts ) : ?>
            <div class="portfolio_btn_box">
                <div class="portfolio_btn_loading vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-theme_style_2"><?php esc_html_e( 'loading...', 'consulting' ); ?></div>
                <a href="#" data-page="1" data-load="<?php echo intval($posts_per_page); ?>" data-category="<?php echo esc_html($category); ?>" class="portfolio_load_more_btn vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-theme_style_2"><i class="fa fa-refresh vc_btn3-icon" aria-hidden="true"></i> <?php esc_html_e( 'load more', 'consulting' ); ?></a>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var $container = $(".stm_portfolio_grid");
        var originLeft = true;
        if( $("body").hasClass("rtl") ) {
            originLeft = false;
        }
        $container.isotope({
            layoutMode: "packery",
            itemSelector: ".item",
            transitionDuration: "0.7s",
            gutter: 10,
            isOriginLeft: originLeft,
            <?php if(!empty($works_count_visible)): ?>
            filter: function(){
                return $(this).index() < <?php echo esc_js(intval($works_count_visible)); ?>
            }
            <?php endif; ?>
        });
        $container.imagesLoaded().progress(function () {
            $container.isotope("layout");
        });
        $container.isotope("layout");

        $(document).on("click", ".portfolio_load_more_btn", function(e){
            e.preventDefault();
            var page = $(this).attr("data-page");
            var load_by = $(this).attr("data-load");
            var category = $(this).attr('data-category');
            $.ajax({
                url: ajaxurl,
                type: "POST",
                dataType: "json",
                data: "&page=" + page + "&load_by=" + load_by + "&category=" + category + "&action=stm_ajax_load_portfolio",
                context: this,
                beforeSend: function (data) {
                    $(this).parent().addClass("portfolio_posts_loading");
                },
                success: function (data) {
                    $(this).parent().removeClass("portfolio_posts_loading");
                    if(data.html) {
                        var $items = $(data.html);
                        $(".stm_portfolio_grid").append($items).isotope("appended", $items, false);
                        stm_sort_portfolio();
                    }
                    $(this).attr("data-page", data.new_page);
                    if(!data.load_more) {
                        $(this).remove();
                        $(".portfolio_btn_box").remove();
                    }
                }
            });
        });

        function stm_sort_portfolio() {
            // Init Isotope
            if ($(".stm_portfolio").length) {
                $(".stm_portfolio").isotope({
                    itemSelector: ".item",
                    layoutMode: "packery"
                });
            }
        }
    });
</script>