<?php
/**
 * Setting Section Main Class
 *
 * @package  MANCA\CoolCA\Settings
 */

namespace MANCA\CoolCA\Settings;

use MANCA\CoolCA\Helper\Helper;
/**
 * CoolCA Setting Section Main
 */
class Section {

	/**
	 * Checks system requirements
	 *
	 * @return Array Fields Settings for CoolCA
	 */
	public static function get() {
		$logo_url = Helper::get_assets_folder_url() . '/img/isologo.jpg';

		$settings = array(
			array(
				/* translators: %s: logo url */
				'desc' => sprintf( __( '<div style="margin-top:50px;background-color:#FFCE00;padding: 10px 5px 10px 0px; border-radius: 0px 15px 0px 0px;"><img src="%s" ></div>', 'wc-coolca' ), $logo_url ),
				'type' => 'title',
				'id'   => 'wc-coolca_shipping_options',
			),
			array(
				'name' => __( 'API Key', 'wc-coolca' ),
				'type' => 'text',
				'id'   => 'wc-coolca-api-key',
			),
			array(
				'type' => 'sectionend',
				'id'   => 'wc-coolca_shipping_options',
			),

			array(
				'title' => __( 'Precios', 'wc-coolca' ),
				'type'  => 'title',
				'desc'  => __( 'En la siguiente sección deberá completar manualmente los precios establecidos por el correo: ', 'wc-coolca' )
				. '<a href="' . esc_url( 'https://www.correoargentino.com.ar/MiCorreo/public/files/lista-de-precios-PY-MiCorreo.pdf?20210121130012' ) . '" target="_blank">' . __( 'Precios RI', 'cool-ca' ) . '</a>'
				. ' | '
				. '<a href="' . esc_url( 'https://www.correoargentino.com.ar/MiCorreo/public/files/lista-de-precios-CF-MiCorreo.pdf?20210121130012' ) . '" target="_blank">' . __( 'Precios CF', 'cool-ca' ) . '</a>'
				. '<br>'
				. __( 'Si posee una API Key, puede utilizarla para completar automáticamente estos valores.', 'wc-coolca' ),
				'id'    => 'wc-coolca_prices_options',
			),
			array(
				'name'    => __( 'Condición frente al IVA', 'wc-coolca' ),
				'type'    => 'select',
				'id'      => 'wc-coolca-vat',
				'options' => array(
					'CF' => 'Consumidor Final',
					'RI' => 'Responsable Inscripto',
				),
				'default' => 'CF',
			),
			array(
				'name' => '',
				'id'   => 'wc-coolca-prices',
				'type' => 'coolca-prices',
			),

			array(
				'type' => 'sectionend',
				'id'   => 'wc-coolca_prices_options',
			),

			array(
				'title' => __( 'Valores por Defecto', 'wc-coolca' ),
				'desc'  => __(
					'Correo Argentino precisa contar con el peso de los productos a enviar. Si no tiene cargado el peso de los mismos, puede utilizar esta funcionalidad para definir un valor por defecto. Esto significa que siempre que el producto no tenga un peso definido, va a utilizar el valor indicado a continuación.',
					'wc-coolca'
				),
				'type'  => 'title',
				'id'    => 'wc-coolca_shipping_options_defaults',
			),

			array(
				'name' => __( 'Peso por defecto', 'wc-coolca' ),
				'type' => 'number',
				'id'   => 'wc-coolca-default-weight',
				'desc' => __( 'Expresar el peso en gramos.', 'wc-coolca' ),
			),
			array(
				'type' => 'sectionend',
				'id'   => 'wc-coolca_shipping_options_defaults',
			),
			array(
				'title' => __( 'Debug', 'wc-coolca' ),
				'desc'  => sprintf(
											/* translators: %s: logs url */
					__(
						'Puede habilitar el debug del plugin para realizar un seguimiento de la comunicación efectuada entre el plugin y la API de CoolCA. Podrá ver el registro desde el menú <a href="%s">WooCommerce > Estado > Registros</a>.',
						'wc-coolca'
					),
					esc_url(
						get_admin_url( null, 'admin.php?page=wc-status&tab=logs' )
					)
				),
				'type'  => 'title',
				'id'    => 'wc-coolca_shipping_options_debug',
			),
			array(
				'name'    => '',
				'id'      => 'wc-coolca-debug',
				'type'    => 'checkbox',
				'default' => 'no',
				'desc'    => __( 'Habilitar Debug', 'wc-coolca' ),
			),
			array(
				'type' => 'sectionend',
				'id'   => 'wc-coolca_shipping_options_debug',
			),
		);

		return $settings;
	}
}
