<?php
    
    /**
     * Parameter-Images Functions
     *
     * @package    Parameter-Images
     * @link       http://www.parameter-images.de/
     * @since      Release 0.1
     */
    
    
    /** 
     * paramimg_get_image()
     * 
     * Returns the complete image html
     *
     * @since      Release 0.1
     * @version    1
     */
    
    function paramimg_get_image( $param = array() ) {
        
        $defaults = array(
            'id' => '',
            'param' => '',
            'src' => '',
        );
        
        $param = array_replace_recursive ( $defaults, $param );
        
        $vars = array(
            'param_array' => false,
            'param_string' => '',
        );
        
        if ( $param['param'] ) {
            
            $vars['param_array'][] = 'param=' . paramimg_encode_query( array( 'setup' => $param['param'] ) );
        }
        
        if ( $param['id'] ) {
            
            $vars['param_array'][] = 'id=' . $param['id'];
        }
        
        $return = false;
        
        if ( $param['src'] ) {
            
            if ( $vars['param_array'] ) {
            
                $vars['param_string'] = '?' . implode( '&', $vars['param_array'] );
            }
            
            $return .= '<img src="' . $param['src'] . $vars['param_string'] . '">';
        }
        
        return $return;
    }
    
    function paramimg_encode_query( $param = array() ) {
        
        $defaults = array(
            'setup' => false,
            'compress' => true
        );
        
        $param = array_replace_recursive( $defaults, $param );
        
        $return = false;
        
        if ( $param['setup'] ) {
            
            $return = http_build_query( $param['setup'] );

            if ( $param['compress'] ) {
               
               $return = gzcompress( $return, 9 );
               $return = rawurlencode( $return );
            }
        }
        
        return $return;
    }
    
    function paramimg_decode_query( $param = array() ) {
        
        $defaults = array(
            'query' => false,
            'uncompress' => true
        );
        
        $param = array_replace_recursive( $defaults, $param );
        
        $return = false;
        
        if ( $param['query'] ) {
            
            if ( $param['uncompress'] ) {
                
                $param['query'] = rawurldecode( $param['query'] );
                $param['query'] = gzuncompress( $param['query'] );
            }
            
            parse_str( $param['query'], $return );
        }
        
        return $return;
    }
        
?>