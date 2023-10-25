<?php
/**
 * Settings Main Class
 *
 * @package  MANCA\CoolCA\Settings
 */

namespace MANCA\CoolCA\Settings;

use MANCA\CoolCA\Settings\Section;
use MANCA\CoolCA\Helper\Helper;
use MANCA\CoolCA\SDK\BranchesSdk;
defined( 'ABSPATH' ) || exit;

/**
 * A main class that holds all our settings logic
 */
class Main {
	/**
	 * Add CoolCa Setting Tab
	 *
	 * @param Array $settings_tab Shipping Methods.
	 * @return Array Shipping Methods
	 */
	public static function add_tab_settings( $settings_tab ) {
		$settings_tab['coolca_shipping_options'] = __( 'Cool Correo Argentino' );
		return $settings_tab;
	}

	/**
	 * Get CoolCa Setting Tab
	 *
	 * @param Array  $settings Shipping Methods.
	 * @param string $current_section Section which is beaing processing.
	 * @return Array Shipping Method Settings
	 */
	public static function get_tab_settings( $settings, $current_section ) {
		if ( 'coolca_shipping_options' === $current_section ) {
			return Section::get();
		} else {
			return $settings;
		}
	}

	/**
	 * Get CoolCa Settings
	 *
	 * @return Array Shipping Methods
	 */
	public static function get_settings() {
		return apply_filters( 'wc_settings_coolca_shipping_options', Section::get() );
	}

	/**
	 * Update CoolCa Settings
	 *
	 * @return Void
	 */
	public static function update_settings() {
		woocommerce_update_options( self::get_settings() );
		return;
	}

	/**
	 * Save Coolca Settings
	 *
	 * @return Void
	 */
	public static function save() {

		// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		if ( empty( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( wp_unslash( $_REQUEST['_wpnonce'] ), 'woocommerce-settings' ) ) {
			echo '<div class="updated error"><p>' . esc_html__( 'Edit failed. Please try again.', 'woocommerce' ) . '</p></div>';
		}

		global $current_section;
		if ( 'coolca_shipping_options' === $current_section ) {

			$price_arr = filter_input( INPUT_POST, 'wc-coolca-price', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
			update_option( 'wc-coolca-price', $price_arr );

			$branches = BranchesSdk::get_branches();
			update_option( 'wc-coolca-branches', $branches );
		}
		return;
	}
}
