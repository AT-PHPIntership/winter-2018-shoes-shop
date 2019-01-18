$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
})
var selected = $('#data-selected').data('selected');
$('#js-select').val(selected);