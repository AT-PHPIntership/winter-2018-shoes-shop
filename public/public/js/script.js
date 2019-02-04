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

  // filter_data();

  function filter_data(){
    var categoryId = $('#active-category').attr('data-id');
    var colorIds = get_filter('js-ck-color');
    var sizeIds = get_filter('js-ck-size');
    var sort = $('.js-slt-sort').val();
    var minPrice = $('#lower-value').text();
    var maxPrice = $('#upper-value').text();
    $.ajax({
      url: filterProductUrl,
      method:"get",
      dataType:"JSON",
      data: {categoryId:categoryId, colorIds:colorIds, sizeIds:sizeIds, sort:sort, minPrice:minPrice, maxPrice:maxPrice},
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
  }

  // get ids filter
  function get_filter(class_name){
    var filter = [];
    $('.'+class_name+':checked').each(function(){
      filter.push($(this).attr('data-id').split(':')[1]);
    });
    return filter;
  }

  // add active-filter-item and filter data
  $('.js-common').click(function(){
    if ($(this).is(':checked')) {
      var name = $(this).parent().parent().find('span').text();
      var dataId = $(this).attr('data-id');
      var activeFilterItem = '<li class="filter-list active-filter-item ml-10" data-id="'+ dataId +'">'+ name +'<i class="fa fa-window-close remove-filter" aria-hidden="true"></i></li>';
      $('.active-filter-list').append(activeFilterItem);
    } else {
      var dataId = $(this).attr('data-id');
      $('.active-filter-item').each(function(){
        if ($(this).attr('data-id') == dataId) {
          $(this).remove();
        }
      });
    }
    filter_data();
  });

  // sort data
  $('.js-slt-sort').on('change', function(){
    filter_data();
  });

  //remove active-filter-item
  $('.active-filter-list').on('click', '.remove-filter', function(){
    $(this).parent().remove();
    var dataId = $(this).parent().attr('data-id');
    $('.js-common').each(function(){
      if ($(this).attr('data-id') == dataId) {
        $(this).removeAttr('checked');
      }
    });
    filter_data();
  });

  // price slider
  $(function(){
    if(document.getElementById("price-range")){
      var nonLinearSlider = document.getElementById('price-range');
      noUiSlider.create(nonLinearSlider, {
        connect: true,
        start: [ 100000, 2000000 ],
        range: {
          'min': [ 0, 100000 ],
          '50%': [ 1000000, 200000 ],
          'max': [ 2000000 ],
        }
      });
      var nodes = [
        document.getElementById('lower-value'),
        document.getElementById('upper-value'),
      ];
      nonLinearSlider.noUiSlider.on('update', function (values, handle) {
        nodes[handle].innerHTML = values[handle];
        filter_data();
      });
    }
  });
});