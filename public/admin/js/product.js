$(document).ready(function () {
  $("#form-product").submit(function (e) {
    e.preventDefault();
    $(this).find('.help-block').remove();
    formData = new FormData(this);
    $.ajax({
      type: "post",
      url: actionUrl,
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        if(data.success){
          window.location.href = '/admin/product';
        }
      },
      error: function (xhr) {
        var res = xhr.responseJSON;
        if ($.isEmptyObject(res) == false) {
          $.each(res.errors,function (key,value) {
            var name = $("[name='"+key+"']");
            if(key.indexOf(".") != -1){
              var arr = key.split(".");
              name = $("[name='"+arr[0]+"[]']:eq("+arr[1]+")");
            }
            name.parent().append('<span class="help-block">'+value[0]+'</span>');
          })
        }
      },
    });
  });
});