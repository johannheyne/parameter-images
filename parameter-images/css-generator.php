<?php

	include('setup.php');
	
	
	echo '<style>';
	
		foreach ( $setup as $behavior => $item ) {
	    	
			foreach ( $item as $breakpoint => $value ) {
	    		echo '@media ( min-width: ' . $breakpoint . 'px  ) {';
	
					echo '.behavior-' . $behavior . ' { ';
						echo 'width: ' . $value['img_width'] . '%;';
					echo '}';
					
				echo '}';
			}
			
		}
	
	echo '</style>';
	
?>