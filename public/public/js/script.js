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
  $(".js-radio-color").on("click", function(){
    var radio = $(this);
    var colorId = radio.attr('data-id');
    $.ajax({
      url: productsByCatAndColorUrl,
      method:"get",
      dataType:"JSON",
      data: {colorId:colorId, categoryId:1},
      success: function(data){
        var list = '';
        if (data.length) {
          $.each(data, function(key, val){
            list += '<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">';
            list += '<div class="content">';
            list += '<div class="content-overlay"></div>';
            list += '<img class="content-image img-fluid d-block mx-auto size-product" src="'+ val.image +'" alt="">';
            list += '<div class="content-details fadeIn-bottom">';
            list += '<div class="bottom d-flex align-items-center justify-content-center">';
            list += '<a href="#"><span class="lnr lnr-cart"></span></a>';
            list += '<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>';
            list += '</div>';
            list += '</div>';
            list += '</div>';
            list += '<div class="price">';
            list += '<h5>'+ val.name +'</h5>';
            if (val.price) {
              list += '<p>'+ val.price +'đ <del class="text-gray">'+ val.original_price +'đ</del></p>';
            } else {
              list += '<p>'+ val.original_price +'đ</p>';
            }
            list += '</div>';
            list += '</div>';
          });
        } else {
          list = '<p class="ml-20 mt-20 text-red">Không có sản phẩm</p>';
        }
        $('#list-product').html(list);
      }
    });
  });
});