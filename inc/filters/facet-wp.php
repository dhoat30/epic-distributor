<?php 

// add facet label for each facet
function fwp_add_facet_labels() {
  ?>
<script>
(function($) {
    $(document).on('facetwp-loaded', function() {
        $('.facetwp-facet').each(function() {
            var facet = $(this);
            var facet_name = facet.attr('data-name');
            var facet_type = facet.attr('data-type');
            var facet_label = FWP.settings.labels[facet_name];
            if (facet_type !== 'pager' && facet_type !== 'sort') {
                if (facet.closest('.facet-wrap').length < 1 && facet.closest('.facetwp-flyout')
                    .length < 1) {
                    facet.wrap('<div class="facet-wrap"></div>');
                    facet.before('<h3 class="facet-label">' + facet_label + '</h3>');
                }
            }
        });
    });
})(jQuery);
</script>
<?php
}
 
add_action( 'wp_head', 'fwp_add_facet_labels', 100 );

// hide facet label is the facet is empty 
add_action( 'facetwp_scripts', function() {
    ?>
<script>
(function($) {
    document.addEventListener('facetwp-loaded', function() {
        $.each(FWP.settings.num_choices, function(key, val) {

            // assuming each facet is wrapped within a "facet-wrap" container element
            // this may need to change depending on your setup, for example:
            // change ".facet-wrap" to ".widget" if using WP text widgets

            var $facet = $('.facetwp-facet-' + key);
            var $wrap = $facet.closest('.facet-wrap');
            var $flyout = $facet.closest('.flyout-row');
            if ($wrap.length || $flyout.length) {
                var $which = $wrap.length ? $wrap : $flyout;
                (0 === val) ? $which.hide(): $which.show();
            }
        });
    });
})(jQuery);
</script>
<?php
  }, 100 );

//   search code 
add_action('pre_get_posts', 'limit_search_to_products');
function limit_search_to_products($query) {
    if ($query->is_search() && !is_admin()) {
        $query->set('post_type', 'product');
    }
}

// Modify the Search Query to Include Product Description, title and sky
add_filter('posts_search', 'custom_search_by_sku', 10, 2);
function custom_search_by_sku($search, $query) {
    if ($query->is_search() && !is_admin() && isset($query->query_vars['s']) && $query->get('post_type') === 'product') {
        global $wpdb;

        $search = '';
        $search_term = $query->query_vars['s'];

        // Check for product title
        $search .= "({$wpdb->posts}.post_title LIKE '%" . esc_sql($wpdb->esc_like($search_term)) . "%')";

        // Check for product description
        $search .= " OR ({$wpdb->posts}.post_content LIKE '%" . esc_sql($wpdb->esc_like($search_term)) . "%')";

        // Check for SKU
        $search .= " OR EXISTS (
            SELECT * FROM $wpdb->postmeta
            WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
            AND $wpdb->postmeta.meta_key = '_sku'
            AND $wpdb->postmeta.meta_value LIKE '%" . esc_sql($wpdb->esc_like($search_term)) . "%'
        )";

        $search = " AND ({$search})";

        return $search;
    }

    return $search;
}

function my_facetwp_indexer_post($post_id, $post) {
    if ('product' === $post->post_type) {
        $sku = get_post_meta($post_id, '_sku', true);
        if (!empty($sku)) {
            FWP()->indexer->index_row(array(
                'post_id' => $post_id,
                'facet_name' => 'sku',
                'facet_value' => $sku,
                'facet_display_value' => $sku,
            ));
        }
    }
}
add_action('facetwp_indexer_post', 'my_facetwp_indexer_post', 10, 2);