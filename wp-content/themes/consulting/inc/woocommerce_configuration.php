<?php

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

if ( ! function_exists( 'consulting_shop_loop_item_author' ) ) {
	function consulting_shop_loop_item_author() {
		$html = '<div class="author">' . esc_html__( 'by', 'consulting' ) . ' ' . get_the_author() . '</div>';
		echo $html;
	}
}

add_action( 'woocommerce_shop_loop_item_title', 'consulting_shop_loop_item_author', 10 );

if ( ! function_exists( 'consulting_before_shop_loop_wr_start' ) ) {
	function consulting_before_shop_loop_wr_start() {
		$html = '<div class="woocommerce_before_shop_loop">';
		echo $html;
	}
}

add_action( 'woocommerce_before_shop_loop', 'consulting_before_shop_loop_wr_start', 15 );

if ( ! function_exists( 'consulting_before_shop_loop_wr_end' ) ) {
	function consulting_before_shop_loop_wr_end() {
		$html = '</div>';
		echo $html;
	}
}

add_action( 'woocommerce_before_shop_loop', 'consulting_before_shop_loop_wr_end', 40 );

add_filter( 'woocommerce_show_page_title', '__return_false' );
add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true' );
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . get_theme_mod( 'shop_products_per_page', 9 ) . ';' ), 20 );
add_filter( 'loop_shop_columns', 'consulting_products_loop_columns' );

if ( ! function_exists( 'consulting_products_loop_columns' ) ) {
	function consulting_products_loop_columns() {
		return 3;
	}
}

add_filter( 'woocommerce_output_related_products_args', 'consulting_related_products_args' );

function consulting_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns']        = 3;

	return $args;
}

add_action( 'after_setup_theme', 'stm_woo_setup' );

function stm_woo_setup() {
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
}