$('.js-addcart').each(function(){
  var nameProduct = $(this).parent().parent().parent().find('.top .head').html();
  $(this).on('click', function(){
    swal(nameProduct, "is added to cart !", "success");
    // alert(nameProduct);
  });
});
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
    var modal = $(this);
    var id = $(e.relatedTarget).data('product');
    $.ajax({
      url: getDetailProduct,
      method:"get",
      dataType:"JSON",
      data: {id:id},
      success: function(data){
        modal.find('#modal-name').text(data.name);
        modal.find('#modal-category').text(data.category.name);
        modal.find('#modal-price').text(data.original_price);
        modal.find('#modal-inventory').text(data.quantity - data.total_sold);
        modal.find('#modal-description').text(data.description);
        console.log(data.product_details);
        var colorIds = [];
        var sizeIds = [];
        $.each(data.product_details, function(key, val){
          colorIds[key] = val.color_id;
          // colorIds[key] = val.color.name;
          sizeIds[key] = val.size_id;
        });
        // colorIds = colorIds.filter(function(key, val) {
        //   return colorIds.indexOf(key) == val;
        // });
        // sizeIds = sizeIds.filter(function(key, val) {
        //   return sizeIds.indexOf(key) == val;
        // });
        console.log(colorIds);
        // console.log(sizeIds);
        // var color = "";
        // $.each(colorIds, function(val){
        //   color += '<option value="'+ val + '">' + val.name + '</option>';
        // });
      }
    });
  });
});