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

	// SETUP NEW IMAGE PARMS {

		$stat['new_w'] = 200;
		$stat['new_h'] = 200;
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
		$stat['path_cache_file'] = $stat['path_root'] . 'cache/' . trim( $stat['uri'], '/' );

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

		//error_log( print_r( $stat, true) );
		
		exit( );

	// }
	
?>