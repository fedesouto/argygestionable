<?php
/**
 * Export Page Class
 *
 * @package  MANCA\CoolCA\Export
 */

namespace  MANCA\CoolCA\Export;

defined( 'ABSPATH' ) || exit;

use MANCA\CoolCA\Helper\Helper;
/**
 * Main Plugin Process Class
 */
class Main {
	/**
	 * Creates Process Page
	 *
	 * @return void
	 */
	public static function create_menu_option() {
		add_submenu_page(
			'woocommerce',
			__( 'Exporta Pedidos Correo Argentino', 'coolca' ),
			__( 'Exporta Pedidos Correo Argentino', 'coolca' ),
			'manage_woocommerce',
			'coolca-export',
			array( __CLASS__, 'page_content' )
		);

	}

	/**
	 * Displays process page
	 *
	 * @return void
	 */
	public static function page_content() {
		if ( ! is_admin() && ! current_user_can( 'manage_options' ) && ! current_user_can( 'manage_woocommerce' ) ) {
			die( esc_html__( 'what are you doing here?', 'coolca' ) );
		}

		$search      = false;
		$form_values = array(
			'from_dt_dflt'         => gmdate( 'Y-m-d' ),
			'to_dt_dflt'           => gmdate( 'Y-m-d' ),
			'curr_status'          => 'all',
			'cool-ca-export-nonce' => wp_create_nonce( 'cool-ca-export' ),
			'inc_free_shipping'    => '',
		);
		// TODO: Add Nonce Validation.
		$nonce_value    = wc_get_var( $_REQUEST['cool-ca-export-nonce'], '' ); // phpcs:ignore
		if (
			! empty( $nonce_value ) &&
			wp_verify_nonce(
				$nonce_value,
				'cool-ca-export'
			)
		) {
			$search = ( isset( $_POST['coolca_search'] ) ) ? true : false;

			$form_values['from_dt_dflt'] = filter_input(
				INPUT_POST,
				'coolca_from_dt',
				FILTER_SANITIZE_STRING
			);

			$form_values['to_dt_dflt'] = filter_input(
				INPUT_POST,
				'coolca_to_dt',
				FILTER_SANITIZE_STRING
			);

			$form_values['curr_status'] = filter_input(
				INPUT_POST,
				'coolca_status',
				FILTER_SANITIZE_STRING
			);

			$form_values['inc_free_shipping'] = ( isset( $_POST['coolca_include_free-shipping'] ) ) ? true : false;

		}

		Helper::get_template_part( 'export', 'header' );
		Helper::get_template_part( 'export', 'form', $form_values );
		if ( $search ) {
			Helper::get_template_part( 'export', 'results', $form_values );
		}
		wp_enqueue_style( 'coolca-export' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_script( 'bootstrap' );
	}


}
