<?php

	include( 'parameter-images/functions.php' );

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Parameter Images</title>
		<meta charset="utf-8"/>

		<link rel="stylesheet" href="css/styles.css" type="text/css" />
		<link rel="stylesheet" href="parameter-images/css/images-mediaqueries.css" type="text/css" />
		<style rel="stylesheet" type="text/css">

		</style>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="parameter-images/js/responsive-behavior.js" type="text/javascript"></script>
		<script type="text/javascript">

		</script>

		<!--[if IE]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</head>
	<body>
		<section id="wrap">

			<?php

				echo get_image( array(
					'behavior' => 'banner',
					'src' => 'images/square.jpg',
				) );

			?>

		</section>
	</body>
</html>
