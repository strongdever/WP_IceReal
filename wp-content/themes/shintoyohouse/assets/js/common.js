!(function($) {
  "use strict";

  let vh = window.innerHeight * 0.01;
  let vw = window.innerWidth * 0.01;
  console.log(window.innerWidth);
  document.documentElement.style.setProperty('--vh', `${vh}px`);
  document.documentElement.style.setProperty('--vw', `${vw}px`);

  // Back to top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 150) {
      $('.back_to_top').fadeIn('slow');
    } else {
      $('.back_to_top').fadeOut('slow');
    }
  });

  $('.back_to_top').click(function() {
    $('html, body').animate({
      scrollTop: 0
    }, 1000);
    return false;
  });


  // Smooth scroll for the navigation menu and links with .scrollto classes
  var scrolltoOffset = 55;
  if (window.matchMedia("(max-width: 991px)").matches) {
    scrolltoOffset = 60;
  }

  $(document).on('click', 'a', function(e) {

    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if (target.length) {
        e.preventDefault();

        var scrollto = target.offset().top - scrolltoOffset;

        if ($(this).attr("href") == '#header') {
          scrollto = 0;
        }

        $('html, body').animate({
          scrollTop: scrollto
        }, 1000);

        if ($(this).parents('.nav_menu, .mobile_nav_menu').length) {
          $('.nav_menu .active, .mobile_nav_menu .active').removeClass('active');
          $(this).addClass('active');
        }

        return false;
      }
    }
  });

  // Mobile Navigation
  $('body').prepend('<button type="button" id="mobile_nav_toggle" class="drawer_toggle"><span class="drawer_icon"><span></span><span></span><span></span></span><span class="drawer_text">MENU</span></button>');
  $('body').append('<div id="mobile_body_overly"></div>');

  $(document).on('click', '.drawer_toggle', function(e) {
    $('body').toggleClass('mobile_nav_active');
    $('.drawer_toggle').toggleClass('drawer_open');
    $('#mobile_body_overly').toggle();
  });

  $(document).on('click', '.mobile_nav_menu .drop_down > a', function(e) {
    e.preventDefault();
    $(this).next().slideToggle(300);
    $(this).parent().toggleClass('active');
  });

  $(document).click(function(e) {
    var container = $("#mobile_nav, .drawer_toggle");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      if ($('body').hasClass('mobile_nav_active')) {
        $('body').removeClass('mobile_nav_active');
        $('.drawer_toggle').removeClass('drawer_open');
        $('#mobile_body_overly').fadeOut();
      }
    }
  });

  // Activate smooth scroll on page load with hash links in the url
  $(document).ready(function() {
    if (window.location.hash) {
      var initial_nav = window.location.hash;
      if ($(initial_nav).length) {
        var scrollto = $(initial_nav).offset().top - scrolltoOffset;
        $('html, body').animate({
          scrollTop: scrollto
        }, 1000);
      }
    }
  });

  if ($('.c_top_main_slider').length > 0) {
    var $slide = $('.c_top_main_slider').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: false,
      autoplay: true,
      fade: true,
      speed: 2000,
      autoplaySpeed: 4000,
      centerMode: false,
      cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
    }).on({
      beforeChange: function(event, slick, currentSlide, nextSlide) {
        $(".slick-slide", this).eq(currentSlide).addClass("preve-slide");
        $(".slick-slide", this).eq(nextSlide).addClass("slide-animation");
      },
      afterChange: function() {
        $(".preve-slide", this).removeClass("preve-slide slide-animation");
      }
    });
    $slide.find(".slick-slide").eq(0).addClass("slide-animation");
  }

  //get all vids
  var video =  document.querySelectorAll('video');

  //add source to video tag
  function addSourceToVideo(element, src) {
      var source = document.createElement('source');
      source.src = src;
      source.type = 'video/mp4';
      element.appendChild(source);
  }

  //determine screen size and select mobile or desktop vid
  function whichSizeVideo(element, src) {
    var windowWidth = window.innerWidth ? window.innerWidth : $(window).width();
    if (windowWidth > 768 ) {
      addSourceToVideo( element, src.dataset.desktopVid);
    } else {
      addSourceToVideo(element, src.dataset.mobileVid);
    }
  }

  //init only if page has videos
  function videoSize() {
    if (video !== undefined) {
    video.forEach(function(element, index) {
        whichSizeVideo(  
          element, //element
          element  //src locations
        );	
      });
    }
  }

  videoSize();

  // modal

  var custom_modal = $(".custom_modal");

  var modal_close_span = $(".close")[0];

  $('.modal_link').on("click", function(e) {
    e.preventDefault();
    $('body').toggleClass('modal_active');
    return false;
  });

  $('.modal_close').on("click", function(e) {
    e.preventDefault();
    $('body').removeClass('modal_active');
  });

  $(window).on('click', function(event) {
    if (event.target.classList.contains('custom_modal')) {
      $('body').removeClass('modal_active');
    }
  });

  // tab
  $(document).ready(function() {

    $(".tabs .tabs_list li a").click(function(e) {
      e.preventDefault();
    });

    $(".tabs .tabs_list li").click(function() {
      var tabid = $(this).find("a").attr("href");
      $(this).parent('.tabs_list').parent('.tabs').find('.tab').removeClass("active");
      $(this).parent('.tabs_list').find('li').removeClass("active");
      $(this).parent('.tabs_list').parent('.tabs').find('.tab').hide();
      $(tabid).show();
      $(this).addClass("active");

    });

  });

})(jQuery);