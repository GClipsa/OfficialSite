$(document).ready(function() {

	$('.popup').magnificPopup({
		type: 'image',
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		},
		callbacks: 
		{
			open: function() 
			{	
				$('.dev_slider').slick('slickPause');
			},
			close: function() 
			{
				$('.dev_slider').slick('slickPlay');
			}
		}
	});

});