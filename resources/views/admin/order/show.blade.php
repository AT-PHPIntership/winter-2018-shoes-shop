@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          @lang('order.title')
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('order.show.title')</h3>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="box-body">
                  <p><b>@lang('order.table.user'):</b> {{ $order->user->profile->name }}</p>
                  <p><b>@lang('order.table.code'):</b> {{ $order->code !== null ? $order->code->name : '' }}</p>
                  <p><b>@lang('order.table.price'):</b> {{ $order->price }}</p>
                  <p><b>@lang('order.table.ship_to'):</b> {{ $order->ship_to }}</p>
                  <p><b>@lang('order.table.phone_to'):</b> {{ $order->phone_to }}</p>
                  <p><b>@lang('order.table.ordered_at'):</b> {{ formatDateVN($order->ordered_at) }}</p>
                  <p><b>@lang('order.table.shipped_at'):</b> {{ formatDateVN($order->shipped_at) }}</p>
                  <p><b>@lang('order.table.status'):</b> 
                    @switch($order->status)
                      @case(\App\Models\Order::APPROVED_STATUS)
                        <span class="label label-primary">@lang('order.status.approved')</span>
                        @break
                      @case(\App\Models\Order::DELIVERED_STATUS)
                        <span class="label label-success">@lang('order.status.delivered')</span>
                        @break
                      @case(\App\Models\Order::DENIED_STATUS)
                        <span class="label label-danger">@lang('order.status.denied')</span>
                        @break
                      @default
                        <span class="label label-warning">@lang('order.status.pending')</span>
                        @break
                    @endswitch
                  </p>
                  <a class="btn btn-warning btn-xs" href="{{ route('admin.orders.index') }}">@lang('common.back')</a>
                </div>
              </div>
              <div class="col-md-12">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('order.show.product')</h3>
                </div>
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th class="w-10">@lang('order.table.id')</th>
                      <th>@lang('order.table.product')</th>
                      <th>@lang('order.table.category')</th>
                      <th>@lang('order.table.original_price')</th>
                      <th>@lang('order.table.price')</th>
                      <th>@lang('order.table.quantity')</th>
                    </tr>
                    @php
                      $total_price = 0;
                    @endphp
                    @foreach ($order->orderDetails as $orderDetail)
                      <tr>
                        <td>{{ $orderDetail->id }}</td>
                        <td>{{ $orderDetail->product->name }}</td>
                        <td>{{ $orderDetail->product->category->name }}</td>
                        <td>{{ $orderDetail->product->original_price }}</td>
                        <td>{{ $orderDetail->price }}</td>
                        <td>{{ $orderDetail->quantity }}</td>
                      </tr>
                      @php
                        $total_price += $orderDetail->price * $orderDetail->quantity;
                      @endphp
                    @endforeach
                    <tr>
                      <td colspan="4">@lang('order.table.total_price')</td>
                      <td colspan="2">{{ $total_price }}</td>
                    </tr>
                  </table>  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
