$(document).ready(function(){
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
});
