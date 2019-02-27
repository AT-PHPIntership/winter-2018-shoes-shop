$(document).ready(function(){
  var arrProduct = JSON.parse(localStorage.getItem('arrProduct'));
  if(!arrProduct || !arrProduct.length){
    arrProduct = [];
  }
  var totalItem = 0;
  if(localStorage.arrProduct != null){
    $.each(arrProduct, function(key, val){
      totalItem += +val.product.quantity;
    });
    $('#js-total-item').html(totalItem);
  }
  $('#js-color').change(function() {
    $(this).removeClass('bd-red');
  });
  $('#js-size').change(function() {
    $(this).removeClass('bd-red');
  });
  $('#js-quantity').change(function() {
    $(this).removeClass('bd-red');
  });
  $('.js-add-cart').click(function(){
    var productId = $(this).attr('data-product-id');
    var productName = $('#js-name').html();
    var productPrice = reverseFormatCurrencyVN($('#js-price').html());
    var colorId = $('#js-color').val();
    var colorName = $('#js-color').children("option:selected").html();
    var sizeId = $('#js-size').val();
    var sizeName = $('#js-size').children("option:selected").html();
    var quantity = $('#js-quantity').val();
    var max = $('#js-quantity').attr("max");
    var imagePath = $('#js-image').children().children().attr("src");
    var totalItem = 0;
    var flag = 1;
    var error = 0;
    if(!sizeId || colorId == ''){
      $('#js-color').addClass('bd-red');
      error = 1;
    }
    if(!sizeId || sizeId == ''){
      $('#js-size').addClass('bd-red');
      error = 1;
    }
    if(!quantity || quantity == 0 || isNaN(quantity)){
      $('#js-quantity').addClass('bd-red');
      error = 1;
    }
    if(!error){
      $.each(arrProduct, function(key, val){
        totalItem += +val.product.quantity;
        if(val.product.id == productId && val.color.id == colorId && val.size.id == sizeId){
          val.product.quantity += +quantity;
          totalItem += +quantity;
          localStorage.setItem('arrProduct', JSON.stringify(arrProduct));
          flag = 0;
        }
      });
      if(flag){
        var data = {};
        var product = {};
        var color = {};
        var size = {};
        product['id'] = +productId;
        product['name'] = productName;
        product['price'] = +productPrice;
        product['quantity'] = +quantity;
        product['max'] = +max;
        product['image'] = imagePath;
        color['id'] = +colorId;
        color['name'] = colorName;
        size['id'] = +sizeId;
        size['name'] = sizeName;
        data['product'] = product;
        data['color'] = color;
        data['size'] = size;
        arrProduct.push(data);
        localStorage.setItem('arrProduct', JSON.stringify(arrProduct));
        totalItem += +quantity;
      }
      $('#js-total-item').html(totalItem);
    }
  });
});