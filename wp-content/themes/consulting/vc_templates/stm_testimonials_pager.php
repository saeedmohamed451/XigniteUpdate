<?php
$style = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_style( 'consulting-animate.min.css' );

$args = array(
	'post_type'      => 'stm_testimonials',
	'posts_per_page' => $count
);

if ( $category != 'all' ) {
	$args['stm_testimonials_category'] = $category;
}

$testimonials = new WP_Query( $args );

if($testimonials->have_posts()): $i = 0; ?>
	<div class="stm_l17_testimonials row-in-<?php echo $count; ?>">
		<div class="slick_prev"><i class="fa fa-chevron-left"></i></div>
		<div class="slick_next"><i class="fa fa-chevron-right"></i></div>
		<div class="top_content">
			<?php while($testimonials->have_posts()): $testimonials->the_post(); $i++; ?>
				<?php 
					$active = '';
					if($i == $count) {
						$active = 'active';
					}
				?>
				<div class="top_content_unit animated top_content_unit_<?php echo intval($i); echo ' ' . esc_attr($active); ?>" data-slide="<?php echo intval($i); ?>">
					<div class="heading_font"><?php the_excerpt(); ?></div>
				</div>
			<?php endwhile; $i = 0; ?>
		</div>
		<div class="stm_l17_pager">
			<?php while($testimonials->have_posts()): $testimonials->the_post(); $i++; ?>
				<?php
					$active = '';
					if($i == $count) {
						$active = 'active';
					}

					$position = get_post_meta( get_the_ID(), 'testimonial_position', true );
					$company = get_post_meta( get_the_ID(), 'testimonial_company', true );
				?>
				<div class="pager_unit pager_unit_<?php echo intval($i); echo ' ' . esc_attr($active); ?>" data-slide="<?php echo intval($i); ?>">
					<div class="inner">
						<div class="image">
							<?php the_post_thumbnail('thumbnail'); ?>
						</div>
						<div class="info">
							<div class="title heading_font"><?php the_title(); ?></div>
							<div class="job_info">
								<?php if(!empty($position)): ?>
									<span class="position"><?php echo esc_attr($position); ?></span>
								<?php endif; ?>
								<?php if(!empty($company)): ?>
									<span class="company"><?php echo esc_attr($company); ?></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>

	<script type="text/javascript">
		jQuery('document').ready(function(){
			var $ = jQuery;

			var totalSlides = <?php echo intval($count); ?>

			$('.pager_unit').click(function(e) {
				e.preventDefault();
				var slideId = $(this).data('slide');

				/*Content*/
				$('.top_content_unit').removeClass('active fadeIn');
				$('.top_content_unit_' + slideId).addClass('active fadeIn');

				/*Pager*/
				$('.pager_unit').removeClass('active');
				$(this).addClass('active');
			});

			$('.stm_l17_testimonials .slick_next').click(function(){
				var currentSlide = $('.pager_unit.active').data('slide');
				var nextSlide = currentSlide + 1;
				if(currentSlide == totalSlides) {
					var nextSlide = 1;
				}
				$('.pager_unit_' + nextSlide).click();
			})

			$('.stm_l17_testimonials .slick_prev').click(function(){
				var currentSlide = $('.pager_unit.active').data('slide');
				var nextSlide = currentSlide - 1;
				if(currentSlide == 1) {
					var nextSlide = totalSlides;
				}
				$('.pager_unit_' + nextSlide).click();
			})
		});
	</script>
<?php endif; ?>
