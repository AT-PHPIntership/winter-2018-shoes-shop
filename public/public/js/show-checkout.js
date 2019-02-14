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
      items += '<td class="col-lg-4">'+ val.product.price +'</td>';
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
    var customer = {};
    customer['customerName'] = $('.customer-name').val();
    customer['phoneNumber'] = $('.phone-number').val();
    customer['shippingAddress'] = $('.shipping-address').val();
    $.ajax({
      url: handleCheckoutUrl,
      method: "get",
      data: {code:code, arrProduct:arrProduct, customer:customer},
      success: function(data){
        console.log(data);
      }
    });
  });
});