// ---------------------------------------------------------------- //
// Portfolio Carousel
// ---------------------------------------------------------------- //
$(window).load(function(){

	function loadSlider(){

		// --------------------------- //
		// Configure Variables
		// --------------------------- //

		// Set max slides to 1 if smartphone or 4 if not
		if (!($('.content-width').css('width') == '960px' || $('.content-width').css('width') == '720px')) { var var_maxslides = 1;  } else { var var_maxslides = 4; };

		// Set slide width depending on resolution
		if (!($('.content-width').css('width') == '960px' || $('.content-width').css('width') == '720px')) { var var_slidewidth = 0; };
		if ($('.content-width').css('width') == '720px') { var var_slidewidth = 153; };
		if ($('.content-width').css('width') == '960px') { var var_slidewidth = 207; };

		// --------------------------- //
		// Slider Settings
		// --------------------------- //
		sliderSettings = {
			minSlides: 4,
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
			nextSelector: '#portfolio-nav .next', // Next slide link
			prevSelector: '#portfolio-nav .back' // Previous slide link
		}

		portfolio_slider = $('#portfolio-carousel').bxSlider_content(sliderSettings);

	};

	// --------------------------- //
	// Load Slider
	// --------------------------- //
	loadSlider();

	// --------------------------- //
	// Reload Slider on Resize
	// --------------------------- //
	$(window).resize(function(){
		portfolio_slider.destroySlider();
		loadSlider();
	});

});