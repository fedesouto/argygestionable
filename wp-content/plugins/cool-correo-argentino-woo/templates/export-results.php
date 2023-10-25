<?php
/**
 * PHP version 7
 *
 * @package  Templates
 */

use MANCA\CoolCA\Helper\Helper;
use MANCA\CoolCA\ShippingMethod\WC_CoolCA;

$from_dt_dflt      = $args['from_dt_dflt'];
$to_dt_dflt        = $args['to_dt_dflt'];
$curr_status       = $args['curr_status'];
$inc_free_shipping = $args['inc_free_shipping'];

$orders = Helper::find_orders( $from_dt_dflt, $to_dt_dflt, $curr_status, $inc_free_shipping );
?>

<h3><?php esc_html_e( 'Resultados', 'coolca' ); ?></h3>

<?php
if ( ! empty( $orders ) ) {
	?>
	<div class="coolca-table-content">
		<table class="table table-striped table-sm table-responsive coolca-exportable">
			<thead>
				<tr>
					<th scope="col"> <?php esc_html_e( 'Acciones', 'coolca' ); ?></th>
					<th scope="col" class=""> <?php esc_html_e( 'Orden#', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Tipo Producto', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Largo', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Ancho', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Altura', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Peso', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Valor del contenido', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Provincia Destino', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Sucursal Destino', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Localidad Destino', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Calle Destino', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Altura Destino', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Piso', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Depto', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Codigo Postal', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Destino Nombre', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Destino Email', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Cod Area Tel', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Tel', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Cod Area Cel', 'coolca' ); ?> </th>
					<th scope="col" class="coolca-exportable"> <?php esc_html_e( 'Cel', 'coolca' ); ?> </th>
				</tr>
			</thead>
		<tbody>
		<?php
		foreach ( $orders as $order_arr ) {
			$order_id = $order_arr['ID'];
			$WCOrder  = new WC_Order( $order_id );

			$customer      = Helper::get_customer_from_order( $WCOrder );
			$items         = Helper::get_items_from_order( $WCOrder );
			$grouped_items = Helper::group_items( $items );

			$totalWeight = 0;
			$totalPrice  = 0;

			$totalHeight = 0;
			$totalWidth  = 0;
			$totalLength = 0;

			foreach ( $grouped_items as $item ) {
				$totalWeight += $item['weight'] * $item['quantity'];
				$totalPrice  += $item['price'] * $item['quantity'];
				$totalHeight += $item['height'];
				$totalWidth   = ( $item['width'] > $totalWidth ) ? $item['width'] : $totalWidth;
				$totalLength  = ( $item['length'] > $totalLength ) ? $item['length'] : $totalLength;
			}

			$shipping_methods = $WCOrder->get_shipping_methods();
			$shipping_method  = array_shift( $shipping_methods );
			if ( $shipping_method->get_method_id() === 'coolca' ) {
				$instance_id          = substr( $shipping_method, strpos( $shipping_method, ':' ) + 1 );
				$CoolCAShippingMethod = new WC_CoolCA( $instance_id );

				// Check if shipping method is branch.
				if ( 'branch' === $CoolCAShippingMethod->service_type ) {
					$brachCd = trim( wc_get_order_item_meta( $shipping_method->get_id(), 'Sucursal' ) );
				}
			}

			// Cantidad de Paquetes por Pedidos.
			$PaqAr     = array();
			$MaxWeight = 25;

			if ( $totalWeight > $MaxWeight ) {
				$cantPaq = floor( $totalWeight / $MaxWeight );
				$diff    = $totalWeight % $MaxWeight;
				if ( $diff > 0 ) {
					++$cantPaq;
				}
				for ( $i = 1; $i < $cantPaq; $i++ ) {
					array_push( $PaqAr, $MaxWeight );
				}
				array_push( $PaqAr, ( $diff > 0 ) ? $diff : $MaxWeight );
			} else {
				$PaqAr[0] = $totalWeight;
			}

			foreach ( $PaqAr as $pa ) {
				?>

				<?php if ( ! empty( $brachCd ) ) { ?>
					<tr>
						<td>
							<button type="button" class="btn btn-default coolca-delete-btn" aria-label="Left Align">
								<span class="dashicons-before dashicons-trash" aria-hidden="true"></span>
							</button>
							<button type="button" class="btn btn-default coolca-add-btn" aria-label="Left Align">
									<span class="dashicons-before dashicons-plus" aria-hidden="true"></span>
							</button>
							<a href="<?php echo esc_url( get_admin_url( null, 'post.php?post=' . $order_id . '&action=edit' ) ); ?>" target='_blank'><span class="btn dashicons-before dashicons-search" aria-hidden="true"></span><a/>
						</td>
						<td class=""> <?php echo esc_html( $order_id ); ?> </td>
						<td class="coolca-exportable"> CP </td>
						<td class="coolca-exportable"> <span class="btn dashicons-before dashicons-edit coolca-edit-span" aria-hidden="true"><?php echo esc_html( helper::remove_special_chars( $totalLength ) ); ?></span> <span class="dashicons-before dashicons-pencil" aria-hidden="true"></span> </td>
						<td class="coolca-exportable"> <span class="btn dashicons-before dashicons-edit coolca-edit-span" aria-hidden="true"><?php echo esc_html( helper::remove_special_chars( $totalWidth ) ); ?></span> <span class="dashicons-before dashicons-pencil" aria-hidden="true"></span> </td>
						<td class="coolca-exportable"> <span class="btn dashicons-before dashicons-edit coolca-edit-span" aria-hidden="true"><?php echo esc_html( helper::remove_special_chars( $totalHeight ) ); ?></span> <span class="dashicons-before dashicons-pencil" aria-hidden="true"></span> </td>
						<td class="coolca-exportable"> <span class="btn dashicons-before dashicons-edit coolca-edit-span" aria-hidden="true"><?php echo esc_html( helper::remove_special_chars( $pa ) ); ?> </span>  </td>
						<td class="coolca-exportable"> <span class="btn dashicons-before dashicons-edit coolca-edit-span" aria-hidden="true"><?php echo esc_html( helper::remove_special_chars( $totalPrice ) ); ?> </span>  </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( Helper::get_branches()[ $brachCd ]['s'] ) ); ?> </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $brachCd ) ); ?> </td>
						<td class="coolca-exportable"> </td>
						<td class="coolca-exportable"> </td>
						<td class="coolca-exportable"> </td>
						<td class="coolca-exportable"> </td>
						<td class="coolca-exportable"> </td>
						<td class="coolca-exportable"> </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['full_name'] ) ); ?> </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['email'] ) ); ?> </td>
						<td class="coolca-exportable"> </td>
						<td class="coolca-exportable"> </td>
						<td class="coolca-exportable"> 11 </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['phone'] ) ); ?>  </td>
					</tr>
				<?php } else { ?>
					<tr>
						<td>
							<button type="button" class="btn btn-default coolca-delete-btn" aria-label="Left Align">
								<span class="dashicons-before dashicons-trash" aria-hidden="true"></span>
							</button>
							<button type="button" class="btn btn-default coolca-add-btn" aria-label="Left Align">
								<span class="dashicons-before dashicons-plus" aria-hidden="true"></span>
							</button>
							<a href="<?php echo esc_url( get_admin_url( null, 'post.php?post=' . $order_id . '&action=edit' ) ); ?>" target='_blank'><span class="btn dashicons-before dashicons-search" aria-hidden="true"></span><a/>
						</td>
						<td class=""> <?php echo esc_html( $order_id ); ?> </td>
						<td class="coolca-exportable"> CP </td>
						<td class="coolca-exportable"> <span class="btn dashicons-before dashicons-edit coolca-edit-span" aria-hidden="true"><?php echo esc_html( helper::remove_special_chars( $totalLength ) ); ?></span>  </td>
						<td class="coolca-exportable"> <span class="btn dashicons-before dashicons-edit coolca-edit-span" aria-hidden="true"><?php echo esc_html( helper::remove_special_chars( $totalWidth ) ); ?></span>  </td>
						<td class="coolca-exportable"> <span class="btn dashicons-before dashicons-edit coolca-edit-span" aria-hidden="true"><?php echo esc_html( helper::remove_special_chars( $totalHeight ) ); ?> </span>  </td>
						<td class="coolca-exportable"> <span class="btn dashicons-before dashicons-edit coolca-edit-span" aria-hidden="true"><?php echo esc_html( helper::remove_special_chars( $pa ) ); ?> </span>  </td>
						<td class="coolca-exportable"> <span class="btn dashicons-before dashicons-edit coolca-edit-span" aria-hidden="true"><?php echo esc_html( helper::remove_special_chars( $totalPrice ) ); ?> </span> </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['province'] ) ); ?> </td>
						<td class="coolca-exportable">  </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['locality'] ) ); ?> </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['street'] ) ); ?>  </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['number'] ) ); ?>  </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['floor'] ) ); ?>   </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['apartment'] ) ); ?>   </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['cp'] ) ); ?>  </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['full_name'] ) ); ?> </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['email'] ) ); ?> </td>
						<td class="coolca-exportable"> </td>
						<td class="coolca-exportable"> </td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['phone_prefix'] ) ); ?></td>
						<td class="coolca-exportable"> <?php echo esc_html( helper::remove_special_chars( $customer['phone'] ) ); ?>  </td>
					</tr>
					<?php
				}
			}
			?>

			<?php
		}
		?>
	</tbody>
</table>
</div>
<button id='cool-ca-export2csv' class="btn btn-primary"> <?php esc_html_e( 'Exportar a CSV', 'coolca' ); ?></button>
	<?php
	wp_enqueue_script( 'coolca-app', Helper::get_assets_folder_url() . '/js/app.js', array( 'jquery' ), true, 'in_footer' );
} else {
	?>
	<p> <?php esc_html_e( 'No hay pedidos en el rango de fechas indicado', 'coolca' ); ?></p>
	<?php
}
?>
