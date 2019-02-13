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
    $('#modal-color').html('<option value="">Chọn</option>');
    $('#modal-size').html('<option value="">Chọn</option>');
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
        modal.find('#modal-color').append(eleColor);
        var eleImage = "";
        $.each(data.images, function(key, val){
          var active = '';
          active = (key == 0) ? 'active' : '';
          eleImage += '<div class="carousel-item ' + active + '"><img class="d-block" src="' + val.path + '" alt=""></div>';
        });
        modal.find('#modal-image').html(eleImage);
      }
    });
  });
  var productQuantity = []
  $('#modal-color').change(function(){
    var colorId = $(this).val();
    $.ajax({
      url: getSizesByColorId,
      method:"get",
      dataType:"JSON",
      data: {colorId:colorId},
      success: function(data){
        productQuantity = data;
        var eleSize = "";
        $.each(data, function(key, val){
          eleSize += '<option value="' + val.size_id + '">' + val.size + '</option>';
        });
        $('#modal-size').append(eleSize);
      }
    });
  });
  $('#modal-size').change(function(){
    var sizeId = $(this).val();
    $.each(productQuantity, function(key, val){
      if (+sizeId == +val.size_id){
        $('#modal-inventory').text(val.quantity);
        $('#modal-quantity').attr('max', val.quantity);
      }
    });
  })
});