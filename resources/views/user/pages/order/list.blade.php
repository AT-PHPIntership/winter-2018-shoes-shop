@extends('user.module.master')
@section('content')
  <div class="content-wrapper p-t-50">
    @include('user.module.sidebar')
    <div class="content full-with">
      <section class="content-header">
        <h1 class="box-title text-uppercase">@lang('user.manage_order')</h1>
      </section>
      <section class="orders">
				<div class="box-header with-border">
					<h3 class="box-title">@lang('user.order_list')</h3>
				</div>
				<div class="box-body text-dark">
					<div class="row item">
						<div class="col-sm-3 item-info">
							<p class="text-body">Đơn hàng <strong>#212</strong></p>
							<p>Ngày đặt: 09/2/2018</p>
							<p>Giá: 10000000Đ</p>
						</div>
						<div class="col-sm-9 item-detail">
							<ul class="product-menu">
								<li class="row prodcut-item">
									<img class="col-sm-4 product-img" alt="hình ảnh">
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
					<hr>
					<div class="row item">
						<div class="col-sm-4 item-info">
							<p>Đơn hàng <strong>#542</strong></p>
							<p>Ngày đặt: 09/2/2018</p>
							<p>Giá: 10000000Đ</p>
						</div>
						<div class="col-sm-8 item-detail">
							<ul class="product-menu">
								<li class="prodcut-item">
										<img alt="hình ảnh">
										<span>Thông tin sản phẩm</span>
										<span>Số lượng: 1</span>
									</li>
							</ul>
						</div>
					</div>
				</div>
      </section>
    </div>
  </div>
@endsection
