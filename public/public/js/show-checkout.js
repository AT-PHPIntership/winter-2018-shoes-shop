$(document).ready(function(){
  // Show list item cart
  function getListCheckoutItem(){
    var arrProduct = JSON.parse(localStorage.getItem("arrProduct"));
    var items = '';
    var subAmount = 0;
    $.each(arrProduct, function(key, val){
      items += '<tr class="row">';
      items += '<td class="col-lg-6"><b>'+ val.product.name +'</b> <p class="mb-0">('+ val.color.name +'-'+ val.size.name +')</p></td>';
      items += '<td class="col-lg-2 text-center">'+ val.product.quantity +'</td>';
      items += '<td class="col-lg-4">'+ formatCurrencyVN(val.product.price) +'</td>';
      items += '</tr>';
      subAmount += val.product.price * val.product.quantity;
    });
    $('.list-checkout-item').html(items);
    $('#checkout-sub-amount').text(formatCurrencyVN(subAmount));
    var code = JSON.parse(localStorage.getItem("code"));
    var codeDecrease = 0;
    if(code){
      codeDecrease = code['decrease'];
      $('#checkout-code-name').text(code['name']);
      $('#checkout-code-decrease').text(formatCurrencyVN(codeDecrease));
    }
    $('#checkout-amount').text(formatCurrencyVN(subAmount - codeDecrease));
  }
  getListCheckoutItem();

  $('#js-handle-checkout').click(function(){
    var arrProduct = JSON.parse(localStorage.getItem("arrProduct"));
    var code = JSON.parse(localStorage.getItem("code"));
    var userId = $('.user-email').attr('data-id');
    var customerName = $('.customer-name').val();
    var phoneNumber = $('.phone-number').val();
    var regexPhone = /((0)+([0-9]{9})\b)/g;
    var shippingAddress = $('.shipping-address').val();
    var flag = 1;
    var customer = {};
    $('.err-customer-name').text('');
    $('.err-phone-number').text('');
    $('.err-shipping-address').text('');
    if(customerName == ''){
      $('.err-customer-name').text(required);
      flag = 0;
    }
    if(phoneNumber == ''){
      $('.err-phone-number').text(required);
      flag = 0;
    }
    if(phoneNumber != '' && !regexPhone.test(phoneNumber)){
      $('.err-phone-number').text(errPhoneNumber);
      flag = 0;
    }
    if(shippingAddress == ''){
      $('.err-shipping-address').text(required);
      flag = 0;
    }
    if(flag){
      customer['userId'] = userId;
      customer['customerName'] = customerName;
      customer['phoneNumber'] = phoneNumber;
      customer['shippingAddress'] = shippingAddress;
    }
    if(arrProduct && arrProduct.length && customer && Object.keys(customer).length){
      $.ajax({
        url: handleCheckoutUrl,
        method: "get",
        data: {code:code, arrProduct:arrProduct, customer:customer},
        success: function(data){
          $('.message-checkout').text(data.message);
          $('.message-checkout').addClass(data.success ? 'success' : 'error');
          if(data.success){
            localStorage.removeItem('arrProduct');
            localStorage.removeItem('code');
          }
        }
      });
    }
  });
});