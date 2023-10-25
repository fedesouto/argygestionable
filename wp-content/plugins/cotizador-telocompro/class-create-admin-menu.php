<?php
/**
 * This file will create admin menu page.
 */

class CTLC_Create_Admin_Page {

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'create_admin_menu' ] );
    }

    public function create_admin_menu() {
        $capability = 'manage_options';
        $slug = 'ctlc-settings';

        add_menu_page(
            __( 'Cotizador Telocompro', 'wp-cotizador-telocompro' ),
            __( 'Cotizador Telocompro', 'wp-cotizador-telocompro' ),
            $capability,
            $slug,
            [ $this, 'menu_page_template' ],
            'dashicons-buddicons-replies'
        );
    }

    public function menu_page_template() {
        echo '<div class="wrap"><div id="ctlc-admin-app"></div></div>';
    }

}
new CTLC_Create_Admin_Page();