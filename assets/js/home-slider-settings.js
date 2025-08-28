// ---------------------------------------------------------------- //
// Home Page Slider
// ---------------------------------------------------------------- //
$(document).ready(function() {

    $('pre code').each(function(i, block) {
        hljs.highlightBlock(block);
    });

    $(".slide-style-0 h1").fadeToggle('fast');

    $(".window").slideToggle(1);


	// Only load slider if more than one slide
	if ($('#home-slider > li').length > 1) {

        // --------------------------- //
		// Settings
		// --------------------------- //
		
		var slider = $('#home-slider').bxSlider_main({
			auto: true, // Start slider automatically
			pause: '4000', // Delay in ms between each transition
			responsive: false,
			useCSS: false,
			touchEnabled: true,
            tickerHover: true,
			nextSelector: '#slider-next', // Next slide link
			prevSelector: '#slider-prev', // Previous slide link
			pagerCustom: '#bx-pager', // Slide status
			autoControlsSelector: '#slider-pause', // Stop/Start button
			autoControls: true,
			autoControlsCombine: true,
			adaptiveHeight: true,
            adaptiveHeightSpeed: 1000,
			onSliderLoad: function(currentIndex){

				$(".slide-outer").css('visibility', 'visible');

                $(".slide-style-0 > h1").css('visibility', 'visible').fadeIn();

                setTimeout(function(){

                    slider.stopAuto();
                    $(".window").slideDown({ duration: 1000, easing: "easeOutExpo"});

                    $("#typed").typed({
                        strings: [$("#thecode").contents().html()],
                        typeSpeed: -200,
                        backDelay: 500,
                        backSpeed: -80,
                        loop: false,
                        cursorChar: "|",
                        contentType: 'html', // or text
                        // defaults to false for infinite loop
                        loopCount: false,
                        preStringTyped: function() {

                        },
                        onStringTyped: function() {},
                        callback: function(){ },
                        resetCallback: function() { }
                    });
                },2000);

			}
		});

        function isOnScreen(element) {
            var elementOffsetTop = element.offset().top;
            var elementHeight = element.height();

            var screenScrollTop = $(window).scrollTop();
            var screenHeight = $(window).height();

            var scrollIsAboveElement = elementOffsetTop + elementHeight - screenScrollTop >= 0;
            var elementIsVisibleOnScreen = screenScrollTop + screenHeight - elementOffsetTop >= 0;

            return scrollIsAboveElement && elementIsVisibleOnScreen;
        }

        // --------------------------- //
        // Check if document is being scrolled past 2px. If so, stop sliding!
        // This checks during live scrolling
        // --------------------------- //
        $(window).scroll(function() {
            clearTimeout($.data(this, 'scrollTimer'));
            $.data(this, 'scrollTimer', setTimeout(function() {
                if(isOnScreen($(".main-content-inner"))){
                    slider.stopAuto();
                    console.log('stop');
                } else {
                    slider.startAuto();
                    console.log('start');
                }
            }, 250));
        });

        // --------------------------- //
		// Check if document is being scrolled past 2px. If so, stop sliding!
		// This checks during live scrolling
		// --------------------------- //
		var $document = $(document);
		$document.scroll(function() {
		});
		
		// --------------------------- //
		// Check if window resized. If so, reset slider.
		// --------------------------- //
		$(window).resize(function(){
			slider.reloadSlider();
		});

		// if there is only 1 slide then remove slide status bar and set only slide to visible
		} else {

		$(".slide-outer").css('visibility', 'visible');
		$(".slide-outer").css('padding-bottom', '0');
		$(".slider-nav-container").hide();

	}
	
});