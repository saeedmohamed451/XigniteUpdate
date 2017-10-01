<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$link = vc_build_link( $link );

$bg = '';
if(!empty($image)) {
	$image = wp_get_attachment_image_src($image, 'full');
	if(!empty($image[0])) {
		$bg = 'style="background-image:url(\' ' . $image[0] . ' \')"';
	}
}
?>

<div class="stm_pricing_plan_unit">
	<div class="stm_pricing_plan">
		<div class="top text-center" <?php echo $bg; ?>>
			<div class="inner">
				<?php if(!empty($label)): ?>
					<div class="stm_label">
						<span><?php echo esc_attr($label); ?></span>
					</div>
				<?php endif; ?>
				<?php if(!empty($title)): ?>
					<div class="title"><?php echo esc_attr($title); ?></div>
				<?php endif; ?>
				<?php if(!empty($price)): ?>
					<div class="price">
						<span class="heading_font"><?php echo esc_attr($price); ?></span>
						<?php if(!empty($price_affix)): ?>
							<span class="price_affix"><?php echo esc_attr($price_affix); ?></span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if(!empty($subtitle)): ?>
					<div class="subtitle"><?php echo esc_attr($subtitle); ?></div>
				<?php endif; ?>
			</div>
		</div>
		<?php if(!empty($features)): ?>
			<div class="content">
				<?php echo wpb_js_remove_wpautop($features, false); ?>

				<?php if(!empty($link['url']) and !empty($link['title'])): ?>
					<div class="stm_pricing_btn">
						<a
							class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-block vc_btn3-icon-left vc_btn3-color-theme_style_1"
							href="<?php echo esc_url($link['url']) ?>"
							title="<?php echo esc_attr($link['title']); ?>"
							<?php if(!empty($link['target'])): ?>target="_blank" <?php endif; ?>
						><?php echo esc_attr($link['title']); ?><i class="fa fa-chevron-left vc_btn3-icon"></i></a>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
