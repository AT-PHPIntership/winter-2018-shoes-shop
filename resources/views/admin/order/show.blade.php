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
                  <p><b>@lang('order.table.user'):</b> {{ $order->user !== null ? $order->user->profile->name : $order->customer_name }}</p>
                  <p><b>@lang('order.table.code'):</b> {{ $order->code !== null ? $order->code->name : '' }}</p>
                  <p><b>@lang('order.table.total_amount'):</b> {{ $order->total_amount }}</p>
                  <p><b>@lang('order.table.shipping_address'):</b> {{ $order->shipping_address }}</p>
                  <p><b>@lang('order.table.phone_number'):</b> {{ $order->phone_number }}</p>
                  <p><b>@lang('order.table.created_at'):</b> {{ formatDateVN($order->created_at) }}</p>
                  <div class="row">
                    <form action="{{ route('admin.orders.update', ['id' => $order->id]) }}" method="post">
                      @csrf
                      @method('PUT')
                      <div class="col-xs-4">
                        <div class="form-group">
                          <label for="order-slt-status">@lang('order.table.status') *</label>
                          <select name="status" class="form-control" id="order-slt-status">
                            <option value="{{ \App\Models\Order::ORDER_STATUS['CONFIRMED'] }}" {{ $order->status === \App\Models\Order::ORDER_STATUS['CONFIRMED'] ? "selected": "" }}>@lang('order.status.confirmed')</option>
                            <option value="{{ \App\Models\Order::ORDER_STATUS['PROCESSING'] }}" {{ $order->status === \App\Models\Order::ORDER_STATUS['PROCESSING'] ? "selected": "" }}>@lang('order.status.processing')</option>
                            <option value="{{ \App\Models\Order::ORDER_STATUS['QUALITY_CHECK'] }}" {{ $order->status === \App\Models\Order::ORDER_STATUS['QUALITY_CHECK'] ? "selected": "" }}>@lang('order.status.quality_check')</option>
                            <option value="{{ \App\Models\Order::ORDER_STATUS['DISPATCHED_ITEM'] }}" {{ $order->status === \App\Models\Order::ORDER_STATUS['DISPATCHED_ITEM'] ? "selected": "" }}>@lang('order.status.dispatched_item')</option>
                            <option value="{{ \App\Models\Order::ORDER_STATUS['DELIVERED'] }}" {{ $order->status === \App\Models\Order::ORDER_STATUS['DELIVERED'] ? "selected": "" }}>@lang('order.status.delivered')</option>
                            <option value="{{ \App\Models\Order::ORDER_STATUS['CANCELED'] }}" {{ $order->status === \App\Models\Order::ORDER_STATUS['CANCELED'] ? "selected": "" }}>@lang('order.status.canceled')</option>
                            <option value="{{ \App\Models\Order::ORDER_STATUS['PENDING'] }}" {{ $order->status === \App\Models\Order::ORDER_STATUS['PENDING'] ? "selected": "" }}>@lang('order.status.pending')</option>
                          </select>
                          @if ($errors->has('status'))
                            <span class="help-block">{{ $errors->first('status') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-xs-5">
                        <div class="form-group">
                          <label for="order-input-delivered-at">@lang('order.table.delivered_at')</label>
                          <input type="date" name="delivered_at" class="form-control" id="order-input-delivered-at" value="{{ $order->delivered_at }}">
                          @if ($errors->has('delivered_at'))
                            <span class="help-block">{{ $errors->first('delivered_at') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-xs-3">
                        <label>@lang('order.table.action')</label>
                        <button type="submit" class="btn btn-primary btn-sm">@lang('common.edit')</button>
                      </div>
                    </form>
                    <div class="col-xs-12">
                      @include('admin.module.message')
                    </div>
                  </div>
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
                      <th>@lang('order.table.amount')</th>
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
                        <td>{{ $orderDetail->price * $orderDetail->quantity }}</td>
                      </tr>
                      @php
                        $total_price += $orderDetail->price * $orderDetail->quantity;
                      @endphp
                    @endforeach
                    <tr>
                      <td colspan="6">@lang('order.table.total_price')</td>
                      <td colspan="1">{{ $total_price }}</td>
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
