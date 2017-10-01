<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if ( $v_align_middle ) {
	$css_class .= ' middle';
}

if ( $enable_hexagon ) {
	$css_class .= ' hexagon';
	if( $enable_hexagon_animation ){
		$css_class .= ' hexanog_animation';
	}
}

if( !empty( $box_style ) ) {
	$css_class .= ' ' . $box_style;
}

if( $box_style == 'style_2' && !empty( $alignment ) ) {
	$css_class .= ' alignment_' . esc_attr( $alignment );
}
if( $box_style == 'style_4' && !empty( $alignment ) ) {
	$css_class .= ' alignment_' . esc_attr( $alignment );
}

$title_classes = array();
$title_class = '';

if( !empty( $title_color ) && $title_color != 'custom' ) {
	$title_classes[] = 'font-color_' . esc_attr( $title_color );
}

if( $hide_title_line ) {
	$title_classes[] = 'no_stripe';
}

if( !empty( $title_classes ) ) {
	$title_class = ' class="'. join(' ', $title_classes) .'"';
}

$title_style = '';
$title_styles = array();
if( !empty( $title_font_size ) ) {
	$title_styles[] = 'font-size:' . esc_attr( $title_font_size ) . 'px';
}

if( !empty( $title_line_height ) ) {
	$title_styles[] = 'line-height:' . esc_attr( $title_line_height )  . 'px';
}

if( $title_color == 'custom' && !empty( $title_color_custom ) ) {
	$title_styles[] = 'color:' . esc_attr( $title_color_custom );
}

if( !empty( $title_styles ) ) {
	$title_style = ' style="'. implode( ';', $title_styles ) .'"';
}

$icon_class = '';

if( !empty( $icon_color ) && $icon_class != 'custom' ) {
	$icon_class .= ' font-color_' . esc_attr( $icon_color );
}

if( !empty( $icon_bg_color ) && $icon_class != 'custom' ) {
    $icon_class .= ' font-color_' . esc_attr( $icon_bg_color );
}

if( !empty( $icon_border_color ) && $box_style == 'style_3' && $icon_class != 'custom' ) {
    $icon_class .= ' border-color_' . esc_attr( $icon_border_color );
}

$icon_styles = array();
$icon_style = '';

if( $icon_bg_color == 'custom' && !empty( $icon_bg_color_custom ) ) {
	$icon_styles[] = 'color:' . esc_attr( $icon_bg_color_custom );
}

if( !empty( $icon_width ) ) {
	if( $box_style == 'style_1' && $style != 'icon_top' ) {
		$icon_styles[] = 'width:' . esc_attr( $icon_width ) . 'px';
	}
}

if( !empty( $icon_width_wr ) && $box_style == 'style_2' ) {
	$icon_styles[] = 'width:' . esc_attr( $icon_width_wr ) . 'px';
}

if( !empty( $icon_height ) && $box_style == 'style_1' && $style == 'icon_top' ) {
	$icon_styles[] = 'height:' . esc_attr( $icon_height ) . 'px';
}

if( !empty( $icon_styles ) ) {
	$icon_style = ' style="'. join(';', $icon_styles) .'"';
}

$link = vc_build_link( $link );

?>

<?php  if ( ! $link['target'] ) { $link['target'] = '_self'; } ?>
<?php if( $box_style == 'style_1' ) : ?>

	<?php if( $style == 'icon_left' ){ ?>
        <?php if ( ! empty( $link['url'] ) ): ?>
            <a href="<?php echo esc_url( $link['url'] ) ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="icon_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $style ); ?> clearfix">
        <?php else: ?>
            <div class="icon_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $style ); ?> clearfix">
        <?php endif; ?>
            <?php if( $icon ){ ?>
                <div class="icon<?php echo $icon_class; ?>"<?php echo $icon_style; ?>><i style="font-size:<?php echo esc_attr( $icon_size ); ?>px; <?php if( $icon_color_custom ){ ?>color: <?php echo esc_attr( $icon_color_custom );?>;<?php } ?> <?php if( $icon_bg_color_custom ){ ?>background-color: <?php echo esc_attr( $icon_bg_color_custom );?>;<?php } ?>" class="<?php echo esc_attr( $icon ); ?>"></i></div>
            <?php } ?>
            <div class="icon_text">
                <?php if ( $title ) { ?>
                    <h5<?php echo $title_style; ?><?php echo $title_class; ?>><?php echo wp_kses( $title, array( 'br' => array() ) ); ?></h5>
                <?php } ?>
                <?php echo wpb_js_remove_wpautop( $content, true ); ?>
            </div>
        <?php if ( ! empty( $link['url'] ) ): ?>
            </a>
        <?php else: ?>
            </div>
        <?php endif; ?>
	<?php }elseif( $style == 'icon_left_transparent' ){ ?>
        <?php if ( ! empty( $link['url'] ) ): ?>
            <a href="<?php echo esc_url( $link['url'] ) ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="icon_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $style ); ?> clearfix">
        <?php else: ?>
            <div class="icon_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $style ); ?> clearfix">
        <?php endif; ?>
			<?php if( $icon ){ ?>
				<div class="icon<?php echo $icon_class; ?>"<?php echo $icon_style; ?>><i style="font-size:<?php echo esc_attr( $icon_size ); ?>px; <?php if( $icon_color_custom ){ ?>color: <?php echo esc_attr( $icon_color_custom );?>;<?php } ?> <?php if( $icon_bg_color_custom ){ ?>background-color: <?php echo esc_attr( $icon_bg_color_custom );?>;<?php } ?>" class="<?php echo esc_attr( $icon ); ?>"></i></div>
			<?php } ?>
			<?php if ( $title ) { ?>
				<h5<?php echo $title_style; ?><?php echo $title_class; ?>><?php echo wp_kses( $title, array( 'br' => array() ) ); ?></h5>
			<?php } ?>
			<div class="icon_text">
				<?php echo wpb_js_remove_wpautop( $content, true ); ?>
			</div>
        <?php if ( ! empty( $link['url'] ) ): ?>
            </a>
        <?php else: ?>
            </div>
        <?php endif; ?>
	<?php }else{ ?>
        <?php if ( ! empty( $link['url'] ) ): ?>
            <a href="<?php echo esc_url( $link['url'] ) ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="icon_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $style ); ?> clearfix">
        <?php else: ?>
            <div class="icon_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $style ); ?> clearfix">
        <?php endif; ?>
			<?php if( $icon ){ ?>
				<div class="icon<?php echo $icon_class; ?>"<?php echo $icon_style; ?>><i style="font-size:<?php echo esc_attr( $icon_size ); ?>px; <?php if( $icon_color_custom ){ ?>color: <?php echo esc_attr( $icon_color_custom );?>;<?php } ?> <?php if( $icon_bg_color_custom ){ ?>background-color: <?php echo esc_attr( $icon_bg_color_custom );?>;<?php } ?>" class="<?php echo esc_attr( $icon ); ?>"></i></div>
			<?php } ?>
			<div class="icon_text">
				<?php if ( $title ) { ?>
					<h4<?php echo $title_style; ?><?php echo $title_class; ?>><?php echo wp_kses( $title, array( 'br' => array() ) ); ?></h4>
				<?php } ?>
				<?php echo wpb_js_remove_wpautop( $content, true ); ?>
			</div>
        <?php if ( ! empty( $link['url'] ) ): ?>
            </a>
        <?php else: ?>
            </div>
        <?php endif; ?>
	<?php } ?>

<?php elseif( $box_style == 'style_2' ) : ?>
    <?php if ( ! empty( $link['url'] ) ): ?>
        <a href="<?php echo esc_url( $link['url'] ) ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="icon_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $style ); ?> clearfix">
    <?php else: ?>
        <div class="icon_box<?php echo esc_attr( $css_class ); ?> clearfix">
    <?php endif; ?>
		<div class="icon_box_inner">
			<?php if( $icon ){ ?>
				<div class="icon<?php echo $icon_class; ?>"<?php echo $icon_style; ?>><i style="font-size:<?php echo esc_attr( $icon_size ); ?>px; <?php if( $icon_color_custom ){ ?>color: <?php echo esc_attr( $icon_color_custom );?>;<?php } ?>" class="<?php echo esc_attr( $icon ); ?>"></i></div>
			<?php } ?>
			<?php if ( $title ) { ?>
				<h5<?php echo $title_style; ?><?php echo $title_class; ?>><?php echo wp_kses( $title, array( 'br' => array() ) ); ?></h5>
			<?php } ?>
		</div>
    <?php if ( ! empty( $link['url'] ) ): ?>
        </a>
    <?php else: ?>
        </div>
    <?php endif; ?>

<?php elseif( $box_style == 'style_3' ) : ?>
    <?php if ( ! empty( $link['url'] ) ): ?>
        <a href="<?php echo esc_url( $link['url'] ) ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="icon_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $style ); ?> clearfix">
    <?php else: ?>
        <div class="icon_box<?php echo esc_attr( $css_class ); ?> clearfix">
    <?php endif; ?>
    <div class="icon_box_inner">
        <?php if( $icon ){ ?>
            <div class="icon<?php echo $icon_class; ?>"<?php echo $icon_style; ?>><i style="font-size:<?php echo esc_attr( $icon_size ); ?>px; <?php if( $icon_color_custom ){ ?>color: <?php echo esc_attr( $icon_color_custom );?>;<?php } ?> <?php if( $icon_line_height ){ ?>line-height: <?php echo esc_attr( $icon_line_height ); ?>px;<?php } ?> <?php if( $icon_border_color_custom ){ ?>border-color: <?php echo esc_attr( $icon_border_color_custom );?><?php } ?>" class="<?php echo esc_attr( $icon ); ?>"></i></div>
        <?php } ?>
        <?php if ( $content ) { ?>
            <div class="icon_text">
                <?php echo wpb_js_remove_wpautop( $content, true ); ?>
            </div>
        <?php } ?>
    </div>
    <?php if ( ! empty( $link['url'] ) ): ?>
        </a>
    <?php else: ?>
        </div>
    <?php endif; ?>

<?php else : ?>
    <?php if ( ! empty( $link['url'] ) ): ?>
        <a href="<?php echo esc_url( $link['url'] ) ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="icon_box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $style ); ?> clearfix">
    <?php else: ?>
        <div class="icon_box<?php echo esc_attr( $css_class ); ?> clearfix">
    <?php endif; ?>
    <div class="icon_box_inner">
        <?php if( $icon ){ ?>
            <div class="icon<?php echo $icon_class; ?>"<?php echo $icon_style; ?>><i style="font-size:<?php echo esc_attr( $icon_size ); ?>px; <?php if( $icon_color_custom ){ ?>color: <?php echo esc_attr( $icon_color_custom );?>;<?php } ?> <?php if( $icon_line_height ){ ?>line-height: <?php echo esc_attr( $icon_line_height ); ?>px;<?php } ?> <?php if( $icon_border_color_custom ){ ?>border-color: <?php echo esc_attr( $icon_border_color_custom );?><?php } ?>" class="<?php echo esc_attr( $icon ); ?>"></i></div>
        <?php } ?>
        <?php if ( $title ) { ?>
            <h4<?php echo $title_style; ?><?php echo $title_class; ?>><?php echo wp_kses( $title, array( 'br' => array() ) ); ?></h4>
        <?php } ?>
        <?php if ( $content ) { ?>
            <div class="icon_text">
                <?php echo wpb_js_remove_wpautop( $content, true ); ?>
            </div>
        <?php } ?>
    </div>
    <?php if ( ! empty( $link['url'] ) ): ?>
        </a>
    <?php else: ?>
        </div>
    <?php endif; ?>
<?php endif; ?>