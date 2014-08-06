jQuery.noConflict();
jQuery(document).ready(function($){

	function responsive_images_refresh() {

	    var obj_images = $( '[data-respbehavior]' )
			window_width = $( window ).width();

		obj_images.each( function() {

			var t = $( this ),
				breakpoints = t.data('respbehavior'),
				current_breakpoint = false,
				last_breakpoint = t.data('breakpoint'),
				src = t.attr('src');

			for ( var i in breakpoints ) {

				if ( ! current_breakpoint && breakpoints[ i ] >= window_width ) {

					current_breakpoint = breakpoints[ i ];
				}
			}

			if ( current_breakpoint !== last_breakpoint ) {

				if ( typeof last_breakpoint === 'undefined' ) {

					t.attr( 'src', src + '&breakpoint=' + current_breakpoint );
					t.data( 'breakpoint', current_breakpoint );
				}
				else {

					var bp_index = src.lastIndexOf('&breakpoint');
					src = src.slice( 0, bp_index )
					t.attr( 'src', src + '&breakpoint=' + current_breakpoint );
					t.data( 'breakpoint', current_breakpoint );
				}
			}

		} );

	};

	var timeout;

	$( window ).resize(function() {

		clearTimeout( timeout );
		timeout = setTimeout( responsive_images_refresh , 250 );

	});

});