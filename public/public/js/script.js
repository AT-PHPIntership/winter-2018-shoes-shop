function formatCurrencyVN(number){
  return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(number);
}
function reverseFormatCurrencyVN(price){
  return price.replace(/[^0-9]/g, "");
}
//Display choosen images
function previewImage(input) 
{
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#image-preview').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
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
  
  $('#modal-product').on('show.bs.modal', function (e) {
    $('#js-color').html('<option value="">'+ option_default +'</option>');
    $('#js-size').html('<option value="">'+ option_default +'</option>');
    $('#js-quantity').val(0);
    var modal = $(this);
    var id = $(e.relatedTarget).data('product');
    $.ajax({
      url: getDetailProduct,
      method:"get",
      dataType:"JSON",
      data: {id:id},
      success: function(data){
        modal.find('#js-name').text(data.product.name);
        modal.find('#js-category').text(data.category.name);
        if (data.product.price) {
          modal.find('#js-price').text(formatCurrencyVN(data.product.price));
          modal.find('#js-original-price').text(formatCurrencyVN(data.product.original_price));
        } else {
          modal.find('#js-original-price').text('');
          modal.find('#js-price').text(formatCurrencyVN(data.product.original_price));
        }
        modal.find('#js-inventory').text(data.product.inventory);
        modal.find('#js-description').text(data.product.description);
        modal.find('.js-add-cart').attr('data-product-id', data.product.id);
        modal.find('#js-link-detail').attr('href', detailProductUrl + '/' + data.product.id);
        var eleColor = "";
        $.each(data.colors, function(key, val){
          eleColor += '<option value="' + val.id + '">' + val.name + '</option>';
        });        
        modal.find('#js-color').append(eleColor);
        var eleImage = "";
        $.each(data.images, function(key, val){
          var active = '';
          active = (key == 0) ? 'active' : '';
          eleImage += '<div class="carousel-item ' + active + '"><img class="d-block quick-view-img" src="' + val.path + '" alt=""></div>';
        });
        modal.find('#js-image').html(eleImage);
      }
    });
  });

  var productInventory = []
  $('#js-color').change(function(){
    $('#js-size').html('<option value="">'+ option_default +'</option>');
    var colorId = $(this).val();
    var productId = $('.js-add-cart').attr('data-product-id');
    if(colorId){
      $.ajax({
        url: getSizesByColorId,
        method:"get",
        dataType:"JSON",
        data: {colorId:colorId,productId:productId},
        success: function(data){
          productInventory = data;
          var eleSize = "";
          $.each(data, function(key, val){
            eleSize += '<option value="' + val.id + '">' + val.size + '</option>';
          });
          $('#js-size').append(eleSize);
        }
      });
    }
  });

  $('#js-size').change(function(){
    var sizeId = $(this).val();
    if(sizeId){
      $.each(productInventory, function(key, val){
        if (+sizeId == +val.id){
          var inventory = val.inventory;
          var productId = $('.js-add-cart').attr("data-product-id");
          var colorId = $('#js-color').val();
          var arrProduct = JSON.parse(localStorage.getItem('arrProduct'));
          if(!arrProduct || !arrProduct.length){
            arrProduct = [];
          }
          if(arrProduct.length){
            $.each(arrProduct, function(key, val){
              if(val.product.id == productId && val.color.id == colorId && val.size.id == sizeId){
                inventory -= val.product.quantity;
              }
            });
          }
          $('#js-inventory').text(inventory);
          $('#js-quantity').attr('max', inventory);
        }
      });
    }
  })
});
