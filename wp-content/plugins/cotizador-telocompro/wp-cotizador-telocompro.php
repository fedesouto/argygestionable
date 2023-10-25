<?php

/**
 * Plugin Name: Cotizador Telocompro
 * Author: Argytec
 * Author URI: https://argytec.com
 * Version: 1.0.0
 * Description: Cotizador Telocompro.
 * Text-Domain: wp-cotizador-telocompro
 */

if (!defined('ABSPATH')) : exit();
endif; // No direct access allowed.

/**
 * Define Plugins Contants
 */
define('CTLC_PATH', trailingslashit(plugin_dir_path(__FILE__)));
define('CTLC_URL', trailingslashit(plugins_url('/', __FILE__)));

/**
 * Loading Necessary Scripts
 */
add_action('admin_enqueue_scripts', 'load_scripts');
function load_scripts()
{
    wp_enqueue_script('wp-cotizador-telocompro', CTLC_URL . 'dist/backoffice.bundle.js', ['jquery', 'wp-element'], wp_rand(), true);
    wp_localize_script('wp-cotizador-telocompro', 'appLocalizer', [
        'apiUrl' => home_url('/wp-json'),
        'nonce' => wp_create_nonce('wp_rest'),
    ]);
}

function custom_shortcode_scripts()
{
    global $post;
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'cotizador')) {
        wp_enqueue_style('bootstrap_styles', CTLC_URL . 'vendor/bootstrap-5.1.3-dist/css/bootstrap.min.css');
        wp_enqueue_script('bootstrap', CTLC_URL . 'vendor/bootstrap-5.1.3-dist/js/bootstrap.js', ['jquery', 'wp-element']);
        wp_enqueue_script('wp-cotizador-telocompro-form', CTLC_URL . 'dist/frontend.bundle.js', ['bootstrap']);
    }
}
add_action('wp_enqueue_scripts', 'custom_shortcode_scripts');


require_once CTLC_PATH . 'classes/class-create-admin-menu.php';
require_once CTLC_PATH . 'classes/class-create-settings-routes.php';
require_once CTLC_PATH . 'classes/class-create-frontend-shortcode.php';
