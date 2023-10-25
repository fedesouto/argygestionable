<?php
/**
 * Helper Class
 *
 * @package  MANCA\CoolCA\Helper
 */

namespace MANCA\CoolCA\Helper;

/**
 * Helper Main Class
 */
class Helper {
	use WooCommerceTrait;
	use CABranchTrait;
	use CACostTrait;
	use AssetTrait;
	use DatabaseTrait;
	use SettingsTrait;
	use DebugTrait;
	use LoggerTrait;
	use TemplateTrait;

	/**
	 * Returns an url pointing to the main filder of the plugin assets
	 *
	 * @param string $string string input.
	 * @return string
	 */
	public static function remove_special_chars( $string = '' ) {

		$string = str_replace( 'á', 'a', $string );
		$string = str_replace( 'é', 'e', $string );
		$string = str_replace( 'í', 'i', $string );
		$string = str_replace( 'ó', 'o', $string );
		$string = str_replace( 'ú', 'u', $string );
		$string = str_replace( 'ñ', 'n', $string );
		$string = str_replace( 'Á', 'A', $string );
		$string = str_replace( 'É', 'E', $string );
		$string = str_replace( 'Í', 'I', $string );
		$string = str_replace( 'Ó', 'O', $string );
		$string = str_replace( 'Ú', 'U', $string );
		$string = str_replace( 'Ñ', 'N', $string );
		$string = preg_replace( '[^A-Za-z0-9 ;.@_]', ' ', $string );
		$string = iconv( 'utf-8', 'ascii//TRANSLIT', $string );
		$string = str_replace( '(', ' ', $string );
		$string = str_replace( ')', ' ', $string );
		$string = str_replace( "'", ' ', $string );
		$string = str_replace( '"', ' ', $string );
		$string = str_replace( '[', ' ', $string );
		$string = str_replace( ']', ' ', $string );
		$string = str_replace( '{', ' ', $string );
		$string = str_replace( '}', ' ', $string );
		$string = str_replace( '#', ' ', $string );
		$string = str_replace( '?', ' ', $string );
		$string = str_replace( ',', ' ', $string );
		$string = str_replace( '/', ' ', $string );
		$string = str_replace( '-', ' ', $string );
		$string = str_replace( ':', ' ', $string );
		$string = str_replace( '  ', ' ', $string );

		return $string;
		/**
		 * Commented, FIXIT.
		 * return utf8_encode($string);
		 */
	}
}
