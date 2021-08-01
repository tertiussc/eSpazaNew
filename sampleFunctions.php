
text/x-generic functions.php ( PHP script, ASCII text, with very long lines, with CRLF line terminators )
<?php
/*Add login page Styles */
function carolina_login_styles(){
    wp_enqueue_style('carolina-login', get_stylesheet_directory_uri() . '/login/login.css');
}
add_action('login_enqueue_scripts', 'carolina_login_styles');

// redirect on login logo press
function carolina_redirect_login(){
    return home_url();
}
add_filter('login_headerurl','carolina_redirect_login');



function carolina_setup(){
    add_image_size('blog_entry', 400, 257, true);
}
add_action('after_setup_theme', 'carolina_setup');


// Add Stylesheets or Scripts
// Add Fonts
function carolinasp_scripts()
{
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,700,900|Lora:400,700');
}
add_action('wp_enqueue_scripts', 'carolinasp_scripts');


// Display products per page
// function products_per_page($products) {
//     $products = 4;
//     return $products;
// }
// add_filter('loop_shop_per_page', 'products_per_page', 20);


// remove homepage content
// function carolinaspa_homepage_content(){
//     remove_action('storefront_homepage', 'storefront_homepage_content');
// }
// add_action('init', 'carolinaspa_homepage_content');


// Change the number of columns
function carolina_shop_columns($columns) {
    return 4;
}
add_filter('loop_shop_columns', 'carolina_shop_columns');


// Display home kits on homepage
function carolinspa_homepage_homekits (){ 
    if(is_page('Welcome')):

    ?>
<div class="homepage-homekit-category">
    <div class="content">
        <div class="columns-3">
            <?php $home_kit = get_term(18, 'product_cat', ARRAY_A); ?>
            <h2 class="section-title"><?php echo $home_kit['name']; ?></h2>
            <p><?php echo $home_kit['description']; ?></p>
            <a href="<?php echo get_category_link($home_kit['term_id']); ?>">
                All Home Kits &raquo
            </a>
        </div>
        <?php echo do_shortcode('[product_category category="home-kits" per_page="3" orderby="price" columns="9"]'); ?>
    </div>
</div>
 
 <?php
 endif;
}
add_action('woocommerce_after_main_content', 'carolinspa_homepage_homekits', 5);



// Spoil yourself banner
function caroline_banner(){ 
    if(is_page('Welcome')):
    
    ?>
<div class="banner-spoil">
    <div class="column-4">
        <h3>Spoil yourself with these high quality items.</h3>
    </div>
    <div class="column-8">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banner.jpg" alt="">
    </div>
</div>

<?php
endif;
}
add_action('woocommerce_after_main_content', 'caroline_banner', 7);


// features with icons
function carolina_features(){ ?>
<!-- closing tags temporarily -->
</main>
</div> <!-- #primary -->
</div> <!-- col full -->



<!-- My features portion -->
<div class="home-features">
    <div class="col-full">
        <div class="columns-4">
            <i class="fas fa-truck"></i>
            <p>Free shipping</p>
        </div>
        <div class="columns-4">
            <i class="fas fa-lock"></i>
            <p>Secure payments</p>
        </div>
        <div class="columns-4">
            <i class="fas fa-undo-alt"></i>
            <p>Returns and refunds</p>
        </div>
    </div>
</div>

<!-- reopening tags -->
<div class="col-full">
    <div class="content-area">
        <div class="site-main">

<?php
}
add_action('woocommerce_before_shop_loop', 'carolina_features', 5);



// Display 3 posts on homepage
function carolina_homepage_posts (){ 
    if(is_page('Welcome')):

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $entries = new WP_Query($args);
?>
<div class="homepage-blog-entries">
    <h2 class="section-title">Latest Blog Entries</h2>
    <ul>
        <?php while($entries -> have_posts()): $entries->the_post(); ?>
        <li>
            <?php The_post_thumbnail('blog_entry'); ?>
            <h2 class="entry-title"><?php the_title(); ?></h2>
            <div class="entry-content">
                <header class="entry-header">
                    <p>By: <?php the_author(); ?> | <?php the_time(get_option('date_format')); ?> </p>
                </header>
                <?php
                    $content = wp_trim_words(get_the_content(), 20);
                    echo "<p class='blog-text'>" . $content . "</p>";
                ?>
                <a href="<?php the_permalink(); ?>" class="entry-link">Read more &raquo</a>
            </div>
        </li>
        <?php endwhile; wp_reset_postdata(); ?>
    </ul>
</div>

<?php  
endif;
} 
add_action('woocommerce_after_main_content', 'carolina_homepage_posts', 8);




// Mailchimp subscribe news letter
function carolina_newsletter (){ 
    if(is_page('Welcome')):
    ?>

<!-- Begin Mailchimp Signup Form -->
<div class="mailchimp-form">
    <link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
    
    <div id="mc_embed_signup" >
    <form action="https://meliorateafrica.us1.list-manage.com/subscribe/post?u=f73fda4b4042134d44e186368&amp;id=08df5914c7" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <div id="mc_embed_signup_scroll" class="col-full">
                <div class="columns-6">
                    <label for="mce-EMAIL">Subscribe to the news letter <em>access to exclusive deals</em></label>
                </div>
                <div class="columns-6 signup-form">
                    <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_f73fda4b4042134d44e186368_08df5914c7" tabindex="-1" value=""></div>
                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                </div>
        </div>
    </form>
    </div>
</div>
<!--End mc_embed_signup-->

<?php
endif;
}
add_action('storefront_before_footer', 'carolina_newsletter', 20);


// Remove the defualt wooCommerce footer and add new one
function carolina_footer (){
    remove_action('storefront_footer', 'storefront_credit', 20);
    add_action('storefront_after_footer', 'carolina_new_footer', 10);
}
add_action('init', 'carolina_footer',10);


// Add new footer
function carolina_new_footer (){
    echo "<div class='reserved'>";
    echo "<p>All rights reserved &copy; Carolina Spa" . " " . get_the_date('Y') . "</p>";
    echo "</div>";
}



// Display full Ccy code e.g. ZAR
function carolina_display_ccy ($symbol, $currency) {
    $symbol = $currency . " ";
    return $symbol;
}
add_filter('woocommerce_currency_symbol', 'carolina_display_ccy', 10, 2);


// Change filter name
// function carolina_filter_title($orderby){
//     $orderby['date'] = __('Sort by new first');
//     return $orderby;
// }
// add_filter('woocommerce_catalog_orderby', 'carolina_filter_title', 40);


// Change the title of product description
function carolina_title_tab_description($tabs){
    global $post;
    if($tabs['description']):
        $tabs['description']['title'] = $post->post_title;
    endif;
    return $tabs;
}
add_filter('woocommerce_product_tabs', 'carolina_title_tab_description', 20);


// change the title heading inside the tab
function carolina_product_heading($title) {
    global $post;
    $title = $post->post_title;
    return $title;
}
add_filter('woocommerce_product_description_heading', 'carolina_product_heading' );


// Add ACF fields to single product pages
function carolina_subtitle_sing_product() {
    global $post;
    $subtitle = get_field('subtitle', $post->ID);
    echo "<h3 class='subtitle'>" . $subtitle . "</h3>";
}
add_action('woocommerce_single_product_summary', 'carolina_subtitle_sing_product', 6);


// To create a new tabl use these 2 steps create Tab then create callback function
// Step 1 -> Create Tab: display video in a new product tab
function carolina_video_tab($tabs){
    global $post;
    $video = get_field('video', $post->ID);
    
    if($video):
        $tabs['video'] = array(
            'title' => 'Video',
            'priority' => 15,
            'callback' => 'carolina_display_video'
        );
    endif;
    return $tabs;
}
add_filter('woocommerce_product_tabs', 'carolina_video_tab', 11, 1);
// Step 2 -> Create callback: video callback funtion
function carolina_display_video(){
    global $post;
    $video = get_field('video', $post->ID);
    if($video):
        echo '<video controls>';
        echo "<source src='". $video[url] . "'>";
        echo '</video>';
    endif;
};


// Display saving as Ccy
// function carolina_saved_price_dollars($price, $product) {
//     if($product->get_sale_price() ):
//         $saved = wc_price($product->get_regular_price() - $product->get_sale_price());
//         return $price . sprintf(__('<br/><span class="saved-amount">Save: %s </span>', 'woocommerce' ), $saved);
//     endif;
//     return $price;
// }
// add_filter('woocommerce_get_price_html', 'carolina_saved_price_dollars', 10, 2);

// show pecentage save
// function carolina_saved_price_percentage($price, $product) {
//     if($product->get_sale_price() ):
//         $percentage = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price())* 100);
//         return $price . sprintf(__('<br/><span class="saved-amount">Save: %s </span>', 'woocommerce' ), $percentage . "%");
//     endif;
//     return $price;
// }
// add_filter('woocommerce_get_price_html', 'carolina_saved_price_percentage', 10, 2);


// rule of 100 mix functions
function carolina_display_savings_with_rule($price, $product){
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
add_filter('woocommerce_get_price_html', 'carolina_display_savings_with_rule', 10, 2);

// Social sharing icons
function carolina_display_sharing_buttons(){ ?>
    <p class="share-text">Share this product on you social feed.</p>
    <div class="addthis_inline_share_toolbox"></div>

<?php            
}
add_action('woocommerce_simple_add_to_cart', 'carolina_display_sharing_buttons', 20);


// Adding social buttons scrips
function carolina_scripts(){ ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-608c0a66370897ad"></script>

<?php
}
add_action('wp_footer', 'carolina_scripts');

// add cart page banner
function carolina_cart_banner(){ 
    global $post;
    $image_url = get_field('cart_banner');
    if($image_url): ?>
        <div class="cart-banner">
            <img src="<?php echo $image_url ?>" alt="coupon">
        </div>
<?php endif;
}
add_action('storefront_page', 'carolina_cart_banner',12);


// Emty cart button
function carolina_emty_cart_button (){ ?>
    <a href="?empty-cart=true" class="button">Empty Cart</a>

<?php
}
add_action('woocommerce_cart_actions', 'carolina_emty_cart_button');
// Empty cart function
function carolina_empty_cart (){
    if(isset($_GET['empty-cart'])):
        global $woocommerce;
        $woocommerce->cart->empty_cart();
    endif;
}
add_action('init', 'carolina_empty_cart');



// remove fields from checkout form
// function carolina_checkout_fields ($fields){
//     unset($fields['billing']['billing_phone']);
//     return $fields;
// }
// add_filter('woocommerce_checkout_fields', 'carolina_checkout_fields', 20, 1);


// Adding field to the biling form
function carolina_add_checkout_fields($fields){
    $fields['billing']['complex'] = array(
        'css' => 'form-row-wide',
        'label' => 'Unit number and Complex name',
        'placeholder' => 'e.g 5 Great Place',
        'priority' => 45
    );
    $fields['order']['heard about us'] = array(
        'type' => 'select',
        'css' => 'form-row-wide',
        'label' => 'How did you hear about us?',
        'options' => array(
            'default' => 'Choose...',
            'tv' => 'Television',
            'radio' => 'Radio',
            'newspaper' => 'Newspaper',
            'internet' => 'Internet',
            'facebook' => 'Facebook',
        ),
        'priority' => 5
    );
     
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'carolina_add_checkout_fields', 20, 1);


// Add a product relationship on a post
function carolina_blog_related_products(){
    global $post;
    $related_products = get_field('related_products', $post->ID);

    if($related_products):
        $product_ids = join($related_products, ', '); ?>
            <div class="related-products">
                <h2 class="section-title">Related Products</h2>
                <?php echo do_shortcode('[products ids="'. $product_ids .'"]'); ?>
            </div>
<?php endif;
}
add_action('storefront_post_content_after', 'carolina_blog_related_products');



// change add to cart text
// function carolina_change_add_cart_text(){
//     return "Make reservation";
// }
// add_filter('woocommerce_product_add_to_cart_text', 'carolina_change_add_cart_text');
// add_filter('woocommerce_product_single_add_to_cart_text', 'carolina_change_add_cart_text');




/*
 * @snippet       WooCommerce User Registration Shortcode
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 4.0
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

add_shortcode( 'wc_reg_form_bbloomer', 'bbloomer_separate_registration_form' );
    
function bbloomer_separate_registration_form() {
   if ( is_admin() ) return;
   if ( is_user_logged_in() ) return;
   ob_start();
 
   // NOTE: THE FOLLOWING <FORM></FORM> IS COPIED FROM woocommerce\templates\myaccount\form-login.php
   // IF WOOCOMMERCE RELEASES AN UPDATE TO THAT TEMPLATE, YOU MUST CHANGE THIS ACCORDINGLY
 
   do_action( 'woocommerce_before_customer_login_form' );
 
   ?>
      <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
 
         <?php do_action( 'woocommerce_register_form_start' ); ?>
 
         <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
 
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
               <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
               <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
            </p>
 
         <?php endif; ?>
 
         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
         </p>
 
         <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
 
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
               <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
               <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
            </p>
 
         <?php else : ?>
 
            <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>
 
         <?php endif; ?>
 
         <?php do_action( 'woocommerce_register_form' ); ?>
 
         <p class="woocommerce-FormRow form-row">
            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
            <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
         </p>
 
         <?php do_action( 'woocommerce_register_form_end' ); ?>
 
      </form>
 
   <?php
     
   return ob_get_clean();
}


/**
 * @snippet       WooCommerce User Login Shortcode
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 4.0
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
add_shortcode( 'wc_login_form_bbloomer', 'bbloomer_separate_login_form' );
  
function bbloomer_separate_login_form() {
   if ( is_admin() ) return;
   if ( is_user_logged_in() ) return; 
   ob_start();
   woocommerce_login_form( array( 'redirect' => 'https://custom.url' ) );
   return ob_get_clean();
}