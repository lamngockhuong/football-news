jQuery(document).ready(function($) {
    "use strict"

    // ---------- Preloader ---------- //
    jQuery(window).on( "load", function() {
        jQuery("#status").delay(1000).fadeOut();
        jQuery("#preloader").delay(1000).fadeOut("slow");
    })
    // ---------- Preloader ---------- //
    
    // ------- Main Banner ------- //
    jQuery('#main-slides').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        speed: 1000,
        arrows: false,
        asNavFor: '#slides-thmnail'
    });
    jQuery('#slides-thmnail').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '#main-slides',
        dots: false,
        focusOnSelect: true,
        arrows: false,
        responsive: [
            { breakpoint: 992, settings: { slidesToShow: 3, slidesToScroll: 1}},
            { breakpoint: 481, settings: { slidesToShow: 2, slidesToScroll: 1}}
        ]
    });
    jQuery('.prev-1').on( "click", function(){
      jQuery('#slides-thmnail').slick('slickPrev');
    });
    jQuery('.next-1').on( "click", function(){
      jQuery('#slides-thmnail').slick('slickNext');
    });
    // ------- Main Banner ------- //

    // ------- Add banner ------- //  
    jQuery('#add-banners-slider').slick({
        dots: true,
        infinite: true,
        speed: 700,
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            { breakpoint: 768, settings:{ slidesToShow: 2, slidesToScroll: 1}},
            { breakpoint: 480, settings:{ slidesToShow: 1, slidesToScroll: 1}}
        ]
    });
    // ------- Add banner ------- //

    // ------- Matches Detail Slider------- //  
    jQuery('#matches-detail-slider').slick({
        dots: true,
        infinite: true,
        speed: 700,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    // ------- Matches Detail Slider------- //  

    // ------- Latest News ------- //
    jQuery('#latest-news-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '#latest-news-thumb'
    });
    jQuery('#latest-news-thumb').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '#latest-news-slider',
        dots: false,
        focusOnSelect: true,
        vertical: true,
        arrows: false,
        responsive: [
            { breakpoint: 992, settings: { slidesToShow: 3, slidesToScroll: 1}},
            { breakpoint: 768, settings: { slidesToShow: 2, slidesToScroll: 1}},
            { breakpoint: 481, settings: { slidesToShow: 1, slidesToScroll: 1}}
        ]
    });
    jQuery('.prev').on( "click", function(){
      jQuery('#latest-news-thumb').slick('slickPrev');
    });

    jQuery('.next').on( "click", function(){
      jQuery('#latest-news-thumb').slick('slickNext');
    });
    // ------- Latest News ------- //

    // ------- Video Slider ------- //  
    jQuery('#video-slider').slick({
        dots: false,
        infinite: true,
        speed: 700,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    // ------- Video Slider ------- //

    // ------- Team Slider ------- //  
    jQuery('#team-slider').slick({
        dots: false,
        infinite: true,
        speed: 700,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            { breakpoint: 992, settings:{ slidesToShow: 3, slidesToScroll: 1}},
            { breakpoint: 1024, settings:{ slidesToShow: 3, slidesToScroll: 1}},
            { breakpoint: 768, settings:{ slidesToShow: 2, slidesToScroll: 1}},
            { breakpoint: 481, settings:{ slidesToShow: 1, slidesToScroll: 1}}
        ]
    });
    // ------- Team Slider ------- //

    // ------- Product Slider ------- //  
    jQuery('#product-slider').slick({
        dots: true,
        infinite: true,
        speed: 700,
        arrows: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [
            { breakpoint: 1400, settings:{ slidesToShow: 5, slidesToScroll: 1}},
            { breakpoint: 1200, settings:{ slidesToShow: 4, slidesToScroll: 1}},
            { breakpoint: 991, settings:{ slidesToShow: 3, slidesToScroll: 1}},
            { breakpoint: 768, settings:{ slidesToShow: 2, slidesToScroll: 1}},
            { breakpoint: 481, settings:{ slidesToShow: 1, slidesToScroll: 1}}
        ]
    });
    // ------- Product Slider ------- //

    // ------- Product Slider ------- //  
    jQuery('#product-slider-2').slick({
        dots: true,
        infinite: true,
        speed: 700,
        arrows: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            { breakpoint: 992, settings:{ slidesToShow: 4, slidesToScroll: 1}},
            { breakpoint: 991, settings:{ slidesToShow: 3, slidesToScroll: 1}},
            { breakpoint: 768, settings:{ slidesToShow: 2, slidesToScroll: 1}},
            { breakpoint: 481, settings:{ slidesToShow: 1, slidesToScroll: 1}}
        ]
    });
    // ------- Product Slider ------- //

    // ------- Brands Icons ------- //  
    jQuery('#brand-icons-slider').slick({
        dots: false,
        infinite: true,
        speed: 700,
        arrows: true,
        slidesToShow: 7,
        slidesToScroll: 1,
        responsive: [
            { breakpoint: 102, settings:{ slidesToShow: 3, slidesToScroll: 1}},
            { breakpoint: 991, settings:{ slidesToShow: 3, slidesToScroll: 1}},
            { breakpoint: 768, settings:{ slidesToShow: 4, slidesToScroll: 1}},
            { breakpoint: 480, settings:{ slidesToShow: 1, slidesToScroll: 1}}
        ]
    });
    // ------- Brands Icons ------- //

    // ------- brand-icons-slider-2 ------- //  
    jQuery('#brand-icons-slider-2').slick({
        dots: false,
        infinite: true,
        speed: 700,
        arrows: true,
        centerMode: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    // ------- brand-icons-slider-2 ------- //

    // ------- Ticker ------- //  
    jQuery('#ticker').slick({
        dots: false,
        infinite: true,
        speed: 700,
        arrows: true,
        vertical: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000
    });
    // ------- Ticker ------- //

    // ------- Matches Detail Slider------- //  
    jQuery('#team-match-slider').slick({
        dots: false,
        infinite: true,
        speed: 700,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    // ------- Matches Detail Slider------- // 

    // ------- Matches Detail Slider------- //  
    jQuery('#footer-product-slider').slick({
        dots: false,
        infinite: true,
        speed: 700,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    // ------- Matches Detail Slider------- // 

    // ------- Mega Blog Slider ------- //  
    jQuery('#mega-blog-slider').slick({
        dots: false,
        infinite: true,
        speed: 700,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            { breakpoint: 102, settings:{ slidesToShow: 3, slidesToScroll: 1}},
            { breakpoint: 991, settings:{ slidesToShow: 3, slidesToScroll: 1}},
            { breakpoint: 600, settings:{ slidesToShow: 2, slidesToScroll: 1}},
            { breakpoint: 480, settings:{ slidesToShow: 1, slidesToScroll: 1}}
        ]
    });
    // ------- Mega Blog Slider ------- //

    // ------- Video Gallery ------- //
    var carousel = jQuery("#video-gallery-slider").waterwheelCarousel({
        flankingItems: 3,
        movingToCenter: function($item) {
            jQuery('#callback-output').prepend('movingToCenter:', 'movedToCenter:', 'movingFromCenter:', 'movedFromCenter:', 'clickedCenter:' + $item.attr('id') + '<br/>');
        }
     });
        jQuery('#prev').on('click', function() {
        carousel.prev();
        return false
    });
        jQuery('#next').on('click', function() {
        carousel.next();
        return false;
    });
    // ------- Video Gallery ------- //

    // ------- Main Banner ------- //
    jQuery('#testimonial-slides').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 1000,
        arrows: false,
        asNavFor: '#testimonial-thumnail'
    });
    jQuery('#testimonial-thumnail').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '#testimonial-slides',
        dots: false,
        focusOnSelect: true,
        arrows: false,
        responsive: [
            { breakpoint: 641, settings: { slidesToShow: 5, slidesToScroll: 1}},
            { breakpoint: 481, settings: { slidesToShow: 3, slidesToScroll: 1}}
        ]
    });
    // ------- Main Banner ------- //

    // ------- Post Slider ------- //
    jQuery('#post-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 1000,
        arrows: false
    });
    // ------- Post Slider ------- //

    // ------- Match Detail Slider ------- //
    jQuery('#match-detail-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 1000,
        arrows: true
    });
    // ------- Match Detail Slider ------- //

    // ------- Product Slides ------- //
    jQuery('#product-slides').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '#product-thumnail'
    });
    jQuery('#product-thumnail').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '#product-slides',
        dots: false,
        focusOnSelect: true,
        arrows: false,
        responsive: [
            { breakpoint: 641, settings: { slidesToShow: 5, slidesToScroll: 1}},
            { breakpoint: 481, settings: { slidesToShow: 3, slidesToScroll: 1}}
        ]
    });
    // ------- Product Slides ------- //

    // ------- Product Slider2 ------- //  
    jQuery('#product-slider2').slick({
        dots: false,
        infinite: true,
        speed: 700,
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            { breakpoint: 102, settings:{ slidesToShow: 3, slidesToScroll: 1}},
            { breakpoint: 991, settings:{ slidesToShow: 3, slidesToScroll: 1}},
            { breakpoint: 600, settings:{ slidesToShow: 2, slidesToScroll: 1}},
            { breakpoint: 480, settings:{ slidesToShow: 1, slidesToScroll: 1}}
        ]
    });
    // ------- Product Slider2 ------- //

    // ---------- Responsive Slider menu ---------- //
    jQuery('.menu-link').bigSlide();
    // ---------- Responsive Slider menu ---------- //

    // ---------- Inner Slider ---------- //  
    jQuery('#animated-slider').carousel({
        interval:5000,
        pause: "false"
    });
    // ---------- Inner Slider ---------- //

    // ---------- Set Language ---------- //
    jQuery("#choses-lang").on("click", function(e){
        e.preventDefault();
        jQuery("#language-dropdown").fadeToggle(100);
    });
    // ---------- Set Language ---------- //
    
    // ------- Date Picker ------- //
    jQuery('#calendar').datepicker({
        inline: true
    });
    // ------- Date Picker ------- //

    // ------- Scroll to Top ------- //
    jQuery('.scrollup').on("click", function () {
        jQuery("html, body").animate({
            scrollTop: 0
        }, 1000);
        return false;
    });
    // ------- Scroll to Top ------- //

    // ------- Counter ------- //
    try {
        jQuery('#tc-counters').appear(function () {
            jQuery('.facts-number').countTo()
        });
    } catch (err) {}    
    // ------- Counter ------- //

    // ------- Range Slider ------- //
    jQuery("#ex2").slider({});
    // ------- Range Slider ------- //

    // ---------- Wow Animation ---------- //
    var wow = new WOW({
        boxClass:     'animate',  
        animateClass: 'animated', 
        offset:       0,          
        mobile:       false        
        });
    wow.init();
    // ---------- Wow Animation ---------- //

    // ------- Event Google Map ------- // 
    jQuery("#custom-map").gmap3({
      map:{
        options:{
          center:[46.578498,2.457275],
          zoom: 5,
          scrollwheel: false
        }
      }
    });
    // ------- Event Google Map ------- //

    // ------- Auto height function ------- //
    var setElementHeight = function () {
        var width = jQuery(window).width();
        /*if (jQuery('.tg-hero-slider li img') >= height) {*/
        var height = jQuery(window).height();
        jQuery('.fullscreen').css('height', (height));
        }
    //       else {
    //            jQuery('.autoheight').css('min-height', (800));
    //        }
    //};
    jQuery(window).on("resize", function () {
        setElementHeight();
    }).resize();
    // ------- Auto height function ------- //

	// ------- Time Counter ------- //
    jQuery('#countdown-1, #countdown-2, #countdown-3, #countdown-4, #countdown-5, #countdown-6, #comming-countdown').countdown({
        date: '7/30/2017 2:17:59',
        offset: -2100,
        day: 'Day',
        days: 'Days'
    });
    // ------- Time Counter ------- //

    // ------- Accodian ------- //
    jQuery(".panel-heading").addClass("collapsed");
    // ------- Accodian ------- //

    // ------- Prety Photo ------- //
    jQuery("a[data-rel]").each(function () {
		jQuery(this).attr("rel", jQuery(this).data("rel"));
	});
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'normal',
		theme: 'dark_square',
		slideshow: 3000,
		autoplay_slideshow: false,
		social_tools: false
	});
	// ------- Prety Photo ------- //

	// ------- PrettyPhoto Video Popup ------- //
    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
    // ------- PrettyPhoto Video Popup ------- //

    // -- News detail -- //
    $('#share-btn1').on('click', function (e) {
        e.stopPropagation();
        $(this).attr('style', 'display: none');
        $('#show-social-icon1').removeClass('on-hover-share');
    });

    $(window).click(function() {
        $('#show-social-icon1').addClass('on-hover-share');
        $('#share-btn1').attr('style', 'display: block');
    });

});
