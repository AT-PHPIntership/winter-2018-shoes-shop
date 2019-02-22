@extends('user.module.master')
@section('content')
  <div class="content-wrapper p-t-50">
    @include('user.module.sidebar')
    <div class="content full-with">
      <section class="content-header">
        <h2 class="box-title text-uppercase">@lang('user.manage_order')</h2>
      </section>
      <section class="orders">
        <h3 class="mb-10">@lang('order.show.title')</h3>
        <div class="text-dark">
          <div class="box">
            <div class="box-header with-border">
              <h5>@lang('order.order') <strong class="order-num">#{{ $order->id}}:</strong>{{ $order->created_at}}</h5>
              <div class="pull-right">@lang('order.table.amount'): {{ formatCurrencyVN($order->total_amount) }} </div>
            </div>
            <div class="box-body with-border">
              <div class="timeline">
                <div class="events">
                  <ol>
                    <ul>
                      <li><a class="{{ ($order->status == 0 || $order->status == 1) ? 'selected' : ''}}">@lang('order.status.ordered')</a></li>
                      <li><a class="{{ ($order->status == 2 || $order->status == 3) ? 'selected' : ''}}">@lang('order.status.processed')</a></li>
                      <li><a class="{{ $order->status == 4 ? 'selected' : ''}}">@lang('order.status.dispatched')</a></li>
                      <li><a class="{{ $order->status == 5 ? 'selected' : ''}}">@lang('order.status.delivered')</a></li>
                    </ul>
                  </ol>
                </div>
              </div>
              <div class="events-content">
                <ol>
                  <li class="selected">
                    @switch($order->status)
                      @case(0)
                      @case(1)
                        <p class="timeline-order">@lang('order.timeline.ordered')<span>{{ $order->updated_at}}</span></p>
                        @break
                      @case(2)
                      @case(3)
                        <p class="timeline-order">@lang('order.timeline.processed')<span>{{ $order->updated_at}}</span></p>
                        @break
                      @case(4)
                        <p class="timeline-order">@lang('order.timeline.dispatched')<span>{{ $order->updated_at}}</span></p>
                        @break
                      @case(5)
                        <p class="timeline-order">@lang('order.timeline.delivered')<span>{{ $order->delivered_at}}</span></p>
                        @break
                      @default
                        <p class="timeline-order">@lang('order.timeline.canceled')<span>{{ $order->updated_at}}</span></p>
                      @break
                    @endswitch
                  </li>
                </ol>
              </div>
            </div>
            <div class="box-body with-border">
              <div class="item-detail">
                <ul class="product-menu">
                  @php
                  $subtotal = 0;
                  @endphp
                  @foreach ($order->orderDetails as $detail)
                  @php
                  $subtotal += $detail->price * $detail->quantity;
                  @endphp
                  <li class="row prodcut-item">
                    <div class="col-sm-3">
                      <img class="product-img" src="{{ $detail->product->images->first() ? $detail->product->images->first()->path : config('define.path.default_image') }}" alt="hình ảnh">
                    </div>
                    <span class="col-sm-5 item-padding">{{ $detail->product->description ? $detail->product->description : "" }}</span>
                    <span class="col-sm-2 item-padding">@lang('order.unit_price'): {{ formatCurrencyVN($detail->price) }}</span>
                    <span class="col-sm-2 item-padding">@lang('order.table.quantity'): {{ $detail->quantity }}</span>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="box-body row">
              <div class="col-sm-7">
                <div class="box-footer">
                  <h5 class="box-title">@lang('order.delivery_address'):</h5>
                  <div class="own-info">
                    <p>{{ $order->customer_name}}</p>
                    <p>{{ $order->shipping_address}}</p>
                    <p>{{ $order->phone_number}}</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-1"></div>
              <div class="col-sm-4">
                <div class="box-footer">
                  <h5 class="box-title">@lang('order.payment.pay')</h5>
                  <div class="own-info">
                    <p>@lang('order.payment.subtotal')<span class="pull-right">{{ formatCurrencyVN($subtotal) }}</span></p>
                    <p>@lang('order.payment.discount')<span class="pull-right">{{ formatCurrencyVN($subtotal - $order->total_amount) }}</span></p>
                    <p>@lang('order.payment.total')<span class="pull-right">{{ formatCurrencyVN($order->total_amount) }}</span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection
