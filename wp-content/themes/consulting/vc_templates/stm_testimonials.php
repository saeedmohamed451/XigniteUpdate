<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$args      = array(
	'post_type'      => 'stm_testimonials',
	'posts_per_page' => $count
);
if ( $per_row ) {
	$css_class .= ' cols_' . $per_row;
}
if ( $style ) {
	$css_class .= ' ' . $style;
}
if ( $category != 'all' ) {
	$args['stm_testimonials_category'] = $category;
}
if( $style == 'style_3' ) {
	wp_enqueue_script( 'owl.carousel' );
	wp_enqueue_style( 'owl.carousel' );
	$css_class .= ' navigation-' . $navigation_type;
}

$owl_wr_id  = uniqid( 'owl_wr_' );
$owl_id     = uniqid( 'owl_' );
$owl_nav_id = uniqid( 'owl-nav-' );

$testimonials = new WP_Query( $args );
?>

<?php if( $style == 'style_3' ) : ?>

	<div class="vc_testimonials<?php echo esc_attr( $css_class ); ?>" id="<?php echo esc_attr( $owl_wr_id ); ?>">
		<div class="container">
			<div class="vc_testimonials_carousel_wr">
				<div class="vc_testimonials_carousel" id="<?php echo esc_attr( $owl_id ); ?>">
					<?php while ( $testimonials->have_posts() ): $testimonials->the_post(); ?>
						<div class="item" data-image="<?php echo esc_url( wp_get_attachment_image_url( get_post_meta( get_the_ID(), 'testimonial_bg_img', true ), true ) ); ?>">
							<?php the_excerpt(); ?>
							<div class="testimonial_info">
								<h4 class="no_stripe"><?php the_title(); ?></h4>
								<?php
									$testimonial_author_info = array();
									$testimonial_author_info[] = get_post_meta( get_the_ID(), 'testimonial_position', true );
									$testimonial_author_info[] = get_post_meta( get_the_ID(), 'testimonial_company', true );
								?>
								<p><strong><?php echo esc_html( join(', ', $testimonial_author_info) ); ?></strong></p>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
				<?php if( $navigation_type == 'bullets' ) : ?>
					<div class="owl-dots" id="<?php echo esc_attr( $owl_nav_id ); ?>"></div>
				<?php else : ?>
					<div class="owl-nav" id="<?php echo esc_attr( $owl_nav_id ); ?>"></div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		jQuery(document).ready(function ($) {

			var <?php echo esc_js( $owl_id ); ?> = $("#<?php echo esc_js( $owl_id ); ?>");
			var <?php echo esc_js( $owl_wr_id ); ?> = $("#<?php echo esc_js( $owl_wr_id ); ?>");

			<?php echo esc_js( $owl_id ); ?>.on('initialized.owl.carousel', function () {
				var bg_image = <?php echo esc_js( $owl_id ); ?>.find(".owl-item.active .item").data("image");
				<?php echo esc_js( $owl_wr_id ); ?>.css({'background-image': 'url('+bg_image+')'});
			});

			var owlRtl = false;

			if( $('body').hasClass('rtl') ) {
				owlRtl = true;
			}

			$("#<?php echo esc_js( $owl_id ); ?>").owlCarousel({
				rtl: owlRtl,
				items: 1,
				<?php if( $navigation_type == 'bullets' ) : ?>
				dotsContainer: '#<?php echo esc_js( $owl_nav_id ); ?>',
				<?php else : ?>
				nav: true,
				dots: false,
				navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
				navContainer: '#<?php echo esc_js( $owl_nav_id ); ?>',
				<?php endif; ?>
				<?php if( $autoplay ): ?>
				autoplay: true,
				<?php endif; ?>
				<?php if( $loop ): ?>
				loop: true,
				<?php endif; ?>
				autoHeight:true,
				autoplayTimeout: <?php echo esc_js( $timeout ); ?>,
				smartSpeed: <?php echo esc_js( $smart_speed ); ?>,
				onTranslated: function () {
					var bg_image = <?php echo esc_js( $owl_id ); ?>.find(".owl-item.active .item").data("image");
					<?php echo esc_js( $owl_wr_id ); ?>.css({'background-image': 'url('+bg_image+')'});
				}
			});

		});
	</script>

<?php else: ?>

	<?php if ( $testimonials->have_posts() ): ?>
		<div class="stm_testimonials<?php echo esc_attr( $css_class ); ?>">
			<?php while ( $testimonials->have_posts() ): $testimonials->the_post(); ?>
				<div class="item">
					<div class="testimonial"><?php the_excerpt(); ?></div>
					<div class="testimonial-info clearfix">
						<div class="testimonial-image"><?php the_post_thumbnail( 'consulting-image-50x50-croped' ); ?></div>
						<div class="testimonial-text">
							<div class="name"><?php the_title(); ?></div>
							<div class="company">
								<?php
								echo esc_html( get_post_meta( get_the_ID(), 'testimonial_position', true ) );
								if( $company = get_post_meta( get_the_ID(), 'testimonial_company', true ) ){
									echo ', ' . esc_html( $company );
								}
								?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	<?php endif; ?>

<?php endif; ?>
