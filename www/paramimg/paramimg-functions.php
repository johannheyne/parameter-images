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
    
    function paramimg_get_image( $param ) {
        
        $defaults = array(
            'id' => false,
            'json' => false,
            'src' => false
        );
        
        $param = array_replace_recursive ( $defaults, $param );
        
        $return = false;
        
        if ( $param['src'] ) {
            
            $return .= '<img src="' . $param['src'] . '">';
        }
        
        return $return;
    }
        
?>