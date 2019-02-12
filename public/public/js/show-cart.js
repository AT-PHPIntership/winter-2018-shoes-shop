$(document).ready(function(){
  // Show list item cart
  function getListCartItem(){
    var arrProduct = JSON.parse(localStorage.getItem("arrProduct"));
    var items = '';
    var subAmount = 0;
    $.each(arrProduct, function(key, val){
      items += '<div class="cart-single-item">';
      items += '<div class="row align-items-center">';
      items += '<div class="col-md-4 col-12">';
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
      items += '<div class="price js-price-item">'+ formatCurrencyVN(val.product.price) +'</div>';
      items += '</div>';
      items += '<div class="col-md-2 col-6">';
      items += '<input type="number" min="0" class="form-control w-50 js-quantity-item" value="'+ val.product.quantity +'" />';
      items += '</div>';
      items += '<div class="col-md-2 col-12">';
      items += '<div class="total js-total-price-item">'+ formatCurrencyVN(val.product.price * val.product.quantity) +'</div>';
      items += '</div>';
      items += '<div class="col-md-2 col-6">';
      items += '<div class="text-center"><a class="js-remove-item" data-product-id="'+ val.product.id +'" href="javascript:void(0)"><i class="fa fa-times fa-2x"></i></a></div>';
      items += '</div>';
      items += '</div>';
      items += '</div>';
      subAmount += val.product.price * val.product.quantity;
    });
    $('.list-cart-item').html(items);
    $('#cart-sub-amount').text(formatCurrencyVN(subAmount));
    $('#cart-amount').text(formatCurrencyVN(subAmount));
  }
  getListCartItem();

  // Remove item
  $('.list-cart-item').on('click', '.js-remove-item',function(){
    if(confirm("Bạn có muốn xóa sản phẩm ?")){
      var productId = $(this).attr('data-product-id');
      var arrProduct = JSON.parse(localStorage.getItem("arrProduct"));
      var totalItem = $('#js-total-item').text();
      $.each(arrProduct, function(key, val){
        if(+productId === val.product.id){
          totalItem -= val.product.quantity;
        }
      });
      $('#js-total-item').text(totalItem);
      arrProduct = arrProduct.filter(function(val){
        return val.product.id !== +productId;
      });
      localStorage.setItem('arrProduct', JSON.stringify(arrProduct));
      getListCartItem();
    }
  });

  // Change quantity item
  $('.list-cart-item').on('click', '.js-quantity-item',function(){
    var arrProduct = JSON.parse(localStorage.getItem("arrProduct"));
    var quantity = $(this).val();
    var productId = $(this).parent().parent().find('.js-remove-item').attr('data-product-id');
    var totalItem = +($('#js-total-item').text());
    $.each(arrProduct, function(key, val){
      if(+productId === val.product.id){
        if(quantity > val.product.quantity){
          totalItem += quantity - val.product.quantity;
        }else{
          totalItem -= val.product.quantity - quantity;
        }
        val.product.quantity = quantity;
      }
    });
    $('#js-total-item').text(totalItem);
    localStorage.setItem('arrProduct', JSON.stringify(arrProduct));
    getListCartItem();
  });

  // Apply Code
  $('.js-apply-code').click(function(){
    var code = $(this).parent().find('.js-input-code').val();
    var arrProduct = JSON.parse(localStorage.getItem("arrProduct"));
    var productIds = [];
    $.each(arrProduct, function(key, val){
      productIds[key] = val.product.id;
    });
    $.ajax({
      url: 'cart/applyCode',
      method: "get",
      dataType:"JSON",
      data: {code:code, productIds:productIds},
      success: function(data){
        if(data['status']){
          var apply = data['apply'];
          if(apply){
            var percent = data['percent'];
            $('#cart-code-percent').text(percent + '%');
            var decrease = 0;
            var productNames = [];
            for (var i = 0; i < arrProduct.length; i++) {
              for (var j = 0; j < apply.length; j++) {
                if(+arrProduct[i].product.id === +apply[j]){
                  decrease += (arrProduct[i].product.price * arrProduct[i].product.quantity * percent)/100;
                  productNames[i] = arrProduct[i].product.name;
                }
              }
            }
            subAmount = 0;
            $.each(arrProduct, function(key, val){
              subAmount += val.product.price * val.product.quantity;
            });
            cartAmount = subAmount - decrease;
            $('#cart-amount').text(formatCurrencyVN(cartAmount));
            $('.mess-coupon').text('Áp mã thành công: '+ productNames);
          }else{
            $('.mess-coupon').text('Không có sản phẩm nào được áp dụng');
          }
        }else{
          $('.mess-coupon').text('Áp mã thất bại');
        }
      }
    });
  });
});