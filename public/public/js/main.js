$(document).ready(function(){
	"use strict";
	var window_width 	 = $(window).width(),
	window_height 		 = window.innerHeight,
	header_height 		 = $(".default-header").height(),
	header_height_static = $(".site-header.static").outerHeight(),
	fitscreen 			 = window_height - header_height;
	$(".fullscreen").css("height", window_height)
	$(".fitscreen").css("height", fitscreen);
    $(".default-header").sticky({topSpacing:0});
  $('.navbar-nav li.dropdown').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
  }, function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
  });

  $('.img-pop-up').magnificPopup({
      type: 'image',
      gallery:{
      enabled:true
      }
  });

  // -------   Active Mobile Menu-----//
  $(".navbar-nav li a[href^='#']").on('click', function(event) {
    var target = this.hash;
    event.preventDefault();
    var navOffset = $('#navbar').height();
    return $('html, body').animate({
      scrollTop: $(this.hash).offset().top-40 - navOffset
    }, 600, function() {
      return window.history.pushState(null, null, target);
    });
  });

  //--------- Accordion Icon Change ---------//
  $('.collapse').on('shown.bs.collapse', function(){
      $(this).parent().find(".lnr-arrow-right").removeClass("lnr-arrow-right").addClass("lnr-arrow-left");
  }).on('hidden.bs.collapse', function(){
      $(this).parent().find(".lnr-arrow-left").removeClass("lnr-arrow-left").addClass("lnr-arrow-right");
  });

  // Select all links with hashes
  $('.main-menubar a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top-70
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });

  $('.quick-view-carousel-details').owlCarousel({
      loop: true,
      dots: true,
      items: 1,
  })
  
  //-------- Have Cupon Button Text Toggle Change -------//
  $('.have-btn').on('click', function(e){
      e.preventDefault();
      $('.have-btn span').text(function(i, text){
        return text === "Have a Coupon?" ? "Close Coupon" : "Have a Coupon?";
      })
      $('.cupon-code').fadeToggle("slow");
  });
  $('.load-more-btn').on('click', function(e){
      e.preventDefault();
      $('.load-product').fadeIn('slow');
      $(this).fadeOut();
  });

  //------- Start Quantity Increase & Decrease Value --------//
  var value, quantity = document.getElementsByClassName('quantity-container');
  function createBindings(quantityContainer) {
    var quantityAmount = quantityContainer.getElementsByClassName('quantity-amount')[0];
    var increase = quantityContainer.getElementsByClassName('increase')[0];
    var decrease = quantityContainer.getElementsByClassName('decrease')[0];
    increase.addEventListener('click', function () { increaseValue(quantityAmount); });
    decrease.addEventListener('click', function () { decreaseValue(quantityAmount); });
  }

  function init() {
    for (var i = 0; i < quantity.length; i++ ) {
        createBindings(quantity[i]);
    }
  };

  function increaseValue(quantityAmount) {
    value = parseInt(quantityAmount.value, 10);

    console.log(quantityAmount, quantityAmount.value);

    value = isNaN(value) ? 0 : value;
    value++;
    quantityAmount.value = value;
  }

  function decreaseValue(quantityAmount) {
    value = parseInt(quantityAmount.value, 10);

    value = isNaN(value) ? 0 : value;
    if (value > 0) value--;

    quantityAmount.value = value;
  }

  init();
  //------- End Quantity Increase & Decrease Value --------//
});
