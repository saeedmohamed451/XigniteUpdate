<?php consulting_get_header(); ?>

	<div class="content-area">

		<?php
			while ( have_posts() ) {
				the_post();

				get_template_part( 'partials/content' );

			}
		?>

	</div>

<?php get_footer(); ?>
