$(document).ready(function(){
  //Notification
  function noti(success, mess){
    success ? $('#notification').addClass('success') : $('#notification').addClass('error');
    $('#notification span').text(mess);
    $('#notification').addClass('show');
    setTimeout(function(){ $('#notification').removeClass('show'); }, 3000);
  }
  
  //Add comment
  $('#js-add-comment').click(function(){
    var commentContent = $('#js-comment-content').val();
    var productId = $(this).attr('data-product-id');
    var userId = $(this).attr('data-user-id');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    if(commentContent == ''){
      $('.comment-error').text(required);
    }else{
      $.ajax({
        url: addCommentUrl,
        method:"post",
        dataType:"JSON",
        data: {commentContent:commentContent, productId:productId, userId:userId},
        success: function(data){
          if(data.success){
            if(data.data.user_name){
              var item = '';
              item += '<li class="comment-item">';
              item += '<div class="single-comment">';
              item += '<div class="user-details d-flex align-items-center flex-wrap">';
              item += '<img src="'+ data.data.user_avatar +'" class="img-fluid order-1 order-sm-1" alt="">';
              item += '<div class="user-name order-3 order-sm-2">';
              item += '<h5>'+ data.data.user_name +'</h5>';
              item += '<span>'+ data.data.comment_created_at +'</span>';
              item += '</div>';
              item += '<a href="javascript:void(0)" data-comment-id="'+ data.data.comment_id +'" class="view-btn color-2 reply order-2 order-sm-3 js-show-reply"><i class="fa fa-reply" aria-hidden="true"></i><span>Reply</span></a>';
              item += '</div>';
              item += '<p class="user-comment">'+ data.data.comment_content +'</p>';
              item += '</div>';
              item += '<ul class="reply-list-'+ data.data.comment_id +'">';
              item += '</ul>';
              item += '</li>';
              if($(".comment-list li").length == 0){
                $(".comment-list").html(item);
              }else{
                $(".comment-list").append(item);
              }
              noti(true, txtAdminCmtSuccess);
            }else{
              noti(true, txtCmtSuccess);
            }
            $("#js-comment-content").val('');
          }else{
            noti(false, data.message);
          }
        }
      });
    }
  });

  // Display form reply
  $('.comment-list').on('click','.js-show-reply',function(){
    commentId = $(this).attr('data-comment-id');
    $(this).hide();
    var item = '';
    item += '<div class="main-form">';
    item += '<textarea class="common-textarea js-reply-content" placeholder="'+txtContent+'" onfocus="this.placeholder=""" onblur="this.placeholder = "'+txtContent+'""></textarea>';
    item += '<span class="mess-error reply-error"></span>';
    item += '<a href="javascript:void(0)" data-comment-id='+ commentId +' class="view-btn color-2 btn-comment js-add-reply"><span>'+txtSubmit+'</span></a>';
    item += '</div>';
    $('.reply-list-'+ commentId +':eq(0)').after(item);
  });

  // Reply Comment
  $('.comment-list').on('click','.js-add-reply',function(){
    var reply = $(this);
    var commentId = reply.attr('data-comment-id');
    var commentContent = reply.parent().find('.js-reply-content').val();
    var productId = $('#js-add-comment').attr('data-product-id');
    var userId = $('#js-add-comment').attr('data-user-id');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    if(commentContent == ''){
      reply.parent().find('.reply-error').text(required);
    }else{
      $.ajax({
        url: addCommentUrl,
        method:"post",
        dataType:"JSON",
        data: {commentId:commentId, commentContent:commentContent, productId:productId, userId:userId},
        success: function(data){
          if(data.success){
            if(data.data.user_name){
              var item = '';
              item += '<li class="comment-item">';
              item += '<div class="single-comment reply-comment">';
              item += '<div class="user-details d-flex align-items-center flex-wrap">';
              item += '<img src="'+ data.data.user_avatar +'" class="img-fluid order-1 order-sm-1" alt="">';
              item += '<div class="user-name order-3 order-sm-2">';
              item += '<h5>'+ data.data.user_name +'</h5>';
              item += '<span>'+ data.data.comment_created_at +'</span>';
              item += '</div>';
              item += '</div>';
              item += '<p class="user-comment">'+ data.data.comment_content +'</p>';
              item += '</div>';
              item += '</li>';
              $('.reply-list-'+commentId).append(item);
              noti(true, txtAdminCmtSuccess);
            }else{
              noti(true, txtCmtSuccess);
            }
            reply.parent().find('.js-reply-content').val('');
          }else{
            noti(false, data.message);
          }
        }
      });
    }
  });
});