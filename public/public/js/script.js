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
$(document).ready(function(){
  $('#exampleModal').on('show.bs.modal', function (e) {
    var modal = $(this);
    var id = $(e.relatedTarget).data('product');
    $.ajax({
      url: getDetailProduct,
      method:"get",
      dataType:"JSON",
      data: {id:id},
      success: function(data){
        modal.find('#modal-name').text(data.product.name);
        modal.find('#modal-category').text(data.category.name);
        if (data.product.price) {
          modal.find('#modal-price').text(data.product.price + 'đ');
          modal.find('#modal-original-price').text(data.product.original_price + 'đ');
        } else {
          modal.find('#modal-original-price').text('');
          modal.find('#modal-price').text(data.product.original_price + 'đ');
        }
        modal.find('#modal-inventory').text(data.product.inventory);
        modal.find('#modal-description').text(data.product.description);
        var eleColor = "";
        $.each(data.colors, function(key, val){
          eleColor += '<option value="' + val.id + '">' + val.name + '</option>';
        });        
        modal.find('#modal-color').html(eleColor);
        var eleSize = "";
        $.each(data.sizes, function(key, val){
          eleSize += '<option value="' + val.id + '">' + val.size + '</option>';
        });
        modal.find('#modal-size').html(eleSize);
      }
    });
  });
});