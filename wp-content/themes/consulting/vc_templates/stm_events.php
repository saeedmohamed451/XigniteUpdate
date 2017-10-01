<?php
$event_style = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$css_class .= ' cols_' . $posts_per_row;

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
	'post_type'      => 'stm_event',
	'posts_per_page' => $posts_per_page,
    'paged' 		 => $paged,
    'orderby' => 'meta_value_num',
    'meta_key' => 'stm_event_date_start',
    'order' => 'ASC'
);

if( 'upcoming' === $events_filter ) {
    $args['meta_query'][] = array(
        'key' => 'stm_event_date_start',
        'value' => time(),
        'compare' => '>=',
    );
} elseif( 'past' === $events_filter ) {
    $args['meta_query'][] = array(
        'key' => 'stm_event_date_end',
        'value' => time(),
        'compare' => '<=',
    );
}

if ( $category != 'all' ) {
    $args['stm_event_category'] = $category;
}

$events = new WP_Query( $args );

$count_posts = wp_count_posts( 'stm_event' );
$published_posts = $count_posts->publish;
?>

<?php if ( $events->have_posts() ): ?>
    <?php if( 'grid' === $event_style ) : ?>
        <div class="stm_events_grid<?php echo esc_attr( $css_class ); ?>">
            <?php while ( $events->have_posts() ): $events->the_post(); ?>
                <?php get_template_part( 'partials/content-event', 'grid' ); ?>
            <?php endwhile; ?>
        </div>
        <?php if( $pagination_enable ) {
            echo '<div class="events_pagination">';
            consulting_paging_nav( 'paging_view_posts-list', $events );
            echo '</div>'; }
        ?>
        <?php wp_reset_postdata(); ?>
    <?php elseif( 'classic' === $event_style ) : ?>
        <div class="stm_events_classic<?php echo esc_attr( $css_class ); ?>">
            <?php while ( $events->have_posts() ): $events->the_post(); ?>
                <?php get_template_part( 'partials/content-event', 'classic' ); ?>
            <?php endwhile; ?>
            <div class="stm_events_list_form">
                <?php get_template_part( 'partials/content', 'event-list-form' ); ?>
            </div>
            <?php if( $pagination_enable ) {
                echo '<div class="events_pagination">';
                consulting_paging_nav( 'paging_view_posts-list', $events );
                echo '</div>'; }
            ?>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php elseif( 'modern' === $event_style ) : ?>
        <div class="stm_events_modern<?php echo esc_attr( $css_class ); ?>">
            <div class="stm_events_modern_list">
                <?php while ( $events->have_posts() ): $events->the_post(); ?>
                    <?php get_template_part( 'partials/content-event', 'modern' ); ?>
                    <?php $post_cat = wp_get_post_terms( get_the_ID(), 'stm_event_category' ); ?>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
            <?php if ( $category != 'all' ) : ?>
                <?php if( $load_more_enable && $posts_per_page < $post_cat[0]->count ) : ?>
                    <div class="event_btn_loading vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-theme_style_2"><?php esc_html_e( 'loading...', 'consulting' ); ?></div>
                    <a href="#" data-page="1" data-load="<?php echo intval($posts_per_page); ?>" data-category="<?php echo esc_html($category); ?>" data-filter="<?php echo esc_html($events_filter); ?>" class="load_more_btn vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-theme_style_2"><i class="fa fa-refresh vc_btn3-icon" aria-hidden="true"></i> <?php esc_html_e( 'load more', 'consulting' ); ?></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if( $load_more_enable && $posts_per_page < $published_posts ) : ?>
                    <div class="event_btn_loading vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-theme_style_2"><?php esc_html_e( 'loading...', 'consulting' ); ?></div>
                    <a href="#" data-page="1" data-load="<?php echo intval($posts_per_page); ?>" data-category="<?php echo esc_html($category); ?>" data-filter="<?php echo esc_html($events_filter); ?>" class="load_more_btn vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-theme_style_2"><i class="fa fa-refresh vc_btn3-icon" aria-hidden="true"></i> <?php esc_html_e( 'load more', 'consulting' ); ?></a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php elseif( 'widget' === $event_style ) : ?>
        <div class="stm_events_widgets<?php echo esc_attr( $css_class ); ?>">
            <?php while ( $events->have_posts() ): $events->the_post(); ?>
                <?php get_template_part( 'partials/content-event', 'widgets' ); ?>
            <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
<?php endif; ?>