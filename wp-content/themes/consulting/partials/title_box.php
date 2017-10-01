<?php
$post_id        = get_the_ID();
$is_shop        = false;
$is_product     = false;
$page_for_posts = get_option( 'page_for_posts' );
if ( is_home() || is_category() || is_search() || is_tag() || is_tax() ) {
	$post_id = $page_for_posts;
}
if ( ( function_exists( 'is_shop' ) && is_shop() )
     || ( function_exists( 'is_product_category' ) && is_product_category() )
     || ( function_exists( 'is_product_tag' ) && is_product_tag() )
) {
	$is_shop = true;
}
if ( function_exists( 'is_product' ) && is_product() ) {
	$is_product = true;
}
if ( $is_shop ) {
	$post_id = get_option( 'woocommerce_shop_page_id' );
}
$class = 'page_title';
if ( get_post_meta( $post_id, 'enable_transparent', true ) ) {
	$class .= ' transparent';
}
if ( get_post_meta( $post_id, 'disable_title', true ) ) {
	$class .= ' disable_title';
}
?>
<?php if ( ! get_post_meta( $post_id, 'disable_title_box', true ) ): ?>
	<div class="<?php echo esc_attr( $class ); ?>">
		<?php if ( ! get_post_meta( $post_id, 'disable_title', true ) || ! get_post_meta( $post_id, 'disable_breadcrumbs', true ) ): ?>
			<div class="container">
				<?php
				if ( ! get_post_meta( $post_id, 'disable_breadcrumbs', true ) ) {
					consulting_breadcrumbs();
				}
				?>
				<?php if ( ! get_post_meta( $post_id, 'disable_title', true ) ): ?>
					<?php if( consulting_page_title( false, esc_html__( 'News', 'consulting' ), esc_html__( 'Careers', 'consulting' ) ) ): ?>
						<h1 class="h2"><?php echo consulting_page_title( false, esc_html__( 'News', 'consulting' ), esc_html__( 'Careers', 'consulting' ) ); ?></h1>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>