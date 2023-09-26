$(document).ready(function() {
	// Show or hide the sticky footer button
	$(window).scroll(function() {
		if ($(this).scrollTop() > 20) {
			$('.go-top').fadeIn(200);
		} else {
			$('.go-top').fadeOut(200);
		}
	});

	// Animate the scroll to top
	$('.go-top').click(function(event) {
		event.preventDefault();

		$('html, body').animate({
			scrollTop : 0
		}, 300);
	})
	
	$(function () {
	    $('#accordion').on('shown.bs.collapse', function (e) {
	        var offset1 = $('.panel.panel-success > .panel-collapse.in').offset();
	        var offset2 = $('.panel.panel-default > .panel-collapse.in').offset();
	        var offset3 = $('.panel.panel-warning > .panel-collapse.in').offset();
	        var offset4 = $('.panel.panel-danger > .panel-collapse.in').offset();
	        if(offset1 || offset2 || offset3 || offset4) {
	            $('html,body').animate({
	                scrollTop: $('.panel-title a').offset().top -60
	            }, 500); 
	        }
	    }); 
	});
});