window.addEvent('domready', function() {
	$$( 'ul.thumblinks' ).each( function( ul ) {
		var li = ul.getParent();
		li.addEvent( 'mouseenter', function( ev ) { this.setStyle( 'display', 'block' ); }.bind( ul ) );
		li.addEvent( 'mouseleave', function( ev ) { this.setStyle( 'display', 'none' ); }.bind( ul ) );
	} );
	$$('a.fotolink').each(function(a) {
	    a.setStyle('height', a.getChildren('img')[0].getSize().y);
	});
});
