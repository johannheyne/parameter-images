<?php

    // Parameter-Images

    include( 'paramimg-functions.php' );

    /* predefine all variables using in the script */

    $vars = array(
        'document_root' => $_SERVER['DOCUMENT_ROOT'],
        'request_uri' => $_SERVER['REQUEST_URI'],
        'request_param' => false,
        'content_type' => false,
    );

    /* setup all parameters from $_REQEST and image setup */

    $param = array(
        'expire' => 1,
    );

    /* separate uri and uri-parameters */

    if ( strstr( $vars['request_uri'], '?' ) ) {

        $temp = explode( '?', $vars['request_uri'] );
        $vars['request_uri'] = $temp[0];
        $vars['request_param'] = $temp[1];
        unset( $temp );
    }

    /* set variables */

    /*
        Replace parameters from image setup (spezified by the id parameter) 
        with parameters send in uri.

        if ( isset( $_GET['id'] ) ) {

            $temp = paramimg_decode_query( $_GET['id'] );

            if ( is_array( $temp ) ) {

                $param['param'] = $temp;
            }
        }

    */

    $param['expire'] = 60;
    $vars['content_type'] = 'image/jpg';

    /* return image */

    header( 'content-type: ' . $vars['content_type'] );
    header( 'cache-control: private, max-age=' . $param['expire'] );
    header( 'expires: ' . gmdate( 'D, d M Y H:i:s', time() + $param['expire'] ) . ' GMT' );

    readfile( $vars['document_root'] . $vars['request_uri'] );

?>