//Display choosen images
function previewImage() 
{
  var totalFile = $("#upload-file").files.length;
  var images = "";
  for(var i = 0; i < totalFile; i++)
  {
    images += "<img class='detail-img' src='" + URL.createObjectURL(event.target.files[i]) + "'>";
  }
  $('#image-preview').html(images);
}
//Display children category list when click parent category
$(document).ready(function(){
  $("#parent-category").on("click", function(){
    var id = $(this).val();
    $.ajax({
      url: getDetailUrl,
      method:"get",
      dataType:"JSON",
      data: {id:id},
      success: function(data){
        var category = "";
        $.each(data, function(key, val){
          category += '<option value="'+ val.id + '">' + val.name + '</option>';
        });
        $("#category-children").html(category);
        var hid = $('#category-children').attr('data-hidden');
        if (data.length  > 0) {
          if (hid == 'hidden') {
            $('#category-children').removeClass('hidden');
            $('#category-children').attr('data-hidden', '');
          }
        } else {
          if (hid == '') {
            $('#category-children').addClass('hidden');
            $('#category-children').attr('data-hidden', 'hidden');
          }
        }
      }
    });
  });
});
//Display product detail when click add button
$(document).ready(function(){
  $("#add-detail").on("click", function(){
    $('#show-detail li:first-child').clone().appendTo('#show-detail');
    var listBtnRemove = $('.js-btn-remove');
    for (var i = 1; i < listBtnRemove.length; i++) {
      $(listBtnRemove[i]).on("click", function(){
        $(this.parentElement.parentElement).remove();
      });
    }
  });
});
