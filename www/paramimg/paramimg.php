<?php
    
    /**
     * Parameter-Images
     *
     * @package    Parameter-Images
     * @link       http://www.parameter-images.de/
     * @since      Release 0.1
     */
    
    
    /* define all variables */
    
    $vars = array(
        'document_root' => $_SERVER['DOCUMENT_ROOT'],
        'request_uri' => $_SERVER['REQUEST_URI'],
        'request_param' => false,
        'content_type' => false,
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
    
    $vars['expire'] = 60;
    $vars['content_type'] = 'image/jpg';
    
    
    /* return image */
    
    header( 'content-type: ' . $vars['content_type'] );
    header( 'cache-control: private, max-age=' . $vars['expire'] );
    header( 'expires: ' . gmdate( 'D, d M Y H:i:s', time() + $vars['expire'] ) . ' GMT' );
    
    readfile( $vars['document_root'] . $vars['request_uri'] );
    
?>