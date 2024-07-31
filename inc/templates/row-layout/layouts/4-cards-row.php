<?php 
// set button color 
function webduel_set_button_color_four_cards_row($button_color){

switch ($button_color) {
    case "blue":
        return array(
            "background_color" => "var(--light-primary)",
            "text_color" => "var(--light-on-primary)"
        );

    case "light_blue":
        return array(
            "background_color" => "var(--dark-primary)",
            "text_color" => "var(--dark-on-primary)"
        );

    case "green":
        return array(
            "background_color" => "var(--light-tertiary)",
            "text_color" => "var(--light-on-tertiary)"
        );

    case "dark_blue":
        return array(
            "background_color" => "var(--dark-tertiary)",
            "text_color" => "var(--dark-on-tertiary)"
        );

    default:
        return null; 
}
}

// Assume you have some ACF fields you want to pass to the template
    $wideCardData = get_sub_field('wide_card');
    $wideCardLink = $wideCardData['link']['url'];
    $wideCardLabel = $wideCardData['link']['title'];
    $wideCardDesktopImage = $wideCardData['desktop_image'];
    $wideCardMobileImage = $wideCardData['mobile_image'];
    if($wideCardData['content']){
        $wideCardBackgroundColor = $wideCardData['content_group']['background_color'];
        $wideCardButtonColor = $wideCardData['content_group']['button_color'];
        $wideCardTextColor = $wideCardData['content_group']['text_color'];
       $wideCardTitle = $wideCardData['content_group']['title'];
       $wideCardSubtitle = $wideCardData['content_group']['subtitle'];
       $wideCardRegularPrice = $wideCardData['content_group']['price']['regular_price'];
       $wideCardSalePrice = $wideCardData['content_group']['price']['sale_price'];
       $wideCardButtonColorArr = webduel_set_button_color_four_cards_row($wideCardButtonColor);
    }
   

    // small card first
    $smallCardFirstData = get_sub_field('small_card');
    $smallCardFirstLink = $smallCardFirstData['link']['url'];
    $smallCardFirstLabel = $smallCardFirstData['link']['title'];
    $smallCardFirstDesktopImage = $smallCardFirstData['image'];
    if($smallCardFirstData['content']){
        $smallCardFirstBackgroundColor = $smallCardFirstData['content_group']['background_color'];
        $smallCardFirstTextColor = $smallCardFirstData['content_group']['text_color'];
       $smallCardFirstTitle = $smallCardFirstData['content_group']['title'];
       $smallCardFirstSubtitle = $smallCardFirstData['content_group']['subtitle'];
       $smallCardFirstRegularPrice = $smallCardFirstData['content_group']['price']['regular_price'];
       $smallCardFirstSalePrice = $smallCardFirstData['content_group']['price']['sale_price'];
    }

      // small card second
      $smallCardSecondData = get_sub_field('small_card_2');
      $smallCardSecondLink = $smallCardSecondData['link']['url'];
      $smallCardSecondLabel = $smallCardSecondData['link']['title'];
      $smallCardSecondDesktopImage = $smallCardSecondData['image'];
      if($smallCardSecondData['content']){
          $smallCardSecondBackgroundColor = $smallCardSecondData['content_group']['background_color'];
          $smallCardSecondTextColor = $smallCardSecondData['content_group']['text_color'];
         $smallCardSecondTitle = $smallCardSecondData['content_group']['title'];
         $smallCardSecondSubtitle = $smallCardSecondData['content_group']['subtitle'];
         $smallCardSecondRegularPrice = $smallCardSecondData['content_group']['price']['regular_price'];
         $smallCardSecondSalePrice = $smallCardSecondData['content_group']['price']['sale_price'];
      }

    //   vertical card 
     // small card second
     $verticalCardData = get_sub_field('vertical_card');
     $verticalCardLink = $verticalCardData['link']['url'];
     $verticalCardLabel = $verticalCardData['link']['title'];
     $verticalCardDesktopImage = $verticalCardData['image'];
     $verticalCardButtonColorArr = null;
     if($verticalCardData['content']){
         $verticalCardBackgroundColor = $verticalCardData['content_group']['background_color'];
         $verticalCardButtonColor = $verticalCardData['content_group']['button_color'];
         $verticalCardTextColor = $verticalCardData['content_group']['text_color'];
        $verticalCardTitle = $verticalCardData['content_group']['title'];
        $verticalCardSubtitle = $verticalCardData['content_group']['subtitle'];
        $verticalCardRegularPrice = $verticalCardData['content_group']['price']['regular_price'];
        $verticalCardSalePrice = $verticalCardData['content_group']['price']['sale_price'];
        $verticalCardButtonColorArr = webduel_set_button_color_four_cards_row($verticalCardButtonColor);
     }
   



     
  
   
 
?>
<section class="four-card-row">
    <div class="row-container">
        <div class="grid-wrapper">
            <div class="column column-1">
                <div class="wide-card card">
                    <a href="<?php echo $wideCardLink; ?> " aria-label="Show Now" class="image-wrapper"
                        style="background-color: <?php echo isset($wideCardBackgroundColor) ? $wideCardBackgroundColor : "none"; ?>">
                        <picture>
                            <source media="(min-width:1366px)"
                                srcset="<?php echo $wideCardDesktopImage['sizes']['2048x2048']; ?>">
                            <source media="(min-width:900px)"
                                srcset="<?php echo $wideCardDesktopImage['sizes']['large']; ?>">
                            <source media="(min-width:400px)"
                                srcset="<?php echo $wideCardMobileImage['sizes']['large']; ?>">
                            <img src="<?php echo $wideCardMobileImage['sizes']['woocommerce_thumbnail']; ?>"
                                alt="<?php echo $wideCardMobileImage['alt']; ?>" width="100%" height="400px"
                                class="img-fill">
                        </picture>
                    </a>
                    <?php 
                    if($wideCardData['content']){
                            ?>
                    <div class="content-wrapper">
                        <h1 class="h2 title"
                            style="color: <?php echo $wideCardTextColor ? $wideCardTextColor : "white"; ?>">
                            <?php echo $wideCardTitle;  ?>
                        </h1>
                        <p class="h6 subtitle"
                            style="color: <?php echo $wideCardTextColor ? $wideCardTextColor : "white"; ?>">
                            <?php echo $wideCardSubtitle;  ?>
                        </p>
                        <div class="price-wrapper">
                            <span class="regular-price h3"
                                style="text-decoration: <?php echo $wideCardSalePrice ? "line-through" : "none"; ?>; color: <?php echo $wideCardTextColor ? $wideCardTextColor : "white"; ?> ">$<?php echo $wideCardRegularPrice;  ?></span>
                            <span class="sale-price h3"
                                style="color: <?php echo $wideCardTextColor ? $wideCardTextColor : "white"; ?>">$<?php echo $wideCardSalePrice;  ?></span>
                        </div>


                        <div class="button-wrapper">
                            <a href="<?php echo htmlspecialchars($wideCardLink); ?>" class="primary-button"
                                style="background-color: <?php echo isset($wideCardButtonColorArr['background_color']) ? htmlspecialchars($wideCardButtonColorArr['background_color']) : 'default-background-color'; ?>;
               color: <?php echo isset($wideCardButtonColorArr['text_color']) ? htmlspecialchars($wideCardButtonColorArr['text_color']) : 'default-text-color'; ?>;">
                                <?php echo htmlspecialchars($wideCardLabel); ?>
                            </a>
                        </div>

                    </div>
                    <?php
                    } 
                        ?>


                </div>
                <div class="small-cards-wrapper">

                    <div class="small-card card">

                        <a href="<?php echo $smallCardFirstLink; ?> " aria-label="Show Now" class="image-wrapper"
                            style="padding-bottom: <?php echo !$smallCardFirstData['content'] ? "calc(43.75% + 128px )" : "43.75%";  ?>">
                            <picture>
                                <source media="(min-width:1366px)"
                                    srcset="<?php echo $smallCardFirstDesktopImage['sizes']['2048x2048']; ?>">
                                <source media="(min-width:900px)"
                                    srcset="<?php echo $smallCardFirstDesktopImage['sizes']['large']; ?>">
                                <source media="(min-width:400px)"
                                    srcset="<?php echo $smallCardFirstDesktopImage['sizes']['large']; ?>">
                                <img src="<?php echo $smallCardFirstDesktopImage['sizes']['woocommerce_thumbnail']; ?>"
                                    alt="<?php echo $smallCardFirstDesktopImage['alt']; ?>" width="100%" height="400px"
                                    class="img-fill">
                            </picture>
                        </a>
                        <?php 
                    if($smallCardFirstData['content']){
                            ?>
                        <div class="content-wrapper"
                            style="background-color: <?php echo isset($smallCardFirstBackgroundColor) ? $smallCardFirstBackgroundColor : "none"; ?>">
                            <h2 class="h4 title center-align"
                                style="color: <?php echo $smallCardFirstTextColor ? $smallCardFirstTextColor : "white"; ?>">
                                <?php echo $smallCardFirstTitle;  ?>
                            </h2>
                            <p class="body1 subtitle center-align"
                                style="color: <?php echo $smallCardFirstTextColor ? $smallCardFirstTextColor : "white"; ?>">
                                <?php echo $smallCardFirstSubtitle;  ?>
                            </p>
                            <div class="price-wrapper center-align">
                                <span class="regular-price h5"
                                    style="text-decoration: <?php echo $smallCardFirstSalePrice ? "line-through" : "none"; ?>; color: <?php echo $smallCardFirstTextColor ? $smallCardFirstTextColor : "white"; ?> ">$<?php echo $smallCardFirstRegularPrice;  ?></span>
                                <span class="sale-price h5"
                                    style="color: <?php echo $smallCardFirstTextColor ? $smallCardFirstTextColor : "white"; ?>">$<?php echo $smallCardFirstSalePrice;  ?></span>
                            </div>
                            <div class="button-wrapper">
                                <a href="<?php echo $smallCardFirstLink; ?>" class="link-button "
                                    style="color: <?php echo $smallCardFirstTextColor ? $smallCardFirstTextColor : "white"; ?>">
                                    <?php echo $smallCardFirstLabel; ?>
                                    <svg height="18px" viewBox="0 0 128 128" width="18px">
                                        <path id="Right_Arrow_4_"
                                            fill="<?php echo $smallCardFirstTextColor ? $smallCardFirstTextColor : "white"; ?>"
                                            stroke="<?php echo $smallCardFirstTextColor ? $smallCardFirstTextColor : "white"; ?>"
                                            d="m44 108c-1.023 0-2.047-.391-2.828-1.172-1.563-1.563-1.563-4.094 0-5.656l37.172-37.172-37.172-37.172c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l40 40c1.563 1.563 1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" />
                                    </svg></a>
                            </div>

                        </div>
                        <?php
                    } 
                        ?>


                    </div>
                    <div class="small-card card">

                        <a href="<?php echo $smallCardSecondLink; ?> " aria-label="Show Now" class="image-wrapper"
                            style="padding-bottom: <?php echo !$smallCardSecondData['content'] ? "calc(43.75% + 128px )" : "43.75%";  ?>">
                            <picture>
                                <source media="(min-width:1366px)"
                                    srcset="<?php echo $smallCardSecondDesktopImage['sizes']['2048x2048']; ?>">
                                <source media="(min-width:900px)"
                                    srcset="<?php echo $smallCardSecondDesktopImage['sizes']['large']; ?>">
                                <source media="(min-width:400px)"
                                    srcset="<?php echo $smallCardSecondDesktopImage['sizes']['large']; ?>">
                                <img src="<?php echo $smallCardSecondDesktopImage['sizes']['woocommerce_thumbnail']; ?>"
                                    alt="<?php echo $smallCardSecondDesktopImage['alt']; ?>" width="100%" height="400px"
                                    class="img-fill">
                            </picture>
                        </a>
                        <?php 
                    if($smallCardSecondData['content']){
                            ?>
                        <div class="content-wrapper"
                            style="background-color: <?php echo isset($smallCardSecondBackgroundColor) ? $smallCardSecondBackgroundColor : "none"; ?>">
                            <h2 class="h4 title center-align"
                                style="color: <?php echo $smallCardSecondTextColor ? $smallCardSecondTextColor : "white"; ?>">
                                <?php echo $smallCardSecondTitle;  ?>
                            </h2>
                            <p class="body1 subtitle center-align"
                                style="color: <?php echo $smallCardSecondTextColor ? $smallCardSecondTextColor : "white"; ?>">
                                <?php echo $smallCardSecondSubtitle;  ?>
                            </p>
                            <div class="price-wrapper center-align">
                                <span class="regular-price h5"
                                    style="text-decoration: <?php echo $smallCardSecondSalePrice ? "line-through" : "none"; ?>; color: <?php echo $smallCardSecondTextColor ? $smallCardSecondTextColor : "white"; ?> ">$<?php echo $smallCardSecondRegularPrice;  ?></span>
                                <span class="sale-price h5"
                                    style="color: <?php echo $smallCardSecondTextColor ? $smallCardSecondTextColor : "white"; ?>">$<?php echo $smallCardSecondSalePrice;  ?></span>
                            </div>
                            <div class="button-wrapper">
                                <a href="<?php echo $smallCardSecondLink; ?>" class="link-button "
                                    style="color: <?php echo $smallCardSecondTextColor ? $smallCardSecondTextColor : "white"; ?>">
                                    <?php echo $smallCardSecondLabel; ?>
                                    <svg height="18px" viewBox="0 0 128 128" width="18px">
                                        <path id="Right_Arrow_4_"
                                            fill="<?php echo $smallCardSecondTextColor ? $smallCardSecondTextColor : "white"; ?>"
                                            stroke="<?php echo $smallCardSecondTextColor ? $smallCardSecondTextColor : "white"; ?>"
                                            d="m44 108c-1.023 0-2.047-.391-2.828-1.172-1.563-1.563-1.563-4.094 0-5.656l37.172-37.172-37.172-37.172c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l40 40c1.563 1.563 1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" />
                                    </svg></a>
                            </div>

                        </div>
                        <?php
                    } 
                        ?>


                    </div>
                </div>

            </div>
            <div class="column column-2">

                <div class="vertical-card card"
                    style="border: 2px solid <?php echo isset($verticalCardBackgroundColor) ? $verticalCardBackgroundColor : "none"; ?>">
                    <?php
                        $paddingBottom = ($verticalCardDesktopImage['height'] / $verticalCardDesktopImage['width']) * 100;
                        ?>
                    <style>
                    @media (max-width: 900px) {
                        .vertical-card.card {
                            padding-bottom: <?php echo $paddingBottom;
                            ?>%;
                        }
                    }
                    </style>
                    <a href="<?php echo $verticalCardLink; ?> " aria-label="Show Now" class="image-wrapper">
                        <picture>
                            <source media="(min-width:1366px)"
                                srcset="<?php echo $verticalCardDesktopImage['sizes']['2048x2048']; ?>">
                            <source media="(min-width:900px)"
                                srcset="<?php echo $verticalCardDesktopImage['sizes']['large']; ?>">
                            <source media="(min-width:400px)"
                                srcset="<?php echo $verticalCardDesktopImage['sizes']['large']; ?>">
                            <img src="<?php echo $verticalCardDesktopImage['sizes']['large']; ?>"
                                alt="<?php echo $verticalCardDesktopImage['alt']; ?>" width="100%" height="400px"
                                class="img-fill">
                        </picture>
                    </a>
                    <?php 
if($verticalCardData['content']){
    ?>
                    <div class="content-wrapper"
                        style="background-color: <?php echo isset($verticalCardBackgroundColor) ? $verticalCardBackgroundColor : "none"; ?>">
                        <h2 class="h2 title center-align"
                            style="color: <?php echo $verticalCardTextColor ? $verticalCardTextColor : "white"; ?>">
                            <?php echo $verticalCardTitle;  ?>
                        </h2>
                        <p class="body1 subtitle center-align"
                            style="color: <?php echo $verticalCardTextColor ? $verticalCardTextColor : "white"; ?>">
                            <?php echo $verticalCardSubtitle;  ?>
                        </p>
                        <div class="price-wrapper center-align">
                            <span class="regular-price h3 "
                                style="text-decoration: <?php echo $verticalCardSalePrice ? "line-through" : "none"; ?>; color: <?php echo $verticalCardTextColor ? $verticalCardTextColor : "white"; ?> ">$<?php echo $verticalCardRegularPrice;  ?></span>
                            <span class="sale-price h3"
                                style="color: <?php echo $verticalCardTextColor ? $verticalCardTextColor : "white"; ?>">$<?php echo $verticalCardSalePrice;  ?></span>
                        </div>
                        <div class="button-wrapper">
                            <a href="<?php echo htmlspecialchars($verticalCardLink); ?>" class="primary-button"
                                style="background-color: <?php echo isset($verticalCardButtonColorArr['background_color']) ? htmlspecialchars($verticalCardButtonColorArr['background_color']) : 'default-background-color'; ?>;
               color: <?php echo isset($verticalCardButtonColorArr['text_color']) ? htmlspecialchars($verticalCardButtonColorArr['text_color']) : 'default-text-color'; ?>;">
                                <?php echo htmlspecialchars($verticalCardLabel); ?>
                            </a>
                        </div>

                    </div>
                    <?php
} 
?>


                </div>
            </div>

        </div>
    </div>
</section>