$('.js-addcart').each(function(){
    var nameProduct = $(this).parent().parent().parent().find('.top .head').html();
    $(this).on('click', function(){
        swal(nameProduct, "is added to cart !", "success");
        // alert(nameProduct);
    });
});
//Display choosen images
function previewImage(input) 
{
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
