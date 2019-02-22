$(document).ready(function(){
  "use strict";

  // Sticky
	var window_width 	 = $(window).width(),
	window_height 		 = window.innerHeight,
	header_height 		 = $(".default-header").height(),
	header_height_static = $(".site-header.static").outerHeight(),
	fitscreen 			 = window_height - header_height;
	$(".fullscreen").css("height", window_height)
	$(".fitscreen").css("height", fitscreen);
  $(".default-header").sticky({topSpacing:0});
  
  // Active Mobile Menu
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
});
