<?php 


    global $product;
    $product_id = $product->get_id();

   // Get the current product price
   $price = get_wholesale_price_by_product_type($product_id);
   // if wholesale price doesn't exist then show the woocommerce price 
     if(empty($price)){
         $price = $product->get_price();
     }
  
  
  //  to get the upfront, divide the price by 11.25
     $upfront = $price / 11.25;
 
    //  to get the installments, subtract the upfront from the price and divide by 71.78 then multiply by 52 weeks 
     $installments  = wc_price(($price -$upfront )/71.78); 
   
    // Output the Afterpay information
    echo '<div class="silver-chef-info">
     <a href="https://www.silverchef.co.nz/pages/equipment-rental-calculator" target="_blank">     <svg data-name="Layer 1" viewBox="0 0 246 116" width="104" height="49.04px" xmlns="http://www.w3.org/2000/svg">
    <defs>
      <linearGradient gradientTransform="matrix(1 0 0 -1 0 118)" gradientUnits="userSpaceOnUse" id="a" x1=".25" x2="100.25" y1="60" y2="60">
        <stop offset="0" stop-color="#67e2c9"></stop>
        <stop offset=".44" stop-color="#00e6c8"></stop>
      </linearGradient>
    </defs>
    <path d="M58 115.69a57.7 57.7 0 1 1 40.8-98.5l1.4 1.4-2.8 2.8L96 20a53.7 53.7 0 0 0-75.9 76 53 53 0 0 0 38 15.7 53.57 53.57 0 0 0 38-15.7l1.4-1.4 2.8 2.8-1.4 1.4A57.74 57.74 0 0 1 58 115.69z" fill="url(#a)"></path>
    <path fill="#000" d="M75.65 42.79a3.2 3.2 0 1 1-3.2-3.2 3.22 3.22 0 0 1 3.2 3.2M57.25 54.19c-3.2-1-6.2-1.9-6.2-4.8 0-2.5 2.3-3.7 4.8-3.7a8.47 8.47 0 0 1 6.4 3l3.5-3.7a12.26 12.26 0 0 0-9.6-4.4c-5.4 0-10.5 3.4-10.5 9.5s4.8 7.7 9 9c3.4 1 6.5 1.8 6.5 4.6 0 2.2-2 3.7-4.8 3.7a10.06 10.06 0 0 1-7.7-3.9L45 67.39a14.27 14.27 0 0 0 11.1 5.2c5.6 0 10.7-3.4 10.7-9.5-.1-6.3-5.1-7.7-9.5-8.9M69.65 49.39h5.5v22.8h-5.5zM78.85 40.79h5.4v31.3h-5.4zM103.75 49.39l-5.9 15.5-5.7-15.5h-5.9l9.2 22.8h4.8l9.2-22.8h-5.7zM120.75 48.79c-7.2 0-11.6 5.4-11.6 12s4.3 11.6 11.5 11.6a12.11 12.11 0 0 0 9.5-4.4l-2.9-3.3a7.72 7.72 0 0 1-6.1 3c-3.9 0-6.1-2.5-6.5-5.2h16.1v-2.3c0-7.2-3.7-11.4-10-11.4m-6.2 9.7c.5-3 2.5-5.1 5.8-5.1s5 2 5 5.1zM191.15 48.79a8.36 8.36 0 0 0-7.1 3.6v-11.6h-5.4v31.4h5.4v-12.3c0-4.2 2.8-6.2 5.5-6.2 2.5 0 4.4 1.6 4.4 4.8v13.7h5.4v-14.7c0-5.7-3.6-8.7-8.2-8.7M213.75 48.79c-7.2 0-11.6 5.4-11.6 12s4.3 11.6 11.5 11.6a12.11 12.11 0 0 0 9.5-4.4l-2.9-3.3a7.72 7.72 0 0 1-6.1 3c-3.9 0-6.1-2.5-6.5-5.2h16.1v-2.3c.1-7.2-3.6-11.4-10-11.4m-6.1 9.7c.5-3 2.5-5.1 5.8-5.1s5 2 5 5.1zM236.15 44.49a4.54 4.54 0 0 1 3.2 1.2l2.2-4.1a9.77 9.77 0 0 0-5.9-2c-4.8 0-8.3 2.9-8.3 8.1v24.5h5.4v-18.3h5.8v-4.8h-5.8v-1.3a3.12 3.12 0 0 1 3.4-3.3M138.85 52.89v-3.5h-5.3v22.8H139V60c0-4 2.4-6 5.4-6a9.85 9.85 0 0 1 1.7.2l1-4.9a13.55 13.55 0 0 0-2-.2c-2.7 0-5.2 1.1-6.2 3.8M163.85 45.79a9.24 9.24 0 0 1 8.2 4.3l4.1-3.5a14.06 14.06 0 0 0-12.1-6c-9.5 0-15.8 7.1-15.8 16.2 0 8.5 5.5 15.6 15.1 15.6a14.54 14.54 0 0 0 12.5-6.3l-3.8-3.3a9.3 9.3 0 0 1-8.1 4.3c-5.8 0-10.1-4.4-10.1-10.8 0-6.1 4.1-10.5 10-10.5M242.45 66a3.3 3.3 0 1 1-3.3 3.3 3.27 3.27 0 0 1 3.3-3.3zm0 5.7a2.37 2.37 0 0 0 2.4-2.4 2.4 2.4 0 1 0-2.4 2.4zm.7-.8l-.9-1.3h-.2v1.3h-.8v-3.4h.8c1.1 0 1.6.3 1.6 1a1.2 1.2 0 0 1-.7 1l1 1.4zm-1.1-2.7v.9c.5 0 .9 0 .9-.4s-.2-.51-.9-.51z"></path>
  </svg>
  </a>
        <div class="content body1"><div class="installment-content body1">From'.$installments.' per week for 12 months.</div>
<div class="checkout-content body1">Select Sliverchef at Checkout, pay nothing now
Get up to $65,000 Instant Approval</div></div>
  
       
    </div>';

?>