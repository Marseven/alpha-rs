/*========================================================================

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Template Name: Insurance - Agency & Business HTML5 Template
Author: Ingenioushubs
Version: 1.00
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

========================================================================*/
$(function () {
    "use strict";

    // for navbar background color when scrolling
    $(window).scroll(function () {
        var $scrolling = $(this).scrollTop();
        var bc2top = $("#back-top-btn");
        var stickytop = $(".sticky-top");
        if ($scrolling >= 100) {
            $('#nav-part').addClass('animated slideInDown navcss')
        } else {
            $('#nav-part').removeClass('animated slideInDown navcss')
        }

        if ($scrolling > 150) {
            bc2top.fadeIn(1000);
        } else {
            bc2top.fadeOut(1000);
        }
    });


    //animation scroll js
    var nav = $('nav'),
        navOffset = nav.offset().top,
        $window = $(window);
    /* navOffset ends */
    //animation scroll js
    var html_body = $('html, body');
    $('nav a').on('click', function () {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                html_body.animate({
                    scrollTop: target.offset().top - 80
                }, 1000);
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll link is clicked
    $('.nav-link').on('click', function () {
        $('.navbar-collapse').collapse('hide');
    });
    // navbar js ends here

    /* -------------------------------------
         back to top js				
     	-------------------------------------- */

    var bc2top = $('#back-top-btn');
    bc2top.on('click', function () {
        html_body.animate({
            scrollTop: 0
        }, 1300);
    });


    /* -------------------------------------
              Preloader				
     	-------------------------------------- */
    $('#preloader').delay(1500).fadeOut(900);


    /* -------------------------------------
          HOME BANNER SLIDER				
 	-------------------------------------- */
    var _tg_homeslider = jQuery('#tg-homeslider');
    _tg_homeslider.pogoSlider({
        pauseOnHover: false,
        autoplay: false,
        generateNav: false,
        displayProgess: false,
        autoplayTimeout: 6000,
        targetHeight: 445,
        responsive: true,
        onSlideStart: (function () {
            var _slideslength = jQuery('.pogoSlider-slide').length;
            var _currentSlide = this.currentSlideIndex + 1;
            jQuery('#tg-totalslides').text(_slideslength);
            jQuery('#tg-currentslide').text(_currentSlide);
        }),
    }).data('plugin_pogoSlider');



    //===== Odometer js

    $('.odometer').appear(function (e) {
        var odo = $(".odometer");
        odo.each(function () {
            var countNumber = $(this).attr("data-count");
            $(this).html(countNumber);
        });
    });

    /* -------------------------------------
         testimonial-slick js				
     	-------------------------------------- */

    $('.testimonial-slick').slick({
        infinite: true,
        autoplaySpeed: 3000,
        prevArrow: '<i class="fa fa-angle-right testNext"></i>',
        nextArrow: '<i class="fa fa-angle-left testprev"></i>',
        autoplay: true,
        arrows: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        cssEase: "ease",
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
			},
            {
                breakpoint: 767,
                settings: {

                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
		}
	],


    });

    /* -------------------------------------
         service-slick js				
     	-------------------------------------- */


    $('.service-slick').slick({
        infinite: true,
        autoplaySpeed: 3000,
        prevArrow: '<i class="fa fa-angle-right servNext"></i>',
        nextArrow: '<i class="fa fa-angle-left servprev"></i>',
        autoplay: true,
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        cssEase: "ease",
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    arrows: false,
                }
			},
            {
                breakpoint: 767,
                settings: {

                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
		}
	],


    });

    /* -------------------------------------
         Wow js				
     	-------------------------------------- */

    var wow = new WOW({
        boxClass: 'wow', // default
        animateClass: 'animated', // default
        offset: 0, // default
        mobile: true, // default
        live: true // default
    })
    wow.init();

    /* -------------------------------------
    	     newsletter				
    -------------------------------------- */

    $(window).load(function () {
        setTimeout(function () {
            $('#popup').modal('show');
        }, 100);
    });


});