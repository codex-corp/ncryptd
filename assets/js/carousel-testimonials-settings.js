// ---------------------------------------------------------------- //
// Testimonials Carousel
// ---------------------------------------------------------------- //
$(window).load(function(){

	function loadSlider(){

		// --------------------------- //
		// Configure Variables
		// --------------------------- //

		// Set max slides to 1 if smartphone or 1 if not
		if (!($('.content-width').css('width') == '960px' || $('.content-width').css('width') == '720px')) { var var_maxslides = 1;  } else { var var_maxslides = 1; };

		// Set slide width depending on resolution
		if (!($('.content-width').css('width') == '960px' || $('.content-width').css('width') == '720px')) { var var_slidewidth = 0; };
		if ($('.content-width').css('width') == '720px') { var var_slidewidth = 153; };
		if ($('.content-width').css('width') == '960px') { var var_slidewidth = 207; };

		// --------------------------- //
		// Slider Settings
		// --------------------------- //
		sliderSettings = {
			minSlides: 1,
			maxSlides: var_maxslides,
			moveSlides: 1,
			pager: false,
			responsive: false,
			useCSS: true,
			hideControlOnEnd: true,
			touchEnabled: true,
			infiniteLoop: true,
			adaptiveHeight: true,
			slideWidth: var_slidewidth,
			nextSelector: '#testimonials-nav .next', // Next slide link
			prevSelector: '#testimonials-nav .back' // Previous slide link
		}

		testimonials_slider = $('#testimonials-carousel').bxSlider_content(sliderSettings);

	};

	// --------------------------- //
	// Load Slider
	// --------------------------- //
	loadSlider();

	// --------------------------- //
	// Reload Slider on Resize
	// --------------------------- //
	$(window).resize(function(){
		testimonials_slider.destroySlider();
		loadSlider();
	});

});