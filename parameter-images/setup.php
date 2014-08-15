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
		'sizesteps' => array(
			'start' => 0,
			'end' => 1300,
			'step' => 50,
		),
		'breakpoints' => array(
			'banner' => array(
				'0' => array(
					'img_width' => 100,
					'ratio' => 0.5,
				),
				'600' => array(
					'img_width' => 75,
					'ratio' => 0.3,
				),
				'800' => array(
					'img_width' => 50,
					'ratio' => 0.3,
				),
				'1000' => array(
					'img_width' => 25,
					'ratio' => 0.3,
				),
			),
		),
	);

?>