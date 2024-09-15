<?php

// remove sku code
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


// add product sku after the title with the brand attribute image 

add_action('woocommerce_single_product_summary', function() { 
    global $product;  // Ensure you have access to the global product object
  // Fetch the product's attributes
  $attributes = $product->get_attributes();
     // Initialize variables for brand name and image
     $brand_image = '';
    $brand_slug = '';
    $brand_name = '';
     // Check if the brand attribute exists and retrieve its terms
     if (isset($attributes['pa_brand']) && !empty($attributes['pa_brand'])) {
         $brand_terms = wc_get_product_terms($product->get_id(), 'pa_brand', array('fields' => 'all'));
         if (!empty($brand_terms)) {
            $brand_name = $brand_terms[0]->name; // Retrieve the brand name
            $brand_slug = $brand_terms[0]->slug; // Retrieve the brand slug
             $brand_image = get_field('brand_logo', 'pa_brand_' . $brand_terms[0]->term_id); // Retrieve the ACF image field for the term
         }
     }
     $brand_url = get_site_url() . '/brand/' . $brand_slug; // Construct the brand URL
    echo '<div class="sku-brand-wrapper">'; 

  // Display the brand name and image if available
  if (!empty($brand_name)) {
    echo "<div class='product-brand'>"; 
    if ($brand_image) {
        echo '<a href="'.$brand_url.'">'; 
        echo "<img src='" . esc_url($brand_image['url']) . "' alt='" . esc_attr($brand_name) . "' width='32px' height='32px'/>";
        echo '</a>';
    }
    echo "</div>";
    echo "<div class='divider'></div>";
    }
    

    // show sku information 
    // check if sku exist 
    if($product->get_sku()){
        woocommerce_template_single_meta();
        echo "<div class='divider'></div>"; 
    }
   
    custom_stock_availability_display(); 
    echo "</div>";
}, 10);

// Add custom stock availability display
function custom_stock_availability_display() {
    global $product;

    $availability = $product->get_availability();
    $stock_status = $availability['class'];
    $availability_text = '';
  
    echo "<div class='stock-availability-wrapper'>";
    // in stock 
    if ( $stock_status === 'in-stock' ) {
        $availability_text = '<div class="custom-stock-status in-stock">
        <svg height="18px" width="18px" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 408.576 408.576" style="enable-background:new 0 0 408.576 408.576;" xml:space="preserve">
            <g>
                <g>
                    <path d="M204.288,0C91.648,0,0,91.648,0,204.288s91.648,204.288,204.288,204.288s204.288-91.648,204.288-204.288    S316.928,0,204.288,0z M318.464,150.528l-130.56,129.536c-7.68,7.68-19.968,8.192-28.16,0.512L90.624,217.6    c-8.192-7.68-8.704-20.48-1.536-28.672c7.68-8.192,20.48-8.704,28.672-1.024l54.784,50.176L289.28,121.344    c8.192-8.192,20.992-8.192,29.184,0C326.656,129.536,326.656,142.336,318.464,150.528z"/>
                </g>
            </g>
            </svg>
            <span>In stock</span></div>';
    } elseif ( $stock_status === 'out-of-stock' ) {
        $availability_text = '<div class="custom-stock-status out-of-stock"><svg height="22px" width="22px" viewBox="0 0 512 512"data-name="Layer 1"><path d="m340.622 85.898-176.351 78.158 81.062 35.928 176.349-78.16z"/><path d="m137.948 152.39 176.352-78.158-60.323-26.732a21.333 21.333 0 0 0 -17.288 0l-167.7 74.327z"/><path d="m234.667 218.59-181.334-80.37v209.806a21.332 21.332 0 0 0 12.69 19.5l168.643 74.742z"/><path d="m256 362.667v79.605l22.855-10.13a116.684 116.684 0 0 1 -22.855-69.475z"/><path d="m373.333 245.333a116.611 116.611 0 0 1 64 19.067v-126.18l-181.333 80.37v144.077a117.466 117.466 0 0 1 117.333-117.334z"/><path d="m373.333 266.667a96 96 0 1 0 96 96 96 96 0 0 0 -96-96zm39.542 120.458a10.666 10.666 0 1 1 -15.083 15.083l-24.459-24.458-24.458 24.458a10.666 10.666 0 1 1 -15.083-15.083l24.458-24.458-24.458-24.458a10.666 10.666 0 1 1 15.083-15.083l24.458 24.458 24.458-24.458a10.666 10.666 0 1 1 15.083 15.083l-24.458 24.458z"/></svg> <span>Out of stock </span></div>';
    } elseif ( $stock_status === 'available-on-backorder' ) {
        $availability_text = '<div class="custom-stock-status on-backorder"><svg height="22px" width="22px"  viewBox="0 0 32 32" ><g id="_x30_6"><path d="m29 4h-23.5859375l.2929688-.2929688c.390625-.390625.390625-1.0234375 0-1.4140625s-1.0234375-.390625-1.4140625 0l-2 2c-.390625.390625-.390625 1.0234375 0 1.4140625l2 2c.1953125.1953126.4511718.2929688.7070312.2929688s.5117188-.0976563.7070313-.2929688c.390625-.390625.390625-1.0234375 0-1.4140625l-.2929688-.2929687h22.5859375v13h-2v2h3c.5522461 0 1-.4477539 1-1v-15c0-.5522461-.4477539-1-1-1z"/><path d="m24.4472656 17.1054688-4-2c-.28125-.140625-.6132813-.140625-.8945313 0l-4 2c-.034729.017395-.0620117.0438843-.0940552.0648193l4.5413209 2.2706299 4.5413208-2.2706299c-.0320435-.0209351-.0593262-.0474243-.0940552-.0648193z"/><path d="m15 22c0 .3789063.2138672.7250977.5527344.8945313l3.9472656 2.1054687v-4.690918l-4.5-2.25z"/><path d="m20.5 25 3.9472656-2.1054688c.3388672-.1694335.5527344-.5156249.5527344-.8945312v-3.940918l-4.5 2.25z"/><path d="m14 22v-5.2000122l3-1.5360718v-4.263916c0-.5522461-.4477539-1-1-1h-13c-.5522461 0-1 .4477539-1 1v18c0 .5522461.4477539 1 1 1h13c.5522461 0 1-.4477539 1-1v-4.2000122l-1.9179688-1.0231323c-.6582031-.3291016-1.0820312-1.0141602-1.0820312-1.7768555zm-6.1464844 2.8535156-2 2c-.0976562.0976563-.2255859.1464844-.3535156.1464844s-.2558594-.0488281-.3535156-.1464844l-1-1c-.1953125-.1953125-.1953125-.5117188 0-.7070313s.5117188-.1953125.7070313 0l.6464843.6464845 1.6464844-1.6464844c.1953125-.1953125.5117188-.1953125.7070313 0s.1953124.5117187-.0000001.7070312zm0-4-2 2c-.0976562.0976563-.2255859.1464844-.3535156.1464844s-.2558594-.0488281-.3535156-.1464844l-1-1c-.1953125-.1953125-.1953125-.5117188 0-.7070313s.5117188-.1953125.7070313 0l.6464843.6464845 1.6464844-1.6464844c.1953125-.1953125.5117188-.1953125.7070313 0s.1953124.5117187-.0000001.7070312zm0-4-2 2c-.0976562.0976563-.2255859.1464844-.3535156.1464844s-.2558594-.0488281-.3535156-.1464844l-1-1c-.1953125-.1953125-.1953125-.5117188 0-.7070313s.5117188-.1953125.7070313 0l.6464843.6464845 1.6464844-1.6464844c.1953125-.1953125.5117188-.1953125.7070313 0s.1953124.5117187-.0000001.7070312zm0-4-2 2c-.0976562.0976563-.2255859.1464844-.3535156.1464844s-.2558594-.0488281-.3535156-.1464844l-1-1c-.1953125-.1953125-.1953125-.5117188 0-.7070313s.5117188-.1953125.7070313 0l.6464843.6464845 1.6464844-1.6464844c.1953125-.1953125.5117188-.1953125.7070313 0s.1953124.5117187-.0000001.7070312z"/></g></svg> <span> Back order </span></div>';
    }

    echo $availability_text;
    echo "</div>";
}


// add price match promise icon - wrap it with div so that price is in the same wrapper
add_action("woocommerce_single_product_summary", function() { 
    $priceMatchIcon = get_field('price_match_icon', 'option');
    if(empty($priceMatchIcon)){
        return; 
    }
    echo '<div class="price-match-promise-wrapper">'; 
    echo '<img src="'.$priceMatchIcon['url'].'" alt="Price Match Promise" width="100px" height="86px" />';
    echo '</div>'; 
}, 10);
// add back link and share button 
add_action('woocommerce_before_single_product', 'webduel_share_and_back_button', 10);

function webduel_share_and_back_button(){
    ?>
<div class="back-share-btn-wrapper">
    <div class="back-wrapper ">
        <a href="#" onclick="window.history.back(); return false;" class="link-button">
            <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/"
                clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                viewBox="0 0 105 105">
                <path
                    d="m97.914 47.917h-81.608l26.221-26.221c1.629-1.629 1.629-4.262 0-5.891-1.63-1.629-4.263-1.629-5.892 0l-33.333 33.329c-.384.387-.688.85-.9 1.358-.421 1.017-.421 2.167 0 3.184.212.508.516.97.9 1.358l33.333 33.329c.812.813 1.879 1.221 2.946 1.221 1.066 0 2.133-.408 2.946-1.221 1.629-1.629 1.629-4.262 0-5.892l-26.221-26.22h81.608c2.3 0 4.167-1.867 4.167-4.167s-1.867-4.167-4.167-4.167z"
                    fill-rule="nonzero" />
            </svg>
            <span>Back<span></a>
    </div>

</div>
<?php 
}


// remove sidebar 
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/**
 * Remove product page tabs
 */
add_filter('woocommerce_product_tabs', 'my_remove_all_product_tabs', 98);

function my_remove_all_product_tabs($tabs)
{
    unset($tabs['description']);        // Remove the description tab
    unset($tabs['reviews']);       // Remove the reviews tab
    unset($tabs['additional_information']);    // Remove the additional information tab
    return $tabs;
}


//remove short description on single product page
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
// //add the short description 
// add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10);



// add quantity label
add_action('woocommerce_before_add_to_cart_quantity',function (){ 
    echo '<div class="webduel-qty-wrapper">';
    echo '<div class="quantity-button decrease">-</div>';
}, 5);


add_action('woocommerce_after_add_to_cart_quantity', function(){ 
    echo '<div class="quantity-button increase">+</div>';
    echo '</div>'; 
}, 20);

// add product descriptions
add_action('woocommerce_after_add_to_cart_quantity', function() { 
    ?>
<div class="success-message">
    <p>Product Added! </p>
    <a href="<?php echo wc_get_cart_url(); ?>">View Cart</a>
</div>
<div class="error-message">
    <svg width="20" height="20" viewBox="0 0 320 320" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M144 208H176V240H144V208ZM144 80H176V176H144V80ZM159.84 0C71.52 0 0 71.68 0 160C0 248.32 71.52 320 159.84 320C248.32 320 320 248.32 320 160C320 71.68 248.32 0 159.84 0ZM160 288C89.28 288 32 230.72 32 160C32 89.28 89.28 32 160 32C230.72 32 288 89.28 288 160C288 230.72 230.72 288 160 288Z"
            fill="black" />
    </svg>

    <p>Something went wrong. Please try again.</p>
</div>
<?php     
}, 150); 





// add after pay 
add_action('woocommerce_single_product_summary', 'display_afterpay_info', 10);

function display_afterpay_info() { 
    global $product; 
    $categories = get_the_terms($product->get_id(), 'product_cat');
    $show_after_pay = false;
    $show_silver_chef = false;
    if ($categories) {
        foreach ($categories as $category) {
          
            // Assuming 'show_after_pay' and 'show_silver_chef' are stored as term meta
            if (get_field('show_after_pay', 'product_cat_' . $category->term_id)) {
                $show_after_pay = true;
            }
            if (get_field('show_silver_chef', 'product_cat_' . $category->term_id)) {
                $show_silver_chef = true;
            }
        }
    }
    if($show_after_pay || $show_silver_chef) { 
        echo '<div class="finance-options-wrapper">';
        if ($show_after_pay) {
            get_template_part('inc/templates/after-pay/after-pay-webduel'); 
            echo "<div class='divider'></div>"; 
        } 
        if ($show_silver_chef) {
            get_template_part('inc/templates/silver-chef/silver-chef');   
        }
    echo '</div>'; 
    }
} 

// stock availability
// Remove the default stock availability text
// Remove the default WooCommerce stock display
add_filter( 'woocommerce_get_stock_html', 'custom_remove_stock_display', 10, 2 );
function custom_remove_stock_display( $html, $product ) {
    return '';
}

// add product description tab html  
get_template_part('inc/templates/product-description-tabs');


// add product resources 
get_template_part('inc/templates/product-resources');

// add youtube video under product short description
add_action( 'woocommerce_single_product_summary', 'custom_lazy_load_youtube_video', 25 );

function custom_lazy_load_youtube_video() {
    global $post;
    
    // Fetch the YouTube video ID from the ACF field
    $youtube_video_id = get_field('youtube_video_id', $post->ID);
    
    if ( $youtube_video_id ) {
        // YouTube thumbnail URL
        $youtube_thumbnail_url = 'https://i.ytimg.com/vi/' . esc_attr( $youtube_video_id ) . '/hq720.jpg';

        echo '<div class="product-video">';
     
        echo '<div class="youtube-video-wrapper" data-video-id="' . esc_attr( $youtube_video_id ) . '" style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; max-width:100%; background:url(' . esc_url( $youtube_thumbnail_url ) . ') no-repeat center center; background-size:cover; cursor:pointer;">';
        echo '<img src="' . esc_url( $youtube_thumbnail_url ) . '" style="width:100%; height:auto; display:block;" alt="youtube Video thumbnail" loading="lazy">';
        echo '<div class="play-button" style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); font-size:64px; color:white;">&#9658;</div>';
        echo '</div>';
        echo '</div>';

        // Add the script directly after the hook
        ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var videoWrappers = document.querySelectorAll(".youtube-video-wrapper");
    videoWrappers.forEach(function(wrapper) {
        wrapper.addEventListener("click", function() {
            var videoId = wrapper.getAttribute(
                'data-video-id'); // Get video ID from the data attribute
            var iframe = document.createElement("iframe");
            iframe.setAttribute("src", "https://www.youtube.com/embed/" + videoId +
                "?autoplay=1&rel=0");
            iframe.setAttribute("frameborder", "0");
            iframe.setAttribute("allow", "autoplay; encrypted-media");
            iframe.setAttribute("allowfullscreen", "1");
            iframe.style.width = "100%";
            iframe.style.height = "100%";
            iframe.style.position = "absolute";
            wrapper.innerHTML = "";
            wrapper.appendChild(iframe);
            wrapper.style.background = "none";
        });
    });
});
</script>
<?php 
    }
}