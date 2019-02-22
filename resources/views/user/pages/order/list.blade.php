@extends('user.module.master')
@section('content')
<div class="content-wrapper p-t-50">
    @include('user.module.sidebar')
    <div class="content full-with">
      <section class="content-header">
        <h2 class="box-title text-uppercase">@lang('user.manage_order')</h2>
      </section>
      <section class="orders">
				<h3 class="mb-10">@lang('user.order_list')</h3>
				<div class="text-dark">
					@if(!count($orders))
						<div class="box">
							<h5 class="box-title p-l-20">@lang('order.none_order')</h5>
						</div>
					@else
						@foreach ($orders as $order)
						<div class="box">
							<div class="box-header with-border">
								<h5>@lang('order.order') <strong class="order-num">#{{ $order->id}}:</strong>{{ $order->created_at}}</h5>
							<div class="pull-right"><a class="{{ $order->status == \App\Models\Order::ORDER_STATUS['CANCELED'] ? 'txt-red' : '' }}" href="{{ route('user.order.show', $order->id)}}">{{ $order->status == \App\Models\Order::ORDER_STATUS['CANCELED'] ? __('order.status.cancel') : __('order.status.follow') }}</a></div>
							</div>
							<div class="box-body">
								<div class="item-detail">
									<ul class="product-menu">
										@foreach ($order->orderDetails as $detail)
										<li class="row prodcut-item">
											<div class="col-sm-3">
												<img class="product-img" src="{{ $detail->product->images->first() ? $detail->product->images->first()->path : config('define.path.default_image') }}" alt="hình ảnh">
											</div>
											<span class="col-sm-6 item-padding">{{ $detail->product->description ? $detail->product->description : ""}}</span>
											<span class="col-sm-3 item-padding">@lang('order.table.quantity'): {{$detail->quantity}}</span>
										</li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
						@endforeach
					@endif
				</div>
				<div>{{ $orders->links() }}</div>
      </section>
    </div>
  </div>
@endsection
