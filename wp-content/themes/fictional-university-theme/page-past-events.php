<?php

get_header();
pageBanner(
    array(
        'title' => 'Past Events',
        'subtitle' => 'A recap of our past events'
    )

); ?>

<div class="container container--narrow page-section">

    <?php

    $today = date('Ymd');
    $past_events = new WP_Query(
        array(
            // below ads pagination for custom query
            'paged' => get_query_var('paged', 1),
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'order_by' => 'meta_value_num',
            'order' => 'ASC',
            // meta querys allow for customisation of posts and how they may be
            'meta_query' => array(
                // pseudo if statement if(key) compares to value display those posts
                array(
                    'key' => 'event_date',
                    'compare' => '<',
                    'value' => $today,
                    'type' => 'numeric'
                )
            )
        )
    );
    while ($past_events->have_posts()) {
        $past_events->the_post();
        get_template_part('template-parts/content-event');
    }


    // pagination does not work on custom querys, must be modified.
    echo paginate_links(
        array(
            'total' => $past_events->max_num_pages
        )
    );
    ?>
</div>

<?php

get_footer(); ?>