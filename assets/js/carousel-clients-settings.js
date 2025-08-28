// ---------------------------------------------------------------- //
// Clients Carousel
// ---------------------------------------------------------------- //
$(window).load(function(){

	function loadSlider(){

		// --------------------------- //
		// Configure Variables
		// --------------------------- //

		// Set max slides to 1 if smartphone or 1 if not
		if (!($('.content-width').css('width') == '960px' || $('.content-width').css('width') == '720px')) { var var_minslides = 1; var var_maxslides = 1; } else { var var_minslides = 5; var var_maxslides = 5; };

		// Set slide width depending on resolution
		if (!($('.content-width').css('width') == '960px' || $('.content-width').css('width') == '720px')) { var var_slidewidth = 0; };
		if ($('.content-width').css('width') == '720px') { var var_slidewidth = 144; };
		if ($('.content-width').css('width') == '960px') { var var_slidewidth = 192; };

		// --------------------------- //
		// Slider Settings
		// --------------------------- //
		sliderSettings = {
			minSlides: var_minslides,
			maxSlides: var_maxslides,
			moveSlides: 1,
			pager: false,
			responsive: false,
			useCSS: true,
			hideControlOnEnd: true,
			touchEnabled: true,
			infiniteLoop: true,
			auto: true,
			adaptiveHeight: true,
			slideWidth: var_slidewidth,
			nextSelector: '#clients-next', // Next slide link
			prevSelector: '#clients-back' // Previous slide link
		}

		clients_slider = $('#clients-carousel').bxSlider_content(sliderSettings);

	};

	// --------------------------- //
	// Load Slider
	// --------------------------- //
	loadSlider();

	// --------------------------- //
	// Reload Slider on Resize
	// --------------------------- //
	$(window).resize(function(){
		//clients_slider.destroySlider();
		loadSlider();
	});

});