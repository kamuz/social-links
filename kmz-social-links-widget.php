<?php
/*
Plugin Name: KMZ Social Links Widget
Description: Custom widget for display set of social links
Version: 0.1
Author: Vladimir Kamuz
Author URI: https://wpdev.pp.ua
Plugin URI: https://wpdev.pp.ua/kmzsociallinks
Licence: GPL2
Text Domain: kmzsociallinks
*/

/**
 * Exit if Access Directly
 */
if(!defined('ABSPATH')){
    exit;
}

/**
 * Load Class
 */
require_once(plugin_dir_path(__FILE__) . '/social-links-class.php');

/**
 * Load Scripts and Styles
 */
function kmz_sl_css_js(){
    wp_enqueue_style('kmz_sl_style', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_script('kmz_sl_script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery'), '0.0.1', true);
}
add_action('wp_enqueue_scripts', 'kmz_sl_css_js');

/**
 * Register widget
 */
function kmz_register_social_links_widget() {
    register_widget( 'Social_Links_Widget' );
}
add_action('widgets_init', 'kmz_register_social_links_widget');