<?php 

// accordion 
add_action('woocommerce_after_single_product', function() { 
    ?>
<div class="product-accordion">
    <div class="tab-links">
        <div class="active tab-link-wrapper"><a class="subtitle1" href="#tab1">Description</a></div>
        <div class="tab-content active">
            <div id="tab1" class="tab active">
                <?php
               // product description 
                    webduel_product_description_HTML();
                ?>
            </div>
        </div>
    </div>
    <?php 
     global $product;

     // Get product attributes that are variations
     $attributes = $product->get_attributes();
    if(!empty($attributes)) { 
        ?>
    <div class="tab-links">
        <div class="tab-link-wrapper"><a href="#tab2" class="subtitle1">Specifications</a></div>
        <div class="tab-content">
            <div id="tab2" class="tab">
                <?php display_global_product_attributes_table(); ?>
            </div>
        </div>
    </div>
    <?php 
    }
    ?>
    <!-- warranty info -->
    <?php 
        $warrantyInfo =  get_field('warranty');   
        if(empty($warrantyInfo)) { 
            $warrantyInfo = get_field('warranty_info_global', 'option');
        }
        if(!empty($warrantyInfo)) {  
            ?>
    <div class="tab-links">
        <div class="tab-link-wrapper"><a href="#tab3" class="subtitle1">Warranty</a></div>
        <div class="tab-content">
            <div id="tab3" class="tab">
                <?php webduel_product_warranty_HTML($warrantyInfo); ?>
            </div>
        </div>


    </div>
    <?php
        }
        ?>

    <!-- delivery info -->
    <?php 
        $deliveryInfo =   get_field('delivery_information', 'option');
        if(!empty($deliveryInfo)) { 
            ?>
    <div class="tab-links">

        <div class="tab-link-wrapper"><a href="#tab4" class="subtitle1">Delivery information</a></div>
        <div class="tab-content">
            <div id="tab4" class="tab">
                <?php webduel_product_delivery_info_HTML($deliveryInfo); ?>
            </div>
        </div>
    </div>
    <?php
        }
        ?>

</div>
</div>
<?php

    // product attributes table 

}, 40); 

function webduel_product_description_HTML(){ 
    global $product; 
    // check if the get_description is not empty 


    if (!empty($product->get_description())) {
        echo '
    <div class="description-wrapper">
        <div class="content description">
        '. $product->get_description().'
        </div> 
    </div>'; 
    }
}
function webduel_product_warranty_HTML($warrantyInfo){ 
    global $product; 
    // check if the get_description is not empty 



        echo '
    <div class="warranty-wrapper">
        <div class="content warranty">
        '. $warrantyInfo.'
        </div> 
    </div>'; 

}

function webduel_product_delivery_info_HTML($deliveryInfo){ 
        echo '<div class="delivery-wrapper">
        <div class="content delivery">
        '. $deliveryInfo.'
        </div> 
    </div>'; 

}
function display_global_product_attributes_table() {
    global $product;

    // Get product attributes that are variations
    $attributes = $product->get_attributes();
    
    $html = '<table class="sm:table-fixed border-collapse border border-grey1-400">
                <tbody>';
    
    // Loop through each attribute and display it
    foreach ($attributes as $attribute) {
        // Check if the attribute is a taxonomy (global attribute)
        if ($attribute->is_taxonomy()) {
            $values = wc_get_product_terms($product->get_id(), $attribute->get_name(), array('fields' => 'names'));
            $attribute_label = wc_attribute_label($attribute->get_name());
            $attribute_values = apply_filters('woocommerce_attribute', wpautop(wptexturize(implode(', ', $values))), $attribute, $values);
        } else {
            // Handle custom attributes (local attributes)
            $attribute_label = wc_attribute_label($attribute->get_name());
            $attribute_values = apply_filters('woocommerce_attribute', wpautop(wptexturize($attribute->get_data()['value'])), $attribute);
        }

        $html .= '<tr class="bg-white">
                    <td class="border border-grey1-400 label"><b>' . $attribute_label . '</b></td>
                    <td class="border border-grey1-400 value">' . $attribute_values . '</td>
                  </tr>';
    }
    

    // Get brand details and add to the table
    $brand_terms = wc_get_product_terms($product->get_id(), 'product_brand', array('fields' => 'names'));
    if (!empty($brand_terms)) {
        $brand_name = implode(', ', $brand_terms);
        $html .= '<tr class="bg-white">
                    <td class="border border-grey1-400 label"><b>Brand</b></td>
                    <td class="border border-grey1-400 value">' . wpautop(wptexturize($brand_name)) . '</td>
                  </tr>';
    }
    
    $html .= '</tbody>
            </table>';

    echo '<div class="attributes-wrapper">' . $html . '</div>';
}

// faq content 
function webduel_product_faq_info_HTML($faqInfo){ 
   ?>
<div class="faq-section row-container" style="padding-top: 24px; padding-bottom: 24px;">
    <div class="faq-content">
        <div class="content-pane show">
            <?php foreach ($faqInfo as $qa) { ?>
            <div class="question-item">
                <h3 class="question body1">
                    <?php echo esc_html($qa['question']); ?>
                    <span class="arrow-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" enable-background="new 0 0 128 128"
                            height="18px" viewBox="0 0 128 128" width="18px">
                            <path fill="var(--light-on-surface)" id="Down_Arrow_3_"
                                d="m64 88c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l37.172 37.172 37.172-37.172c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" />
                        </svg>
                    </span> <!-- This is a downward arrow -->
                </h3>
                <div class="answer" style="display: none;">
                    <?php echo wpautop($qa['answer']); ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php 

}