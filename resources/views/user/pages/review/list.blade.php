{{-- @extends('user.module.master')
@section('content')
	<div class="content-wrapper mt-60">
		@include('user.module.sidebar')
		<div class="content full-with">
			<section class="content-header">
				<h3 class="box-title text-uppercase text-center">Nhan xet cua toi</h3>
			</section>
			<section class="review-list">
				<h4 class="mb-10">Danh sach</h4>
				<div class="text-dark">
					@if(!count($reviews))
						<div class="box">
							<h5 class="box-title p-l-20">@lang('order.none_order')</h5>
						</div>
					@else
						<div class="row">
							<div class="col-lg-12">
								<div class="review-item">
									<div class="row">
										<div class="item-left">
											<img src="{{ config('define.path.default_image') }}" alt="">
										</div>
										<div class="item-right">
											<h5>Tai nghe Xiaomi Basic</h5>
											<p>28/03/2019 13:46:51</p>
											<p>
												<span>Hai long</span>
												<span>*****</span>
												<span>Da duyet</span>
											</p>
											<p>Sản phẩm rẻ. Nghe ổn. Tôi luôn lựa chọn mua hàng của Xiaomi. Tiki giao hàng nhanh.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					{{-- @endif --}}
				</div>
				{{-- <div>{{ $orders->links() }}</div> --}}
			</section>
		</div>
	</div>
@endsection --}}
