function myRound(zahl,n){
    var faktor;
    faktor = Math.pow(10,n);
    return(Math.round(zahl * faktor) / faktor);
}

jQuery.noConflict();
jQuery(document).ready(function($){
	
	
	$( 'body' ).prepend( '<div class="open_responsive_images_popup">RespImg</div>' );
	$( '.open_responsive_images_popup' ).on( 'click', function() {
	
		window.open ( document.URL, "responsive_images_popup", "menubar=1,resizable=1,width=350,height=250" );
	} );
	
	
	
	function responsive_images_data() {
	
		var obj_images = $( '[data-respbehavior]' )
			window_width = $( window ).width();
		
		$( '.responsive_images_data' ).remove();
		
		obj_images.each( function() {

			var t = $( this ),
				breakpoints = t.data('respbehavior'),
				breakpoints_html = '',
				img_px_width = t.width(),
				img_rel_width = myRound( ( 100 / window_width ) * img_px_width, 8 );
			
			for ( var i in breakpoints ) {

				breakpoints_html += '<span class="responsive_images_breakpoint">' + breakpoints[ i ] + '</span> ';
			}
			
			t.after('<div class="responsive_images_data" style="">Width: ' + img_rel_width + '%, Breakpoints: ' + breakpoints_html + '</div>');
		
		} );
		
		$( '.responsive_images_breakpoint' ).css({
			'cursor': 'pointer'
		})
		.on( 'click', function() {
			
			t = $( this );
			window.resizeTo( t.text(), 500);
		} );
	
	}
	
	responsive_images_data();
	
	var timeout;

	$( window ).resize(function() {

		clearTimeout( timeout );
		timeout = setTimeout( responsive_images_data , 250 );

	});

});