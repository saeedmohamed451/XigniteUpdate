<div class="item <?php
$portfolio_box = array();
$portfolio_box['portfolio_column']   = get_post_meta( get_the_ID(), 'stm_portfolio_column', true );
if ( $portfolio_box ) {
    foreach ( $portfolio_box as $key => $val ) {
        echo $portfolio_box['portfolio_column'];
    }
}
$term_list  = wp_get_post_terms( get_the_ID(), 'stm_portfolio_category' );
?>">
    <?php if ( has_post_thumbnail() ): ?>
        <?php if ( $portfolio_box['portfolio_column'] === 'default' ): ?>
            <?php $image_size = 'consulting-image-700x500-croped'; ?>
        <?php elseif( $portfolio_box['portfolio_column'] === 'long' ) : ?>
            <?php $image_size = 'consulting-image-700x1060-croped'; ?>
        <?php elseif( $portfolio_box['portfolio_column'] === 'wide' ) : ?>
            <?php $image_size = 'consulting-image-1460x500-croped'; ?>
        <?php endif; ?>
        <?php
        $post_thumbnail = wpb_getImageBySize( array(
            'attach_id'  => get_post_thumbnail_id(),
            'thumb_size' => $image_size,
        ) );
        $post_thumbnail = $post_thumbnail['thumbnail'];
        ?>
        <div class="item_thumbnail has-thumbnail">
            <?php echo $post_thumbnail; ?>
            <a href="<?php the_permalink(); ?>">
                <span class="portfolio-title">
                    <?php the_title(); ?>
                    <?php if( $term_list ): ?>
                        <span class="portfolio-category"><?php echo esc_html( $term_list[0]->name ); ?></span>
                    <?php endif; ?>
                </span>
            </a>
        </div>
        <?php else: ?>
        <div class="item_thumbnail">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/tmp/placeholder.gif' ); ?>" alt="" />
            <a href="<?php the_permalink(); ?>">
                <span class="portfolio-title">
                    <?php the_title(); ?>
                    <?php if( $term_list ): ?>
                        <span class="portfolio-category"><?php echo esc_html( $term_list[0]->name ); ?></span>
                    <?php endif; ?>
                </span>
            </a>
        </div>
    <?php endif; ?>
</div>