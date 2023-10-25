<?php
/**
 * Cool CA Woo Shipping Method Class
 *
 * @package  MANCA\CoolCA\ShippingMethod
 */

namespace MANCA\CoolCA\ShippingMethod;

use MANCA\CoolCA\Helper\Helper;
use WC_Shipping_Method;

defined( 'ABSPATH' ) || class_exists( '\WC_Shipping_Method' ) || exit;

/**
 * Our main payment method class
 */
class WC_CoolCA extends \WC_Shipping_Method {
	/**
	 * Default constructor
	 *
	 * @param int $instance_id Shipping Method Instance from Order.
	 * @return void
	 */
	public function __construct( $instance_id = 0 ) {
		$this->id                 = 'coolca';
		$this->instance_id        = absint( $instance_id );
		$this->method_title       = __( 'Cool Correo Argentino', 'cool-ca' );
		$this->method_description = __( 'Permite a tus clientes calcular el costo del envío por Correo Argentino (paq.ar).', 'cool-ca' );
		$this->supports           = array(
			'shipping-zones',
			'instance-settings',
			'instance-settings-modal',
		);
		$this->init();
	}

	/**
	 * Init user set variables.
	 *
	 * @return void
	 */
	public function init() {
		$this->instance_form_fields = include 'settings-coolca.php';
		$this->title                = $this->get_option( 'title' );

		// Custom Settings.
		$this->additional_description = $this->get_option( 'coolca-additional-description' );
		$this->service_type           = $this->get_option( 'coolca-service-type' );
		$this->price_type             = $this->get_option( 'coolca-price-type' );
		$this->pickup_country         = $this->get_option( 'coolca-pickup-country' );
		$this->pickup_state           = $this->get_option( 'coolca-pickup-state' );
		$this->pickup_city            = $this->get_option( 'coolca-pickup-city' );
		$this->pickup_postcode        = $this->get_option( 'coolca-pickup-postcode' );
		$this->pickup_address1        = $this->get_option( 'coolca-pickup-address1' );
		$this->pickup_address2        = $this->get_option( 'coolca-pickup-address2' );
		$this->free_delivery          = $this->get_option( 'coolca-free-delivery' );
		$this->free_delivery_from     = $this->get_option( 'coolca-free-delivery-from' );
		$this->charge_discount        = $this->get_option( 'coolca-charge-discount-cb' );
		$this->charge_discount_type   = $this->get_option( 'coolca-charge-discount-type' );
		$this->charge_discount_pct    = $this->get_option( 'coolca-charge-discount-pct' );

		// Save settings in admin if you have any defined.
		add_action(
			'woocommerce_update_options_shipping_' . $this->id,
			array(
				$this,
				'process_admin_options',
			)
		);
		add_action( 'admin_footer', array( 'MANCA\CoolCA\ShippingMethod\WC_CoolCA', 'enqueue_admin_js' ), 10 ); // Priority needs to be higher than wc_print_js (25).
	}

	/**
	 * Sanitize the cost field.
	 *
	 * @param string $value value to be zanitized.
	 * @return string
	 */
	public function sanitize_cost( $value ) {
		$value = filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
		return $value;
	}

	/**
	 * Calculate the shipping costs.
	 *
	 * @param array $package Package of items from cart.
	 * @return void
	 */
	public function calculate_shipping( $package = array() ) {
		$rate = array(
			'label'    => $this->get_option( 'title' ), // Label for the rate.
			'cost'     => '0', // Amount for shipping or an array of costs (for per item shipping).
			'taxes'    => '', // Pass an array of taxes, or pass nothing to have it calculated for you, or pass 'false' to calculate no tax for this method.
			'calc_tax' => 'per_order', // Calc tax per_order or per_item. Per item needs an array of costs passed via 'cost'.
			'package'  => $package,
			'term'     => '',
		);
		Helper::log( '******************************' );
		Helper::log( 'Init calculate_shipping----->' );
		$cost = 0;

		$items = Helper::get_items_from_cart( WC()->cart );
		if ( false === $items ) {
			Helper::log( 'No items' );
			return;
		}

		// if WCFM - WooCommerce Multivendor Marketplace is activated
		if ( class_exists( 'WCFMmp' ) && function_exists( 'wcfm_get_vendor_id_by_post' ) ) {

			$item       = $items[0];
			$product_id = $item['id'];
			$vendor_id  = wcfm_get_vendor_id_by_post( $product_id );

			$vendor_state    = get_user_meta( $vendor_id, '_wcfm_state', true );
			$vendor_city     = get_user_meta( $vendor_id, '_wcfm_city', true );
			$vendor_postcode = get_user_meta( $vendor_id, '_wcfm_zip', true );

			Helper::log( 'WCFMmp vendor >' . $vendor_id );
			Helper::log( 'WCFMmp vendor state >' . $vendor_state );
			Helper::log( 'WCFMmp vendor city >' . $vendor_city );
			Helper::log( 'WCFMmp vendor postcode >' . $vendor_postcode );

			$this->pickup_state    = ( ! empty( $vendor_state ) ) ? $vendor_state : $this->pickup_state;
			$this->pickup_city     = ( ! empty( $vendor_city ) ) ? $vendor_city : $this->pickup_city;
			$this->pickup_postcode = ( ! empty( $vendor_postcode ) ) ? $vendor_postcode : $this->pickup_postcode;
		}

		if ( 'branch' === $this->service_type ) {
			$coolca_branch = filter_input(
				INPUT_POST,
				'coolca_branch',
				FILTER_SANITIZE_STRING
			); // phpcs:ignore WordPress.Security.NonceVerification

			if ( $coolca_branch ) {
				if ( isset( helper::get_branches()[ $post_data['coolca_branch'] ] ) ) {
					$branch = helper::get_branches()[ $post_data['coolca_branch'] ];
					$zone   = helper::get_zone( $this->pickup_state, $this->pickup_city, $this->pickup_postcode, $branch['s'], $branch['c'], $branch['pc'] );
				}
			}

			if ( ! isset( $zone ) ) {
				$zone = helper::get_zone( $this->pickup_state, $this->pickup_city, $this->pickup_postcode, $package['destination']['state'], $package['destination']['city'], $package['destination']['postcode'] );
			}
		} else {
			$zone = helper::get_zone( $this->pickup_state, $this->pickup_city, $this->pickup_postcode, $package['destination']['state'], $package['destination']['city'], $package['destination']['postcode'] );
		}

		$has_costs = false;
		$MaxWeight = 30;
		$MaxDim    = 250;
		$MaxCm     = 150;

		Helper::log( 'Zone: ' . $zone );
		Helper::log( 'items: ' );
		Helper::log( $items );

		/**
		 * Tu envío puede pesar hasta 25 kilos para ser admitido.
		 * Nota: Es importante que peses cuidadosamente tu paquete antes de llevarlo a la sucursal dado que podría ser rechazado por diferencias de peso.
		 * Las medidas máximas permitidas son hasta 250 cm sumando largo, ancho y alto (ninguno mayor a 150 cm).
		 */
		$PaqAr = array();

		$currWeight    = 0;
		$currDim       = 0;
		$currVolWeight = 0;
		foreach ( $items as $item ) {
			// Add default weight
			if ( 0 === $item['weight'] ) {
				$item['weight'] = floatval( intval( Helper::get_option( 'default-weight' ) ) / 1000 );
			}
			if ( $item['weight'] > $MaxWeight
			|| $item['height'] + $item['width'] + $item['length'] > $MaxDim
			|| $item['height'] > $MaxCm
			|| $item['height'] > $MaxCm
			|| $item['height'] > $MaxCm ) {
				// Producto no puede ser enviado.
				Helper::log( 'Producto no cumple con las restricciones de tamaño / peso.' );
				return;
			}

			// V1.1.1 - Now dimentions are required!
			if ( empty( $item['height'] ) || empty( $item['width'] )  || empty( $item['length']  ) ) {
				Helper::log('Error obteniendo el tamaño del paquete, los productos deben tener sus dimensiones cargadas.' );
				return;
			}

			$currWeight += $item['weight'];
			$currDim    += $item['height'] + $item['width'] + $item['length'];
			// Coeficiente de Aforo: fixed 6000.
			$currVolWeight += floatval( ( $item['height'] * $item['width'] * $item['length'] ) / 6000 );
		};

		if ( $currWeight > $MaxWeight ) {

			$cantPaq = floor( $currWeight / $MaxWeight );
			$diff    = $currWeight % $MaxWeight;
			if ( $diff > 0 ) {
				++$cantPaq;
			};

			for ( $i = 1; $i < $cantPaq; $i++ ) {
				array_push( $PaqAr, $MaxWeight );
			}
			array_push( $PaqAr, ( $diff > 0 ) ? $diff : $MaxWeight );
		} else {
			$PaqAr[0] = $currWeight;
		}

		$totalCost = 0;
		foreach ( $PaqAr as $PaqWeight ) {
			$serviceTypePre = '';

			// Se obtienen los proporcionales de cada paquete.
			$PaqVolWeight  = ( $PaqWeight / $currWeight ) * $currVolWeight;
			$PaqEvalWeight = ( $PaqVolWeight < $PaqWeight ) ? $PaqWeight : $PaqVolWeight;

			if ( $PaqVolWeight < $PaqWeight || $PaqVolWeight < $MaxWeight ) {
				// Evaluar por Tarifario Peso Real.
				$WeightRange = array( 0.5, 1, 2, 3, 5, 10, 15, 20, 25, 30 );
				foreach ( $WeightRange as $value ) {
					if ( $PaqEvalWeight <= $value ) {
						$weight = $value;
						break;
					}
				}
			} else {
				$serviceTypePre = 'v';
				// Evaluar por Tarifario Peso Volumétrico.
				$WeightRange = array( 35, 40, 50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150 );
				foreach ( $WeightRange as $value ) {
					if ( $PaqEvalWeight <= $value ) {
						$weight = $value;
						break;
					}
				}
			}

			$totalCost += helper::get_price( $serviceTypePre . $this->service_type, strVal( $zone ), strVal( $weight ) );
		}

		Helper::log( 'Real Weight: ' . $currWeight );
		Helper::log( 'Volume Weight: ' . $currVolWeight );
		Helper::log( 'PaqAr: ' );
		Helper::log( $PaqAr );
		Helper::log( 'cost: ' . $totalCost );
		Helper::log( Helper::get_price_map() );

		if ( ! $totalCost || 0 === $totalCost ) {
			Helper::log( 'No es posible realizar el envío-' );
			return;
		}

		if ( $totalCost > 0 ) {
			$has_costs    = true;
			$rate['cost'] = $totalCost;
		}

		if ( 'yes' === $this->charge_discount ) {
			$charge_discount_pct = abs( floatval( $this->charge_discount_pct ) );
			if ( 'DISCOUNT' === $this->charge_discount_type ) {
				$charge_discount_pct = $charge_discount_pct * -1;
			}
			$rate['cost'] = $rate['cost'] * ( 1 + $charge_discount_pct / 100 );
		}

		if ( 'yes' === $this->free_delivery && floatval( $this->free_delivery_from ) <= floatval( $package['contents_cost'] ) ) {
			$rate['cost']  = 0;
			$rate['label'] = $this->get_option( 'title' ) . ' ' . __( ' - Gratis', 'cool-ca' );
		}

		if ( $has_costs ) {
			// Register the rate.
			$this->add_rate( $rate );
		}
	}

	/**
	 * Enqueue admin JS for settings
	 *
	 * @return void
	 */
	public static function enqueue_admin_js() {
		wc_enqueue_js(
			"jQuery( function( $ ) {
          function wcCoolcaFree( el ) {
            var form = $( el ).closest( 'form' );
            var freeDeliveryFrom = $( '#woocommerce_coolca_coolca-free-delivery-from', form ).closest( 'tr' );            
            if ( $( el ).prop('checked') ) {
              freeDeliveryFrom.show();             
            } else {         
              freeDeliveryFrom.hide();
            }                  
          }            
          $( document.body ).on( 'change', '#woocommerce_coolca_coolca-free-delivery', function() {
            wcCoolcaFree( this );
          });  
          // Change while load.
          $( '#woocommerce_coolca_coolca-free-delivery' ).trigger( 'change' );
          $( document.body ).on( 'wc_backbone_modal_loaded', function( evt, target ) {
            if ( 'wc-modal-shipping-method-settings' === target ) {
              wcCoolcaFree( $( '#wc-backbone-modal-dialog #woocommerce_coolca_coolca-free-delivery', evt.currentTarget ) );
            }
          } );
        
        
        function wcCoolcaChargeDiscount( el ) {
          var form = $( el ).closest( 'form' );
          var chargeDiscountType = $( '#woocommerce_coolca_coolca-charge-discount-type', form ).closest( 'tr' );            
          var chargeDiscountPct = $( '#woocommerce_coolca_coolca-charge-discount-pct', form ).closest( 'tr' );            
          if ( $( el ).prop('checked') ) {
            chargeDiscountType.show();  
            chargeDiscountPct.show();           
          } else {         
            chargeDiscountType.hide();  
            chargeDiscountPct.hide();    
          }                  
        }
        $( document.body ).on( 'change', '#woocommerce_coolca_coolca-charge-discount-cb', function() {
          wcCoolcaChargeDiscount( this );
        });  
        // Change while load.
        $( '#woocommerce_coolca_coolca-charge-discount-cb' ).trigger( 'change' );
        $( document.body ).on( 'wc_backbone_modal_loaded', function( evt, target ) {
          if ( 'wc-modal-shipping-method-settings' === target ) {
            wcCoolcaChargeDiscount( $( '#wc-backbone-modal-dialog #woocommerce_coolca_coolca-charge-discount-cb', evt.currentTarget ) );
          }
        } );
        

        });
        "
		);
	}

}
