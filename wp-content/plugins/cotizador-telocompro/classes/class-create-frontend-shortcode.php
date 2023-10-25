<?php

class CTLC_Create_Frontend_Shortcode
{

    public function __construct()
    {
        add_shortcode('cotizador', [$this, 'create_cotizador']);
    }

    public function create_cotizador()
    {
        return ('<div id="root"></div>'
        );
    }
}

new CTLC_Create_Frontend_Shortcode();
