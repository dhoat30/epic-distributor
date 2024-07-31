<?php 
// Assume you have some ACF fields you want to pass to the template
          $title = get_sub_field('title');
            $selectedCategories = get_sub_field('select_categories');
          $ctaData = get_sub_field('cta');
          
       
?>

<section class="product-list-container category-container ">

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
    <div class="row-container products">


        <?php 
  foreach ($selectedCategories as $category_id) {
    $term = get_term_by('id', $category_id, 'product_cat');

    if ($term) {
        // Get the category name
        $category_name = $term->name;

        // Get the category URL
        $category_link = get_term_link($term);

        // Get the category image URL
        $thumbnail_id = get_term_meta($category_id, 'thumbnail_id', true);

        if ($thumbnail_id) {
            $image_details = wp_get_attachment_image_src($thumbnail_id, 'woocommerce_thumbnail');
        
            $thumbnail_url =  $image_details[0]; 
        } else {
            $thumbnail_url = false;
        }
        // Output the category name, link, and image
        ?>
        <div class="product">
            <a href="<?php echo $category_link;  ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"
                tabindex="0">

                <img width="430" height="430" src="<?php echo $thumbnail_url;  ?>"
                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                    alt="<?php echo $category_name ?>" decoding="async" title="<?php echo $category_name ?>"
                    loading="lazy" defer>
            </a><a href="<?php echo $category_link;  ?>" alt="<?php echo $category_name ?>" class="product-title">
                <h2 class="woocommerce-loop-product__title"><span><?php echo $category_name ?></span>
                    <svg width="28px" height="28px" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                        viewBox="0 0 512.009 512.009" style="enable-background:new 0 0 512.009 512.009;"
                        xml:space="preserve">
                        <g>
                            <g>
                                <path fill="var(--light-on-tertiary-container)"
                                    d="M508.625,247.801L508.625,247.801L392.262,131.437c-4.18-4.881-11.526-5.45-16.407-1.269    c-4.881,4.18-5.45,11.526-1.269,16.407c0.39,0.455,0.814,0.88,1.269,1.269l96.465,96.582H11.636C5.21,244.426,0,249.636,0,256.063    s5.21,11.636,11.636,11.636H472.32l-96.465,96.465c-4.881,4.18-5.45,11.526-1.269,16.407s11.526,5.45,16.407,1.269    c0.455-0.39,0.88-0.814,1.269-1.269l116.364-116.364C513.137,259.67,513.137,252.34,508.625,247.801z" />
                            </g>
                        </g>

                    </svg>
                </h2>
            </a>

        </div>
        <?php 
    } else {
        echo "Category not found for ID: " . $category_id . "<br>";
    }
}

  ?>

    </div>

</section>
<?php