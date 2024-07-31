<?php 
get_header();
do_action('webduel_hero_section');  
?>
<div class="body-container index-page margin-row ">


    <?php 

            while(have_posts()){
                the_post(); 
               
                    ?>
    <div class="title-wrapper center-align">
        <div class="row-container">
            <?php 
                                if ( function_exists('yoast_breadcrumb') ) {
                                    yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                                  }
                        ?>
            <h1 class="h2 center-align"><?php the_title();?></h1>
        </div>

    </div>

    <div class="content row-container">
        <?php the_content();
            //    row layouts 
                        get_template_part('inc/templates/row-layout');
                    
            ?>
    </div>

    <?php
            }
        ?>

</div>


<?php 
    get_footer();
?>