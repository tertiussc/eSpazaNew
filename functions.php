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