function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
}

jQuery.noConflict();
jQuery(document).ready(function($){

	function responsive_images_refresh() {

	    var obj_images = $( '[data-respbehavior]' ),
			window_width = $( window ).width(),
			devicedata = $.parseJSON( getCookie( 'devicedata' ) );

		obj_images.each( function() {

			// SETUP VARIABLES {

				var t = $( this ),
					respbehavior = $.parseJSON( t.attr('data-respbehavior') ),
					breakpoints = respbehavior.bp,
					current_breakpoint = false,
					current_breakpoint_step = false,
					breakpoint_steps = [],
					last_breakpoint = t.data('breakpoint'),
					src = t.attr('src');

			// }

			// DEFAULT LAST BREAKPOINT BY COOKIE {

				for ( var i = respbehavior.se; i >= respbehavior.ss; i = i - respbehavior.st ) {

					breakpoint_steps.push( i );

                   	if ( i >= window_width ) {

						current_breakpoint_step = i;
					}
				}

				$.extend( breakpoints, breakpoint_steps );

			// }

			// GET THE CURRENT BREAKPOINT {

				breakpoints.sort(function(a, b) {
				  return +/\d+/.exec(a)[0] - +/\d+/.exec(b)[0];
				});

				//breakpoints.reverse();

				for ( var i in breakpoints ) {

					if ( breakpoints[ i ] <= window_width ) {

						current_breakpoint = breakpoints[ i ];
					}
				}
				console.log( current_breakpoint );

			// }

			// CHANGE BREAKPOINT IN SRC {

				if ( current_breakpoint !== last_breakpoint ) {

					// CHANGE SRC {

						var bp_index = src.lastIndexOf('&breakpoint');

						if ( bp_index === -1 ) {

							t.attr( 'src', src + '&breakpoint=' + current_breakpoint );
							t.data( 'breakpoint', current_breakpoint );
						}
						else {

							src = src.slice( 0, bp_index )
							t.attr( 'src', src + '&breakpoint=' + current_breakpoint );
							t.data( 'breakpoint', current_breakpoint );
						}

					// }

				}

			// }

		} );

	};

	var timeout;

	$( window ).resize(function() {

		clearTimeout( timeout );
		timeout = setTimeout( responsive_images_refresh , 250 );

	});

});