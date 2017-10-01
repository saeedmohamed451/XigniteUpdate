<?php if ( class_exists( 'WooCommerce' ) ): ?>
    <?php if ( ! WC()->cart->is_empty() ) : ?>
        <span class="count"><?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'consulting' ), WC()->cart->get_cart_contents_count() ); ?></span>
    <?php else : ?>
    <?php endif; ?>
<?php endif; ?>