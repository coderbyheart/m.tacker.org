window.addEvent('domready', function() {
	// Close-Link on SkyScraper Ad
    if( $( 'skyscraperclose' ) ) {
		$( 'skyscraperclose' ).addEvent( 'click', function() { $( 'skyscraper' ).destroy(); } );
	};

	// Youtube Videos
	var youtubeVideos = 0;
	var youtubeVideoWidth = 0;
	var youtubeVideoHeight = 0;
	$$( '#post-content a' ).each( function ( link ) {
		if ( link.href.search( /youtube/i ) > 0 ) {
			link.addClass( 'icon' );
			link.addClass( 'iyoutube' );
			var vUrlRegex = /v=([^&]+)/;
			var match = vUrlRegex.exec( link.href );
   			if (!match) {
   				// New style youtube links
    			var vUrlRegex = /v\/([^&]+)/;
				var match = vUrlRegex.exec( link.href );
			}
			if ( match ) {
				var vidH3 = new Element( 'h3', { 'html': link.get( 'text' ) } );
				vidH3.inject( $( 'post-content' ) );
				youtubeVideos++;
				var youtubeVideoElement = new Element( 'div', { 'id': 'youtubeVideo' + youtubeVideos, 'class': 'youtubeVideo' } );
				youtubeVideoElement.inject( $( 'post-content' ) );
				youtubeVideoWidth = youtubeVideoElement.getWidth();
				youtubeVideoHeight = youtubeVideoWidth * 0.80;
				new Element( 'div', { 'id': 'youtubeVideo' + youtubeVideos + 'Target' } ).inject( youtubeVideoElement );
				swfobject.embedSWF( 'http://www.youtube.com/v/' + match[1] + '&hl=de&fs=1', 'youtubeVideo' + youtubeVideos +  'Target', youtubeVideoWidth, youtubeVideoHeight, '9.0.0' );
			}
		} else if ( link.href.search( /wikipedia/i ) > 0 ) {
			link.addClass( 'icon' );
			link.addClass( 'iwikipedia' );
		}
	} );
	
	// Moving meta
	var postmeta = $('post-meta');
	if (postmeta) {
		var postmetaTop = parseInt(postmeta.getStyle('margin-top'), 10);
		var postmetaTopMax = $('post-content').getHeight() - postmeta.getHeight() - postmetaTop;
		var postmetaFx = new Fx.Tween(postmeta);
	    $(window).addEvent('scroll', function(ev) {
	        var w = $(window);
	        postmetaFx.cancel();
	        postmetaFx.start('margin-top', Math.min(postmetaTop + w.getScroll().y, postmetaTopMax));
	    });
	}
});
