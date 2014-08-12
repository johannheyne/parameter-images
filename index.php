<?php

	include( 'parameter-images/functions.php' );

?><!DOCTYPE html>
<html>
	<head>
		<title>Parameter Images</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<script>

			// PARAMETER IMAGES SET DEVICE DATA COOKIE {

				/* It is important to fire this script very early in the document. */

				(function(){

					var w = window,
						d = document,
						e = d.documentElement, // IE6
						g = d.getElementsByTagName('body')[0], // older versions of IE
						wx = w.innerWidth || e.clientWidth || g.clientWidth,
						wy = w.innerHeight|| e.clientHeight|| g.clientHeight,
						sx = screen.width,
						sy = screen.height,
						de = ( 'devicePixelRatio' in window ? devicePixelRatio : '1' );

					document.cookie='devicedata={"screen":{"width":"' + sx + '","height":"' + sy + '","density":"' + de + '"},"window":{"width":"' + wx + '","height":"' + wy + '"}}; path=/';

				}());

			// }

		</script>

		<link rel="stylesheet" href="css/styles.css" type="text/css" />
		<link rel="stylesheet" href="parameter-images/css/images-mediaqueries.css" type="text/css" />
		<style rel="stylesheet" type="text/css">

		</style>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="parameter-images/js/responsive-behavior.js" type="text/javascript"></script>
		<script src="parameter-images/js/responsive-data.js" type="text/javascript"></script>
		<script type="text/javascript">

		</script>

		<!--[if IE]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</head>
	<body>
		<section class="wrap">

			<?php

				echo get_image( array(
					'behavior' => 'banner',
					'src' => 'images/square.jpg',
				) );

			?>

		</section>
	</body>
</html>
