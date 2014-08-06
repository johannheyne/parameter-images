<?php

	function get_image( $p = array() ) {

	    // DEFAULTS {

	        $defaults = array(
            	'behavior' => false,
            	'src' => false,
	        );

	        $p = array_replace_recursive( $defaults, $p );

	    // }
	
		// VARS {

			$vars['return'] = false;

		// }

	    if ( $p['behavior'] ) {
			
			$vars['return'] .= '<img src="' . $p['src'] . '?behavior=' . $p['behavior'] . '">';
			
			return $vars['return'];
	    }
	    else {

	    	return '';
	    }

	}

?>