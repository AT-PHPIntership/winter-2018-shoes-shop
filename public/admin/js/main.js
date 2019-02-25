function formatCurrencyVN(number){
  return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(number);
}
function previewAvatar() 
{
  var image = '';
  image = '<img class="profile-user-img no-mg img-responsive img-circle" src="'+ URL.createObjectURL(event.target.files[0]) +'" alt="">';
  $('#preview-avatar').html(image);
}
$(document).ready(function(){
  $('.select2').select2();
  $('#datepicker-from').datepicker({
    autoclose: true
  });
  $('#datepicker-to').datepicker({
    autoclose: true
  });
  $(".js-status-cmt").click(function(){
    var js_status = $(this);
    var id = js_status.data('id');
    var status = js_status.attr('data-status');
    status = status == 1 ? 0 : 1;
    $.ajax({
      url: changeStatus,
      method:"get",
      dataType:"JSON",
      data: {id:id, status:status},
      success: function(data){
        if (data) {
          js_status.attr('data-status', status);
          if (status == 1) {
            js_status.text(active);
            js_status.removeClass('btn-warning').addClass('btn-primary')
          } else {
            js_status.text(blocked);
            js_status.removeClass('btn-primary').addClass('btn-warning');
          }
        }
      }
    });
  });
});
