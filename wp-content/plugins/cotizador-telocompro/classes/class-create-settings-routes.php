<?php

/**
 * This file will create Custom Rest API End Points.
 */
class WP_React_Settings_Rest_Route
{

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'create_rest_routes']);
    }

    public function create_rest_routes()
    {
        register_rest_route('ctlc/v1', '/rates', [
            'methods' => 'GET',
            'callback' => [$this, 'get_settings'],
            'permission_callback' => [$this, 'get_settings_permission']
        ]);
        register_rest_route('ctlc/v1', '/rates', [
            'methods' => 'POST',
            'callback' => [$this, 'save_settings'],
            'permission_callback' => [$this, 'save_settings_permission']
        ]);
        register_rest_route('ctlc/v1', '/solicitar', [
            'methods' => 'POST',
            'callback' => [$this, 'solicitar'],
            'permission_callback' => [$this, 'get_settings_permission']
        ]);
    }

    public function get_settings()
    {
        $rates = get_option('ctlc_rates');
        $response = [
            'rates' => $rates,
        ];

        return rest_ensure_response($response);
    }

    public function get_settings_permission()
    {
        return true;
    }

    public function save_settings($req)
    {

        // TODO: Sanizitizar valores 
        $rates = $req['rates'];

        update_option('ctlc_rates', $rates);
        return rest_ensure_response('success');
    }

    public function save_settings_permission()
    {
        return current_user_can('publish_posts');
    }

    /* 
        BUSCA LA TASA EN LA BASE DE DATOS.

    public function cotizar($req)
    {
        $request = $req['request'];
        $monto = $request['monto'];
        $cuotas = $request['cuotas'];

        $rates = get_option('ctlc_rates');

        $obj = reset(array_filter($rates, function ($item) use ($cuotas, $monto) {
            return $item['cuotas'] == $cuotas && $item['monto'] == $monto;
        }));

        return rest_ensure_response($obj);
    } */

    public function solicitar($req)
    {
        $request = $req['request'];

        $nombre = $request['nombre'];
        $apellido = $request['apellido'];
        /* $correo = $request['correo'];
        $telefono = $request['telefono'];
        $direccion = $request['direccion'];
        $provincia = $request['provincia'];
        $localidad = $request['localidad'];
        $codigo_postal = $request['codigo_postal'];
        $banco = $request['banco'];
        $cuit_cuil = $request['cuit_cuil'];
        $cbu = $request['cbu'];
        $tipo_de_cuenta = $request['tipo_de_cuenta'];
        $ingresos_mensuales = $request['ingresos_mensuales'];
        $tarjeta = $request['tarjeta'];
        $cuotas = $request['cuotas'];
        $monto_a_devolver = $request['monto_a_devolver'];
        $monto_cuota = $request['monto_cuota'];
        $monto_solicitado = $request['monto_solicitado']; */

        $res = $nombre . " " . $apellido;

        $headers = "From: argytec@gmail.com";
        $to = "argytec@gmail.com";
        
        return rest_ensure_response($res);
        
        
            if(wp_mail($to, 'Prueba', 'Funca telocompro', $headers)) {
        

        return rest_ensure_response('success');}
        else{ 
            return rest_ensure_response('not success');
        }
    }
}
new WP_React_Settings_Rest_Route();
