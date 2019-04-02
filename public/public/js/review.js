$(document).ready(function(){
  //Show form review
  $('.js-btn-review').click(function(){
    if(+userLogin.id){
      $('.review-form').toggle();
      if($(this).text() == 'Viết nhận xét của bạn'){
        $(this).text('Đóng');
      } else {
        $(this).text('Viết nhận xét của bạn');
      }
    }else{
      if(confirm('Bạn cần đăng nhập trước khi đánh giá.')){
        window.location = loginUrl;
      }
    }
  });

  //Click input file
  $('.btn-fake').click(function(){
    $('.btn-file').click();
  });

  //Preview img
  var files = [];
  $('.btn-file').change(function(e){
    var totalImage = $('.btn-file').get(0).files.length;
    if(totalImage + files.length > 5){
      $('.error-image small').text('Chỉ được up tối đa 5 hình.');
    }else{
      $('.error-image small').text('');
      for(var i = 0; i < totalImage; i++)
      {
        var file = $('.btn-file').prop('files')[i];
        var totalFile = files.length;
        var images = '';
        images += '<div class="img-content">';
        images += '<img class="img-preview" src="'+ URL.createObjectURL(event.target.files[i]) +'" alt="">';
        images += '<span data-name="'+ file['name'] +'" class="rm-img js-remove-img"><i class="fa fa-times-circle"></i></span>';
        images += '</div>';
        if(totalFile){
          var flag = 1;
          for(var j = 0;j < totalFile; j++){
            if(files[j]['name'] == file['name']){
              $('.error-image small').text('Có hình ảnh bị trùng và sẽ không được upload.');
              flag = 0;
            }
          }
          if(flag){
            files.push(file);
            $('.wrapper-img').append(images);
          }
        }else{
          files.push(file);
          $('.wrapper-img').append(images);
        }
      }
      $('.btn-file').wrap('<form>').closest('form').get(0).reset();
      $('.btn-file').unwrap();
    }
  });

  //Remove img
  $('.wrapper-img').on('click', '.js-remove-img',function(){
    var name = $(this).attr('data-name');
    for(var j = 0;j < files.length; j++){
      if(files[j]['name'] == name){
        files.splice(j, 1);
        $(this).parent().remove();
        $('.error-image small').text('');
      }
    }
  });

  $('#add-review-form').submit(function (e) {
    e.preventDefault();
    $(this).find('.help-block').remove();
    formData = new FormData(this);
    for(let i = 0; i < files.length; i++){
      formData.append('images[' + i + ']', files[i]);
    }
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      url: addReviewUrl,
      method: "post",
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        if(data['success']){
          alert(data['message']);
          $('.review-form').css('display', 'none');
          $('.action-review').css('display', 'none');
        }else{
          alert(data['message']);
        }
      },
      error: function(data){
        var res = data.responseJSON;
        if ($.isEmptyObject(res) == false) {
          $.each(res.errors,function (key,value) {
            $("#"+key).closest(".form-group")
                      .append('<span class="help-block">'+value+'</span>');
          });
        }
      }
    });
  });

  //Show list review
  listReview();
  function listReview(page = 1){
    var url = window.location.pathname;
    var productId = url.substring(url.lastIndexOf('/') + 1);
    var sort = $('#js-slt-sort').val();
    var isBuy = $('#js-slt-is-buy').val();
    var star = $('#js-slt-star').val();
    $.ajax({
      url: listReviewUrl,
      method: "GET",
      data: {productId:productId, page:page, sort:sort, isBuy:isBuy, star:star},
      success: function(data){
        if(data.data.length){
          var list = '';
          $.each(data.data, function(key, val){
            list += '<div class="review-item">';
            list += '<div class="row">';
            list += '<div class="col-md-2 text-center">';
            list += '<div class="user-avatar">';
            list += '<img src="'+ val['user']['profile']['avatar'] +'" alt="">';
            list += '</div>';
            list += '<p class="user-name">'+ val['user']['profile']['name'] +'</p>';
            list += '<p class="date-review">'+ val['created_at'] +'</p>';
            list += '</div>';
            list += '<div class="col-md-10">';
            list += '<div class="rv-info">';
            list += '<div class="rv-rating">';
            var star = val['star'];
            list += '<i class="fa fa-star '+ (1 <= star ? 'active' : '') +'"></i>';
            list += '<i class="fa fa-star '+ (2 <= star ? 'active' : '') +'"></i>';
            list += '<i class="fa fa-star '+ (3 <= star ? 'active' : '') +'"></i>';
            list += '<i class="fa fa-star '+ (4 <= star ? 'active' : '') +'"></i>';
            list += '<i class="fa fa-star '+ (5 <= star ? 'active' : '') +'"></i>';
            list += '</div> ';
            list += '<p class="rv-title">'+ val['title'] +'</p>';
            if(val['is_buy']){
              list += '<p class="rv-buy-already">';
              list += '<img src="/public/images/icon_verified.png" alt="">';
              list += '<span>Verified Purchase</span>';
              list += '</p>';
            }
            list += '<p class="rv-content">'+ val['content'] +'</p>';
            if(val['images']){
              list += '<div class="rv-image">';
              $.each(val['images'], function(key, val){
                list += '<img src="'+ val['path'] +'" alt="">';
              });
              list += '</div>';
            }
            list += '<div class="rv-like">';
            var isLike;
            if(val['likes'].length){
              $.each(val['likes'], function(key, val){
                val['user_id'] == +userLogin.id ? isLike = 1 : isLike = 0;
              });
            }
            list += '<button class="js-btn-like"><i class="fa fa-thumbs-up '+ (isLike == 1 ? 'active' : '') +'"></i></button>';
            list += '<span class="rv-total-like '+ (isLike == 1 ? 'active' : '') +'">'+ (val['likes'].length > 0 ? val['likes'].length : '') +'</span>';
            list += '</div>';
            list += '</div>';
            list += '</div>';
            list += '</div>';
            list += '</div>';
          });
          var totalPage = data['paginator']['last_page'];
          if(totalPage > 1){
            list += '<div class="paginate-review">';
            for (let i = 1; i <= totalPage; i++) {
              list += '<a class="'+ (page == i ? 'active' : '') +'" href="'+ listReviewUrl +'?page='+ i +'">'+ i +'</a>';            
            }
            list += '</div>';
          }
          $('.review-list').html(list);
        }else{
          $('.review-list').html('Chưa có đánh giá nào!');
        }
      },
      error: function(data){
        console.log(data);        
      }
    });
  }

  //Click paginate
  $(document).on('click','.paginate-review a', function(e){
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    listReview(page);
  });

  // sort data
  $('#js-slt-sort').on('change', function(){
    listReview();
  });
  $('#js-slt-is-buy').on('change', function(){
    listReview();
  });
  $('#js-slt-star').on('change', function(){
    listReview();
  });
});