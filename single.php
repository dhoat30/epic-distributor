<?php 
get_header();
do_action('webduel_hero_section');  
?>
<div class="body-container margin-row blogs-container">
    <?php 
            while(have_posts()){
                the_post();      

                    ?>
    <div class="row-container container">
        <?php echo do_shortcode('[webduel_toc]');?>
        <div class="content-container">
            <div class="title-wrapper">
                <?php 
                                if ( function_exists('yoast_breadcrumb') ) {
                                    yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                                  }
                        ?>
                <h1 class="h2 title"><?php the_title();?></h1>
                <!-- get featured image  -->
                <?php
                 if (has_post_thumbnail()) {
                    $thumbnail_id = get_post_thumbnail_id();
                    $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
    
                    $large_image_url = wp_get_attachment_image_url($thumbnail_id, 'large');
                    $medium_image_url = wp_get_attachment_image_url($thumbnail_id, 'medium');
                    $small_image_url = wp_get_attachment_image_url($thumbnail_id, 'thumbnail');

                    $metadata = wp_get_attachment_metadata($thumbnail_id);
                    $width = $metadata['width'];
                    $height = $metadata['height'];
                    $aspect_ratio = ($height / $width) * 100;
             
                 
                ?>
                <div class="post-thumbnail image-wrapper" style="padding-bottom: <?php echo $aspect_ratio; ?>%;">
                    <picture>
                        <source media="(min-width: 480px)" srcset="<?php echo esc_url($large_image_url); ?>">
                        <img class="img-fill" src="<?php echo esc_url($medium_image_url); ?>"
                            alt="<?php echo esc_attr($thumbnail_alt); ?>" width="100%" height="300px">
                    </picture>
                </div>
                <?php 
                 }
                 ?>
            </div>

            <?php 
        if(get_the_content()){ 
            ?>

            <div class="content-wrapper">
                <?php 
        the_content(); 
            ?>
            </div>
            <?php 
        }
        ?>
        </div>
    </div>
    <?php
            }
        ?>

</div>


<?php 
    get_footer();
?>