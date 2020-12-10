<?php 
// Woo-Zap edition

// Add a filter to 'template_include' hook
add_filter( 'template_include', 'wpse_force_template' );
function wpse_force_template( $template ) {
    // If the current url is an archive of any kind
    if( is_archive() ) {
        // Set this to the template file inside your plugin folder
        $template = WP_PLUGIN_DIR .'/'. plugin_basename( dirname(__FILE__) ) .'/templates/archive-woo-zap.php';
    }
    // Always return, even if we didn't change anything
    return $template;
}

/**
 * Include CSS file
 */
function woozap_scripts() {
    wp_register_style( 'woozap-css',  plugin_dir_url( __FILE__ ) . 'assets/css/woo-zap.css',  array(), time() );
    wp_enqueue_style( 'woozap-css' );
}
add_action( 'wp_enqueue_scripts', 'woozap_scripts' );

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Adicionar', 'woocommerce' ); 
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Adicionar', 'woocommerce' );
}

add_filter( 'woocommerce_cart_item_quantity', 'wc_cart_item_quantity', 10, 3 );
function wc_cart_item_quantity( $product_quantity, $cart_item_key, $cart_item ){
    if( is_cart() ){
        $product_quantity = sprintf( '%2$s <input type="hidden" name="cart[%1$s][qty]" value="%2$s" />', $cart_item_key, $cart_item['quantity'] );
    }
    return $product_quantity;
}


/**
* Change Proceed To Checkout Text
**/
function woocommerce_button_proceed_to_checkout_new() { ?>
<form action="<?php echo get_home_url(); ?>/woo-zap/" method="post">
  <input type="hidden" id="produtos" name="produtos" value="<?php 
                                                       global $woocommerce;
                                                       $items = $woocommerce->cart->get_cart();
                                                       foreach($items as $item => $values) {
                                                           $_product = wc_get_product( $values['data']->get_id());
                                                           echo "*".$_product->get_title().'* - Qdt: '.$values['quantity'].'%0A ';
                                                       } ?>">
  <input type="submit" value="<?php esc_html_e( 'Finalziar Pedido', 'woocommerce' ); ?>" class="checkout-button button alt wc-forward">
</form>
<?php }

