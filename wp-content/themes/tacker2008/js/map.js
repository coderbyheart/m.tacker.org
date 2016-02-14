window.addEvent('domready', function() {
	var postmap = $('postmap');
	if (!postmap) return;
	var ll = new URI(postmap.getNext('p.geo').getElement('a').get('href')).getData('ll').split(',');
	if (GBrowserIsCompatible()) {
	    var map = new GMap2(document.getElementById("postmap"));
	    map.setCenter(new GLatLng(ll[0], ll[1]), 15);
	    map.setMapType(G_HYBRID_MAP);
	    map.addControl(new GLargeMapControl());
	    map.addControl(new GMapTypeControl());
	    map.addOverlay( new GMarker( map.getCenter() ) );
	} 
});
