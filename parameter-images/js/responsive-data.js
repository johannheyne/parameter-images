function myRound(zahl,n){
    var faktor;
    faktor = Math.pow(10,n);
    return(Math.round(zahl * faktor) / faktor);
}

jQuery.noConflict();
jQuery(document).ready(function($){
	
	
	$( 'body' ).prepend( '<div class="open_responsive_images_popup" style="font-family: Arial, sans-serif; font-size: 1rem; line-height: 1.4rem; background: orange; opacity: 0.5; position: absolute; padding: 0 6px; color: black;">RespImg</div>' );
	
	$( '.open_responsive_images_popup' ).on( 'click', function() {
	
		var new_window = window.open( document.URL, "responsive_images_popup", "menubar=1,resizable=1,width=1024,height=1024" );
		new_window.focus();
	} );
	
	
	
	function responsive_images_data() {
	
		var obj_images = $( '[data-respbehavior]' ),
			window_width = $( window ).width();
			
		$( '.responsive_images_data' ).remove();
		
		obj_images.each( function( index ) {
			
			
			var t = $( this ),
				breakpoints = t.data('respbehavior'),
				breakpoints_html = '',
				img_px_width = t.width(),
				img_rel_width = myRound( ( 100 / window_width ) * img_px_width, 8 );

			for ( var i in breakpoints ) {
				
				breakpoints_html += '<span class="responsive_images_breakpoint">' + breakpoints[ i ] + '</span> ';
			}
			
			t.before('<div  id="' + index + '" class="responsive_images_data" style="font-family: Arial, sans-serif; font-size: 1rem; line-height: 1.4rem; background: orange; opacity: 0.5; position: relative; top: 4.2rem; display: inline-block; padding: 0 6px; max-width: 100%; color: black;">ID: ' + index + '<br>Width: ' + img_rel_width + '%,<br>Breakpoints: ' + breakpoints_html + '</div>');
		
		} );
		
		$( '.responsive_images_breakpoint' ).css({
			'cursor': 'pointer'
		})
		.on( 'click', function() {
			var t = $( this ),
			id = t.parent().attr('id');
			
			document.location.hash = 0;
			
			var new_window = window.open( document.URL, "responsive_images_popup", "menubar=1,resizable=1,width=1024,height=1024" );
			new_window.focus();
			
			window.resizeTo( t.text(), 500 );
			
			window.setTimeout( function () {

				document.location.hash = id;
				
			}, 400 );
		} );
	
	}
	
	responsive_images_data();
	
	var timeout;

	$( window ).resize(function() {

		clearTimeout( timeout );
		timeout = setTimeout( responsive_images_data , 250 );

	});

});