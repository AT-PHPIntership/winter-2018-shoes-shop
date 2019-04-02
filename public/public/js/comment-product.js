$(document).ready(function(){
  //Notification
  function noti(success, mess){
    success ? $('#notification').addClass('success') : $('#notification').addClass('error');
    $('#notification span').text(mess);
    $('#notification').addClass('show');
    setTimeout(function(){ $('#notification').removeClass('show'); }, 3000);
  }
  
  //Show list comment
  function showListComment(page = 1){
    var url = window.location.pathname;
    var productId = url.substring(url.lastIndexOf('/') + 1);
    $.ajax({
      url: getListCommentUrl,
      method:"get",
      dataType:"JSON",
      data: {productId:productId, page:page},
      success: function(data){
        if(data.success){
          if(data.result.data.length){
            var item = '';
            $.each(data.result.data, function(key, val){
              item += '<li class="comment-item">'
              item += '<div class="single-comment">'
              item += '<div class="user-details d-flex align-items-center flex-wrap">';
              item += '<img src="'+ val.user.profile.avatar +'" class="img-fluid order-1 order-sm-1" alt="">';
              item += '<div class="user-name order-3 order-sm-2">';
              item += '<h5>'+ val.user.profile.name +'</h5>';
              item += '<span>'+ val.created_at +'</span>';
              item += '</div>';
                if(+userLogin.id){
                  item += '<div class="group-btn order-2 order-sm-3">';
                  item += '<a href="javascript:void(0)" data-comment-id="'+ val.id +'" class="js-show-reply"><i class="fa fa-reply" aria-label="Tra loi" aria-hidden="true"></i><span>'+ txtReply +'</span></a>';
                  // if(val.user.id === +userLogin.id || +userLogin.role == 1){
                  if(val.user.id === +userLogin.id){
                    item += '<a href="javascript:void(0)" data-comment-id="'+ val.id +'" class="js-remove-cmt"><i class="fa fa-times" aria-hidden="true"></i><span>Xóa</span></a>';
                  }
                  item += '</div>';
                }
              item += '</div>';
              item += '<p class="user-comment">'+ val.content +'</p>';
              item += '</div>';
              item += '<ul class="reply-list-'+ val.id +'">';
                if(val.children){
                  $.each(val.children, function(key, val){
                    item += '<li>';
                    item += '<div class="single-comment reply-comment">';
                    item += '<div class="user-details d-flex align-items-center flex-wrap">';
                    item += '<img src="'+ val.user.profile.avatar +'" class="img-fluid order-1 order-sm-1" alt="">';
                    item += '<div class="user-name order-3 order-sm-2">';
                    item += '<h5>'+ val.user.profile.name +'</h5>';
                    item += '<span>'+ val.created_at +'</span>';
                    item += '</div>';
                    // if(+userLogin.id && (val.user.id === +userLogin.id || +userLogin.role == 1)){
                    if(+userLogin.id && val.user.id === +userLogin.id){
                      item += '<div class="group-btn order-2 order-sm-3">';
                      item += '<a href="javascript:void(0)" data-comment-id="'+ val.id +'" class="js-remove-cmt"><i class="fa fa-times" aria-hidden="true"></i><span>Xóa</span></a>';
                      item += '</div>';
                    }
                    item += '</div>';
                    item += '<p class="user-comment">'+ val.content +'</p>';
                    item += '</div>';
                    item += '</li>';
                  });
                }
              item += '</ul>';
              item += '</li>';
            });
            $('.comment-list').append(item);
            var totalPage = data.result.paginator.last_page;
            if(page < totalPage){
              loadMore = '<a class="active" href="'+ getListCommentUrl +'?page='+ (page + 1) +'">'+ txtLoadMore +'</a>';
              $('#js-load-more-comment').html(loadMore);
            }else{
              $('#js-load-more-comment').html('');
            }
          }else{
            $('.comment-list').html('<b>'+ txtNoComment +'</b>');
          }
        }else{
          noti(false, data.message);
        }
      }
    });
  }
  showListComment();

  // Click LoadMore
  $(document).on('click','#js-load-more-comment a', function(e){
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    showListComment(page);
  });

  //Add comment
  $('#js-add-comment').click(function(){
    var commentContent = $('#js-comment-content').val();
    var productId = $(this).attr('data-product-id');
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
        data: {commentContent:commentContent, productId:productId},
        success: function(data){
          if(data.success){
            if(data.data.user_name){
              var data = data.data;
              var item = '';
              item += '<li class="comment-item">';
              item += '<div class="single-comment">';
              item += '<div class="user-details d-flex align-items-center flex-wrap">';
              item += '<img src="'+ data.user_avatar +'" class="img-fluid order-1 order-sm-1" alt="">';
              item += '<div class="user-name order-3 order-sm-2">';
              item += '<h5>'+ data.user_name +'</h5>';
              item += '<span>'+ data.comment_created_at +'</span>';
              item += '</div>';
              item += '<div class="group-btn order-2 order-sm-3">';
              item += '<a href="javascript:void(0)" data-comment-id="'+ data.comment_id +'" class="js-show-reply"><i class="fa fa-reply" aria-label="Tra loi" aria-hidden="true"></i><span>'+ txtReply +'</span></a>';
              item += '<a href="javascript:void(0)" data-comment-id="'+ data.comment_id +'" class="js-remove-cmt"><i class="fa fa-times" aria-hidden="true"></i><span>Xóa</span></a>';
              item += '</div>';
              item += '</div>';
              item += '<p class="user-comment">'+ data.comment_content +'</p>';
              item += '</div>';
              item += '<ul class="reply-list-'+ data.comment_id +'">';
              item += '</ul>';
              item += '</li>';
              if($(".comment-list li").length == 0){
                $(".comment-list").html(item);
              }else{
                $(".comment-list li:eq(0)").before(item);
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
        data: {commentId:commentId, commentContent:commentContent, productId:productId},
        success: function(data){
          if(data.success){
            if(data.data.user_name){
              var data = data.data;
              var item = '';
              item += '<li class="comment-item">';
              item += '<div class="single-comment reply-comment">';
              item += '<div class="user-details d-flex align-items-center flex-wrap">';
              item += '<img src="'+ data.user_avatar +'" class="img-fluid order-1 order-sm-1" alt="">';
              item += '<div class="user-name order-3 order-sm-2">';
              item += '<h5>'+ data.user_name +'</h5>';
              item += '<span>'+ data.comment_created_at +'</span>';
              item += '</div>';
              item += '<div class="group-btn order-2 order-sm-3">';
              item += '<a href="javascript:void(0)" data-comment-id="'+ data.comment_id +'" class="js-remove-cmt"><i class="fa fa-times" aria-hidden="true"></i><span>Xóa</span></a>';
              item += '</div>';
              item += '</div>';
              item += '<p class="user-comment">'+ data.comment_content +'</p>';
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

  // Remove Comment
  $('.comment-list').on('click','.js-remove-cmt',function(){
    var eleRemove = $(this);
    var commentId = eleRemove.attr('data-comment-id');
    if(confirm(txtQuesDelCmt)){
      $.ajax({
        url: removeCommentUrl,
        method:"get",
        dataType:"JSON",
        data: {commentId:commentId},
        success: function(data){
          if(data.success){
            eleRemove.parent().parent().parent().parent().remove();
            noti(true, txtDeleteCmtSuccess);
          }else{
            noti(false, data.message);
          }
        }
      });
    }
  });
});
