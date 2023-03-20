<?php

function argytec_theme_support() {
    // Adds dynamic title tag
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'argytec_theme_support');

function argytec_menus() {

    $locations = array(
        'primary' => 'Primary Navigation Menu',
        'footer' => 'Footer Menu Items'
    );

    register_nav_menus($locations);

}

add_action('init', 'argytec_menus');


function argytec_register_styles() {

    wp_enqueue_style('argytec_customcss', get_template_directory_uri() . "/style.css", array('argytec_bootstrap'), '1.0', 'all');
    wp_enqueue_style('argytec_bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css", array(), '5.3.0', 'all');


}

function argytec_register_scripts() {

    wp_enqueue_script('argytec_scripts', get_template_directory_uri() . '/assets' . '/js' . '/main.js', array(), '1.0', 'all');
    wp_enqueue_script('argytec_bootstrap_scripts', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js", array(), '1.0', 'all');
}




add_action('wp_enqueue_scripts', 'argytec_register_styles');
add_action('wp_enqueue_scripts', 'argytec_register_scripts');


?>