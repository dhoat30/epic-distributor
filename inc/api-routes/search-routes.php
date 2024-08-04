<?php 
add_action("rest_api_init", "search_route");

function search_route() {
    // Search products
    register_rest_route("webduel/v1", "search", array(
        "methods" => "GET",
        "callback" => "search_products",
        'permission_callback' => '__return_true', // Allow public access
    ));
}

// Helper function to perform a basic product search
function basic_product_search($term, $posts_per_page) {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $posts_per_page,
        's' => $term,
    );

    $search = new WP_Query($args);
    $results = array();

    while ($search->have_posts()) {
        $search->the_post();
        $results[get_the_ID()] = array(
            "title" => get_the_title(),
            "image" => get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_gallery_thumbnail'),
            "link" => get_the_permalink()
        );
    }

    wp_reset_postdata();

    return $results;
}

// Helper function to perform a meta and taxonomy search
function advanced_product_search($term, $posts_per_page) {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $posts_per_page,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => '_sku',
                'value' => $term,
                'compare' => 'LIKE'
            ),
            array(
                'key' => '_price',
                'value' => $term,
                'compare' => 'LIKE'
            )
        ),
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'product_cat',
                'field' => 'name',
                'terms' => $term,
                'operator' => 'LIKE'
            ),
            array(
                'taxonomy' => 'product_tag',
                'field' => 'name',
                'terms' => $term,
                'operator' => 'LIKE'
            )
        )
    );

    $search = new WP_Query($args);
    $results = array();

    while ($search->have_posts()) {
        $search->the_post();
        $results[get_the_ID()] = array(
            "title" => get_the_title(),
            "image" => get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_gallery_thumbnail'),
            "link" => get_the_permalink()
        );
    }

    wp_reset_postdata();

    return $results;
}

// Combined product search
function perform_product_search($term, $posts_per_page = 10) {
    $basic_results = basic_product_search($term, $posts_per_page);
    $advanced_results = advanced_product_search($term, $posts_per_page);

    // Merge results
    $results = array_merge($basic_results, $advanced_results);

    // Remove duplicates by using unique product IDs
    $results = array_values($results);

    // Limit the results to the desired number
    if (count($results) > $posts_per_page) {
        $results = array_slice($results, 0, $posts_per_page);
    }

    return $results;
}

// Search products
function search_products($data) {
    $term = sanitize_text_field($data["term"]);
    if (empty($term)) {
        return new WP_Error('no_term', 'Search term is required', array('status' => 400));
    }

    $results = perform_product_search($term, 100);

    return $results;
}