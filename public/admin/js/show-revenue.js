$(document).ready(function(){
  $("#js-show-revenue").click(function(){
    var fromDate = $('.js-from-date').val();
    var toDate = $('.js-to-date').val();
    var flag = 1;
    $('.wp-from-date').change(function() {
      $(this).removeClass('bd-red');
    });
    $('.wp-to-date').change(function() {
      $(this).removeClass('bd-red');
    });
    if(fromDate == ''){
      $('.wp-from-date').addClass('bd-red');
      flag = 0;
    }
    if(toDate == ''){
      $('.wp-to-date').addClass('bd-red');
      flag = 0;
    }
    if(flag){
      $.ajax({
        url: showRevenueUrl,
        method:"get",
        data: {fromDate:fromDate, toDate:toDate},
        success: function(data){
          if(data.length){
            var item = '';
            var total = 0;
            $.each(data, function(key, val){
              item += '<tr>';
              item += '<td>'+ val.id +'</td>';
              item += '<td>'+ val.order_id +'</td>';
              item += '<td>'+ val.user_name +'</td>';
              item += '<td>'+ val.code_name +'</td>';
              item += '<td>'+ val.order_created_at +'</td>';
              item += '<td>'+ val.order_delivered_at +'</td>';
              item += '<td>'+ formatCurrencyVN(val.order_total_amount) +'</td>';
              item += '</tr>';
              total += +val.order_total_amount;
            });
            $('#js-body-order').html(item);
            $('#total-all').text(formatCurrencyVN(total));
          }else{
            $('#js-body-order').html('');
            $('#total-all').text('');
          }
        }
      });
    }
  });
});
