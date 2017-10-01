<?php

$link = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$link = vc_build_link( $link );

if( $align_center ){
	$css_class .= ' align_center';
}

if( $style ){
	$css_class .= ' ' . $style;
}

$icon_styles = array();
$icon_style = '';

if( !empty( $title_icon_size ) ) {
	$icon_styles[] = 'font-size:' . esc_attr( $title_icon_size ) . 'px';
}

if( !empty( $icon_styles ) && is_array( $icon_styles ) ) {
	$icon_style = ' style="'. implode( ';', $icon_styles ) .'"';
}
if( !empty( $vc_image_size ) ) {
	$image_size = $vc_image_size;
} else {
	$image_size = 'consulting-image-350x204-croped';
}

if( $style == 'style_3' ){
	$image_size = 'consulting-image-350x250-croped';
}

$style_l15 = '';

echo $style_l15;

if(!empty($icon_l15) and stm_check_layout('layout_15')) {
	$style_l15 = 'stm_style_l15_icon';
}

?>

<div class="info_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr($style_l15); ?>">

	<?php if(!empty($style_l15)): ?>
		<div class="stm_icon_l15">
			<i class="<?php echo esc_attr($icon_l15) ?>"></i>
		</div>
	<?php endif; ?>

	<?php if( $style == 'style_3' ): ?>
		<div class="info_box_wrapper">
	<?php endif; ?>

	<?php if( $style == 'style_6' ) : ?>

		<div class="info_box_text">
			<div class="title">
				<div class="icon">
					<i class="<?php echo esc_attr( $title_icon ); ?>"<?php echo $icon_style; ?>></i>
				</div>
				<h5 class="no_stripe"><?php echo esc_html( $title ); ?></h5>
			</div>
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>
			<?php
			if ( $link['url'] ) {
				if ( ! $link['title'] ) {
					$link['title'] = esc_html__( 'Read more', 'consulting' );
				}
				if ( ! $link['target'] ) {
					$link['target'] = '_self';
				}
				if( $icon ){
					$link['title'] = '<span>' . esc_html( $link['title'] ) . '</span>' . '<i class=" ' . esc_attr( $icon ) . ' stm_icon"></i>';
				}
				echo ' <a class="read_more" target="' . esc_attr( $link['target'] ) . '" href="' . esc_url( $link['url'] ) . '">' . $link['title'] . '</a>';
			}
			?>
		</div>

	<?php else : ?>

		<?php if( $style == 'style_4' ) : ?>
			<?php if( $image ): ?>
				<?php
				$image_data = wpb_getImageBySize(array(
					'attach_id' => $image,
					'thumb_size' => '512x364'
				));
				?>
				<div class="info_box_image"><?php echo $image_data['thumbnail']; ?></div>
			<?php endif; ?>
		<?php else : ?>
			<?php if( empty( $vc_image_size ) && $image && $thumbnail = wp_get_attachment_image( $image, $image_size ) ){ ?>
				<div class="info_box_image"><?php echo $thumbnail; ?></div>
			<?php } elseif( $image && !empty( $vc_image_size ) ) { ?>
				<?php
					$vc_image_data = wpb_getImageBySize(array(
						'attach_id' => $image,
						'thumb_size' => $vc_image_size
					));
				?>
				<div class="info_box_image"><?php echo $vc_image_data['thumbnail']; ?></div>
			<?php } ?>
		<?php endif; ?>

		<?php if( $style == 'style_3' ): ?>
			<div class="info_box_text">
		<?php endif; ?>

		<?php if ( $title ) { ?>
			<div class="title">
				<?php if( $style == 'style_3' ): ?>
					<div class="icon">
						<i class="<?php echo esc_attr( $title_icon ); ?>"></i>
					</div>
				<?php endif; ?>
				<?php if( $style == 'style_3' ) : ?>
					<h6 class="no_stripe"><span><?php echo esc_html( $title ); ?></span></h6>
				<?php elseif( $style == 'style_5' ) : ?>
					<h3><?php echo esc_html( $title ); ?></h3>
				<?php else : ?>
					<h4 class="no_stripe"><?php echo esc_html( $title ); ?></h4>
				<?php endif; ?>
			</div>
		<?php } ?>
		<?php echo wpb_js_remove_wpautop( $content, true ); ?>
		<?php
		if ( $link['url'] ) {
			if ( ! $link['title'] ) {
				$link['title'] = esc_html__( 'Read More', 'consulting' );
			}
			if ( ! $link['target'] ) {
				$link['target'] = '_self';
			}
			if( $icon ){
				$link['title'] = '<span>' . esc_html( $link['title'] ) . '</span>' . '<i class=" ' . esc_attr( $icon ) . ' stm_icon"></i>';
			}
			echo ' <a class="read_more" target="' . esc_attr( $link['target'] ) . '" href="' . esc_url( $link['url'] ) . '">' . $link['title'] . '</a>';
		}
		?>
		<?php if( $style == 'style_3' ): ?>
			</div>
		<?php endif; ?>

	<?php endif; ?>

	<?php if( $style == 'style_3' ): ?>
		</div>
	<?php endif; ?>
</div>