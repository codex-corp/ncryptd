$(window).load(function() {
	
	// ---------------------------------------------------------------- //
	// Flickr Widget
	// ---------------------------------------------------------------- //
	// Flickr User ID (Use http://idgettr.com to convert username to ID)
	// --------------------------- //
	
	var $username = "71865026@N00";
	
	// --------------------------- //
	// Number of images to display
	// --------------------------- //
	
	var $amount = "8";

	// --------------------------- //
	// JSON Request
	// --------------------------- //
	
	$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id=" + $username + "&lang=en-us&format=json&jsoncallback=?", function(data){
		$.each(data.items, function(i,item){
			if(i<=$amount - 1){ // <— change this number to display more or less images
				$("<img/>").attr("src", item.media.m).appendTo(".footer-flickr-container")
				.wrap("<div class='flickr_badge_image'><a href='" + item.link + "' target='_blank' class='image-link mini'></a></div>");
				}
		});
	});
	
});