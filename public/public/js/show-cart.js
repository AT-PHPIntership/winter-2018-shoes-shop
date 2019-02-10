$(document).ready(function(){
  var arrProduct = JSON.parse(localStorage.getItem("arrProduct"));
  function getListCartItem(){
    var items = '';
    var subTotal = 0;
    $.each(arrProduct, function(key, val){
      items += '<div class="cart-single-item">';
      items += '<div class="row align-items-center">';
      items += '<div class="col-md-5 col-12">';
      items += '<div class="product-item d-flex align-items-center">';
      var img = val.product.image ? val.product.image : '/public/img/default_product.png';
      items += '<img src="'+ img +'" class="img-fluid img-product-cart" alt="">';
      items += '<div class="row">';
      items += '<h6 class="col-md-12">'+ val.product.name +'</h6>';
      items += '<h6 class="col-md-12">Màu: <span>'+ val.color.name +'</span> | Size: <span>'+ val.size.name +'</span></h6>';
      items += '</div>';
      items += '</div>';
      items += '</div>';
      items += '<div class="col-md-2 col-6">';
      items += '<div class="price">'+ formatCurrencyVN(val.product.price) +'</div>';
      items += '</div>';
      items += '<div class="col-md-2 col-6">';
      items += '<input type="number" class="form-control w-50" value="'+ val.product.quantity +'" />';
      items += '</div>';
      items += '<div class="col-md-2 col-12">';
      items += '<div class="total">'+ formatCurrencyVN(val.product.price * val.product.quantity) +'</div>';
      items += '</div>';
      items += '<div class="col-md-1 col-6">';
      items += '<div class="text-center"><a class="js-remove-item" href="javascript:void(0)"><i class="fa fa-times fa-2x"></i></a></div>';
      items += '</div>';
      items += '</div>';
      items += '</div>';
      subTotal += val.product.price * val.product.quantity;
    });
    $('.list-cart-item').html(items);
    $('#cart-sub-total-price').html(formatCurrencyVN(subTotal));
  }
  getListCartItem();
  $('.js-remove-item').click(function(){
    $(this).parent().parent().parent().remove();
  });
});