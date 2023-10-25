<?php
/**
 * Class SettingsTrait
 *
 * @package  MANCA\CoolCA\Helper
 */

namespace MANCA\CoolCA\Helper;

/**
 * Settings Trait
 */
trait SettingsTrait {


	/**
	 * Gets a plugin option
	 *
	 * @param string  $key meta_key.
	 * @param boolean $default default value for $key.
	 * @return mixed
	 */
	public static function get_option( string $key, $default = false ) {
		return get_option( 'wc-coolca-' . $key, $default );
	}

	/**
	 * Gets a plugin option
	 *
	 * @param string  $key meta_key.
	 * @param boolean $value value to set.
	 * @return mixed
	 */
	public static function set_option( string $key, $value = false ) {
		return update_option( 'wc-coolca-' . $key, $value );
	}

	/**
	 * Gets the seller settings
	 *
	 * @return array
	 */
	public static function get_setup_from_settings() {
		return array(
			'api-key'        => self::get_option( 'api-key' ),
			'vat'            => self::get_option( 'vat' ),
			'debug'          => self::get_option( 'debug' ),
			'prices'         => self::get_option( 'prices' ),
			'default-weight' => self::get_option( 'default-weight' ),
		);
	}

}
