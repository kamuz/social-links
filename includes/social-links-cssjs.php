<?php

function kmz_sl_css_js(){
    wp_enqueue_style('kmz_sl_style', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_script('kmz_sl_script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery'), '0.0.1', true);
}
add_action('wp_enqueue_scripts', 'kmz_sl_css_js');