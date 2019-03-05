//Display choosen images
function previewImage() 
{
  var totalFile = $('#upload-file').get(0).files.length;
  var images = "";
  for(var i = 0; i < totalFile; i++)
  {
    images += "<img class='detail-img' src='" + URL.createObjectURL(event.target.files[i]) + "'>";
  }
  $('#image-preview').html(images);
}
$(document).ready(function(){
  //Display children category list when click parent category
  $("#parent-category").on("click", function(){
    var id = $(this).val();
    var categoryChildren = $('#category-children');
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
        categoryChildren.html(category);
        var hid = categoryChildren.attr('data-hidden');
        if (data.length  > 0) {
          if (hid == 'hidden') {
            categoryChildren.removeClass('hidden');
            categoryChildren.attr('data-hidden', '');
          }
        } else {
          if (hid == '') {
            categoryChildren.addClass('hidden');
            categoryChildren.attr('data-hidden', 'hidden');
          }
        }
      }
    });
  });
  //Display product detail when click add button
  $("#add-detail").on("click", function(){
    $('#show-detail li:first-child').clone().appendTo('#show-detail');
    removeProduct();
  });

  //Remove product
  function removeProduct(){
    var listBtnRemove = $('.js-btn-remove');
    for (var i = 0; i < listBtnRemove.length; i++) {
      $(listBtnRemove[i]).on("click", function(){
        $(this.parentElement.parentElement).remove();
      });
    }
  }
  removeProduct();
});
