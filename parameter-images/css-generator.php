<?php

	include('setup.php');
	
	
	echo '<style>';
	
		foreach ( $setup as $behavior => $item ) {
	    	
			krsort( $item );
			
			foreach ( $item as $breakpoint => $value ) {
	    		echo '@media ( max-width: ' . $breakpoint . 'px  ) {';
	
					echo '.behavior-' . $behavior . ' { ';
						echo 'width: ' . $value['img_width'] . '%;';
					echo '}';
					
				echo '}';
			}
			
		}
	
	echo '</style>';
	
?>