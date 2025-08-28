/* Webarch Admin Dashboard 
/* This JS is only for DEMO Purposes - Extract the code that you need
-----------------------------------------------------------------*/	
	$(document).ready(function() {		
		$('#popover').popover();
		$('.tip').tooltip();
		
		$('#btnFlip').click(function(){
			$('#animateAlert').show();
			$('#animateAlert').addClass("bounceIn ");
		});
		$('#btnShake').click(function(){
			$('#animateAlert').show();
		});
		$('#btnBouce').click(function(){
			$('#animateAlert').show();		
		});
	});