@extends('user.module.master')
@section('content')
	<div class="content-wrapper mt-60">
		@include('user.module.sidebar')
		<div class="content full-with">
			<section class="content-header">
				<h3 class="box-title text-uppercase text-center">{{ __('index.detail.review.my') }}</h3>
			</section>
			<section class="review">
				<h4 class="mb-10">{{ __('index.detail.review.list') }}</h4>
				<div class="review-list">
					@if(!count($reviews))
						<div class="box">
							<h5 class="box-title p-l-20">@lang('order.none_order')</h5>
						</div>
					@else
            @foreach ($reviews as $review)
              <div class="review-item clearfix">
                <div class="item-left">
                  <img class="review-pr-img" src="{{ $review->product->images->first() ? $review->product->images->first()->path : config('define.path.default_image') }}" alt="">
                </div>
                <div class="item-right">
                  <h5>{{ $review->product->name }}</h5>
                  <p>{{ $review->created_at }}</p>
                  <p>
                    <span>{{ $review->title }}</span>
                    <span class="rv-rate">
                      <i class="fa fa-star {{ $review->star >= 1 ? 'active' : '' }}"></i>
                      <i class="fa fa-star {{ $review->star >= 2 ? 'active' : '' }}"></i>
                      <i class="fa fa-star {{ $review->star >= 3 ? 'active' : '' }}"></i>
                      <i class="fa fa-star {{ $review->star >= 4 ? 'active' : '' }}"></i>
                      <i class="fa fa-star {{ $review->star >= 5 ? 'active' : '' }}"></i>
                    </span>
                    <span class="{{ $review->status == \App\Models\Review::ACTIVE_STATUS ? 'text-success' : 'text-warning' }}">{{ $review->status == \App\Models\Review::ACTIVE_STATUS ? __('index.detail.review.approved') : __('index.detail.review.pending') }}</span>
                  </p>
                  <p>{{ $review->content }}</p>
                  <p>
                    @if ($review->images)
                      @foreach ($review->images as $image)
                        <img class="img-small" src="{{ $image->path }}" alt="" width="50px" width="50px">
                      @endforeach
                    @endif
                  </p>
                </div>
              </div>
            @endforeach
					@endif
				</div>
				<div>{{ $reviews->links() }}</div>
			</section>
		</div>
	</div>
@endsection
