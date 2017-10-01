<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if( $style != 'carousel' ) {
	$css_class .= ' ' . $style;
}
if ( $style == 'grid' ) {
	$css_class .= ' cols_' . $per_row;
}
if ( $grid_view == 'short' ) {
    $css_class .= ' short-view';
}

if(!empty($style_grid) and $style_grid == 2) {
	$css_class .= ' style_2';
}

$args      = array(
    'post_type'      => 'stm_staff',
    'posts_per_page' => $count
);

if ( $category != 'all' ) {
    $args['stm_staff_category'] = $category;
}

$testimonials = new WP_Query( $args );

if( $style == 'carousel' ) {
	wp_enqueue_script( 'slick' );
	wp_enqueue_style( 'slick' );
}

$carousel_id = uniqid('staff_carousel_');

$link = vc_build_link( $link );
?>

<?php if ( $testimonials->have_posts() ) : ?>

	<?php if( $style == 'carousel' ) : ?>

		<div class="staff_carousel_container<?php echo esc_attr( $css_class ); ?>">
			<?php if( $carousel_arrows ) : ?>
				<div class="staff_carousel_arrows"><div class="staff_carousel_arrows_inner"></div></div>
			<?php endif; ?>
            <div class="staff_carousel-box">
                <div class="staff_carousel" id="<?php echo esc_attr( $carousel_id ); ?>">
                    <?php while ( $testimonials->have_posts() ): $testimonials->the_post(); ?>
                        <div class="staff_carousel_item">
                            <?php if( has_post_thumbnail() ): ?>
                                <div class="staff_image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'consulting-image-350x250-croped' ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="staff_info">
                                <h5 class="no_stripe">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h5>
                                <?php if( $department = get_post_meta( get_the_ID(), 'department', true ) ): ?>
                                    <div class="staff_department">
                                        <?php echo esc_html( $department ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
		</div>

	<?php else: ?>

		<div class="staff_list<?php echo esc_attr( $css_class ); ?>">
			<ul>
				<?php while ( $testimonials->have_posts() ): $testimonials->the_post(); ?>
					<li>
						<?php if ( $style != 'grid' ) {
							$len = 155;
						}else{
							$len = 95;
						} ?>
						<?php if(!empty($style_grid) and $style_grid == 2): $len = 250; ?>
							<div class="inner_box">
								<div class="inner">
									<h4 class="no_stripe">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h4>
									<?php if( $department = get_post_meta( get_the_ID(), 'department', true ) ): ?>
										<div class="staff_department">
											<?php echo esc_html( $department ); ?>
										</div>
									<?php endif; ?>
									<div class="stm_invis">
										<div class="stm_excerpt">
											<?php if( $excerpt = consulting_substr_text( get_the_excerpt(), $len ) ): ?>
												<p><?php echo esc_html( $excerpt ); ?></p>
											<?php endif; ?>
										</div>
										<a class="stm_link_bordered white" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'consulting'); ?></a>
									</div>
								</div>
								<div class="staff_image">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'consulting-image-1110x550-croped' ); ?>
									</a>
								</div>
							</div>
						<?php else: ?>
							<?php if( has_post_thumbnail() ): ?>
								<div class="staff_image">
									<a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'consulting-image-350x250-croped' ); ?>
									</a>
								</div>
							<?php endif; ?>
							<div class="staff_info">
								<h4 class="no_stripe">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h4>
								<?php if( $department = get_post_meta( get_the_ID(), 'department', true ) ): ?>
									<div class="staff_department">
										<?php echo esc_html( $department ); ?>
									</div>
								<?php endif; ?>
								<?php if( $excerpt = consulting_substr_text( get_the_excerpt(), $len ) ): ?>
									<p><?php echo esc_html( $excerpt ); ?></p>
								<?php endif; ?>
								<?php if ( $style != 'grid' ) : ?>
									<a href="<?php the_permalink(); ?>" class="button bordered size-sm icon_right"><?php esc_html_e( 'view profile', 'consulting' ); ?> <i class="fa fa-chevron-right"></i></a>
								<?php else: ?>
									<a class="read_more" href="<?php the_permalink(); ?>">
										<span><?php esc_html_e( 'view profile', 'consulting' ); ?></span>
										<i class=" fa fa-chevron-right stm_icon"></i>
									</a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</li>
				<?php endwhile;
				wp_reset_postdata(); ?>
                <?php if ( $link['url'] ): ?>
                <li class="staff_custom_link">
                    <a href="<?php echo esc_url( $link['url'] ); ?>">
                        <?php if(!empty( $link['title'] ) || !empty( $link_text )) : ?>
                        <span>
                            <?php if(!empty( $link['title'] )) : ?>
                            <span class="staff_custom_link_title"><?php echo esc_html( $link['title'] ); ?></span>
                            <?php endif; ?>
                            <?php echo esc_html( $link_text ); ?>
                        </span>
                        <?php endif; ?>
                    </a>
                </li>
                <?php endif; ?>
			</ul>

		</div>

	<?php endif; ?>

<?php endif; ?>

<?php if( $style == 'carousel' ): ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			"use strict";
			var <?php echo esc_attr( $carousel_id ) ?> = $("#<?php echo esc_attr( $carousel_id ) ?>");
			var slickRtl = false;

			if( $('body').hasClass('rtl') ) {
				slickRtl = true;
			}
			<?php echo esc_attr( $carousel_id ) ?>.slick({
				rtl: slickRtl,
				dots: false,
				infinite: true,
				<?php if( $carousel_arrows ) : ?>
				arrows: true,
				appendArrows: '.staff_carousel_arrows_inner',
				prevArrow: "<div class=\"slick_prev\"><i class=\"fa fa-chevron-left\"></i></div>",
				nextArrow: "<div class=\"slick_next\"><i class=\"fa fa-chevron-right\"></i></div>",
				<?php else : ?>
				arrows: false,
				<?php endif; ?>
				slidesToShow: <?php echo esc_js( $slides_to_show ); ?>,
				cssEase: "cubic-bezier(0.455, 0.030, 0.515, 0.955)",
				responsive: [
					{
						breakpoint: 769,
						settings: {
							slidesToShow: 1
						}
					}
				]
			});
		});
	</script>
<?php endif; ?>
