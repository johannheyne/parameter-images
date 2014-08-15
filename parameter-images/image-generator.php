<?php

	// INCLUDE IMAGE SETUP {

		include('setup.php');

	// }

	// VARS {

		$stat['new_w'] = false;
		$stat['new_h'] = false;
		$stat['offset_x'] = false;
		$stat['offset_y'] = false;
		$stat['browser_cache'] = false;
		$stat['breakpoint'] = false;
		$stat['breakpoint_step'] = false;

		$stat['devicedata'] = false;
		$stat['window_width'] = false;
		$stat['reduze'] = false;

		$stat['uri'] = false;
		$stat['path_root'] = false;
		$stat['path_cache_dir'] = false;
		$stat['filename'] = false;
		$stat['extension'] = false;
		$stat['path_file'] = false;
		$stat['dimensions'] = false;
		$stat['src_w'] = false;
		$stat['src_h'] = false;
		$stat['img_new'] = false;
		$stat['img_old'] = false;

	// }

	// GET THE IMAGE SETUP DATA OF BREAKPOINT {

		if ( isset( $_COOKIE['devicedata'] ) ) {

			$stat['devicedata'] = json_decode( stripslashes( $_COOKIE['devicedata'] ), true );
			$stat['window_width'] = $stat['devicedata']['window']['width'];
		}
		else {

			$stat['window_width'] = 9999;
		}

		ksort( $setup['breakpoints'][ $_GET['behavior'] ] );

		if ( isset( $_GET['breakpoint'] ) ) {

			$check_width = $_GET['breakpoint'];
		}
		else {

			$check_width = $stat['window_width'];
		}

		foreach ( $setup['breakpoints'][ $_GET['behavior'] ] as $breakpoint => $item ) {

			if ( 
				! isset( $stat['setup'] ) 
				OR ( $breakpoint <= $check_width ) 
			) {

				$stat['setup'] = $item;
			    $stat['breakpoint'] = $breakpoint;
				$set_breakpoint = true;
				$stat['reduze'] = 0;
			}
			else {

				if ( isset( $set_breakpoint ) ) {

				    $stat['breakpoint'] = $breakpoint;
					unset( $set_breakpoint );
					$stat['reduze'] = 1;
				}
			}
		}

	// }

	// GET SIZESTEP {

		for ( $i = $setup['sizesteps']['end']; $i >= $setup['sizesteps']['start']; $i = $i - $setup['sizesteps']['step'] ) {

			if ( $i > $check_width ) {

				$stat['breakpoint_step'] = $i;

				if ( $stat['breakpoint_step'] < $stat['breakpoint'] && $stat['breakpoint_step'] !== $stat['breakpoint'] ) {

					$stat['reduze'] = 0;
				}
			}
		}
		
		if ( ! $stat['breakpoint_step'] ) {
		    
			$stat['breakpoint_step'] = $setup['sizesteps']['end'];
		}

	// }

	// SETUP PARAMETERS OF NEW IMAGE {

		$stat['new_w'] = round( ( $stat['breakpoint_step'] / 100 ) * $stat['setup']['img_width'], 0, PHP_ROUND_HALF_UP ) - $stat['reduze'];
		$stat['new_h'] = round( $stat['new_w'] * $stat['setup']['ratio'], 0, PHP_ROUND_HALF_UP );
		$stat['offset_x'] = 0;
		$stat['offset_y'] = 0;
		$stat['browser_cache'] = 1;

	// }

	// DEFINE PATHS {

		$stat['uri'] = parse_url( urldecode( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH );
		$stat['path_root'] = str_replace( 'parameter-images/image-generator.php', '', $_SERVER['SCRIPT_FILENAME'] );
		$stat['filename'] = basename( $stat['uri'] );
		$stat['extension'] = strtolower( pathinfo( $stat['filename'], PATHINFO_EXTENSION ) );
		$stat['path_file'] = $stat['path_root'] . trim( $stat['uri'], '/' );
		$stat['path_cache_file'] = $stat['path_root'] . 'cache' . dirname( $stat['uri'] ) . '/' . $_GET['behavior'] . '/' . $stat['new_w'] . '-' . $stat['new_h'] . '-' . $stat['filename']; // '/' . $_GET['behavior']

	// }

	// GET OLD IMAGE SIZE {

		$stat['dimensions'] = getimagesize( $stat['path_file'] );
		$stat['src_w'] = $stat['dimensions'][0];
		$stat['src_h'] = $stat['dimensions'][1];

	// }

	// DEFINE NEW IMAGE {

		$stat['img_new'] = imagecreatetruecolor( $stat['new_w'], $stat['new_h'] ); // re-sized image

	// }

	// GET SOURCE IMAGE {

		switch ( $stat['extension'] ) {

			case 'png':
			$stat['img_old'] = @imagecreatefrompng( $stat['path_file'] ); // original image
			break;

			case 'gif':
			$stat['img_old'] = @imagecreatefromgif ( $stat['path_file'] ); // original image
			break;

			default:
			$stat['img_old'] = @imagecreatefromjpeg( $stat['path_file'] ); // original image
			imageinterlace( $stat['img_new'], true ); // Enable interlancing ( progressive JPG, smaller size file )
			break;
		}

		// PNG ALPHABLENDING

		if ( $stat['extension'] == 'png' ) {

			imagealphablending( $stat['img_new'], false );
			imagesavealpha( $stat['img_new'],true );
			$transparent = imagecolorallocatealpha( $stat['img_new'], 255, 255, 255, 127 );
			imagefilledrectangle( $stat['img_new'], 0, 0, $stat['new_w'], $stat['new_h'], $transparent );
		}

	// }

	// RESAMPLE IMAGE {

		imagecopyresampled( $stat['img_new'], $stat['img_old'], $stat['offset_x'], $stat['offset_y'], 0, 0, $stat['new_w'], $stat['new_h'], $stat['src_w'], $stat['src_h'] ); // do the resize in memory

		imagedestroy( $stat['img_old'] );

	// RESAMPLE IMAGE }

	// CACHE {

		// CACHE {

			$stat['path_cache_dir'] = dirname( $stat['path_cache_file'] );

			// does the directory exist already?
			if ( ! is_dir( $stat['path_cache_dir'] ) ) { 

				if ( ! mkdir( $stat['path_cache_dir'], 0755, true ) ) {

					// check again if it really doesn't exist to protect against race conditions
					if ( ! is_dir( $stat['path_cache_dir'] ) ) {

						// uh-oh, failed to make that directory
						imagedestroy( $stat['img_new'] );
					}
				}
			}

			// save the new file in the appropriate path, and send a version to the browser
			switch ( $stat['extension'] ) {

				case 'png':
					$gotSaved = imagepng( $stat['img_new'], $stat['path_cache_file'], 9, PNG_FILTER_NONE );
					break;
				case 'gif':
					$gotSaved = imagegif( $stat['img_new'], $stat['path_cache_file'] );
					break;
				default:
					$gotSaved = imagejpeg( $stat['img_new'], $stat['path_cache_file'], 95 );
					break;
			}

			imagedestroy( $stat['img_new'] );

		// CACHE }

	// }

	// UNSET COOKIES {

		//for ( $i = 1; $i <= 100; $i++ ) {
        //
		//	if ( isset( $_COOKIE[ 'img' . $i ] ) ) {
        //
		//		setcookie( 'img' . $i, '', time() - 0, '/') ;
		//		unset( $_COOKIE[ 'img' . $i ] );
		//	}
		//}

	// }

	// SEND IMAGE {

		if ( in_array( $stat['extension'], array( 'png', 'gif', 'jpeg' ) ) ) {

			header( "Content-Type: image/" . $stat['extension'] );
		}
		else {

			header( "Content-Type: image/jpeg" );
		}

		header( "Cache-Control: private, max-age=" . $stat['browser_cache'] );
		header( 'Expires: ' . gmdate( 'D, d M Y H:i:s', time( ) + $stat['browser_cache'] ) . ' GMT' );
		header( 'Content-Length: ' . filesize( $stat['path_cache_file'] ) );
		readfile( $stat['path_cache_file'] );

		exit( );

	// }

?>