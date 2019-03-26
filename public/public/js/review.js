var list = [];
$(document).ready(function(){
  //Show form review
  $('.js-btn-review').click(function(){
    $('.review-form').toggle();
    if($(this).text() == 'Viết nhận xét của bạn'){
      $(this).text('Đóng');
    } else {
      $(this).text('Viết nhận xét của bạn');
    }
  });

  //Click input file
  $('.btn-fake').click(function(){
    $('#btn-file').click();
  });

  //Preview img
  $('#btn-file').change(function(e){
    var total = $('#btn-file').get(0).files.length;
    if(total + list.length > 5){
      $('.error-image small').text('Chỉ được up tối đa 5 hình.');
    }else{
      $('.error-image small').text('');
      for(var i = 0; i < total; i++)
      {
        var images = "";
        var item = $('#btn-file').prop('files')[i];
        var count = list.length;
        if(count){
          var flag = 1;
          for(var j = 0;j < count; j++){
            if(list[j]['name'] == item['name']){
              $('.error-image small').text('Có hình ảnh bị trùng và sẽ không được upload.');
              flag = 0;
            }
          }
          if(flag){
            list.push(item);
            images += '<div class="img-content">';
            images += '<img class="img-preview" src="'+ URL.createObjectURL(event.target.files[i]) +'" alt="">';
            images += '<span data-name="'+ item['name'] +'" class="rm-img js-remove-img"><i class="fa fa-times-circle"></i></span>';
            images += '</div>';
            $('.wrapper-img').append(images);
          }
        }else{
          list.push(item);
          images += '<div class="img-content">';
          images += '<img class="img-preview" src="'+ URL.createObjectURL(event.target.files[i]) +'" alt="">';
          images += '<span data-name="'+ item['name'] +'" class="rm-img js-remove-img"><i class="fa fa-times-circle"></i></span>';
          images += '</div>';
          $('.wrapper-img').append(images);
        }
      }
      $('#btn-file').closest('form').get(0).reset();
    }
  });

  //Remove img
  $('.wrapper-img').on('click', '.js-remove-img',function(){
    var name = $(this).attr('data-name');
    for(var j = 0;j < list.length; j++){
      if(list[j]['name'] == name){
        list.splice(j, 1);
        $(this).parent().remove();
      }
    }
  });
});

