<?php

/* ---------------- Login Styles ---------------- */

function espaza_login_styles(){
    wp_enqueue_style('espaza-login', get_stylesheet_directory_uri() . '/assets/css/login.css');
}
add_action('login_enqueue_scripts', 'espaza_login_styles');

/* ---------------- Login redirect ---------------- */
function espaza_redirect_login() {
    return home_url();
}
add_filter('login_headerurl', 'espaza_redirect_login');


// Remove the defualt wooCommerce footer and add new one
function espaza_footer (){
    remove_action('storefront_footer', 'storefront_credit', 20);
    add_action('storefront_after_footer', 'espaza_new_footer', 10);
}
add_action('init', 'espaza_footer',10);

// rule of 100 mix functions
function espaza_display_savings_with_rule($price, $product){
    if($product->get_sale_price() ):
        $regular_price = $product->get_regular_price();

        if($regular_price > 100) {
            $saved = wc_price($product->get_regular_price() - $product->get_sale_price());
            return $price . sprintf(__('<br/><span class="saved-amount">Save: %s </span>', 'woocommerce' ), $saved);
        } else {
            $percentage = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price())* 100);
            return $price . sprintf(__('<br/><span class="saved-amount">Save: %s </span>', 'woocommerce' ), $percentage . "%");
        }
    endif;
    return $price;
}
add_filter('woocommerce_get_price_html', 'espaza_display_savings_with_rule', 10, 2);

// Emty cart button
function espaza_emty_cart_button (){ ?>
    <a href="?empty-cart=true" class="button">Empty Cart</a>

<?php
}
add_action('woocommerce_cart_actions', 'espaza_emty_cart_button');
// Empty cart function
function espaza_empty_cart (){
    if(isset($_GET['empty-cart'])):
        global $woocommerce;
        $woocommerce->cart->empty_cart();
    endif;
}
add_action('init', 'espaza_empty_cart');

// Add new footer
function espaza_new_footer (){
    echo "<div class='reserved'>";
    echo "<p> eSpaza All Rights Reserved &copy;" . " " . get_the_date('Y') . "</p>";
    echo "</div>";
}