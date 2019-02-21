@extends('user.module.master')
@section('content')
@dd($orders[1]->orderDetails)
  <div class="content-wrapper p-t-50">
    @include('user.module.sidebar')
    <div class="content full-with">
      <section class="content-header">
        <h1 class="box-title text-uppercase">@lang('user.manage_order')</h1>
      </section>
      <section class="orders">
					<h3>@lang('user.order_list')</h3>
				<div class="text-dark">
					@foreach ($orders as $item)
					<div class="box">
						<div class="box-header with-border">
							<h5>Đơn hàng <strong class="order-num">#{{ $item->id}}</strong>Ngày đặt: {{ $item->created_at}}</h5>
						</div>
						<div class="box-body">
							<div class="col-sm-9 item-detail">
								<ul class="product-menu">
									<li class="row prodcut-item">
									<img class="col-sm-4 product-img" src="{{$item->orderDetails->product->}}" alt="hình ảnh">
										<span class="col-sm-5 item-padding">Thông tin sản phẩm</span>
										<span class="col-sm-3 item-padding">Số lượng: 2</span>
									</li>
									<li class="row prodcut-item">
											<img class="col-sm-4 product-img" alt="hình ảnh">
											<span class="col-sm-5 item-padding">Thông tin sản phẩm</span>
											<span class="col-sm-3 item-padding">Số lượng: 1</span>
										</li>
								</ul>
							</div>
						</div>
					</div>
					@endforeach
				</div>
      </section>
    </div>
  </div>
@endsection
