$(document).ready(function(){
  var arrProduct = JSON.parse(localStorage.getItem("arrProduct"));
  console.log(arrProduct);
  var items = '';
  function getListCartItem(){
    $.each(arrProduct, function(key, val){
      items = '<div class="cart-single-item">';
      items += '<div class="product-item d-flex align-items-center">';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
      items += '';
    });
  }
});