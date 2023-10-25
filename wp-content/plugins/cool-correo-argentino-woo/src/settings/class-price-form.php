<?php
/**
 * Price Form Main Class
 *
 * @package  MANCA\CoolCA\Settings
 */

namespace MANCA\CoolCA\Settings;

/**
 * CoolCA Setting Section Main
 */
class PriceForm {

	/**
	 * Render Price Form.
	 *
	 * @param string $value Nothing.
	 * @return void
	 */
	public static function render( $value ) {
		$saved_values = ! empty( get_option( 'wc-coolca-price' ) )
			? get_option( 'wc-coolca-price' )
			: array();
		$saved_values = array_merge(
			array(
				'classic'  => array(
					'0.5' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'1'   => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'2'   => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'3'   => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'5'   => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'10'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'15'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'20'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'25'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'30'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
				),
				'branch'   => array(
					'0.5' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'1'   => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'2'   => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'3'   => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'5'   => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'10'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'15'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'20'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'25'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'30'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
				),
				'vclassic' => array(
					'35'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'40'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'50'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'60'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'70'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'80'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'90'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'100' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'110' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'120' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'130' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'140' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'150' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
				),
				'vbranch'  => array(
					'35'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'40'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'50'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'60'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'70'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'80'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'90'  => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'100' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'110' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'120' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'130' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'140' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
					'150' => array(
						'1' => 0,
						'2' => 0,
						'3' => 0,
						'4' => 0,
					),
				),
			),
			$saved_values
		);
		?>	
		<br>        
		<table>            
			<thead>
				<tr>
					<th rowspan=2 colspan=2><?php esc_html_e( 'Clásico', 'cool-ca' ); ?></th>
					<th colspan=4><?php esc_html_e( 'ZONA', 'cool-ca' ); ?></th>
				</tr>
				<tr>
					<th><?php esc_html_e( '1', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '2', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '3', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '4', 'cool-ca' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th rowspan=10><?php esc_html_e( 'PESO', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '0.5', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[classic][0.5][1]" value="<?php echo esc_html( $saved_values['classic']['0.5']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][0.5][2]" value="<?php echo esc_html( $saved_values['classic']['0.5']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][0.5][3]" value="<?php echo esc_html( $saved_values['classic']['0.5']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][0.5][4]" value="<?php echo esc_html( $saved_values['classic']['0.5']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '1', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[classic][1][1]" value="<?php echo esc_html( $saved_values['classic']['1']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][1][2]" value="<?php echo esc_html( $saved_values['classic']['1']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][1][3]" value="<?php echo esc_html( $saved_values['classic']['1']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][1][4]" value="<?php echo esc_html( $saved_values['classic']['1']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '2', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[classic][2][1]" value="<?php echo esc_html( $saved_values['classic']['2']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][2][2]" value="<?php echo esc_html( $saved_values['classic']['2']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][2][3]" value="<?php echo esc_html( $saved_values['classic']['2']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][2][4]" value="<?php echo esc_html( $saved_values['classic']['2']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '3', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[classic][3][1]" value="<?php echo esc_html( $saved_values['classic']['3']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][3][2]" value="<?php echo esc_html( $saved_values['classic']['3']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][3][3]" value="<?php echo esc_html( $saved_values['classic']['3']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][3][4]" value="<?php echo esc_html( $saved_values['classic']['3']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '5', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[classic][5][1]" value="<?php echo esc_html( $saved_values['classic']['5']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][5][2]" value="<?php echo esc_html( $saved_values['classic']['5']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][5][3]" value="<?php echo esc_html( $saved_values['classic']['5']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][5][4]" value="<?php echo esc_html( $saved_values['classic']['5']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '10', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[classic][10][1]" value="<?php echo esc_html( $saved_values['classic']['10']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][10][2]" value="<?php echo esc_html( $saved_values['classic']['10']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][10][3]" value="<?php echo esc_html( $saved_values['classic']['10']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][10][4]" value="<?php echo esc_html( $saved_values['classic']['10']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '15', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[classic][15][1]" value="<?php echo esc_html( $saved_values['classic']['15']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][15][2]" value="<?php echo esc_html( $saved_values['classic']['15']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][15][3]" value="<?php echo esc_html( $saved_values['classic']['15']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][15][4]" value="<?php echo esc_html( $saved_values['classic']['15']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '20', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[classic][20][1]" value="<?php echo esc_html( $saved_values['classic']['20']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][20][2]" value="<?php echo esc_html( $saved_values['classic']['20']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][20][3]" value="<?php echo esc_html( $saved_values['classic']['20']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][20][4]" value="<?php echo esc_html( $saved_values['classic']['20']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '25', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[classic][25][1]" value="<?php echo esc_html( $saved_values['classic']['25']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][25][2]" value="<?php echo esc_html( $saved_values['classic']['25']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][25][3]" value="<?php echo esc_html( $saved_values['classic']['25']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][25][4]" value="<?php echo esc_html( $saved_values['classic']['25']['4'] ); ?>" step=".01"></td>
				</tr>	
				<tr>
					<th><?php esc_html_e( '30', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[classic][30][1]" value="<?php echo esc_html( $saved_values['classic']['30']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][30][2]" value="<?php echo esc_html( $saved_values['classic']['30']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][30][3]" value="<?php echo esc_html( $saved_values['classic']['30']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[classic][30][4]" value="<?php echo esc_html( $saved_values['classic']['30']['4'] ); ?>" step=".01"></td>
				</tr>							 
			</tbody>
		</table>        
		<table>            
			<thead>
				<tr>
					<th rowspan=2 colspan=2><?php esc_html_e( 'Sucursal', 'cool-ca' ); ?></th>
					<th colspan=4><?php esc_html_e( 'ZONA', 'cool-ca' ); ?></th>
				</tr>
				<tr>
					<th><?php esc_html_e( '1', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '2', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '3', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '4', 'cool-ca' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th rowspan=10><?php esc_html_e( 'PESO', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '0.5', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[branch][0.5][1]" value="<?php echo esc_html( $saved_values['branch']['0.5']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][0.5][2]" value="<?php echo esc_html( $saved_values['branch']['0.5']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][0.5][3]" value="<?php echo esc_html( $saved_values['branch']['0.5']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][0.5][4]" value="<?php echo esc_html( $saved_values['branch']['0.5']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '1', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[branch][1][1]" value="<?php echo esc_html( $saved_values['branch']['1']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][1][2]" value="<?php echo esc_html( $saved_values['branch']['1']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][1][3]" value="<?php echo esc_html( $saved_values['branch']['1']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][1][4]" value="<?php echo esc_html( $saved_values['branch']['1']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '2', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[branch][2][1]" value="<?php echo esc_html( $saved_values['branch']['2']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][2][2]" value="<?php echo esc_html( $saved_values['branch']['2']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][2][3]" value="<?php echo esc_html( $saved_values['branch']['2']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][2][4]" value="<?php echo esc_html( $saved_values['branch']['2']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '3', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[branch][3][1]" value="<?php echo esc_html( $saved_values['branch']['3']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][3][2]" value="<?php echo esc_html( $saved_values['branch']['3']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][3][3]" value="<?php echo esc_html( $saved_values['branch']['3']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][3][4]" value="<?php echo esc_html( $saved_values['branch']['3']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '5', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[branch][5][1]" value="<?php echo esc_html( $saved_values['branch']['5']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][5][2]" value="<?php echo esc_html( $saved_values['branch']['5']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][5][3]" value="<?php echo esc_html( $saved_values['branch']['5']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][5][4]" value="<?php echo esc_html( $saved_values['branch']['5']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '10', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[branch][10][1]" value="<?php echo esc_html( $saved_values['branch']['10']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][10][2]" value="<?php echo esc_html( $saved_values['branch']['10']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][10][3]" value="<?php echo esc_html( $saved_values['branch']['10']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][10][4]" value="<?php echo esc_html( $saved_values['branch']['10']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '15', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[branch][15][1]" value="<?php echo esc_html( $saved_values['branch']['15']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][15][2]" value="<?php echo esc_html( $saved_values['branch']['15']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][15][3]" value="<?php echo esc_html( $saved_values['branch']['15']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][15][4]" value="<?php echo esc_html( $saved_values['branch']['15']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '20', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[branch][20][1]" value="<?php echo esc_html( $saved_values['branch']['20']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][20][2]" value="<?php echo esc_html( $saved_values['branch']['20']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][20][3]" value="<?php echo esc_html( $saved_values['branch']['20']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][20][4]" value="<?php echo esc_html( $saved_values['branch']['20']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '25', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[branch][25][1]" value="<?php echo esc_html( $saved_values['branch']['25']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][25][2]" value="<?php echo esc_html( $saved_values['branch']['25']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][25][3]" value="<?php echo esc_html( $saved_values['branch']['25']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][25][4]" value="<?php echo esc_html( $saved_values['branch']['25']['4'] ); ?>" step=".01"></td>
				</tr>
				<tr>
					<th><?php esc_html_e( '30', 'cool-ca' ); ?></th>
					<td><input type="number" name="wc-coolca-price[branch][30][1]" value="<?php echo esc_html( $saved_values['branch']['30']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][30][2]" value="<?php echo esc_html( $saved_values['branch']['30']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][30][3]" value="<?php echo esc_html( $saved_values['branch']['30']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[branch][30][4]" value="<?php echo esc_html( $saved_values['branch']['30']['4'] ); ?>" step=".01"></td>
				</tr>								 
			</tbody>			
		</table>
		<br>
		<table>            
			<thead>
				<tr>
					<th rowspan=2 colspan=2><?php esc_html_e( 'Volumétrico Clásico', 'cool-ca' ); ?></th>
					<th colspan=4><?php esc_html_e( 'ZONA', 'cool-ca' ); ?></th>
				</tr>
				<tr>
					<th><?php esc_html_e( '1', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '2', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '3', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '4', 'cool-ca' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th rowspan=13><?php esc_html_e( 'PESO', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '35', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vclassic][35][1]" value="<?php echo esc_html( $saved_values['vclassic']['35']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][35][2]" value="<?php echo esc_html( $saved_values['vclassic']['35']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][35][3]" value="<?php echo esc_html( $saved_values['vclassic']['35']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][35][4]" value="<?php echo esc_html( $saved_values['vclassic']['35']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '40', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vclassic][40][1]" value="<?php echo esc_html( $saved_values['vclassic']['40']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][40][2]" value="<?php echo esc_html( $saved_values['vclassic']['40']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][40][3]" value="<?php echo esc_html( $saved_values['vclassic']['40']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][40][4]" value="<?php echo esc_html( $saved_values['vclassic']['40']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '50', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vclassic][50][1]" value="<?php echo esc_html( $saved_values['vclassic']['50']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][50][2]" value="<?php echo esc_html( $saved_values['vclassic']['50']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][50][3]" value="<?php echo esc_html( $saved_values['vclassic']['50']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][50][4]" value="<?php echo esc_html( $saved_values['vclassic']['50']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '60', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vclassic][60][1]" value="<?php echo esc_html( $saved_values['vclassic']['60']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][60][2]" value="<?php echo esc_html( $saved_values['vclassic']['60']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][60][3]" value="<?php echo esc_html( $saved_values['vclassic']['60']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][60][4]" value="<?php echo esc_html( $saved_values['vclassic']['60']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '70', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vclassic][70][1]" value="<?php echo esc_html( $saved_values['vclassic']['70']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][70][2]" value="<?php echo esc_html( $saved_values['vclassic']['70']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][70][3]" value="<?php echo esc_html( $saved_values['vclassic']['70']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][70][4]" value="<?php echo esc_html( $saved_values['vclassic']['70']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '80', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vclassic][80][1]" value="<?php echo esc_html( $saved_values['vclassic']['80']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][80][2]" value="<?php echo esc_html( $saved_values['vclassic']['80']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][80][3]" value="<?php echo esc_html( $saved_values['vclassic']['80']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][80][4]" value="<?php echo esc_html( $saved_values['vclassic']['80']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '90', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vclassic][90][1]" value="<?php echo esc_html( $saved_values['vclassic']['90']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][90][2]" value="<?php echo esc_html( $saved_values['vclassic']['90']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][90][3]" value="<?php echo esc_html( $saved_values['vclassic']['90']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][90][4]" value="<?php echo esc_html( $saved_values['vclassic']['90']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '100', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vclassic][100][1]" value="<?php echo esc_html( $saved_values['vclassic']['100']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][100][2]" value="<?php echo esc_html( $saved_values['vclassic']['100']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][100][3]" value="<?php echo esc_html( $saved_values['vclassic']['100']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][100][4]" value="<?php echo esc_html( $saved_values['vclassic']['100']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '110', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vclassic][110][1]" value="<?php echo esc_html( $saved_values['vclassic']['110']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][110][2]" value="<?php echo esc_html( $saved_values['vclassic']['110']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][110][3]" value="<?php echo esc_html( $saved_values['vclassic']['110']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][110][4]" value="<?php echo esc_html( $saved_values['vclassic']['110']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '120', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vclassic][120][1]" value="<?php echo esc_html( $saved_values['vclassic']['120']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][120][2]" value="<?php echo esc_html( $saved_values['vclassic']['120']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][120][3]" value="<?php echo esc_html( $saved_values['vclassic']['120']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][120][4]" value="<?php echo esc_html( $saved_values['vclassic']['120']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '130', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vclassic][130][1]" value="<?php echo esc_html( $saved_values['vclassic']['130']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][130][2]" value="<?php echo esc_html( $saved_values['vclassic']['130']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][130][3]" value="<?php echo esc_html( $saved_values['vclassic']['130']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][130][4]" value="<?php echo esc_html( $saved_values['vclassic']['130']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '140', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vclassic][140][1]" value="<?php echo esc_html( $saved_values['vclassic']['140']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][140][2]" value="<?php echo esc_html( $saved_values['vclassic']['140']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][140][3]" value="<?php echo esc_html( $saved_values['vclassic']['140']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][140][4]" value="<?php echo esc_html( $saved_values['vclassic']['140']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '150', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vclassic][150][1]" value="<?php echo esc_html( $saved_values['vclassic']['150']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][150][2]" value="<?php echo esc_html( $saved_values['vclassic']['150']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][150][3]" value="<?php echo esc_html( $saved_values['vclassic']['150']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vclassic][150][4]" value="<?php echo esc_html( $saved_values['vclassic']['150']['4'] ); ?>" step=".01"></td>						
				</tr>
			</tbody>			
		</table>        
		<table>            
			<thead>
				<tr>
					<th rowspan=2 colspan=2><?php esc_html_e( 'Volumétrico Sucursal', 'cool-ca' ); ?></th>
					<th colspan=4><?php esc_html_e( 'ZONA', 'cool-ca' ); ?></th>
				</tr>
				<tr>
					<th><?php esc_html_e( '1', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '2', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '3', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '4', 'cool-ca' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th rowspan=13><?php esc_html_e( 'PESO', 'cool-ca' ); ?></th>
					<th><?php esc_html_e( '35', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vbranch][35][1]" value="<?php echo esc_html( $saved_values['vbranch']['35']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][35][2]" value="<?php echo esc_html( $saved_values['vbranch']['35']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][35][3]" value="<?php echo esc_html( $saved_values['vbranch']['35']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][35][4]" value="<?php echo esc_html( $saved_values['vbranch']['35']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '40', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vbranch][40][1]" value="<?php echo esc_html( $saved_values['vbranch']['40']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][40][2]" value="<?php echo esc_html( $saved_values['vbranch']['40']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][40][3]" value="<?php echo esc_html( $saved_values['vbranch']['40']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][40][4]" value="<?php echo esc_html( $saved_values['vbranch']['40']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '50', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vbranch][50][1]" value="<?php echo esc_html( $saved_values['vbranch']['50']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][50][2]" value="<?php echo esc_html( $saved_values['vbranch']['50']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][50][3]" value="<?php echo esc_html( $saved_values['vbranch']['50']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][50][4]" value="<?php echo esc_html( $saved_values['vbranch']['50']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '60', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vbranch][60][1]" value="<?php echo esc_html( $saved_values['vbranch']['60']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][60][2]" value="<?php echo esc_html( $saved_values['vbranch']['60']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][60][3]" value="<?php echo esc_html( $saved_values['vbranch']['60']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][60][4]" value="<?php echo esc_html( $saved_values['vbranch']['60']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '70', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vbranch][70][1]" value="<?php echo esc_html( $saved_values['vbranch']['70']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][70][2]" value="<?php echo esc_html( $saved_values['vbranch']['70']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][70][3]" value="<?php echo esc_html( $saved_values['vbranch']['70']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][70][4]" value="<?php echo esc_html( $saved_values['vbranch']['70']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '80', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vbranch][80][1]" value="<?php echo esc_html( $saved_values['vbranch']['80']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][80][2]" value="<?php echo esc_html( $saved_values['vbranch']['80']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][80][3]" value="<?php echo esc_html( $saved_values['vbranch']['80']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][80][4]" value="<?php echo esc_html( $saved_values['vbranch']['80']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '90', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vbranch][90][1]" value="<?php echo esc_html( $saved_values['vbranch']['90']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][90][2]" value="<?php echo esc_html( $saved_values['vbranch']['90']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][90][3]" value="<?php echo esc_html( $saved_values['vbranch']['90']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][90][4]" value="<?php echo esc_html( $saved_values['vbranch']['90']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '100', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vbranch][100][1]" value="<?php echo esc_html( $saved_values['vbranch']['100']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][100][2]" value="<?php echo esc_html( $saved_values['vbranch']['100']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][100][3]" value="<?php echo esc_html( $saved_values['vbranch']['100']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][100][4]" value="<?php echo esc_html( $saved_values['vbranch']['100']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '110', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vbranch][110][1]" value="<?php echo esc_html( $saved_values['vbranch']['110']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][110][2]" value="<?php echo esc_html( $saved_values['vbranch']['110']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][110][3]" value="<?php echo esc_html( $saved_values['vbranch']['110']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][110][4]" value="<?php echo esc_html( $saved_values['vbranch']['110']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '120', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vbranch][120][1]" value="<?php echo esc_html( $saved_values['vbranch']['120']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][120][2]" value="<?php echo esc_html( $saved_values['vbranch']['120']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][120][3]" value="<?php echo esc_html( $saved_values['vbranch']['120']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][120][4]" value="<?php echo esc_html( $saved_values['vbranch']['120']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '130', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vbranch][130][1]" value="<?php echo esc_html( $saved_values['vbranch']['130']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][130][2]" value="<?php echo esc_html( $saved_values['vbranch']['130']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][130][3]" value="<?php echo esc_html( $saved_values['vbranch']['130']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][130][4]" value="<?php echo esc_html( $saved_values['vbranch']['130']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '140', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vbranch][140][1]" value="<?php echo esc_html( $saved_values['vbranch']['140']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][140][2]" value="<?php echo esc_html( $saved_values['vbranch']['140']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][140][3]" value="<?php echo esc_html( $saved_values['vbranch']['140']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][140][4]" value="<?php echo esc_html( $saved_values['vbranch']['140']['4'] ); ?>" step=".01"></td>						
				</tr>
				<tr>
					<th><?php esc_html_e( '150', 'cool-ca' ); ?></th>                   					 
					<td><input type="number" name="wc-coolca-price[vbranch][150][1]" value="<?php echo esc_html( $saved_values['vbranch']['150']['1'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][150][2]" value="<?php echo esc_html( $saved_values['vbranch']['150']['2'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][150][3]" value="<?php echo esc_html( $saved_values['vbranch']['150']['3'] ); ?>" step=".01"></td>
					<td><input type="number" name="wc-coolca-price[vbranch][150][4]" value="<?php echo esc_html( $saved_values['vbranch']['150']['4'] ); ?>" step=".01"></td>						
				</tr>
			</tbody>			
		</table>        
		<?php
	}
}
