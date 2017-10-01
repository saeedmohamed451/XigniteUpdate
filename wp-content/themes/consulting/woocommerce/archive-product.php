<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<?php
$sidebar_type = get_theme_mod( 'shop_sidebar_type', 'wp' );
if ( $sidebar_type == 'wp' ) {
	$sidebar_id = get_theme_mod( 'shop_wp_sidebar', 'consulting-shop' );
} else {
	$sidebar_id = get_theme_mod( 'shop_vc_sidebar' );
}
if ( ! empty( $_GET['sidebar_id'] ) ) {
	$sidebar_id =  $_GET['sidebar_id'];
}
$structure = consulting_get_structure( $sidebar_id, $sidebar_type, get_theme_mod( 'shop_sidebar_position', 'right' ) ); ?>

<?php echo $structure['content_before']; ?>
	<?php if ( get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'disable_title', true ) ): ?>
		<h1 class="h2 page_title_2"><?php consulting_page_title( true, esc_html__( 'News', 'consulting' ), esc_html__( 'Careers', 'consulting' ) ); ?></h1>
	<?php endif; ?>
	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

			<?php
			/**
			 * woocommerce_before_shop_loop hook.
			 *
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
<?php echo $structure['content_after']; ?>
<?php echo $structure['sidebar_before']; ?>
	<?php
	if ( $sidebar_id ) {
		if ( $sidebar_type == 'wp' ) {
			$sidebar = true;
		} else {
			$sidebar = get_post( $sidebar_id );
		}
	}
	if ( isset( $sidebar ) ) {
		if ( $sidebar_type == 'vc' ) { ?>
			<div class="sidebar-area stm_sidebar">
				<style type="text/css" scoped>
					<?php echo get_post_meta( $sidebar_id, '_wpb_shortcodes_custom_css', true ); ?>
				</style>
				<?php echo apply_filters( 'the_content', $sidebar->post_content ); ?>
			</div>
		<?php } else { ?>
			<div class="sidebar-area default_widgets">
				<?php dynamic_sidebar( $sidebar_id ); ?>
			</div>
		<?php }
	}
	?>
<?php echo $structure['sidebar_after']; ?>
<?php get_footer( 'shop' ); ?>
