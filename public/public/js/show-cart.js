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
      items += '<input type="number" min="1" max="'+ (val.product.max - val.product.quantity) +'" class="form-control w-50 js-quantity-item" value="'+ val.product.quantity +'" />';
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
    var code = JSON.parse(localStorage.getItem("code"));
    var codeDecrease = 0;
    if(code){
      codeDecrease = code['decrease'];
      $('.js-input-code').val(code['name']);
      $('#cart-code-decrease').text(formatCurrencyVN(codeDecrease));
    }
    $('#cart-amount').text(formatCurrencyVN(subAmount - codeDecrease));
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
      if(arrProduct.length == 0){
        localStorage.removeItem('arrProduct');
        localStorage.removeItem('code');
      }else{
        checkCode();
      }
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
    checkCode();
  });

  // Get subAmount
  function getSubAmount(){
    subAmount = 0;
    var arrProduct = JSON.parse(localStorage.getItem("arrProduct"));
    $.each(arrProduct, function(key, val){
      subAmount += val.product.price * val.product.quantity;
    });
    return subAmount;
  }

  // Get Product: id, quantity
  function getProduct(){
    var arrProduct = JSON.parse(localStorage.getItem("arrProduct"));
    var data = [];
    $.each(arrProduct, function(key, val){
      data.push({
        'id' : val.product.id,
        'quantity' : val.product.quantity,
      });
    });
    return data;
  }

  //check code
  function checkCode(){
    var codeName = $('.js-input-code').val();
    var products = getProduct();
    if(codeName != '' && products.length != 0){
      $.ajax({
        url: 'cart/applyCode',
        method: "get",
        data: {code:codeName, products:products},
        success: function(data){
          if(data == ''){
            $('.mess-coupon').text('Áp mã thất bại (Mã đã hết hoặc sai mã)');
            localStorage.removeItem('code');
            $('#cart-code-decrease').text('');
            $('#cart-amount').text(formatCurrencyVN(getSubAmount()));
          }else{
            var subAmount = getSubAmount();
            var amount = subAmount - data;
            $('.mess-coupon').text('Áp mã thành công');
            $('#cart-code-decrease').text(formatCurrencyVN(data));
            $('#cart-amount').text(formatCurrencyVN(amount));
            code = {};
            code['name'] = codeName;
            code['decrease'] = +data;
            localStorage.setItem('code', JSON.stringify(code));
          }
        }
      });
    }
  }

  // Apply Code
  $('.js-apply-code').click(function(){
    checkCode();
  });

  //Redirect checkout
  $('.js-checkout-order').click(function(){
    window.location.href = "/checkout";
  });
});