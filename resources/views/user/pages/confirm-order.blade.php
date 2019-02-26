<h1>{{ __('index.header.title') }}</h1>
<p>{{ __('checkout.message.thanks') }}</p>
<p>{{ __('order.table.order_id') }}: {{ $order->id }}</p>
<p>{{ __('order.table.status') }}: 
  @switch($order->status)
    @case(\App\Models\Order::ORDER_STATUS['CONFIRMED'])
      @lang('order.status.confirmed')
      @break
    @case(\App\Models\Order::ORDER_STATUS['PROCESSING'])
      @lang('order.status.processing')
      @break
    @case(\App\Models\Order::ORDER_STATUS['QUALITY_CHECK'])
      @lang('order.status.quality_check')
      @break
    @case(\App\Models\Order::ORDER_STATUS['DISPATCHED_ITEM'])
      @lang('order.status.dispatched_item')
      @break
    @case(\App\Models\Order::ORDER_STATUS['DELIVERED'])
      @lang('order.status.delivered')
      @break
    @case(\App\Models\Order::ORDER_STATUS['CANCELED'])
      @lang('order.status.canceled')
      @break
    @default
      @lang('order.status.pending')
      @break
  @endswitch
</p>
<p>{{ __('order.table.created_at') }}: {{ formatDateVN($order->created_at) }}</p>
<table border="1px">
  <thead>
    <tr>
      <th>{{ __('cart.table.product') }}</th>
      <th>{{ __('cart.table.price') }}</th>
      <th>{{ __('cart.table.quantity') }}</th>
      <th>{{ __('cart.table.total') }}</th>
    </tr>
  </thead>
  <tbody>
    @php
      $subTotalAmount = 0;
    @endphp
    @foreach ($order->orderDetails as $orderDetail)
      <tr>
        <td>{{ $orderDetail->product->name }} <p>({{ $orderDetail->product->color.'-'.$orderDetail->product->size }})</p></td>
        <td>{{ formatCurrencyVN($orderDetail->price) }}</td>
        <td>{{ $orderDetail->quantity }}</td>
        <td>{{ formatCurrencyVN($orderDetail->price * $orderDetail->quantity) }}</td>
      </tr>
      @php
        $subTotalAmount += $orderDetail->price * $orderDetail->quantity;
      @endphp
    @endforeach
  </tbody>
  <tfoot>
      <tr>
        <td colspan="3">{{ __('cart.table.sub_amount') }}</td>
        <td>{{ formatCurrencyVN($subTotalAmount) }}</td>
      </tr>
      <tr>
        <td colspan="3">{{ __('cart.code.title') }} (<small>{{ $order->code ? $order->code->name : '' }}</small>)</td>
        <td>- {{ formatCurrencyVN($subTotalAmount - $order->total_amount) }}</td>
      </tr>
      <tr>
        <td colspan="3">{{ __('cart.table.amount') }}</td>
        <td>{{ formatCurrencyVN($order->total_amount) }}</td>
      </tr>
    </tfoot>
</table>