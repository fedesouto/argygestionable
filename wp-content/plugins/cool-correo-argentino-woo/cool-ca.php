<?php
/**
 * Plugin Name: Cool Correo Argentino for WooCommerce
 * Description: Método de Envío de WooCommerce para Correo Argentino.
 * Version: 1.1.1
 * Requires PHP: 7.0
 * Author: MANCA
 * Author URI: https://manca.com.ar
 * Text Domain: cool-ca
 * WC requires at least: 5.4.1
 * WC tested up to: 5.6.0
 *
 * @package MANCA\CoolCA;
 */

use MANCA\CoolCA\Helper\Helper;

defined( 'ABSPATH' ) || exit;

add_action( 'plugins_loaded', array( 'CoolCA', 'init' ) );

/**
 * Plugin's base Class
 */
class CoolCA {

	const VERSION     = '1.1.1';
	const PLUGIN_NAME = 'cool-correo-argentino-for-woocommerce';
	const MAIN_FILE   = __FILE__;
	const MAIN_DIR    = __DIR__;

	/**
	 * Checks system requirements
	 *
	 * @return bool
	 */
	public static function check_system() {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		$system = self::check_components();

		if ( $system['flag'] ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
			echo '<div class="notice notice-error is-dismissible">';
			/* translators: %s: System Flag */
			echo '<p>' . sprintf( __( '<strong>%1$s/strong> Requiere al menos %2$s versión %3$s o superior.', 'cool-ca' ), esc_html( self::PLUGIN_NAME ), esc_html( $system['flag'] ), esc_html( $system['version'] ) ) . '</p>';
			echo '</div>';
			return false;
		}

		if ( ! class_exists( 'WooCommerce' ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
			echo '<div class="notice notice-error is-dismissible">';
			/* translators: %s: Plugin Name */
			echo '<p>' . sprintf( __( 'WooCommerce debe estar activo antes de usar <strong>%s</strong>', 'cool-ca' ), esc_html( self::PLUGIN_NAME ) ) . '</p>';
			echo '</div>';
			return false;
		}
		return true;
	}

	/**
	 * Check the components required for the plugin to work (PHP, WordPress and WooCommerce)
	 *
	 * @return array
	 */
	private static function check_components() {
		global $wp_version;
		$flag    = false;
		$version = false;

		if ( version_compare( PHP_VERSION, '7.0', '<' ) ) {
			$flag    = 'PHP';
			$version = '7.0';
		} elseif ( version_compare( $wp_version, '5.4', '<' ) ) {
			$flag    = 'WordPress';
			$version = '5.4';
		} elseif ( ! defined( 'WC_VERSION' ) || version_compare( WC_VERSION, '4.3', '<' ) ) {
			$flag    = 'WooCommerce';
			$version = '4.3';
		}

		return array(
			'flag'    => $flag,
			'version' => $version,
		);
	}

	/**
	 * Inits our plugin
	 *
	 * @return void|bool
	 */
	public static function init() {
		if ( ! self::check_system() ) {
			return false;
		}

		spl_autoload_register(
			function ( $class ) {
				// Plugin base Namespace.
				if ( strpos( $class, 'CoolCA' ) === false ) {
					return;
				}
				$class     = str_replace( '\\', '/', $class );
				$parts     = explode( '/', $class );
				$classname = array_pop( $parts );

				$filename = $classname;
				$filename = str_replace( 'WooCommerce', 'Woocommerce', $filename );
				$filename = str_replace( 'WC_', 'Wc', $filename );
				$filename = str_replace( 'WC', 'Wc', $filename );
				$filename = preg_replace( '/([A-Z])/', '-$1', $filename );
				$filename = 'class' . $filename;
				$filename = strtolower( $filename );
				$folder   = strtolower( array_pop( $parts ) );
				if ( 'class-coolca' === $filename ) {
					return;
				}
				require_once plugin_dir_path( __FILE__ ) . 'src/' . $folder . '/' . $filename . '.php';
			}
		);
		include_once __DIR__ . '/hooks.php';
		Helper::init();
		self::load_textdomain();

	}

	/**
	 * Create a link to the settings page, in the plugins page
	 *
	 * @param array $links Array of Links.
	 * @return array
	 */
	public static function create_settings_link( array $links ) {
		$link = '<a href="' . esc_url( get_admin_url( null, 'admin.php?page=wc-settings&tab=shipping&section=coolca_shipping_options' ) ) . '">' . __( 'Ajustes', 'cool-ca' ) . '</a>';
		array_unshift( $links, $link );
		$link = '<a href="' . esc_url( 'https://www.correoargentino.com.ar/MiCorreo/public/files/lista-de-precios-PY-MiCorreo.pdf?20210121130012' ) . '" target="_blank">' . __( 'Precios RI', 'cool-ca' ) . '</a>';
		array_unshift( $links, $link );
		$link = '<a href="' . esc_url( 'https://www.correoargentino.com.ar/MiCorreo/public/files/lista-de-precios-CF-MiCorreo.pdf?20210121130012' ) . '" target="_blank">' . __( 'Precios CF', 'cool-ca' ) . '</a>';
		array_unshift( $links, $link );
		return $links;
	}

	/**
	 * Adds our shipping method to WooCommerce
	 *
	 * @param array $shipping_methods Array of Shipping Methods.
	 * @return array
	 */
	public static function add_shipping_method( $shipping_methods ) {
		$shipping_methods['coolca'] = '\MANCA\CoolCA\ShippingMethod\WC_CoolCA';
		return $shipping_methods;
	}

	/**
	 * Loads the plugin text domain
	 *
	 * @return void
	 */
	public static function load_textdomain() {
		load_plugin_textdomain( 'cool-ca', false, basename( dirname( __FILE__ ) ) . '/i18n/languages' );
	}

	/**
	 * Agregar CSS + JS
	 *
	 * @return void
	 */
	public static function add_scripts() {
		wp_register_style( 'bootstrap', Helper::get_assets_folder_url() . '/css/bootstrap.min.css', array(), self::VERSION );
		wp_register_script( 'bootstrap', Helper::get_assets_folder_url() . '/js/bootstrap.min.js', array( 'jquery' ), true, 'in_footer', self::VERSION );
		wp_register_style( 'coolca-export', Helper::get_assets_folder_url() . '/css/export.css', array(), self::VERSION );
	}
}

