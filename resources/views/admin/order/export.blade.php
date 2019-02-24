<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
  <style>
    html, body {
      font-family: 'Dejavu Sans', sans-serif;
    }
    h1,h2,p {
      padding: 0;
      margin: 0;
    }
    .text-center {
      text-align: center;
    }
    .mt-10 {
      margin-top: 10px;
    }
    .mt-30 {
      margin-top: 30px;
    }
    .mt-50 {
      margin-top: 50px;
    }
    .w-100 {
      width: 100%;
    }
    .d-block {
      display: block;
    }
    .wrapper {
      width: 450px;
      margin: 0 auto;
    }
    table {
      border-collapse: collapse;
    }
    th, td {
      border-bottom: 1px solid gray;
      padding: 3px 5px;
    }
    th {
      text-align: left;
    }
    .order-info p {
      padding: 3px 0;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="header mt-50">
      <h1 class="text-center">{{ __('admin.footer.shop-name') }}</h1>
      <p class="text-center">{{ __('order.table.shipping_address') }}: {{ __('admin.index.address') }}</p>
      <h2 class="text-center mt-10">{{ __('order.table.bill') }}</h2>
    </div>
    <div class="main mt-10">
      <div class="order-info">
        <p class="text-center">{{ __('order.table.order_id') }}: {{ $order->id }}</p>
        <p class="text-center">{{ __('order.table.created_at') }}: {{ formatDateVN($order->id) }}</p>
        <p>{{ __('order.table.customer_name') }}: {{ $order->user_id ? $order->user->profile->name : $order->customer_name }}</p>
        <p>SĐT: 0792760420</p>
        <p>Địa chỉ: 12 Nguyễn Văn Thoại, Đà Nẵng</p>
      </div>
      <table class="w-100 mt-10">
        <thead>
          <tr>
            <th>TT</th>
            <th>Sản phẩm</th>
            <th>SL</th>
            <th>Giá</th>
            <th>Thành tiền</th>
          </tr>
        </thead>
        <tbody>
          @php
            $subTotalAmount = 0;
          @endphp
          @foreach ($order->orderDetails as $key => $orderDetail)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>
                {{ $orderDetail->product->name }}
                <span class="d-block">({{ $orderDetail->size . '-' . $orderDetail->color }})</span>
              </td>
              <td>{{ $orderDetail->quantity }}</td>
              <td>{{ formatCurrencyVN($orderDetail->price) }}</td>
              <td>{{ formatCurrencyVN($orderDetail->quantity * $orderDetail->price) }}</td>
            </tr>
            @php
              $subTotalAmount += $orderDetail->quantity * $orderDetail->price;
            @endphp
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4">Tạm tính:</td>
            <td>{{ formatCurrencyVN($subTotalAmount) }}</td>
          </tr>
          <tr>
            <td colspan="4">Mã khuyến mãi:</td>
            <td>{{ formatCurrencyVN($subTotalAmount - $order->total_amount) }}</td>
          </tr>
          <tr>
            <td colspan="4">Tổng tiền:</td>
            <td>{{ formatCurrencyVN($order->total_amount) }}</td>
          </tr>
        </tfoot>
      </table>
      <div class="text-center mt-30">
        <p>Cảm ơn quý khách</p>
        <p>Hẹn gặp lại!</p>
      </div>
    </div>
  </div>
</body>
</html>