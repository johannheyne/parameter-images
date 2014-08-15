<?php

	// INCLUDE IMAGE SETUP {

		include('setup.php');
		
	// }
	
	function get_image( $p = array() ) {
		
		global $setup;
		
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
		
		// PREPARE BEHAVIOR JSON {
			
			$respbehavior_arr = array();
			
			foreach ( $setup['breakpoints'][ $p['behavior'] ] as $key => $item ) {
			    
				array_push( $respbehavior_arr, $key );
			}
			
			$respbehavior_json = json_encode( $respbehavior_arr );
			
		// }
		
		// GET CURRENT BREAKPOINT {

			/*$devicedata = json_decode( stripslashes( $_COOKIE['devicedata'] ), true );
			$window_width = $devicedata['window']['width'];
			
			ksort( $setup['breakpoints'][ $p['behavior'] ] );
			$current_breakpoint = false;

			foreach ( $setup['breakpoints'][ $p['behavior'] ] as $breakpoint => $item ) {

		    	if ( ! $current_breakpoint &&  $breakpoint >= $window_width ) {

					$current_breakpoint = $breakpoint;
				}
			}*/
			
		// }
		
	    if ( $p['behavior'] ) {
			
			$vars['return'] .= '<img class="resp behavior-' . $p['behavior'] . '" src="' . $p['src'] . '?behavior=' . $p['behavior'] . '" data-respbehavior="' . $respbehavior_json . '">';
			
			return $vars['return'];
	    }
	    else {

	    	return '';
	    }

	}

?>