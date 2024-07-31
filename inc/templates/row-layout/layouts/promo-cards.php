<?php 
  // Assume you have some ACF fields you want to pass to the template
  $title = get_sub_field('title');
  $promoCardsArr = get_sub_field('cards');


?>

<section class="promo-container">
    <div class="row-container">
        <?php 
// check if the section title exists 
if($title){ 
?>
        <h2 class="center-align h3"><?php echo $title;  ?></h2>
        <?php 
}
?>
        <div class="cards">
            <?php 
      $position = 0; 
foreach ($promoCardsArr as $card) {

?>
            <div class="card" style="position: relative; padding-bottom: 100%; 
      width: 100%;  ">
                <picture>
                    <source media="(min-width:600px)" srcset="<?php echo $card['image']['sizes']['medium']; ?>">
                    <img src="<?php echo $card['image']['sizes']['woocommerce_thumbnail']; ?>"
                        alt="<?php echo $card['image']['alt']; ?>" width="100%" height="400px"
                        loading="<?php echo $position !== 0 ? "lazy" : null ?> ">
                </picture>

            </div>
            <?php
       $position++;

}

?>
        </div>
    </div>
</section>