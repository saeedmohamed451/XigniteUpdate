<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="post_thumbnail"><a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'consulting-image-350x204-croped' ); ?></a>
		</div>
	<?php } ?>
	<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
	<div class="post_date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></div>
</li>