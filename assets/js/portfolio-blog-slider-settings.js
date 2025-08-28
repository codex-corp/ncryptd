// ---------------------------------------------------------------- //
// Portfolio / Blog Page Image Slider
// ---------------------------------------------------------------- //
$(window).load(function() {
	
	// Only load slider if more than one slide
	if ($('#portfolio-blog-slider > img').length > 1) {
		
		// --------------------------- //
		// Settings
		// --------------------------- //
		
		var portfolio_blog_slider = $('#portfolio-blog-slider').bxSlider_content({
			auto: false, // Start slider automatically
			pause: '4000', // Delay in ms between each transition
			responsive: false,
			useCSS: false,
			touchEnabled: true,
			pager: false,
			infiniteLoop: true,
			nextSelector: '#portfolio-blog-slider-next', // Next slide link
			prevSelector: '#portfolio-blog-slider-prev', // Previous slide link
			adaptiveHeight: true,
			onSliderLoad: function(){
				$("#portfolio-blog-slider img").css('visibility', 'visible');
			}
		});
		
		// --------------------------- //
		// Check if window resized. If so, reset slider.
		// --------------------------- //
		
		$(window).resize(function(){
			portfolio_blog_slider.reloadSlider();
		});
		
		} else {
		
		$("#portfolio-blog-slider img").css('visibility', 'visible');
		
	}
	
});