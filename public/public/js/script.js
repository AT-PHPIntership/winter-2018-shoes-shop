$('.js-addcart').each(function(){
    var nameProduct = $(this).parent().parent().parent().find('.top .head').html();
    $(this).on('click', function(){
        swal(nameProduct, "is added to cart !", "success");
        // alert(nameProduct);
    });
});