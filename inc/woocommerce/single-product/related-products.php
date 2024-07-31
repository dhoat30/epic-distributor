<?php 

// Add a wrapper div around upsells, related products, and recently viewed products
add_action('woocommerce_after_single_product', function() {
    echo '<div class="products-loop-wrapper-webduel">';
}, 50);

add_action('woocommerce_after_single_product', function() {
    echo '</div>';
}, 90);

// Remove and add custom upsell products section
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
add_action('woocommerce_after_single_product', 'custom_upsell_output', 60);

function custom_upsell_output() {
    global $product;

    $upsells = $product->get_upsell_ids();

    if (!$upsells) {
        return;
    }

    $args = apply_filters('woocommerce_upsells_args', array(
        'post_type'           => 'product',
        'ignore_sticky_posts' => 1,
        'no_found_rows'       => 1,
        'posts_per_page'      => 10,
        'orderby'             => 'rand',
        'post__in'            => $upsells,
        'meta_query'          => WC()->query->get_meta_query(),
    ));

    $products = new WP_Query($args);
    webduel_product_loop_HTML($products, 'You may also like', 'up-sells upsells');
    wp_reset_postdata();
}

// Remove and add custom related products section
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action('woocommerce_after_single_product', 'custom_related_products_output', 70);

function custom_related_products_output() {
    global $product;

    if (!$product) {
        return;
    }

    $related = wc_get_related_products($product->get_id(), 4);

    if (count($related) === 0) {
        return;
    }

    $args = apply_filters('woocommerce_related_products_args', array(
        'post_type'           => 'product',
        'ignore_sticky_posts' => 1,
        'no_found_rows'       => 1,
        'posts_per_page'      => 8,
        'orderby'             => 'rand',
        'post__in'            => $related,
        'meta_query'          => WC()->query->get_meta_query(),
    ));

    $products = new WP_Query($args);
    webduel_product_loop_HTML($products, 'Related products', 'related');
    wp_reset_postdata();
}

// Recently viewed products - HTML
function show_recently_viewed_products() {
    if (empty($_COOKIE['recently_viewed'])) return;

    $viewed_products = explode(',', $_COOKIE['recently_viewed']);
    $viewed_products = array_reverse($viewed_products);

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 5,
        'post__in'       => $viewed_products,
        'orderby'        => 'post__in',
    );

    $products = new WP_Query($args);
    webduel_product_loop_HTML($products, 'Recently viewed', 'recently-viewed-products');
    wp_reset_query();
}

add_action('woocommerce_after_single_product', 'show_recently_viewed_products', 80);




// Product loop HTML function
function webduel_product_loop_HTML($products, $title, $section_class) {
    if ($products->have_posts()) : ?>

<section class="<?php echo esc_attr($section_class); ?>">
    <div class="title-wrapper row-container">
        <h2 class="h3 underline"><?php esc_html_e($title, 'woocommerce'); ?></h2>
    </div>
    <?php woocommerce_product_loop_start(); ?>
    <?php while ($products->have_posts()) : $products->the_post(); ?>
    <?php wc_get_template_part('content', 'product'); ?>
    <?php endwhile; ?>
    <?php woocommerce_product_loop_end(); ?>
</section>

<?php endif;
}