<?php
get_header();
?>

<?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $sliderArr = get_field("hero_slider"); 
            if(!empty($sliderArr)){
     
            ?>
<!-- home page -->
<section class="slider-container hero-slider">
    <div class="skeleton"></div>
    <div class="card-list">
        <?php 
            foreach ($sliderArr as $slider) {
              
   // Access the 'desktop_image' array
   $desktop_image = $slider['desktop_image'];
   $mobile_image = $slider['mobile_image'];
   $cta = $slider['link'];

   ?>

        <a href="<?php echo $cta['url']; ?> " aria-label="Show Now">
            <picture>
                <source media="(min-width:1366px)" srcset="<?php echo $desktop_image['sizes']['2048x2048']; ?>">
                <source media="(min-width:600px)" srcset="<?php echo $desktop_image['sizes']['large']; ?>">
                <img src="<?php echo $mobile_image['sizes']['woocommerce_thumbnail']; ?>"
                    alt="<?php echo $mobile_image['alt']; ?>" width="100%" height="400px">
            </picture>
        </a>

        <?php 
            } 
            ?>
    </div>
    <?php 
    }
?>
</section>
<?php 
            }
            ?>

<?php
} 
else {
    echo 'No content found for the home page';
}
    ?>


<!-- row layouts  -->
<?php 
        get_template_part('inc/templates/row-layout/row-layout');
        ?>

<?php 
        $testimonials = get_field('testimonials', 'option');
        if(!empty($testimonials)){
            ?>
<section class="testimonials-section">
    <div class="row-container">

        <?php 
                    $sectionTitle=$testimonials['title']; 
                    $sectionSubtitle = $testimonials['subtitle'];
                    $testimonialsArr= $testimonials['testimonial'];    
                    ?>
        <div class="title-wrapper">
            <p class="subtitle1 subtitle center-align"><?php echo $sectionSubtitle;  ?></p>
            <h2 class="center-align title h3"><?php echo $sectionTitle;  ?></h2>
        </div>
    </div>
    <div class="testimonials-wrapper row-container">
        <?php 
            foreach( $testimonialsArr as $data){ 
                $testimonial = $data['content'];
                $name = $data['name'];
                ?>
        <div class="testimonial-card">
            <div class="testimonial-name h4">
                <?php  echo $name; ?>
            </div>
            <div class="rating-stars">
                <?php 
                    for($i=0; $i<5; $i++){
                        ?>
                <svg width="16px" height="16px" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <polygon style="fill:#FCC153;"
                        points="256,12.652 177.157,173.261 0,198.569 128.486,323.164 98.314,499.348 256,416.609   413.686,499.348 383.514,323.164 512,198.569 334.843,173.261 " />

                </svg>
                <?php
                    } 
                    ?>

            </div>
            <div class="content body1">
                <?php echo $testimonial;  ?>
            </div>
        </div>
        <?php 
            }
            ?>
    </div>

</section>
<?php 
        } 

?>

<?php get_footer(); ?>