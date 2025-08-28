$(document).ready(function() {

	// ---------------------------------------------------------------- //
	// Set dark top bar background colour if scrolled past home banner
	// ---------------------------------------------------------------- //

	var $win = $(window);

	$(window).scroll(function(){
		if (!$('.home-banner').hasClass('light')) {
			if ($('body').hasClass('home')) {
				if ($('.topbar-outer').hasClass('dark')) {
					if ($win.scrollTop() > 60 ) {
						$('.topbar-outer').addClass('main-color-bg');
						} else {
						$('.topbar-outer').removeClass('main-color-bg');
					}
				}
			}
		}
	});

	// ---------------------------------------------------------------- //
	// Set dark top bar background colour on load if white home banner
	// ---------------------------------------------------------------- //

	if ($('.home-banner').hasClass('light')) {
		if ($('.topbar-outer').hasClass('dark')) {
			$('.topbar-outer').addClass('main-color-bg');
		}
	}

	// ---------------------------------------------------------------- //
	// Mobile Navigation Show/Hide
	// ---------------------------------------------------------------- //

	$('.mobilenav-click').click(function() {
		$('.mobilenav').slideToggle();
	});

	// ---------------------------------------------------------------- //
	// Toggles
	// ---------------------------------------------------------------- //

	// Hide all closed accordion content areas
	$('.accordion.closed .accordion-content').hide();

	// Main toggle function
	$('.accordion .accordion-header').click(function() {

		if($(this).parent().hasClass('open')){

			$(this).next('div').slideUp('fast');
			$(this).parent().removeClass('open');
			$(this).parent().addClass('closed');

			} else {

			$(this).next('div').slideDown('fast');
			$(this).parent().removeClass('closed');
			$(this).parent().addClass('open');

		}
	});

	// ---------------------------------------------------------------- //
	// Tabs
	// ---------------------------------------------------------------- //

	$('ul.tabs').each(function(){
		// For each set of tabs, we want to keep track of
		// which tab is active and it's associated content
		var $active, $content, $links = $(this).find('a');

		// If the location.hash matches one of the links, use that as the active tab.
		// If no match is found, use the first link as the initial active tab.
		$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
		$active.addClass('active');
		$content = $($active.attr('href'));

		// Hide the remaining content
		$links.not($active).each(function () {
			$($(this).attr('href')).hide();
		});

		// Bind the click event handler
		$(this).on('click', 'a', function(e){
			// Make the old tab inactive.
			$active.removeClass('active');
			$content.hide();

			// Update the variables with the new link and content
			$active = $(this);
			$content = $($(this).attr('href'));

			// Make the tab active.
			$active.addClass('active');
			$content.show();

			// Prevent the anchor's default click action
			e.preventDefault();
		});
	});

	// ---------------------------------------------------------------- //
	// Alerts (Hide when close button clicked)
	// ---------------------------------------------------------------- //

	$(".alert span.close").click(function() {
		$(this).parent().fadeOut();
	});

	// ---------------------------------------------------------------- //
	// Animate page content on load
	// ---------------------------------------------------------------- //

	$(".content-width").animate({ opacity: 1 }, 300);

	// ---------------------------------------------------------------- //
	// Disable :hover effects for touch enabled devices
	// ---------------------------------------------------------------- //

	if ('createTouch' in document)
	{
		try
		{
			var ignore = /:hover/;
			for (var i=0; i<document.styleSheets.length; i++)
			{
				var sheet = document.styleSheets[i];
				for (var j=sheet.cssRules.length-1; j>=0; j--)
				{
					var rule = sheet.cssRules[j];
					if (rule.type === CSSRule.STYLE_RULE && ignore.test(rule.selectorText))
					{
						sheet.deleteRule(j);
					}
				}
			}
		}
		catch(e){}
	};

	// ---------------------------------------------------------------- //
	// Top of Page Link
	// ---------------------------------------------------------------- //

	$(window).scroll(function(){
        if ($(this).scrollTop() > 300) {
            $('.top-of-page-link').fadeIn();
			} else {
            $('.top-of-page-link').fadeOut();
		}
	});

	$('.top-of-page-link').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});

	// ---------------------------------------------------------------- //
	// Mobile Navigation - Duplicate standard navigation contents
	// ---------------------------------------------------------------- //

	var $main_nav = $('ul.topnav');
	$main_nav.data('navigation',$main_nav.html());

	var newnav = $main_nav.data('navigation');
	$(newnav).appendTo('ul.mobilenav');

});