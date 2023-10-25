<?php
/**
 * Database Trait
 *
 * @package  MANCA\CoolCA\Helper
 */

namespace MANCA\CoolCA\Helper;

trait DatabaseTrait {
	/**
	 * Find orders by scheduled datetime
	 *
	 * @param string $from_dt From Date to Search Orders.
	 * @param string $to_dt To Date to Search Orders.
	 * @param string $status Status to Search Orders.
	 * @param bool   $includeFree Check if search must includes Free Shipping Method.
	 * @return array|string
	 */
	public static function find_orders( string $from_dt, string $to_dt, string $status, bool $includeFree ) {
		global $wpdb;
		$free                       = ( $includeFree ) ? 'free' : 'none';
		$posts                      = $wpdb->prefix . 'posts';
		$woocommerce_order_items    = $wpdb->prefix . 'woocommerce_order_items';
		$woocommerce_order_itemmeta = $wpdb->prefix . 'woocommerce_order_itemmeta';
		$wp_wc_order_stats          = $wpdb->prefix . 'wp_wc_order_stats';
		$query                      = "SELECT ID
			FROM {$posts}
			WHERE ID in (SELECT A.order_id
						FROM {$woocommerce_order_items} A, {$woocommerce_order_itemmeta} B
						WHERE A.order_item_type = 'shipping'
						AND A.order_item_id = B.order_item_id
						AND B.meta_key = 'method_id'
						AND (B.meta_value = 'coolca' or B.meta_value like %s ))
			AND DATE(post_date) >= %s  AND   DATE(post_date)<= %s
			AND post_type = 'shop_order'
			AND (post_status = %s OR 'all' = %s)
			";

		return $wpdb->get_results( $wpdb->prepare( $query, $wpdb->esc_like( '%' . $free . '%' ), $from_dt, $to_dt, $status, $status ), ARRAY_A );
	}



}
