<?php

/*
Plugin Name: Shapely Companion by Geogo
Plugin URI: https://www.linkedin.com/in/avishekjana/
Description: Custom WordPress Plugin to make all geogo widgets available for use.
Author: Avishek Jana
Version: 1
Author URI: https://www.linkedin.com/in/avishekjana/
*/

// Theme assets for this plugin
function shapely_companion_geogo_enqueued_assets() {
  wp_enqueue_style('geogo-companion-css-file', plugin_dir_url(__FILE__) . '/css/style.css', '', time());
}
add_action('wp_enqueue_scripts', 'shapely_companion_geogo_enqueued_assets');


// Admin assets for this plugin
function go_features_enqueued_js() {
  wp_enqueue_script('features_cloneya_js', plugin_dir_url(__FILE__) . '/js/jquery-cloneya.js', array( 'jquery' ) );
  wp_enqueue_script('features-js-file', plugin_dir_url(__FILE__) . '/js/script.js', array('jquery'), '1.0.0', false);
}
add_action('admin_enqueue_scripts', 'go_features_enqueued_js');

// Add widgets
require_once plugin_dir_path( __FILE__ ) . '/widgets/class-shapely-geogo-fullwidth-section.php';
require_once plugin_dir_path( __FILE__ ) . '/widgets/class-shapely-geogo-offering-section.php';
require_once plugin_dir_path( __FILE__ ) . '/widgets/class-shapely-geogo-services-section.php';
require_once plugin_dir_path( __FILE__ ) . '/widgets/class-shapely-geogo-projects-section.php';
require_once plugin_dir_path( __FILE__ ) . '/widgets/class-shapely-geogo-projects-wide-section.php';
require_once plugin_dir_path( __FILE__ ) . '/widgets/class-shapely-geogo-testimonials-section.php';

?>
