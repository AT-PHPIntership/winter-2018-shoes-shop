$(document).ready(function(){
  //Show form review
  $('.js-btn-review').click(function(){
    if(isLogin){
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
});