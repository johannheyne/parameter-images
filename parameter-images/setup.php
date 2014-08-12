<?php

	/* How Parameter Images Works?
	
		Parameter Images figures out, what image size is actullay needed on 
		the current browser window size. If the window is resizing to a biger width,
		Parameter Images will try to load a bigger immage. If resizing the window
		to a smaller width, there is no need to reload a smaller image until there
		is a artdirction change on the smaller image.
		
		
		
		$setup = array(
			'teaser' => array(
			
				// Die Breakpoints beziehen sich auf max-width.
				'400' => array(
					'img_width' => 400,
					'img_height' => 200,
				),
				'600' => array(
					'img_width' => 300,
					'img_height' => 150,
				),
			),
		);
		
		
	*/


	$setup = array(
		'banner' => array(
			'400' => array(
				'img_width' => 400,
				'img_height' => 200,
			),
			'600' => array(
				'img_width' => 600,
				'img_height' => 150,
			),
			'800' => array(
				'img_width' => 800,
				'img_height' => 200,
			),
			'9999' => array(
				'img_width' => 1000,
				'img_height' => 250,
			),
		),
	);

?>