$(document).ready(function(){
  $('#js-check-product').click(function(){
    var colorIds = [];
    var sizeIds = [];
    var quantities = [];
    $(".js-color").each(function() {
      colorIds.push($(this).val());
    });
    $(".js-size").each(function() {
      sizeIds.push($(this).val());
    });
    $(".js-quantity").each(function() {
      quantities.push($(this).val());
    });
    var products = {};
    products['colors'] = colorIds;
    products['sizes'] = sizeIds;
    products['quantities'] = quantities;
    console.log(products);
  });
  // $.ajax({
  //   url: anyURL,
  //   method: "get",
  //   data: {products:products, ...},
  //   success: function(data){
      
  //   }
  // });
});