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


// Add new footer
function espaza_new_footer (){
    echo "<div class='reserved'>";
    echo "<p> eSpaza All Rights Reserved &copy;" . " " . get_the_date('Y') . "</p>";
    echo "</div>";
}