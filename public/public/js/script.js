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