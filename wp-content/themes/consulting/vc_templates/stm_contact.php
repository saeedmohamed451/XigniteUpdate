<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
if ( ! $image_size ) {
	$image_size = '174x174';
}
$image = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $image_size ) );
?>

<?php if( $style == 'style_2' ) : ?>
    <div class="stm_contact_two<?php echo esc_attr( $css_class ); ?> clearfix">
        <?php if( ! empty( $image['thumbnail'] ) ){ ?>
            <div class="stm_contact_image">
                <?php echo $image['thumbnail']; ?>
            </div>
        <?php } ?>
        <div class="stm_contact_info">
            <h5 class="no_stripe"><?php echo esc_html( $name ); ?></h5>
            <?php if( $job ){ ?>
                <div class="stm_contact_job"><?php echo esc_html( $job ); ?></div>
            <?php } ?>
            <?php if( $phone || $phone_two ){ ?>
                <div class="stm_contact_row"><i class="fa fa-phone"></i> <?php echo esc_html( $phone ); ?><br /><?php echo esc_html( $phone_two ); ?></div>
            <?php } ?>
            <?php if( $email ){ ?>
                <div class="stm_contact_row"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo antispambot( $email ); ?>"><?php echo antispambot( $email ); ?></a></div>
            <?php } ?>
            <?php if( $skype ){ ?>
                <div class="stm_contact_row"><i class="fa fa-skype"></i> <a href="skype:<?php echo esc_attr( $skype ); ?>"><?php echo esc_html( $skype ); ?></a></div>
            <?php } ?>
        </div>
    </div>
<?php else: ?>
<div class="stm_contact<?php echo esc_attr( $css_class ); ?> clearfix">
	<?php if( ! empty( $image['thumbnail'] ) ){ ?>
		<div class="stm_contact_image">
			<?php echo $image['thumbnail']; ?>
		</div>
	<?php } ?>
	<div class="stm_contact_info">
		<h5 class="no_stripe"><?php echo esc_html( $name ); ?></h5>
		<?php if( $job ){ ?>
			<div class="stm_contact_job"><?php echo esc_html( $job ); ?></div>
		<?php } ?>
		<?php if( $email ){ ?>
			<div class="stm_contact_row"><?php esc_html_e( 'Email: ', 'consulting' ); ?><a href="mailto:<?php echo antispambot( $email ); ?>"><?php echo antispambot( $email ); ?></a></div>
		<?php } ?>
		<?php if( $skype ){ ?>
			<div class="stm_contact_row"><?php esc_html_e( 'Skype: ', 'consulting' ); ?><a href="skype:<?php echo esc_attr( $skype ); ?>"><?php echo esc_html( $skype ); ?></a></div>
		<?php } ?>
	</div>
</div>
<?php endif; ?>