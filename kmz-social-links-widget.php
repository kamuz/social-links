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

// Exit if Access Directly
if(!defined('ABSPATH')){
    exit;
}

// Load Scripts and Styles
require_once(plugin_dir_path(__FILE__) . '/includes/social-links-cssjs.php');

// Load Class
require_once(plugin_dir_path(__FILE__) . '/includes/social-links-class.php');

// Register widget
function kmz_register_social_links_widget() {
    register_widget( 'Social_Links_Widget' );
}
add_action('widgets_init', 'kmz_register_social_links_widget');