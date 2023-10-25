<?php
/**
 * PHP version 7
 *
 * @package  Hooks
 */

defined( 'ABSPATH' ) || exit;

// --- Settings
add_filter( 'woocommerce_get_sections_shipping', array( '\MANCA\CoolCA\Settings\Main', 'add_tab_settings' ) );
add_filter( 'woocommerce_get_settings_shipping', array( '\MANCA\CoolCA\Settings\Main', 'get_tab_settings' ), 10, 2 );
add_action( 'woocommerce_update_options_coolca_shipping_options', array( '\MANCA\CoolCA\Settings\Main', 'update_settings' ) );

// --- Settings - Prices
add_action( 'woocommerce_admin_field_coolca-prices', array( '\MANCA\CoolCA\Settings\PriceForm', 'render' ) );
add_action( 'woocommerce_settings_save_shipping', array( '\MANCA\CoolCA\Settings\Main', 'save' ) );

// --- Shipment Method
add_filter( 'woocommerce_shipping_methods', array( 'CoolCA', 'add_shipping_method' ) );

// --- CheckOut Fields
add_action( 'woocommerce_checkout_update_order_meta', array( '\MANCA\CoolCA\CheckOut\BranchField', 'checkout_update_order_meta' ) );
add_filter( 'woocommerce_order_details_before_order_table', array( '\MANCA\CoolCA\CheckOut\BranchField', 'display_fields' ) );
add_action( 'woocommerce_after_shipping_rate', array( '\MANCA\CoolCA\CheckOut\BranchField', 'shipping_point_field' ) );
add_filter( 'woocommerce_checkout_fields', array( '\MANCA\CoolCA\CheckOut\BranchField', 'override_checkout_fields' ) );

// --- Plugin Links
add_filter( 'plugin_action_links_' . plugin_basename( CoolCA::MAIN_FILE ), array( 'CoolCA', 'create_settings_link' ) );

// --- Run Import Manually
add_action( 'admin_menu', array( '\MANCA\CoolCA\Export\Main', 'create_menu_option' ) );

// --- Add Scripts
add_action( 'admin_enqueue_scripts', array( 'CoolCA', 'add_scripts' ) );
