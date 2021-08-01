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

// features with icons
function espaza_features(){ ?>
    <!-- closing tags temporarily -->
    </main>
    </div> <!-- #primary -->
    </div> <!-- col full -->
 
    <!-- My features portion -->
    <div class="espaza-features">
        <div class="col-full">
            <div class="columns-4">
                <i class="fas fa-shopping-bag"></i>
                <p>Buy Local</p>
            </div>
            <div class="columns-4">
                <i class="fas fa-award"></i>
                <p>Trusted Brands</p>
            </div>
            <div class="columns-4">
                <i class="fas fa-user-check"></i>
                <p>Your People</p>
            </div>
        </div>
    </div>
    
    <!-- reopening tags -->
    <div class="col-full">
        <div class="content-area">
            <div class="site-main">
    
    <?php
    }
    add_action('woocommerce_before_shop_loop', 'espaza_features', 5);

    // Display 3 latest posts on homepage
function espaza_homepage_posts (){ 
    if(is_page('Shop')):

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
                    $content = wp_trim_words(get_the_excerpt(), 20);
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
add_action('woocommerce_after_main_content', 'espaza_homepage_posts', 8);
