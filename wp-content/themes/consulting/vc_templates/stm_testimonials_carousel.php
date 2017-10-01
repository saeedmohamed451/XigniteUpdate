<?php
$style = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'slick' );
wp_enqueue_style( 'slick' );

$class_to_filter = 'testimonials_carousel';

$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' );

if( !empty( $style ) ) {
	$class_to_filter .= ' ' . esc_attr( $style );
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter );

$args = array(
	'post_type'      => 'stm_testimonials',
	'posts_per_page' => $count
);

$link = vc_build_link( $link );

if ( $category != 'all' ) {
	$args['stm_testimonials_category'] = $category;
}

if( $per_row ){
	$css_class .= ' per_row_' . $per_row;
}

if( $disable_carousel ){
	$css_class .= ' disable_carousel';
}

if( empty( $thumb_size ) ) {
	$thumb_size = '350x250';
}

$consulting_config = consulting_config();

$testimonials = new WP_Query( $args );
$id           = uniqid( 'partners_carousel_' );

$autoplay_carousel_js = 'false';
if(!empty($autoplay_carousel) and $autoplay_carousel == 'yes') {
	$autoplay_carousel_js = 'true';
}
?>
<?php if( $testimonials->have_posts() ): ?>
	<div class="<?php echo esc_attr( $css_class ); ?>" id="<?php echo esc_attr( $id ); ?>">
		<?php while( $testimonials->have_posts() ): $testimonials->the_post(); ?>

			<?php if( $style == 'style_1' ) : ?>
				<?php if($consulting_config['layout'] == 'layout_14' and !$disable_carousel): ?>
					<div class="testimonial">
						<?php
						$author_photo = wpb_getImageBySize( array(
							'attach_id' => get_post_thumbnail_id(),
							'thumb_size' => $thumb_size,
						) );
						?>
						<div class="image">
							<?php if ( $link['url'] ): ?>
								<a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo $author_photo['thumbnail']; ?></a>
							<?php else: ?>
								<?php echo $author_photo['thumbnail']; ?>
							<?php endif; ?>
						</div>
						<div class="info">
							<?php
							$position = get_post_meta( get_the_ID(), 'testimonial_position', true );
							$company = get_post_meta( get_the_ID(), 'testimonial_company', true );
							?>

							<div class="heading_font"><?php the_excerpt(); ?></div>
							<h4 class="no_stripe">
								<?php if ( $link['url'] ): ?>
									<a href="<?php echo esc_url( $link['url'] ); ?>">
										<?php the_title(); ?>
									</a>
								<?php else: ?>
									<?php the_title(); ?>
								<?php endif; ?>
							</h4>
							<?php if( $position ): ?>
								<span class="position"><?php echo esc_html( $position ); ?>, </span>
							<?php endif; ?>
							<?php if( $company ): ?>
								<span class="company"><?php echo esc_html( $company ); ?></span>
							<?php endif; ?>
						</div>
					</div>
				<?php elseif(stm_check_layout('layout_15') or stm_check_layout('layout_18') && !$disable_carousel): ?>
					<?php
						$bg_image = get_post_meta(get_the_id(), 'testimonial_bg_img', true);
						$video_url = get_post_meta(get_the_id(), 'testimonial_video_url', true);
						$position = get_post_meta( get_the_ID(), 'testimonial_position', true );
						$company = get_post_meta( get_the_ID(), 'testimonial_company', true );

						if(empty($bg_image)) {
							$bg_image = '';
						} else {
							$bg_image = wp_get_attachment_image_src($bg_image, 'full');
							if(!empty($bg_image[0])) {
								$bg_image = 'style="background-image:url(' . $bg_image[0] . ')"';
							} else {
								$bg_image = '';
							}
						}
					?>
					<div class="testimonial" <?php echo sanitize_text_field($bg_image); ?>>
						<div class="info">
							<div class="container">
								<?php if(!empty($video_url)): ?>
									<a href="#" data-url="<?php echo esc_attr($video_url); ?>" class="stm_video_url stm_fancy-iframe"></a>
								<?php endif; ?>
								<div class="stm_testimonial_excerpt"><i><?php the_excerpt(); ?></i></div>
								<h4 class="no_stripe">
									<?php if ( $link['url'] ): ?>
										<a href="<?php echo esc_url( $link['url'] ); ?>">
											<?php the_title(); ?>
										</a>
									<?php else: ?>
										<?php the_title(); ?>
									<?php endif; ?>
								</h4>
								<?php if( $position ): ?>
									<span class="position"><?php echo esc_html( $position ); ?>, </span>
								<?php endif; ?>
								<?php if( $company ): ?>
									<span class="company"><?php echo esc_html( $company ); ?></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php else: ?>
					<div class="testimonial">
						<?php
						$author_photo = wpb_getImageBySize( array(
							'attach_id' => get_post_thumbnail_id(),
							'thumb_size' => $thumb_size,
						) );
						?>
						<div class="image">
							<?php if ( $link['url'] ): ?>
								<a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo $author_photo['thumbnail']; ?></a>
							<?php else: ?>
								<?php echo $author_photo['thumbnail']; ?>
							<?php endif; ?>
						</div>
						<div class="info">
							<h4 class="no_stripe">
								<?php if ( $link['url'] ): ?>
									<a href="<?php echo esc_url( $link['url'] ); ?>">
										<?php the_title(); ?>
									</a>
								<?php else: ?>
									<?php the_title(); ?>
								<?php endif; ?>
							</h4>
							<?php
								$position = get_post_meta( get_the_ID(), 'testimonial_position', true );
								$company = get_post_meta( get_the_ID(), 'testimonial_company', true );
							?>
							<?php if( $consulting_config['layout'] == 'layout_8' || $consulting_config['layout'] == 'layout_10' ) : ?>
								<?php
									$author_info = array();
									$author_info[] = $position;
									$author_info[] = $company;
								?>
								<?php if( !empty( $author_info ) ) : ?>
									<div class="position"><?php echo join(', ', $author_info); ?></div>
								<?php endif; ?>
							<?php else : ?>
								<?php if( $position ): ?>
									<div class="position"><?php echo esc_html( $position ); ?></div>
								<?php endif; ?>
								<?php if( $company ): ?>
									<div class="company"><?php echo esc_html( $company ); ?></div>
								<?php endif; ?>
							<?php endif; ?>
							<?php the_excerpt(); ?>
						</div>
					</div>
				<?php endif; ?>

			<?php elseif( $style == 'style_2' ) : ?>

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
			<?php elseif( $style == 'style_3' ) : ?>

				<div class="testimonial">
					<div class="testimonial_inner">
						<?php if( has_post_thumbnail() ): ?>
							<?php
								$author_photo = wpb_getImageBySize( array(
									'attach_id' => get_post_thumbnail_id(),
									'thumb_size' => '348x348',
								) );
							?>
							<div class="image">
								<?php if ( $link['url'] ): ?>
									<a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo $author_photo['thumbnail']; ?></a>
								<?php else: ?>
									<?php echo $author_photo['thumbnail']; ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<div class="info">
							<div class="stm_testimonials_content_unit"><?php the_excerpt(); ?></div>
							<h6 class="no_stripe">
								<?php if ( $link['url'] ): ?>
									<a href="<?php echo esc_url( $link['url'] ); ?>">
										<?php the_title(); ?>
									</a>
								<?php else: ?>
									<?php the_title(); ?>
								<?php endif; ?>
							</h6>
							<?php
								$author_info = array();
								$author_info[] = get_post_meta( get_the_ID(), 'testimonial_position', true );
								$author_info[] = get_post_meta( get_the_ID(), 'testimonial_company', true );
							?>
							<?php if( !empty( $author_info ) && is_array( $author_info ) ): ?>
								<div class="position"><?php echo esc_html( join(', ', $author_info) ); ?></div>
							<?php endif; ?>
						</div>
					</div>
				</div>

			<?php endif; ?>
		<?php endwhile; ?>
	</div>
	<?php if( ! $disable_carousel ): ?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				"use strict";
				var <?php echo esc_attr( $id ) ?> = $("#<?php echo esc_attr( $id ) ?>");
				var slickRtl = false;

				if( $('body').hasClass('rtl') ) {
					slickRtl = true;
				}

				<?php
					$opt = 'arrows: false,';
					 if( !$disable_carousel_arrows ) {
					    $opt = 'arrows: true,';
					    $opt .= 'prevArrow:"<div class=\"slick_prev\"><i class=\"fa fa-chevron-left\"></i></div>",';
					    $opt .= 'nextArrow: "<div class=\"slick_next\"><i class=\"fa fa-chevron-right\"></i></div>",';
					 }
				?>

				<?php echo esc_attr( $id ) ?>.slick({
					rtl: slickRtl,
					dots: false,
					infinite: true,
					<?php echo $opt; ?>
					autoplaySpeed: 5000,
					autoplay: <?php echo esc_js($autoplay_carousel_js); ?>,
					slidesToShow: <?php echo esc_js( $per_row ); ?>,
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
<?php endif; ?>
<?php wp_reset_query(); ?>
