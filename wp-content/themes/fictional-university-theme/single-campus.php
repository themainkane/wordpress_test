<?php
get_header();


while (have_posts()) {
    the_post();
    pageBanner();
    ?>


    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i
                        class="fa fa-home" aria-hidden="true"></i> All Campuses
                </a>
                <span class="metabox__main">
                    <?php the_title(); ?>
                </span>
            </p>
        </div>
        <div class="generic-content">
            <?php the_content(); ?>
        </div>

        <div class="acf-map">
            <?php
            $mapLocation = get_field('map_location') ?>
            <div class="marker" data-lat="<?= $mapLocation['lat']; ?>" data-lng="<?= $mapLocation['lng']; ?>">
                <h3>
                    <?php the_title(); ?>
                </h3>
                <?= $mapLocation['address'] ?>
            </div>
        </div>

        <?php

        $relatedPrograms = new WP_Query(
            array(
                'posts_per_page' => -1,
                'post_type' => 'program',
                'order_by' => 'title',
                'order' => 'ASC',
                // meta querys allow for customisation of posts and how they may be
                'meta_query' => array(
                    // pseudo if statement if(key) compares to value display those posts
                    array(
                        'key' => 'related_campus',
                        'compare' => 'LIKE',
                        'value' => '"' . get_the_ID() . '"'
                    )
                )
            )
        );
        if ($relatedPrograms->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium"> Programs available at this campus:</h2>';

            echo '<ul class="min-list link-list">';
            while ($relatedPrograms->have_posts()) {
                $relatedPrograms->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                        </span>

                </li>
            <?php }
            echo '</ul>';
        }

        // resets the id to the relevant URL, must run between custom queries
        wp_reset_postdata();

        // $today = date('Ymd');
        $relatedEvents = new WP_Query(
            array(
                'posts_per_page' => -1,
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'order_by' => 'meta_value_num',
                'order' => 'ASC',
                // meta querys allow for customisation of posts and how they may be
                'meta_query' => array(
                    // pseudo if statement if(key) compares to value display those posts
                    array(
                        'key' => 'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type' => 'numeric'
                    ),
                    array(
                        'key' => 'related_campus',
                        'compare' => 'LIKE',
                        'value' => '"' . get_the_ID() . '"'
                    )
                )
            )
        );
        if ($relatedEvents->have_posts()) {
            echo '<hr class= "section-break">';
            echo '<h2 class= "headline headline--medium"> Related Events </h2>';
            while ($relatedEvents->have_posts()) {
                $relatedEvents->the_post();
                get_template_part('template-parts/content-event');
            }
        } ?>
    </div>

<?php }

get_footer();

?>