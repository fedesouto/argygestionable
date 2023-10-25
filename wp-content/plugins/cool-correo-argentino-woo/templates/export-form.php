<?php
/**
 * PHP version 7
 *
 * @package  Templates
 */

$from_dt_dflt      = $args['from_dt_dflt'];
$to_dt_dflt        = $args['to_dt_dflt'];
$curr_status       = $args['curr_status'];
$nonce             = $args['cool-ca-export-nonce'];
$inc_free_shipping = $args['inc_free_shipping'];
?>
<form action="" method="post" enctype="multipart/form-data" >
	<input type="hidden" name="cool-ca-export-nonce" value="<?php echo esc_html( $nonce ); ?>">
	<label for="coolca_from_dt"><?php esc_html_e( 'Fecha desde: ', 'coolca' ); ?>
		<input type="date" name="coolca_from_dt" value="<?php echo esc_attr( $from_dt_dflt ); ?>" required/>
	</label>
	<label for="coolca_to_dt"><?php esc_html_e( 'a:', 'coolca' ); ?>
		<input type="date" name="coolca_to_dt" value="<?php echo esc_attr( $to_dt_dflt ); ?>" required/>
	</label>
	<label for="coolca_status"><?php esc_html_e( 'Estado:', 'coolca' ); ?>
		<select name="coolca_status" id="cars">
			<?php
				$wc_order_statuses        = wc_get_order_statuses();
				$wc_order_statuses['all'] = __( 'Todos', 'coll-ca' );
			foreach ( $wc_order_statuses as $key => $value ) {
				$selected = ( $curr_status === $key ) ? 'selected' : '';
				echo '<option value="' . esc_attr( $key ) . '" ' . esc_attr( $selected ) . '>' . esc_html( $value ) . '</option>';
			}
			?>
		</select>
	</label>
	<label for="coolca_include_free"><?php esc_html_e( 'Incluir Método Envío Gratuito:', 'coolca' ); ?>
		<input type="checkbox" name="coolca_include_free-shipping" <?php echo ( $inc_free_shipping ) ? 'checked' : ''; ?>/>
	</label>
	<input type="hidden" name="coolca_search" />
	<input type="submit" class="btn btn-primary" value="Buscar" name="submit"></p>
</form>
