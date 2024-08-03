<?php
// Assume you have some ACF fields you want to pass to the template
            $sectionTitle = get_sub_field('section_title');
            $rowTitle = get_sub_field('title');
            $description = get_sub_field('description');
            $image = get_sub_field('image');
            $imageAlignment = get_sub_field('image_alignment');
            $iconsArr = get_sub_field('icons');
            $ctaData = get_sub_field('cta');
            $trailingValue = 0; 

?>

<section class=" row-layout">
    <?php 
    // check if the section title exists 
    if($sectionTitle){ 
        ?>
    <h2 class="center-align h3 bold"><?php echo $sectionTitle;  ?></h2>
    <?php 
    }
    ?>
    <div class="wrapper row-container"
        style="flex-direction:<?php echo $imageAlignment === "left" ? "row-reverse" : "row";  ?>">
        <div class="content-wrapper">
            <div class="icon-wrapper">
                <?php 
                if($iconsArr){ 
                // Loop through the icons array
                foreach($iconsArr as $icon){
                    $trailingValue++; 
                    $svgIcon = $icon['svg_icon'];
                    $iconLabel = $icon['label'];
                    ?>
                <div class="icon"
                    style="border-radius:<?php echo $iconLabel ? "50px" : "50%" ?>; width: <?php echo $iconLabel ? "auto" : "73px" ?>">
                    <div class="svg-wrapper"> <img src="<?php echo $svgIcon['url']; ?>"
                            alt="<?php echo $svgIcon['alt'] ? $svgIcon['alt'] : "svg icons" ?> " height="30px"
                            width="30px" defer loading="lazy">
                    </div>
                    <p class="body1 icon-text"><?php echo $iconLabel;  ?></p>
                </div>
                <?php
                }
            }
                ?>
            </div>
            <h2 class="h2 title"><?php  echo $rowTitle;  ?></h2>
            <div class="body1"><?php echo $description;  ?></div>
            <?php
                if(!empty($ctaData)) {
                    ?>
            <a class="primary-button" href="<?php echo $ctaData['url']; ?>">

                <span><?php echo $ctaData['title'];  ?>
                </span>
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
            </a>
            <?php
                }
            ?>
        </div>
        <style>
        <?php echo ".row-layout .image-wrapper-".$trailingValue;

        ?> {
            padding-bottom: <?php echo ($image['height']/$image['width'])*50?>%;
        }

        @media(max-width: 1020px) {
            <?php echo ".row-layout .image-wrapper-".$trailingValue;

            ?> {
                padding-bottom: <?php echo ($image['height']/$image['width'])*100?>%;
            }
        }
        </style>
        <div class="image-wrapper image-wrapper-<?php echo $trailingValue;  ?>">
            <picture>
                <source media="(min-width:600px)" srcset="<?php echo $image['sizes']['large']; ?>">
                <img src="<?php echo $image['sizes']['woocommerce_thumbnail']; ?>"
                    alt="<?php echo $image['alt'] ? $image['alt'] : $rowTitle; ?>" width="100%" height="400px" defer
                    loading="lazy">
            </picture>
        </div>
    </div>
</section>