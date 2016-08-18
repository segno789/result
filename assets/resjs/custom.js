/*-------------------------------------------------------------------------
 * UNIVERSE -  Custom jQuery Scripts
 * ------------------------------------------------------------------------

	1.	Plugins Init
	2.	Site Specific Functions
	3.	Shortcodes
	4.  Other Need Scripts (Plugins config, themes and etc)
	
-------------------------------------------------------------------------*/


jQuery(document).ready(function($){
	"use strict";
	
	
/*------------------------------------------------------------------------*/
/*	1.	Plugins Init
/*------------------------------------------------------------------------*/


/************** ToolTip *********************/

	function toolTipInit() {
	
		$('.social-icons li a').tooltip({
			placement: 'top'
		});
	}
	
	toolTipInit();

    $('#news-carousel').carousel({interval: 3000, pause: "hover"});
/************** Tabs *********************/

	$('#tabs').tab();


/************** SuperFish Menu *********************/

	function initSuperFish(){
		
		$(".sf-menu").superfish({
			 delay:  50,
			 autoArrows: true,
			 animation:   {opacity:'show'}
			 //cssArrows: true
		});
		
		// Replace SuperFish CSS Arrows to Font Awesome Icons
		$('nav > ul.sf-menu > li').each(function(){
			var ele = $(this).find('.sf-with-ul').not('.sf-with-ul2');
			ele.append('<i class="fa fa-angle-down"></i>');
		});
		$('nav > ul.sf-menu > li').each(function(){
			$(this).find('.sf-with-ul2').append('<i class="fa fa-angle-right"></i>');
		});
	}
	
	initSuperFish();



/************** FlexSlider *********************/

	$(window).load(function() {
	    $('.flexslider').flexslider({
	    	animation: "fade",
	    	touch: true,
	    	controlNav: false,
	    	prevText: "&nbsp;",  
			nextText: "&nbsp;" 
	    });
	});

	$('.carousel').carousel({
	  interval: 300
	});



/************** FancyBox *********************/
	$(".fancybox").fancybox({
		padding: 5,
		titlePosition: 'over'
	});



/************** pSlider *********************/

	$('#slider-testimonials').pSlider({
        slider: $('#slider-testimonials ul li'),
        visible: 1,
        button: {
            next: $('#slider-testimonials .next'),
            prev: $('#slider-testimonials .prev')
        }
    });



/************** mixitup *********************/
    $('#Grid').mixitup({
        effects: ['fade','grayscale'],
        easing: 'snap',
        transitionSpeed: 400
    });
	



/*------------------------------------------------------------------------*/
/*	2.	Site Specific Functions
/*------------------------------------------------------------------------*/


	$('.sub-menu').addClass('animated fadeInRight');




/************** Responsive Navigation *********************/

	$('.menu-toggle-btn').click(function(){
        $('.responsive_menu').stop(true,true).slideToggle();
    });


});