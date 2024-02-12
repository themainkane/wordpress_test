<?php

get_header(); ?>

<div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>)">
    </div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">
            See Our Events
        </h1>
        <div class="page-banner__intro">
            <p>Past Events
            </p>
        </div>
    </div>
</div>

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
        $past_events->the_post(); ?>
        <div class="event-summary">
            <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
                <span class="event-summary__month">
                    <!-- correctly format event date using inbuilt DateTime class -->
                    <?php $eventDate = new DateTime(get_field('event_date'));
                    echo $eventDate->format('M'); ?>
                </span>
                <span class="event-summary__day">
                    <?php $eventDate = new DateTime(get_field('event_date'));
                    echo $eventDate->format('d'); ?>
                </span>
            </a>
            <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>">
                        <?php the_title() ?>
                    </a></h5>
                <p>
                    <?php wp_trim_words(get_the_content(), 15); ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn
                        more</a>
                </p>
            </div>
        </div>

    <?php }
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