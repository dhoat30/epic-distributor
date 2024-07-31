<?php 
// Assume you have some ACF fields you want to pass to the template
          $title = get_sub_field('title');
            $products = get_sub_field('select_product');
          $ctaData = get_sub_field('cta');
          // Assume $products is your array of WP_Post objects
            $product_ids = array(); // This will store the product IDs
            foreach ($products as $product) {
                $product_ids[] = $product->ID; // Add each product's ID to the new array
            }
?>

<section class="product-list-container ">
    <?php 
  // check if the section title exists 
  if($title){ 
      ?>
    <div class="row-container">
        <h2 class="center-align h3"><?php echo $title;  ?></h2>
    </div>
    <?php 
  }
  ?>
    <?php
        // Ensure WooCommerce is active
        if (class_exists('WooCommerce')) {

            // Query parameters
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1, // Set to -1 to show all, or set a specific limit
                'post__in' => $product_ids, // Use the 'post__in' parameter to specify the array of IDs
                'orderby' => 'post__in' // This ensures the products are ordered as in your array
            );

            // The Query
            $loop = new WP_Query($args);

            // The Loop
            if ($loop->have_posts()) {
                echo '<ul class="products">'; // Start a wrapper for the products
                while ($loop->have_posts()) : $loop->the_post();
                    wc_get_template_part('content', 'product'); // Get the WooCommerce product template
                endwhile;
                echo '</ul>';
            } else {
                echo '<p>No products found</p>';
            }

            // Restore original Post Data
            wp_reset_postdata();
        }
    ?>
    <?php 
    if($ctaData){
    ?>
    <a class="border-button section-link" href="<?php echo $ctaData['url']; ?>">
        <span><?php echo $ctaData['title'];  ?></span>
    </a>
    <?php } ?>
</section>