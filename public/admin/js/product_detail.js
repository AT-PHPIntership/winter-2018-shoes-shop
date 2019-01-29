//Display choosen images
function previewImage() 
{
  var total_file=document.getElementById("upload-file").files.length;
  var images = "";
  for(var i=0;i<total_file;i++)
  {
    images += "<img class='detail-img' src='"+URL.createObjectURL(event.target.files[i])+"'>";
  }
  $('#image-preview').html(images);
}
//Display children category list when click parent category
$(document).ready(function(){
  $("#parent-category").on("click", function(){
    var id = $(this).val();
    $.ajax({
      url: '../category/children',
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
    $.ajax({
      url: "detail",
      method:"get",
      dataType:"JSON",
      success: function(data){
        var color = '<select name="color_id[]" id="color" class="form-control" placeholder="Chọn màu">';
        $.each(data.color, function(key, val){
          color += '<option value="'+ val.id + '">' + val.name + '</option>';
        });
        color += '</select>';
        var size = '<select name="size_id[]" class="form-control" placeholder="Chọn size">';
        $.each(data.size, function(key, val){
          size += '<option value="'+ val.id + '">' + val.size + '</option>';
        });
        size += '</select>';
        
        var output = '<li class="js-row row margin-y-10">';
        output += '<div class="col-xs-4">';
        output += color;
        output += '</div>';
        output += '<div class="col-xs-3">';
        output += size;
        output += '</div>';
        output += '<div class="col-xs-4">';
        output += '<input name="quantity_type[]" type="number" class="form-control" placeholder="Số lượng">';
        output += '</div>';
        output += '<div class="col-xs-1">';
        output += '<button type="button" class="js-btn-remove btn"> x </button>';
        output += '</div>';
        output += '</li>';
        $("#show-detail").append(output);
        var listBtnRemove = document.getElementsByClassName('js-btn-remove');
        for (var i = 0; i < listBtnRemove.length; i++) {
          listBtnRemove[i].addEventListener("click", function(){
            $(this.parentElement.parentElement).remove();
          });
        }
      }
    });
  });
});
