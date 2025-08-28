// ---------------------------------------------------------------- //
// Portfolio Filter Settings (MixItUp plugin)
// ---------------------------------------------------------------- //
$(document).ready(function() {
		
	$('#portfolio').mixitup({
		targetSelector: '.portfolio-item',
		filterSelector: '.filter',
		effects: ['fade','scale'],
		easing: 'snap'
	});	
	
});