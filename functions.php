<?php 
/**
 * webduel functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package webduel

 */
// filter 
require get_theme_file_path('/inc/filters/facet-wp.php');
//  routes
require get_theme_file_path('/inc/api-routes/search-routes.php');


// general
require get_theme_file_path('/inc/custom-post-type.php');
require get_theme_file_path('/inc/cpt-settings.php');
require get_theme_file_path('/inc/nav-registeration.php');
require get_theme_file_path('/inc/users.php');
// optimization 
require get_theme_file_path('/inc/optimization/optimization.php');


// woocommerce 
require get_theme_file_path('/inc/woocommerce/image-size.php');
require get_theme_file_path('/inc/woocommerce/single-product/image-gallery.php');
require get_theme_file_path('/inc/woocommerce/single-product/product-summary.php');
require get_theme_file_path('/inc/woocommerce/single-product/product-summary-accordion.php');

require get_theme_file_path('/inc/woocommerce/single-product/related-products.php');
require get_theme_file_path('/inc/woocommerce/single-product/ajax-operations.php');
require get_theme_file_path('/inc/woocommerce/VariationSwatches/VariationSwatches.php');

require get_theme_file_path('/inc/woocommerce/product-archive/archive-product.php');

require get_theme_file_path('/inc/woocommerce/cart/cart.php');
require get_theme_file_path('/inc/woocommerce/cart/cart-ajax.php');

require get_theme_file_path('/inc/woocommerce/checkout/checkout.php');

require get_theme_file_path('/inc/woocommerce/misc/misc.php');

// shortcodes
require get_theme_file_path('/inc/short-codes/social-share.php');
// require get_theme_file_path('/inc/short-codes/related-products-shortcode.php');
require get_theme_file_path('/inc/short-codes/archive-page-shortcode.php');
require get_theme_file_path('/inc/short-codes/general-shortcodes.php');

// get a quote 
require get_theme_file_path('/inc/woocommerce/quote-feature/quote-feature.php');
require get_theme_file_path('/inc/woocommerce/quote-feature/quote-ajax.php');

// ajax 
require get_theme_file_path('/inc/ajax/form-processor.php');

// wholesale 
require get_theme_file_path('/inc/woocommerce/wholesale/wholesale-registration.php');

// account 
require get_theme_file_path('/inc/woocommerce/account/order.php');
// notices 
function is_dev_environment() {
    $server_name = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
    return (strpos($server_name, 'local') !== false || strpos($server_name, '127.0.0.1') !== false);
}


 //enqueue scripts
 function webduel_scripts(){ 
    // Parse the site URL to get its components.
    if (is_dev_environment()) {
        wp_enqueue_style('webduel_index',get_template_directory_uri() . '/build/index.css', array(), filemtime(get_template_directory() . '/build/index.css'));

        // Code to run in development environment
        // For example, enqueue non-minified scripts and stylesheets for better readability
    } 

    wp_enqueue_script('main',  get_template_directory_uri() . '/build/index.js', array(), filemtime(get_template_directory() . '/build/index.js'), true);
    
    wp_enqueue_script('optimization',  get_template_directory_uri() . '/optimization.js', array(), filemtime(get_template_directory() . '/build/index.js'), true);

   wp_enqueue_script("jQuery");
    
    wp_localize_script("main", "webduelData", array(
      "root_url" => get_site_url(),
      "nonce" => wp_create_nonce("wp_rest"),
      'loadingmessage' => __('Sending user info, please wait...'),
      'ajaxurl' => admin_url( 'admin-ajax.php' ), 
        'siteurl' => get_site_url(),
        'cart_url' => wc_get_cart_url(),
    ));
}
add_action( "wp_enqueue_scripts", "webduel_scripts" ); 

// inline critical styles 
function webduel_inline_critical_css() {
    
    $critical_css_path = get_template_directory() . '/build/critical.css';
    if (file_exists($critical_css_path)) {
        echo '<style>' . file_get_contents($critical_css_path) . '</style>';
    }
}
add_action('wp_head', 'webduel_inline_critical_css', 1);

// main styles 
function webduel_add_async_main_styles() {
    $main_styles_path = get_template_directory_uri() . '/build/style-index.css';
    $timestamp = filemtime(get_template_directory() . '/build/index.css');
    echo "<link rel='preload' href='{$main_styles_path}?ver={$timestamp}' as='style' onload=\"this.onload=null;this.rel='stylesheet'\">";
    echo "<noscript><link rel='stylesheet' href='{$main_styles_path}?ver={$timestamp}'></noscript>";

    // add slick styles
    echo '<link rel="preload" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
    echo '<link rel="preload" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
    echo '<noscript><link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">';
    echo '<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"></noscript>';

}
add_action('wp_head', 'webduel_add_async_main_styles');


// enable svg 
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter('upload_mimes', 'cc_mime_types');
  


// remove downloads link on account page
add_filter('woocommerce_account_menu_items', 'remove_downloads_from_account_menu', 10, 1);

function remove_downloads_from_account_menu($items) {
    unset($items['downloads']);
    return $items;
}

// Change the sender email
add_filter('wp_mail_from', function ($email) {
    return 'admin@epicdistributors.co.nz'; // Replace with your desired email address
});

// Change the sender name
add_filter('wp_mail_from_name', function ($name) {
    return 'Epic Distributors '; // Replace with your desired sender name
});

// add page slug to body class
function add_slug_body_class($classes) {
    if (is_singular()) {
        global $post;
        $classes[] = $post->post_name;
    }
    return $classes;
}
add_filter('body_class', 'add_slug_body_class');

// table of content 
function generate_toc($content) {
    $toc = [];
    $dom = new DOMDocument();
    @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    // Find all H2 elements
    $h2Elements = $dom->getElementsByTagName('h2');
    foreach ($h2Elements as $h2) {
        if ($h2->hasAttribute('id')) {
            $h2Entry = [
                'id' => $h2->getAttribute('id'),
                'text' => trim($h2->textContent),
                'tag' => 'h2',
                'subitems' => []
            ];

            // Process all sibling nodes until the next H2 is found
            $nextNode = $h2->nextSibling;
            while ($nextNode !== null && !($nextNode instanceof DOMElement && $nextNode->tagName === 'h2')) {
                if ($nextNode instanceof DOMElement && $nextNode->tagName === 'h3' && $nextNode->hasAttribute('id')) {
                    $h2Entry['subitems'][] = [
                        'id' => $nextNode->getAttribute('id'),
                        'text' => trim($nextNode->textContent),
                        'tag' => 'h3'
                    ];
                }
                $nextNode = $nextNode->nextSibling;
            }

            $toc[] = $h2Entry;
        }
    }

    return $toc;
}

function webduel_toc_shortcode($atts) {
    global $post;
    $content = $post->post_content;

    $toc = generate_toc($content);

    // Build TOC HTML
    $toc_html = '<div class="table-of-contents"><h2 class="h4">Table of Contents</h2><ul>';
    foreach ($toc as $h2) {
        $toc_html .= '<li><a href="#' . $h2['id'] . '">' . $h2['text'] . '</a>';
        if (!empty($h2['subitems'])) {
            $toc_html .= '<ul>';
            foreach ($h2['subitems'] as $h3) {
                $toc_html .= '<li><a href="#' . $h3['id'] . '">' . $h3['text'] . '</a></li>';
            }
            $toc_html .= '</ul>';
        }
        $toc_html .= '</li>';
    }
    $toc_html .= '</ul></div>';

    return $toc_html;
}

add_shortcode('webduel_toc', 'webduel_toc_shortcode');