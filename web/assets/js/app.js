(function ($) {

	'use strict';
	
    // ------------------------------------------------------- //
    // Preloader
    // ------------------------------------------------------ //
	$(window).on("load", function () {
		$(".loader").fadeOut();
		$("#preloader").delay(350).fadeOut("slow");
	});
	
	// ------------------------------------------------------- //
	// Sidebar Functionality
	// ------------------------------------------------------ //
	$('#toggle-btn').on('click', function (e) {
		e.preventDefault();
		$(this).toggleClass('active');

		$('.side-navbar').toggleClass('shrinked');
		$('.content-inner').toggleClass('active');

		if ($(window).outerWidth() > 1183) {
			if ($('#toggle-btn').hasClass('active')) {
				$('.navbar-header .brand-small').hide();
				$('.navbar-header .brand-big').show();
			} else {
				$('.navbar-header .brand-small').show();
				$('.navbar-header .brand-big').hide();
			}
		}

		if ($(window).outerWidth() < 1183) {
			$('.navbar-header .brand-small').show();
		}
	});
	// Close dropdown after click
	$(function () {
	    $(".side-navbar li a").click(function(event) {
		    $(".collapse").collapse('hide');
	    });
	});
	
    // ------------------------------------------------------- //
    // Dynamic Height
    // ------------------------------------------------------ //	
	$(window).resize(function(){
	    var height = $(this).height() - $(".header").height() + $(".main-footer").height()
	    $('.d-scroll').height(height);
	})

	$(window).resize();
	
    // ------------------------------------------------------- //
    // Auto Height Scrollbar
    // ------------------------------------------------------ //
	$(window).resize(function() {
		$('.auto-scroll').height($(window).height() - 130);
	});

	$(window).trigger('resize');
	
    // ------------------------------------------------------- //
    // Back To Top
    // ------------------------------------------------------ //
    $(function () {
        // Show or hide the sticky footer button
        $(window).scroll(function () {
            if ($(this).scrollTop() > 350) {
                $('.go-top').fadeIn(100);
            } else {
                $('.go-top').fadeOut(200);
            }
        });

        // Animate the scroll to top
        $('.go-top').click(function (event) {
            event.preventDefault();

            $('html, body').animate({
                scrollTop: 0
            }, 800);
        })
    }); 

    // ------------------------------------------------------- //
    // Custom Checkbox (check, heart, star)
    // ------------------------------------------------------ //
	$('.checkbox').click(function(){
        $(this).toggleClass('is-checked');
    });
		
    // ------------------------------------------------------- //
    // Check / Uncheck all checkboxes
    // ------------------------------------------------------ //
    $("#check-all").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });

    // ------------------------------------------------------- //
    // Card Close
    // ------------------------------------------------------ //
    $('a.remove').on('click', function (e) {
        e.preventDefault();
        $(this).parents('.col-remove').fadeOut(500);
    });

	// ------------------------------------------------------- //
	// Sidebar Scrollbar
	// ------------------------------------------------------ //	
	// $(".sidebar-scroll").niceScroll({
 //      cursorwidth:7,
 //      cursoropacitymin:0.1,
 //      cursoropacitymax:0.4,
 //      cursorfixedheight: 200,
 //      cursorcolor:'#fff',
 //    	 railpadding: {
	// 	 top: 50,
	// 	 right: 2,
	// 	 left: 0,
	// 	 bottom: 0
	//   },      
	// });

	$(".dropdown-menu.notification").niceScroll({
		railpadding: {
			top: 0,
			right: 3,
			left: 0,
			bottom: 0
		},
		scrollspeed: 100,
		zindex: "auto",
		autohidemode: "leave",
		cursorwidth: "7px",
		cursorcolor: "rgba(52, 40, 104, 0.4)",
		cursorborder: "rgba(52, 40, 104, 0.1)"
	});

	// ------------------------------------------------------- //
	// Widget Scrollbar
	// ------------------------------------------------------ //	
	$(".widget-scroll").niceScroll({
		railpadding: {
			top: 0,
			right: 3,
			left: 0,
			bottom: 0
		},
		scrollspeed: 100,
		zindex: "auto",
		autohidemode: "leave",
		cursorwidth: "4px",
		cursorcolor: "rgba(52, 40, 104, 0.1)",
		cursorborder: "rgba(52, 40, 104, 0.1)"
	});

	// ------------------------------------------------------- //
	// Table Scrollbar
	// ------------------------------------------------------ //	
	$(".table-scroll").niceScroll({
		railpadding: {
			top: 0,
			right: 0,
			left: 0,
			bottom: 0
		},
		scrollspeed: 100,
		zindex: "auto",
		autohidemode: "leave",
		cursorwidth: "4px",
		cursorcolor: "rgba(52, 40, 104, 0.1)",
		cursorborder: "rgba(52, 40, 104, 0.1)"
	});

	// ------------------------------------------------------- //
	// Offcanvas Scrollbar
	// ------------------------------------------------------ //	
	$(".offcanvas-scroll").niceScroll({
		railpadding: {
			top: 0,
			right: 2,
			left: 0,
			bottom: 0
		},
		scrollspeed: 100,
		zindex: "auto",
		hidecursordelay: 800,
		cursorwidth: "3px",
		cursorcolor: "rgba(52, 40, 104, 0.1)",
		cursorborder: "rgba(52, 40, 104, 0.1)",
		preservenativescrolling: true,
		boxzoom: false
	});

	// ------------------------------------------------------- //
	// Search Box
	// ------------------------------------------------------ //
	$('#search').on('click', function (e) {
		e.preventDefault();
		$('.search-box').slideDown();
	});
	$('.dismiss').on('click', function () {
		$('.search-box').slideUp();
	});
	
	// ------------------------------------------------------- //
	// Adding slide effect to dropdown
	// ------------------------------------------------------ //
    $('.dropdown').on('show.bs.dropdown', function(e){
      $(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
    });

    $('.dropdown').on('hide.bs.dropdown', function(e){
      $(this).find('.dropdown-menu').first().stop(true, true).slideUp(300);
    });

	// ------------------------------------------------------- //
	// Options hover effect to dropdown
	// ------------------------------------------------------ //
	$('.widget-options > .dropdown, .actions > .dropdown, .quick-actions > .dropdown').hover(function () {
		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(350);
	}, function () {
		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(350);
	});
	
	// ------------------------------------------------------- //
	// Offcanvas Sidebar
	// ------------------------------------------------------ //
	$(function () {
		//open
		$('.open-sidebar').on('click', function (event) {
			event.preventDefault();
			$('.off-sidebar').addClass('is-visible');
		});
		//close
		$('.off-sidebar').on('click', function (event) {
			if ($(event.target).is('.off-sidebar') || $(event.target).is('.off-sidebar-close')) {
				$('.off-sidebar').removeClass('is-visible');
				event.preventDefault();
			}
		});
	});

	// ------------------------------------------------------- //
	// Close Modal After Time Period
	// ------------------------------------------------------ //
	$(function () {
		$('#delay-modal').on('show.bs.modal', function () {
			var myModal = $(this);
			clearTimeout(myModal.data('hideInterval'));
			myModal.data('hideInterval', setTimeout(function () {
				myModal.modal('hide');
			}, 2500));
		});
	});


	$(function(){

        var url = window.location.pathname, 
        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$");
	        $('.side-navbar a').each(function(){
	            // and test its normalized href against the url pathname regexp
	            var href = this.href.replace(/\/$/,'').split('/');
	         
	            if((url.indexOf(href[href.length-1]) != -1 && href.length!=4)||urlRegExp.test(this.href.replace(/\/$/,'')) && href.length==4){
	                $(this).addClass('active');
	                $(this).parents('li').addClass('active');
	                $(this).parents('ul').addClass('show').prev('a').attr('aria-expanded',true);
	            }
	        });    
	});


})(jQuery);