<?php
/**
 * Branch Field Class
 *
 * @package  MANCA\CoolCA\CheckOut
 */

namespace MANCA\CoolCA\CheckOut;

use MANCA\CoolCA\Helper\Helper;
use MANCA\CoolCA\ShippingMethod\WC_CoolCA;

defined( 'ABSPATH' ) || exit();

/**
 * Checkout Class to mantain new custom fields for checkout.
 */
class BranchField {
	/**
	 * Show Branch Select Field
	 *
	 * @param string $method Shipping Method Selected.
	 * @param array  $index Shipping Method Index.
	 */
	public static function shipping_point_field( $method, $index = 0 ) {
		if ( ! is_checkout() ) {
			return; // Only on checkout page.
		}

		$shipping_methods = WC()->session->get( 'chosen_shipping_methods' );
		$shipping_method  = $shipping_methods[0];

		// If shipping method is the choosen one.
		if ( $method->id === $shipping_method ) {
			// If shipping method choosen is from Cool Correo Argentino.
			if ( false !== strpos( $shipping_method, 'coolca' ) ) {
				$instance_id          = substr(
					$shipping_method,
					strpos( $shipping_method, ':' ) + 1
				);
				$CoolCAShippingMethod = new WC_CoolCA( $instance_id );
				// Check if shipping method is branch.
				if ( 'branch' === $CoolCAShippingMethod->service_type ) {

					global $woocommerce;
					$package       = $woocommerce->cart->get_shipping_packages();
					$state         = $package[0]['destination']['state'];
					$defaultBranch = '';

					$post_data_str = filter_input(
						INPUT_POST,
						'post_data',
						FILTER_SANITIZE_STRING
					);
					if ( ! empty( $post_data_str ) ) {
						parse_str( $post_data_str, $post_data );
						$nonce_value =
							$post_data['woocommerce-process-checkout-nonce'];
						if (
							empty( $nonce_value ) ||
							! wp_verify_nonce(
								$nonce_value,
								'woocommerce-process_checkout'
							)
						) {
							return;
						}
						if ( isset( $post_data['coolca_branch'] ) ) {
							$defaultBranch = $post_data['coolca_branch'];
						}
					}
					?>
					<div class="container_coolca_branch">
					<?php
					woocommerce_form_field(
						'coolca_branch',
						array(
							'type'        => 'select',
							'class'       => array(
								'field-row-wide',
								'coolca_branch',
								'update_totals_on_change',
							),
							'input_class' => array( 'wc-enhanced-select' ),
							'label'       => __( 'Seleccione la Sucursal', 'cool-ca' ),
							'required'    => true,
							'options'     => helper::get_branches_dropdown( $state ),
						),
						$defaultBranch
					);
					?>
					</div">
					<script> jQuery(document).ready( function(){ jQuery('.wc-enhanced-select').selectWoo();}); </script>
					<?php
				}
			}
		}
	}

	/**
	 * Show Branch Select Field
	 *
	 * @param array $fields Checkout Fields.
	 */
	public static function override_checkout_fields( $fields ) {
		array_push(
			$fields['billing']['billing_state']['class'],
			'update_totals_on_change'
		);
		// check if it's setting up.
		array_push(
			$fields['shipping']['shipping_state']['class'],
			'update_totals_on_change'
		);
		/**
		 * For future uses.
		 * if ( isset( $fields['shipping'] ) ) {
		 *
		 * }
		*/
		return $fields;
	}

	/**
	 * Save checkout fields
	 *
	 * @param string $order_id Order ID.
	 * @param bool   $post_data Posted data.
	 */
	public static function checkout_update_order_meta( $order_id, $post_data = null ) {
		$order            = wc_get_order( $order_id );
		$shipping_methods = $order->get_shipping_methods();
		$shipping_method  = array_shift( $shipping_methods );

		$nonce_value    = wc_get_var( $_REQUEST['woocommerce-process-checkout-nonce'], wc_get_var( $_REQUEST['_wpnonce'], '' ) ); // phpcs:ignore
		if (
			empty( $nonce_value ) ||
			! wp_verify_nonce(
				$nonce_value,
				'woocommerce-process_checkout'
			)
		) {
			return;
		}

		$coolca_branch = filter_input(
			INPUT_POST,
			'coolca_branch',
			FILTER_SANITIZE_STRING
		);

		if ( $coolca_branch ) {
			wc_add_order_item_meta(
				$shipping_method->get_id(),
				'Sucursal',
				sanitize_text_field( $coolca_branch )
			);

			/**
			 *  v1.0.3 - Add Shipping Meta Data "Branch Description"
			 */
			$branches = helper::get_branches_dropdown();
			if ( isset( $branches[ $coolca_branch ] ) ) {
				wc_add_order_item_meta(
					$shipping_method->get_id(),
					'Nombre Sucursal',
					sanitize_text_field( $branches[ $coolca_branch ] )
				);
			}
		}
	}

	/**
	 * Display New fields on Order
	 *
	 * @param WC_ORDER $order Woo Order Object.
	 */
	public static function display_fields( $order ) {
		$shipping_methods = $order->get_shipping_methods();
		$shipping_method  = array_shift( $shipping_methods );
		if ( ! empty( $shipping_method ) ) {
			if ( 'coolca' === $shipping_method->get_method_id() ) {
				$instance_id          = substr(
					$shipping_method,
					strpos( $shipping_method, ':' ) + 1
				);
				$CoolCAShippingMethod = new WC_CoolCA( $instance_id );

				// Check if shipping method is branch.
				if ( 'branch' === $CoolCAShippingMethod->service_type ) {
					?>
					<h2 class="woocommerce-order-coolca"> 
						<?php
						__(
							'Envío por Correo Argentino',
							'cool-ca'
						);
						?>
					</h2>
					<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
					<li class="woocommerce-order-overview__order order">
						<?php __( 'Método Envío', 'cool-ca' ); ?>
						<strong><?php echo esc_html( $shipping_method->get_method_title() ); ?></strong>
					</li>
					<?php
					if (
					! empty( wc_get_order_item_meta( $shipping_method->get_id(), 'Sucursal' ) )
					) {
						?>
					<li class="woocommerce-order-overview__order order">
									<?php __( 'Sucursal', 'cool-ca' ); ?>
						<strong>
						<?php
						echo esc_html(
							wc_get_order_item_meta(
								$shipping_method->get_id(),
								'Sucursal'
							)
						);
						?>
	</strong>
					</li>
					<?php } ?>
				</ul>
					<?php
				}
			}
		}
	}
}
