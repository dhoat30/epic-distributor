<?php 
get_header();
do_action('webduel_hero_section');  

// truncate excerpt 
function custom_truncate($text, $length = 20) {
    $text = strip_shortcodes($text);
    $text = wp_strip_all_tags($text);
    if (strlen($text) > $length) {
        $text = substr($text, 0, $length) . '...';
    }
    return $text;
}

function custom_excerpt_or_truncate($length = 40) {
    if (has_excerpt()) {
        $excerpt = get_the_excerpt();
        echo custom_truncate($excerpt, $length);
    } else {
        $content = get_the_content();
        echo custom_truncate($content, $length);
    }
}
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

    <div class="content-wrapper row-container">
        <div class="cards">
            <?php
        // Custom query to fetch 'blogs' custom post type
        $args = array(
            'post_type' => 'blogs', // Change 'blogs' to your custom post type
            'posts_per_page' => 10, // Number of posts to display
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1 // For pagination
        );

        $blogs_query = new WP_Query($args);

        if ($blogs_query->have_posts()) :
            while ($blogs_query->have_posts()) : $blogs_query->the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
                <div class="entry-header">

                    <a href="<?php the_permalink(); ?>" class="image-wrapper" style="padding-bottom: 56.25%; ">
                        <?php if (has_post_thumbnail()) : 
                            $thumbnail_id = get_post_thumbnail_id();
                            $medium_image = wp_get_attachment_image_src($thumbnail_id, 'medium');
                            $large_image = wp_get_attachment_image_src($thumbnail_id, 'large');
                          
                            ?>
                        <picture>
                            <source media="(min-width: 480px)" srcset="<?php echo esc_url($large_image[0]); ?>">
                            <img class="img-fill" src="<?php echo esc_url($medium_image[0]); ?>" alt="" width="100%"
                                height="300px">
                        </picture>
                        <?php endif; ?>
                    </a>


                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>" class="h5"><?php the_title(); ?></a>
                    </h2>
                </div>

                <div class="entry-content">
                    <?php custom_excerpt_or_truncate(120); ?>
                </div>


                <a href="<?php the_permalink(); ?>" class="read-more link-text">Read More</a>

            </article>
            <?php endwhile; ?>

            <div class="pagination">
                <?php
                // Pagination
                echo paginate_links(array(
                    'total' => $blogs_query->max_num_pages
                ));
                ?>
            </div>

            <?php else : ?>
            <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'textdomain'); ?></p>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        </div>
    </div>

    <?php
            }
        ?>

</div>


<?php 
    get_footer();
?>