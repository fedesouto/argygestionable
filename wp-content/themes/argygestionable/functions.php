<?php

function argytec_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
}

add_action('after_setup_theme', 'argytec_theme_support');

function argytec_register_custom_nav_walker()
{
    $location = get_template_directory() . '/classes/class-argytec-walker-nav-menu.php';
    require($location);
}

add_action('after_setup_theme', 'argytec_register_custom_nav_walker');

function argytec_menus()
{

    $locations = array(
        'primary' => 'Primary Navigation Menu',
        'footer' => 'Footer Menu Items'
    );

    register_nav_menus($locations);
}

add_action('init', 'argytec_menus');


function argytec_register_styles()
{

    wp_enqueue_style('argytec_customcss', get_template_directory_uri() . "/style.css", array('argytec_bootstrap'), '1.0', 'all');
    wp_enqueue_style('argytec_bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css", array(), '5.3.0', 'all');
}

add_action('wp_enqueue_scripts', 'argytec_register_styles');

function argytec_register_scripts()
{

    wp_enqueue_script('argytec_scripts', get_template_directory_uri() . '/assets' . '/js' . '/main.js', array(), '1.0', 'all');
    wp_enqueue_script('argytec_bootstrap_scripts', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js", array(), '1.0', 'all');
}

add_action('wp_enqueue_scripts', 'argytec_register_scripts');

function argytec_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'argytec_add_woocommerce_support');


// Custom Loop template

function argytec_template_loop_product_title()
{
    echo '<h3 class="card-title ' . esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title')) . '">' . get_the_title() . '</h3>';
}

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'argytec_template_loop_product_title', 10);


function argytec_template_loop_product_thumbnail()
{
    echo '<img class="card-img-top" src="' . get_the_post_thumbnail_url() . '">';
}


remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
add_action('woocommerce_before_shop_loop_item_title', 'argytec_template_loop_product_thumbnail');

function argytec_template_loop_product_card_body_open()
{
    echo '<div class="card-body text-center p-4">';
}

add_action('woocommerce_before_shop_loop_item_title', 'argytec_template_loop_product_card_body_open');

function argytec_template_loop_product_card_body_close() {
    echo '</div>';
}
add_action( 'woocommerce_after_shop_loop_item', 'argytec_template_loop_product_card_body_close' );
