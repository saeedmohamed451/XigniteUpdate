<?php

if ( ! function_exists( 'consulting_print_styles' ) ) {
	function consulting_print_styles() {
		$post_id        = get_the_ID();
		$is_shop        = false;
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
		if ( $is_shop ) {
			$post_id = get_option( 'woocommerce_shop_page_id' );
		}

		$css = "";

		$title_box = array();

		$title_box['color']               = get_post_meta( $post_id, 'title_box_title_color', true );
		$title_box['background-color']    = get_post_meta( $post_id, 'title_box_title_bg_color', true );
		$title_box['background-image']    = wp_get_attachment_image_src( get_post_meta( $post_id, 'title_box_bg_image', true ), 'full' );
		$title_box['background-position'] = get_post_meta( $post_id, 'title_box_bg_position', true );
		$title_box['background-size']     = get_post_meta( $post_id, 'title_box_bg_size', true );
		$title_box['background-repeat']   = get_post_meta( $post_id, 'title_box_bg_repeat', true );

		if ( $title_box ) {
			$css .= '.page_title{ ';
			foreach ( $title_box as $key => $val ) {
				if ( $val ) {
					if ( $key != 'background-image' ) {
						$css .= $key . ': ' . esc_attr( $val ) . ' !important; ';
					} else {
						$css .= $key . ': url(' . esc_url( $val[0] ) . ') !important; ';
					}
				}
			}
			$css .= '}';
		}

		if( $title_box_title_line_color = get_post_meta( $post_id, 'title_box_title_line_color', true ) ){
			$css .= 'body .page_title h1:after{
				background: ' . $title_box_title_line_color . ';
			}';
		}

		if( get_theme_mod( 'site_boxed' ) && get_theme_mod( 'custom_bg_image' ) ){
			$css .= '
				body.boxed_layout{
					background-image: url( ' . esc_url( get_theme_mod( 'custom_bg_image' ) ) . ' ) !important;
				}
			';
		}

		$custom_css = get_theme_mod( 'custom_css' );

		if ( $custom_css ) {
			$css .= preg_replace( '/\s+/', ' ', $custom_css );
		}

		wp_add_inline_style( 'consulting-layout', $css );
	}
}

add_action( 'wp_enqueue_scripts', 'consulting_print_styles' );


/*In consulting 3.5 CSS saved in uploads folder*/
function consulting_skin_custom() {
	$site_color = get_theme_mod( 'site_skin', 'skin_default' );

	if( $site_color == 'skin_custom' ) {
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$consulting_config = consulting_config();
		$custom_style_css = $wp_filesystem->get_contents( get_template_directory() . '/assets/css/'. $consulting_config['layout'] .'/main.css' );

		$base_color = get_theme_mod( 'site_skin_base_color', $consulting_config['base_color'] );
		$secondary_color = get_theme_mod( 'site_skin_secondary_color', $consulting_config['secondary_color'] );
		$third_color = get_theme_mod( 'site_skin_third_color', $consulting_config['third_color'] );

		$colors_arr = array();
		$colors_arr[] = $base_color;
		$colors_arr[] = $secondary_color;
		$colors_arr[] = $third_color;
		$colors_differences = false;

		$search_colors = array(
			$consulting_config['base_color'],
			$consulting_config['secondary_color'],
			$consulting_config['third_color'],
			'../../'
		);

		$replace_colors = array(
			$base_color,
			$secondary_color,
			$third_color,
			'/wp-content/themes/consulting/assets/'
		);

		if( !empty( $consulting_config['base_rgb_color']['alpha'] ) ) {
			foreach( $consulting_config['base_rgb_color']['alpha'] as $val ) {
				$search_colors[] = 'rgba('. $consulting_config['base_rgb_color']['rgb'] .', '. $val .')';
				$replace_colors[] = consulting_hex2rgba( $base_color, $val );
			}
		}

		if( !empty( $consulting_config['secondary_rgb_color']['alpha'] ) ) {
			foreach( $consulting_config['secondary_rgb_color']['alpha'] as $val ) {
				$search_colors[] = 'rgba('. $consulting_config['secondary_rgb_color']['rgb'] .', '. $val .')';
				$replace_colors[] = consulting_hex2rgba( $secondary_color, $val );
			}
		}

		if( !empty( $consulting_config['third_rgb_color']['alpha'] ) ) {
			foreach( $consulting_config['third_rgb_color']['alpha'] as $val ) {
				$search_colors[] = 'rgba('. $consulting_config['third_rgb_color']['rgb'] .', '. $val .')';
				$replace_colors[] = consulting_hex2rgba( $third_color, $val );
			}
		}

		$custom_style_css = str_replace( $search_colors, $replace_colors, $custom_style_css );
		$custom_style_css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_style_css );

		$upload_dir = wp_upload_dir();

		if( ! $wp_filesystem->is_dir( $upload_dir['basedir'] . '/stm_uploads' ) ) {
			$wp_filesystem->mkdir( $upload_dir['basedir'] . '/stm_uploads', FS_CHMOD_DIR );
		}

		if( $custom_style_css ) {
			$css_to_filter = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_style_css );
			$css_to_filter = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css_to_filter );

			$custom_style_file = $upload_dir['basedir'] . '/stm_uploads/skin-custom.css';

			if( $custom_style_file ) {
				$custom_style_content = $wp_filesystem->get_contents( $custom_style_file );

				if( is_array( $colors_arr ) && !empty( $colors_arr ) ) {
					foreach( $colors_arr as $color ) {
						$color_find = strpos( $custom_style_content, $color );
						if( ! $color_find && ! $colors_differences ) {
							$colors_differences = true;
						}
					}
				}

				if( $colors_differences ) {
					$wp_filesystem->put_contents($custom_style_file, $css_to_filter, FS_CHMOD_FILE);
				}
			} else {
				$wp_filesystem->put_contents($custom_style_file, $css_to_filter, FS_CHMOD_FILE);
			}
		}
	}
}

add_action( 'customize_save_after', 'consulting_skin_custom', 20 );

function stm_migrate_prev_settings() {
	$transition = get_option('stm_css_transition', 'no');

	if($transition == 'no') {
		consulting_skin_custom();
		update_option('stm_css_transition', 'yes');
	}
}

add_action('init', 'stm_migrate_prev_settings');