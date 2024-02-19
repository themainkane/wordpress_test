<?php

// function pageBanner($args = null)
// {
//   if (!isset($args['title'])) {
//     $args['title'] = get_the_title();
//   }

//   if (!isset($args['subtitle'])) {
//     $args['subtitle'] = get_field('page_banner_subtitle');
//   }
//   if (!isset($args['photo'])) {
//     if (get_field('page_banner_background_image') and !is_archive() and !is_home()) {
//       $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
//     } else {
//       $args['photo'] = get_theme_file_uri('images/ocean.jpg');
//     }
//   }

//  
// }

// ******simplified from the messy if statements in the course. 
function pageBanner($args = null)
{
  $title = $args['title'] ?? get_the_title();
  $subtitle = $args['subtitle'] ?? get_field('page_banner_subtitle');
  $photo = $args['photo'] ?? (
    get_field('page_banner_background_image') && !is_archive() && !is_home() ?
    get_field('page_banner_background_image')['sizes']['pageBanner'] :
    get_theme_file_uri('images/ocean.jpg')
  );
  ?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?= $photo ?>)">
    </div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">
        <?= $title ?>
      </h1>
      <div class="page-banner__intro">
        <p>
          <?= $subtitle ?>
        </p>
      </div>
    </div>
  </div>
  <?php
}
function university_files()
{
  wp_enqueue_script('google-map', "//maps.googleapis.com/maps/api/js?key=AIzaSyCgG-PbuJR4kVlt24YVWQiIgPiJ4e26X84", NULL, '1.0', true);
  wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_action('wp_enqueue_scripts', 'university_files');

function universtiy_features()
{
  // register_nav_menu('headerMenuLocation', 'Header Menu Location');
  // register_nav_menu('footerLocationOne', 'Footer Location One');
  // register_nav_menu('footerLocationTwo', 'Footer Location Two');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  // custom cropping can be acheived by the array as the last argument. 
  // add_image_size('professorLandscape', 400, 260, array('left', 'top'));
  add_image_size('professorLandscape', 400, 260, true);
  add_image_size('professorPortrait', 480, 650, true);
  add_image_size('pageBanner', 1500, 350, true);
}
add_action('after_setup_theme', 'universtiy_features');

function university_adjust_queries($query)
{
  if (!is_admin() and is_post_type_archive('campus') and $query->is_main_query()) {
    $query->set('posts_per_page', -1);
  }

  if (!is_admin() and is_post_type_archive('program') and $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }

  $today = date('Ymd');
  if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
    $query->set('meta_key', 'event_date');
    $query->set('order_by', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_key', 'event_date');
    $query->set(
      'meta_query',
      array(
        array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
        )
      )
    );
  }
}

add_action('pre_get_posts', 'university_adjust_queries');

function university_map_key($api)
{
  $api['key'] = 'AIzaSyCgG-PbuJR4kVlt24YVWQiIgPiJ4e26X84';
  return $api;
}

add_filter('acf/fields/google_map/api', 'university_map_key');

