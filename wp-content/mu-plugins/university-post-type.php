<?php
function university_post_types()
{
    // event post type
    register_post_type(
        // posttype is the slug for the url 'event' in this case unless rewrite used
        'event',
        array(
            // makes custom post time available in restful API
            'show_in_rest' => true,
            // must inclie show inrest and supports => editor to see modern block editor
            'supports' => array(
                'title',
                'editor',
                'excerpt'
            ),
            'rewrite' => array(
                'slug' => 'events'
            ),
            'has_archive' => true,
            'public' => true,
            'labels' => array(
                'name' => 'Events',
                'show_in_rest' => true,
                'add_new_item' => 'Add New Event',
                'edit_item' => 'Edit Event',
                'all_items' => 'All Events',
                'singular_name' => 'Event'

            ),
            'menu_icon' => 'dashicons-calendar'
        )
    );

    register_post_type(
        // posttype is the slug for the url 'event' in this case unless rewrite used
        'program',
        array(
            // makes custom post time available in restful API
            'show_in_rest' => true,
            // must inclie show inrest and supports => editor to see modern block editor
            'supports' => array(
                'title',
                'editor'
            ),
            'rewrite' => array(
                'slug' => 'program'
            ),
            'has_archive' => true,
            'public' => true,
            'labels' => array(
                'name' => 'Programs',
                'show_in_rest' => true,
                'add_new_item' => 'Add New Program',
                'edit_item' => 'Edit Program',
                'all_items' => 'All Programs',
                'singular_name' => 'Program'

            ),
            'menu_icon' => 'dashicons-awards'
        )
    );

    register_post_type(
        // posttype is the slug for the url 'event' in this case unless rewrite used
        'professor',
        array(
            // makes custom post time available in restful API
            'show_in_rest' => true,
            // must inclie show inrest and supports => editor to see modern block editor
            'supports' => array(
                'title',
                'editor',
                'thumbnail'
            ),
            'public' => true,
            'labels' => array(
                'name' => 'Professors',
                'show_in_rest' => true,
                'add_new_item' => 'Add New Professor',
                'edit_item' => 'Edit Professor',
                'all_items' => 'All Professors',
                'singular_name' => 'Professor'

            ),
            'menu_icon' => 'dashicons-welcome-learn-more'
        )
    );
}

add_action('init', 'university_post_types');