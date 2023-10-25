<?php
/**
 * Woocommerce Trait
 *
 * @package  MANCA\CoolCA\Helper
 */

namespace MANCA\CoolCA\Helper;

trait WooCommerceTrait {

	/**
	 * Gets the customer from a WooCommerce Cart
	 *
	 * @param WC_Customer $customer customer info like Order.
	 * @return array|false
	 */
	public static function get_customer_from_cart( $customer ) {
		if ( ! $customer ) {
			return false;
		}
		$name          = self::get_customer_name( $customer );
		$first_name    = self::get_customer_first_name( $customer );
		$last_name     = self::get_customer_last_name( $customer );
		$address       = self::get_address( $customer );
		$postal_code   = self::get_postal_code( $customer );
		$province      = self::get_province( $customer );
		$province_name = self::get_province_name( $province );
		$locality      = self::get_locality( $customer );
		$full_address  = self::get_full_address( $address, $locality, $postal_code, $province );

		return array(
			'first_name'    => $first_name,
			'last_name'     => $last_name,
			'full_name'     => $name,
			'street'        => $address['street'],
			'number'        => $address['number'],
			'floor'         => $address['floor'],
			'apartment'     => $address['apartment'],
			'full_address'  => $full_address,
			'cp'            => $postal_code,
			'locality'      => $locality,
			'province'      => $province,
			'province_name' => $province_name,
		);
	}

	/**
	 * Gets full address
	 *
	 * @param array  $address Address info.
	 * @param string $locality Locality|city info.
	 * @param string $postal_code Postal Code.
	 * @param string $province Province|state.
	 * @return string
	 */
	public static function get_full_address( array $address, string $locality, string $postal_code, string $province ) {
		$full_address = $address['street'];
		if ( ! empty( $address['number'] ) ) {
			$full_address .= ' ' . $address['number'];
		}
		if ( ! empty( $address['floor'] ) ) {
			$full_address .= ', ';
			$full_address .= $address['floor'];
			if ( ! empty( $address['apartment'] ) ) {
				$full_address .= ' ' . $address['apartment'];
			}
		}
		$full_address .= '. ';
		$full_address .= $locality . ' ' . $postal_code . ', ' . $province;
		return $full_address;
	}

	/**
	 * Remove prefix from String.
	 *
	 * @param string $str input string.
	 * @param string $prefix prefix to be removed from $str..
	 * @return string
	 */
	public static function remove_prefix( $str, $prefix ) {
		if ( substr( $str, 0, strlen( $prefix ) ) === $prefix ) {
			return substr( $str, strlen( $prefix ) );
		}
		return $str;
	}

	/**
	 * Sanitize Phone Number.
	 *
	 * @param string $phone Phone number.
	 * @return string
	 */
	public static function get_phone_sanitized( $phone ) {

		$phoneRet = self::remove_prefix( self::remove_prefix( self::remove_prefix( self::remove_prefix( $phone, '+' ), '549' ), '15' ), '0' );

		$phoneRet = self::remove_prefix( $phoneRet, self::get_phone_prefix_arg( $phoneRet ) );
		return $phoneRet;
	}

	/**
	 * Get Argentinian phone number prefix.
	 *
	 * @param string $phone Phone number.
	 * @return string
	 */
	public static function get_phone_prefix_arg( $phone ) {
		$prefixs = array( '11', '351', '379', '370', '221', '380', '261', '299', '343', '376', '280', '362', '2966', '387', '383', '264', '266', '381', '388', '342', '2954', '385', '2920', '2901', '11', '220', '221', '223', '230', '236', '237', '249', '260', '261', '263', '264', '266', '280', '291', '294', '297', '298', '299', '336', '341', '342', '343', '345', '348', '351', '353', '358', '362', '364', '370', '376', '379', '380', '381', '383', '385', '387', '388', '2202', '2221', '2223', '2224', '2225', '2226', '2227', '2229', '2241', '2242', '2243', '2244', '2245', '2246', '2252', '2254', '2255', '2257', '2261', '2262', '2264', '2265', '2266', '2267', '2268', '2271', '2272', '2273', '2274', '2281', '2283', '2284', '2285', '2286', '2291', '2292', '2296', '2297', '2302', '2314', '2316', '2317', '2320', '2323', '2324', '2325', '2326', '2331', '2333', '2334', '2335', '2336', '2337', '2338', '2342', '2343', '2344', '2345', '2346', '2352', '2353', '2354', '2355', '2356', '2357', '2358', '2392', '2393', '2394', '2395', '2396', '2473', '2474', '2475', '2477', '2478', '2622', '2624', '2625', '2626', '2646', '2647', '2648', '2651', '2652', '2655', '2656', '2657', '2658', '2901', '2902', '2903', '2920', '2921', '2922', '2923', '2924', '2925', '2926', '2927', '2928', '2929', '2931', '2932', '2933', '2934', '2935', '2936', '2940', '2942', '2945', '2946', '2948', '2952', '2953', '2954', '2962', '2963', '2964', '2966', '2972', '2982', '2983', '3327', '3329', '3382', '3385', '3387', '3388', '3400', '3401', '3402', '3404', '3405', '3406', '3407', '3408', '3409', '3435', '3436', '3437', '3438', '3442', '3444', '3445', '3446', '3447', '3454', '3455', '3456', '3458', '3460', '3462', '3463', '3464', '3465', '3466', '3467', '3468', '3469', '3471', '3472', '3476', '3482', '3483', '3487', '3489', '3491', '3492', '3493', '3496', '3497', '3498', '3521', '3522', '3524', '3525', '3532', '3533', '3537', '3541', '3542', '3543', '3544', '3546', '3547', '3548', '3549', '3562', '3563', '3564', '3571', '3572', '3573', '3574', '3575', '3576', '3582', '3583', '3584', '3585', '3711', '3715', '3716', '3718', '3721', '3725', '3731', '3734', '3735', '3741', '3743', '3751', '3754', '3755', '3756', '3757', '3758', '3772', '3773', '3774', '3775', '3777', '3781', '3782', '3786', '3821', '3825', '3826', '3827', '3832', '3835', '3837', '3838', '3841', '3843', '3844', '3845', '3846', '3854', '3855', '3856', '3857', '3858', '3861', '3862', '3863', '3865', '3867', '3868', '3869', '3873', '3876', '3877', '3878', '3885', '3886', '3889', '3888', '3891', '3892', '3894' );

		foreach ( $prefixs as $prefix ) {
			if ( substr( $phone, 0, strlen( $prefix ) ) === $prefix ) {
				return $prefix;
			}
		}
		return '';
	}

	/**
	 * Get Argentinian phone number prefix Sanitized.
	 *
	 * @param string $phone Phone number.
	 * @return string
	 */
	public static function get_phone_prefix_sanitized( $phone ) {
		$phoneRet = self::remove_prefix( self::remove_prefix( self::remove_prefix( self::remove_prefix( $phone, '+' ), '549' ), '15' ), '0' );
		$phoneRet = self::get_phone_prefix_arg( $phoneRet );
		return ( ! empty( $phoneRet ) ) ? $phoneRet : '11';
	}

	/**
	 * Gets customer data from an order
	 *
	 * @param WC_Order $order Woo Order Object.
	 * @return array|false
	 */
	public static function get_customer_from_order( $order ) {
		if ( ! $order ) {
			return false;
		}
		$data          = self::get_customer_from_cart( $order );
		$data['email'] = $order->get_billing_email();
		if ( isset( get_post_meta( $order->get_id(), '_billing_phone' )[0] ) ) {
			$data['phone']        = self::get_phone_sanitized( get_post_meta( $order->get_id(), '_billing_phone' )[0] );
			$data['phone_prefix'] = self::get_phone_prefix_sanitized( get_post_meta( $order->get_id(), '_billing_phone' )[0] );
		} else {
			$data['phone']        = '';
			$data['phone_prefix'] = '';
		}

		$data['extra_info'] = $order->get_customer_note();
		return $data;
	}

	/**
	 * Gets the province from a customer
	 *
	 * @param WC_Customer $customer WC Order Object.
	 * @return string
	 */
	public static function get_province( $customer ) {
		return ( $customer->get_shipping_state() ) ? $customer->get_shipping_state() : $customer->get_billing_state();
	}

	/**
	 * Gets the locality from a customer
	 *
	 * @param WC_Customer $customer WC Order Object.
	 * @return string
	 */
	public static function get_locality( $customer ) {
		return ( $customer->get_shipping_city() ) ? $customer->get_shipping_city() : $customer->get_billing_city();
	}

	/**
	 * Gets the postal code from a customer
	 *
	 * @param WC_Customer $customer WC Order Object.
	 * @return string
	 */
	public static function get_postal_code( $customer ) {
		return ( $customer->get_shipping_postcode() ) ? $customer->get_shipping_postcode() : $customer->get_billing_postcode();
	}

	/**
	 * Gets the full customer name
	 *
	 * @param WC_Customer $customer WC Order Object.
	 * @return string
	 */
	public static function get_customer_name( $customer ) {
		$name = self::get_customer_first_name( $customer ) . ' ' . self::get_customer_last_name( $customer );
		return $name;
	}

	/**
	 * Gets the customer first name
	 *
	 * @param WC_Customer $customer WC Order Object.
	 * @return string
	 */
	public static function get_customer_first_name( $customer ) {
		return ( $customer->get_shipping_first_name() ) ? $customer->get_shipping_first_name() : $customer->get_billing_first_name();
	}

	/**
	 * Gets the customer last name
	 *
	 * @param WC_Customer $customer WC Order Object.
	 * @return string
	 */
	public static function get_customer_last_name( $customer ) {
		return ( $customer->get_shipping_last_name() ) ? $customer->get_shipping_last_name() : $customer->get_billing_last_name();
	}

	/**
	 * Gets the address of an order
	 *
	 * @param WC_Order $order WC Order Object.
	 * @return false|array
	 */
	public static function get_address( $order ) {
		if ( ! $order ) {
			return false;
		}
		if ( $order->get_shipping_address_1() ) {
			$shipping_line_1 = $order->get_shipping_address_1();
			$shipping_line_2 = $order->get_shipping_address_2();
		} else {
			$shipping_line_1 = $order->get_billing_address_1();
			$shipping_line_2 = $order->get_billing_address_2();
		}
		$street_name   = '';
		$street_number = '';
		$floor         = '';
		$apartment     = '';

		// Find a match and store it in $result.
		if ( preg_match( '/^([^\d]*[^\d\s]) *(\d.*)$/', $shipping_line_1, $result ) ) {
			// $result[1] will have the steet name
			$street_name = $result[1];
			// and $result[2] is the number part.
			$street_number = $result[2];
		} else {
			$street_name = $shipping_line_1;
		}

		// Find a match and store it in $result.
		if ( preg_match( '/^([^\d]*[^\d\s]) *(\d.*)$/', $shipping_line_2, $result ) ) {
			// $result[1] will have the steet name
			$floor = $result[1];
			// and $result[2] is the number part.
			$apartment = $result[2];
		} else {
			$floor = $shipping_line_2;
		}

		return array(
			'street'    => $street_name,
			'number'    => $street_number,
			'floor'     => $floor,
			'apartment' => $apartment,
		);
	}

	/**
	 * Get specific details from an address (floor and apt)
	 *
	 * @param string $fl_apt Get Floor from address.
	 * @return array
	 */
	public static function get_floor_and_apt( $fl_apt ) {
		// firts we'll asume the user did things right. Something like "piso 24, depto. 5h".
		preg_match( '/(piso|p|p.) ?(\w+),? ?(departamento|depto|dept|dpto|dpt|dpt.º|depto.|dept.|dpto.|dpt.|apartamento|apto|apt|apto.|apt.) ?(\w+)/i', $fl_apt, $res );
		$line2 = $res;

		if ( ! empty( $line2 ) ) {
			// everything was written great. Now lets grab what matters.
			$floor     = trim( $line2[2] );
			$apartment = trim( $line2[4] );
		} else {
			// maybe the user wrote something like "depto. 5, piso 24". Let's try that.
			preg_match( '/(departamento|depto|dept|dpto|dpt|dpt.º|depto.|dept.|dpto.|dpt.|apartamento|apto|apt|apto.|apt.) ?(\w+),? ?(piso|p|p.) ?(\w+)/i', $fl_apt, $res );
			$line2 = $res;
		}

		if ( ! empty( $line2 ) && empty( $apartment ) && empty( $floor ) ) {
			// apparently, that was the case. Guess some people just like to make things difficult.
			$floor     = trim( $line2[4] );
			$apartment = trim( $line2[2] );
		} else {
			// something is wrong. Let's be more specific. First we'll try with only the floor.
			preg_match( '/^(piso|p|p.) ?(\w+)$/i', $fl_apt, $res );
			$line2 = $res;
		}

		if ( ! empty( $line2 ) && empty( $floor ) ) {
			// now we've got it! The user just wrote the floor number. Now lets grab what matters.
			$floor = trim( $line2[2] );
		} else {
			// still no. Now we'll try with the apartment.
			preg_match( '/^(departamento|depto|dept|dpto|dpt|dpt.º|depto.|dept.|dpto.|dpt.|apartamento|apto|apt|apto.|apt.) ?(\w+)$/i', $fl_apt, $res );
			$line2 = $res;
		}

		if ( ! empty( $line2 ) && empty( $apartment ) && empty( $floor ) ) {
			// success! The user just wrote the apartment information. No clue why, but who am I to judge.
			$apartment = trim( $line2[2] );
		} else {
			// ok, weird. Now we'll try a more generic approach just in case the user missplelled something.
			preg_match( '/(\d+),? [a-zA-Z.,!*]* ?([a-zA-Z0-9 ]+)/i', $fl_apt, $res );
			$line2 = $res;
		}

		if ( ! empty( $line2 ) && empty( $floor ) && empty( $apartment ) ) {
			// finally! The user just missplelled something. It happens to the best of us.
			$floor     = trim( $line2[1] );
			$apartment = trim( $line2[2] );
		} else {
			// last try! This one is in case the user wrote the floor and apartment together ("12C").
			preg_match( '/(\d+)(\D*)/i', $fl_apt, $res );
			$line2 = $res;
		}

		if ( ! empty( $line2 ) && empty( $floor ) && empty( $apartment ) ) {
			// ok, we've got it. I was starting to panic.
			$floor     = trim( $line2[1] );
			$apartment = trim( $line2[2] );
		} elseif ( empty( $floor ) && empty( $apartment ) ) {
			// I give up. I can't make sense of it. We'll save it in case it's something useful.
			$floor = $fl_apt;
		}

		return array(
			$floor,
			$apartment,
		);
	}

	/**
	 * Gets the province name
	 *
	 * @param string $province_id Province|State ID.
	 * @return string
	 */
	public static function get_province_name( string $province_id = '' ) {
		switch ( $province_id ) {
			// Mexico.
			case 'DF':
				$zone = 'Ciudad de Mexico';
				break;
			case 'JA':
				$zone = 'Jalisco';
				break;
			case 'NL':
				$zone = 'Nuevo León';
				break;
			case 'AG':
				$zone = 'Aguascalientes';
				break;
			case 'BC':
				$zone = 'Baja California';
				break;
			case 'BS':
				$zone = 'Baja California Sur';
				break;
			case 'CM':
				$zone = 'Campeche';
				break;
			case 'CS':
				$zone = 'Chiapas';
				break;
			case 'CH':
				$zone = 'Chihuahua';
				break;
			case 'CO':
				$zone = 'Coahuila';
				break;
			case 'CL':
				$zone = 'Colima';
				break;
			case 'DG':
				$zone = 'Durango';
				break;
			case 'GT':
				$zone = 'Guanajuato';
				break;
			case 'GR':
				$zone = 'Guerrero';
				break;
			case 'HG':
				$zone = 'Hidalgo';
				break;
			case 'MX':
				$zone = 'Estado de México';
				break;
			case 'MI':
				$zone = 'Michoacán';
				break;
			case 'MO':
				$zone = 'Morelos';
				break;
			case 'NA':
				$zone = 'Nayarit';
				break;
			case 'OA':
				$zone = 'Oaxaca';
				break;
			case 'PU':
				$zone = 'Puebla';
				break;
			case 'QR':
				$zone = 'Quintana Roo';
				break;
			case 'QT':
				$zone = 'Querétaro';
				break;
			case 'SL':
				$zone = 'San Luis Potosí';
				break;
			case 'SI':
				$zone = 'Sinaloa';
				break;
			case 'SO':
				$zone = 'Sonora';
				break;
			case 'TB':
				$zone = 'Tabasco';
				break;
			case 'TM':
				$zone = 'Tamaulipas';
				break;
			case 'TL':
				$zone = 'Tlaxcala';
				break;
			case 'VE':
				$zone = 'Veracruz';
				break;
			case 'YU':
				$zone = 'Yucatán';
				break;
			case 'ZA':
				$zone = 'Zacatecas';
				break;

			// Peru.
			case 'CAL':
				$zone = 'El Callao';
				break;
			case 'LMA':
				$zone = 'Municipalidad Metropolitana de Lima';
				break;
			case 'AMA':
				$zone = 'Amazonas';
				break;
			case 'ANC':
				$zone = 'Ancash';
				break;
			case 'APU':
				$zone = 'Apurímac';
				break;
			case 'ARE':
				$zone = 'Arequipa';
				break;
			case 'AYA':
				$zone = 'Ayacucho';
				break;
			case 'CAJ':
				$zone = 'Cajamarca';
				break;
			case 'CUS':
				$zone = 'Cusco';
				break;
			case 'HUV':
				$zone = 'Huancavelica';
				break;
			case 'HUC':
				$zone = 'Huánuco';
				break;
			case 'ICA':
				$zone = 'Ica';
				break;
			case 'JUN':
				$zone = 'Junín';
				break;
			case 'LAL':
				$zone = 'La Libertad';
				break;
			case 'LA':
				$zone = '>Lambayeque';
				break;
			case 'LIM':
				$zone = 'Lima';
				break;
			case 'LOR':
				$zone = 'Loreto';
				break;
			case 'MDD':
				$zone = 'Madre de Dios';
				break;
			case 'MOQ':
				$zone = 'Moquegua';
				break;
			case 'PAS':
				$zone = 'Pasco';
				break;
			case 'PIU':
				$zone = 'Piura';
				break;
			case 'PUN':
				$zone = 'Puno';
				break;
			case 'SAM':
				$zone = 'San Martín';
				break;
			case 'TAC':
				$zone = 'Tacna';
				break;
			case 'TUM':
				$zone = 'Tumbes';
				break;
			case 'UCA':
				$zone = 'Ucayali';
				break;

			// Argentina.
			case 'C':
				$zone = 'Ciudad Autónoma de Buenos Aires';
				break;
			case 'B':
				$zone = 'Buenos Aires';
				break;
			case 'K':
				$zone = 'Catamarca';
				break;
			case 'H':
				$zone = 'Chaco';
				break;
			case 'U':
				$zone = 'Chubut';
				break;
			case 'X':
				$zone = 'Córdoba';
				break;
			case 'W':
				$zone = 'Corrientes';
				break;
			case 'E':
				$zone = 'Entre Ríos';
				break;
			case 'P':
				$zone = 'Formosa';
				break;
			case 'Y':
				$zone = 'Jujuy';
				break;
			case 'L':
				$zone = 'La Pampa';
				break;
			case 'F':
				$zone = 'La Rioja';
				break;
			case 'M':
				$zone = 'Mendoza';
				break;
			case 'N':
				$zone = 'Misiones';
				break;
			case 'Q':
				$zone = 'Neuquén';
				break;
			case 'R':
				$zone = 'Río Negro';
				break;
			case 'A':
				$zone = 'Salta';
				break;
			case 'J':
				$zone = 'San Juan';
				break;
			case 'D':
				$zone = 'San Luis';
				break;
			case 'Z':
				$zone = 'Santa Cruz';
				break;
			case 'S':
				$zone = 'Santa Fe';
				break;
			case 'G':
				$zone = 'Santiago del Estero';
				break;
			case 'V':
				$zone = 'Tierra del Fuego';
				break;
			case 'T':
				$zone = 'Tucumán';
				break;

			default:
				$zone = $province_id;
				break;
		}
		return $zone;
	}

	/**
	 * Gets product dimensions and details
	 *
	 * @param int $product_id Product ID.
	 * @return false|array
	 */
	public static function get_product_dimensions( $product_id ) {
		$product = wc_get_product( $product_id );
		if ( ! $product ) {
			return false;
		}
		// V1.0.4 - Add Default Weight.
		/*
		if ( empty( $product->get_height() ) || empty( $product->get_length() ) || empty( $product->get_width() ) || ! $product->has_weight() ) {
			return false;
		}*/
		$dimension_unit = 'cm';
		$weight_unit    = 'kg';

		$height = ( $product->get_height() ? wc_get_dimension( $product->get_height(), $dimension_unit ) : '0' );
		$width  = ( $product->get_width() ? wc_get_dimension( $product->get_width(), $dimension_unit ) : '0' );
		$length = ( $product->get_length() ? wc_get_dimension( $product->get_length(), $dimension_unit ) : '0' );

		$new_product = array(
			'height'                 => ( $product->get_height() ? wc_get_dimension( $product->get_height(), $dimension_unit ) : '0' ),
			'width'                  => ( $product->get_width() ? wc_get_dimension( $product->get_width(), $dimension_unit ) : '0' ),
			'length'                 => ( $product->get_length() ? wc_get_dimension( $product->get_length(), $dimension_unit ) : '0' ),
			'weight'                 => ( $product->has_weight() ? wc_get_weight( $product->get_weight(), $weight_unit ) : '0' ),
			'price'                  => $product->get_price(),
			'description'            => $product->get_name(),
			'id'                     => $product_id,
			'sku'                    => $product->get_sku(),
			'wc-coolca-product-size' => $height * $width * $length,
		);
		return $new_product;
	}

	/**
	 * Gets all items from a cart
	 *
	 * @param WC_Cart $cart WC Cart Object.
	 * @return false|array
	 */
	public static function get_items_from_cart( $cart ) {
		$products = array();
		$items    = $cart->get_cart();
		foreach ( $items as $item ) {
			$product_id  = $item['data']->get_id();
			$new_product = self::get_product_dimensions( $product_id );
			if ( ! $new_product ) {
				return false;
			}
			for ( $i = 0;$i < $item['quantity'];$i++ ) {
				$products[] = $new_product;
			}
		}
		return $products;
	}

	/**
	 * Gets items from an order
	 *
	 * @param WC_Order $order WC Order Object.
	 * @return false|array
	 */
	public static function get_items_from_order( $order ) {
		$products = array();
		$items    = $order->get_items();
		foreach ( $items as $item ) {
			$product_id = $item->get_variation_id();
			if ( ! $product_id ) {
				$product_id = $item->get_product_id();
			}
			$new_product = self::get_product_dimensions( $product_id );
			if ( ! $new_product ) {
				return false;
			}
			$item_cant = $item->get_quantity();
			for ( $i = 0;$i < $item_cant;$i++ ) {
				$products[] = $new_product;
			}
		}
		return $products;
	}

	/**
	 * Groups an array of items
	 *
	 * @param array $items Array of Items.
	 * @return array
	 */
	public static function group_items( array $items ) {
		$grouped_items = array();
		foreach ( $items as $item ) {
			if ( isset( $grouped_items[ $item['id'] ] ) ) {
				$grouped_items[ $item['id'] ]['quantity']++;
			} else {
				$grouped_items[ $item['id'] ]             = $item;
				$grouped_items[ $item['id'] ]['quantity'] = 1;
			}
		}
		return $grouped_items;
	}
}
