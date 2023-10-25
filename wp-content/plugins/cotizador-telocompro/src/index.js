import React from 'react';
import ReactDOM from 'react-dom';
import BackOffice from './BackOffice';

document.addEventListener( 'DOMContentLoaded', function() {
    var element = document.getElementById( 'ctlc-admin-app' );
    if( typeof element !== 'undefined' && element !== null ) {
        ReactDOM.render( <BackOffice />, document.getElementById( 'ctlc-admin-app' ) );
    }
} )