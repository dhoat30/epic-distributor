<?php 
  // Assume you have some ACF fields you want to pass to the template
  $promoCardsArr = get_sub_field('cards');

?>

<section class="promo-container">
    <div class="row-container">

        <div class="cards">
            <?php 
      $position = 0; 
foreach ($promoCardsArr as $card) {
    $link = $card['link']['url'];
    $label = $card['link']['title'];
    $image = $card['image']; 
    if($card['content']){ 
        $backgroundColor = $card['content']['background_color'];
        $title = $card['content']['title'];
        $subtitle = $card['content']['subtitle'];
        $regularPrice = $card['content']['price']['regular_price'];
        $salePrice = $card['content']['price']['sale_price'];
    }
  

?>
            <div class="small-card card">

                <a href="<?php echo $link; ?>" aria-label="Show Now" class="image-wrapper"
                    style="padding-bottom: <?php echo !$card['do_you_want_to_add_custom_content'] ? "calc(43.75% + 128px )" : "43.75%";  ?>">
                    <picture>
                        <source media="(min-width:1366px)" srcset="<?php echo $image['sizes']['2048x2048']; ?>">
                        <source media="(min-width:900px)" srcset="<?php echo $image['sizes']['large']; ?>">
                        <source media="(min-width:500px)" srcset="<?php echo $image['sizes']['large']; ?>">
                        <img src="<?php echo $image['sizes']['medium_large']; ?>" alt="<?php echo $image['alt']; ?>"
                            width="100%" height="400px" class="img-fill" loading="lazy">
                    </picture>
                </a>
                <?php 
            
    
if($card['do_you_want_to_add_custom_content']){
    ?>
                <div class="content-wrapper"
                    style="background-color: <?php echo isset($backgroundColor) ? $backgroundColor : "none"; ?>">
                    <h2 class="h4 title center-align" style="color: white; ">
                        <?php echo $title;  ?>
                    </h2>
                    <p class="body1 subtitle center-align" style="color: white;">
                        <?php echo $subtitle;  ?>
                    </p>

                    <?php
                    if($regularPrice ){
                    ?>
                    <div class="price-wrapper center-align">
                        <span class="regular-price h5"
                            style="text-decoration: <?php echo $salePrice ? "line-through" : "none"; ?>; color: white; ">$<?php echo $regularPrice;  ?></span>
                        <?php 
                         if($salePrice){
                             ?>
                        <span class="sale-price h5" style="color:white;">$<?php echo $salePrice;  ?></span>
                        <?php 
                         }  
                         ?>
                    </div>
                    <?php } ?>

                    <div class="button-wrapper">
                        <a href="<?php echo $link; ?>" class="link-button " style="color:white;">
                            <?php echo $label; ?>
                            <svg height="18px" viewBox="0 0 128 128" width="18px">
                                <path id="Right_Arrow_4_" fill="white" stroke="white"
                                    d="m44 108c-1.023 0-2.047-.391-2.828-1.172-1.563-1.563-1.563-4.094 0-5.656l37.172-37.172-37.172-37.172c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l40 40c1.563 1.563 1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" />
                            </svg></a>
                    </div>

                </div>
                <?php
} 
?>


            </div>
            <?php
       $position++;

}

?>
        </div>
    </div>
</section>