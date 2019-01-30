$('.js-addcart').each(function(){
  var nameProduct = $(this).parent().parent().parent().find('.top .head').html();
  $(this).on('click', function(){
    swal(nameProduct, "is added to cart !", "success");
    // alert(nameProduct);
  });
});
$(document).ready(function(){
  $(".owl-carousel").owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
      0:{
        items:1
      },
      600:{
        items:2
      },
      1000:{
        items:4
      }
    }
  });
});
$('#exampleModal').on('show.bs.modal', function (e) {
  var id = $(e.relatedTarget).data('product');
  var modal = $(this)
    // modal.find('.top .head').val(id);
  console.log(modal);
});