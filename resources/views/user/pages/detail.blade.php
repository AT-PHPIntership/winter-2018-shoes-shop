@extends('user.module.master')
@section('content')
  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb" style="margin-top: 55px">
    <div class="container">
      <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
        <div>
          <h2 class="text-white py-3">{{ trans('product.product_detail') }}</h2>
          <nav class="d-flex align-items-center justify-content-start">
            <a href="{{ route('user.index') }}">{{ trans('common.home') }}<i class="fa fa-caret-right" aria-hidden="true"></i></a>
            <span class="text-white">{{ trans('product.product_detail') }}</span>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Area -->
  <!-- Start Product Details -->
  <div class="container">
    <div class="product-quick-view">
      <h3 class="mb-10">{{ trans('product.product_detail') }}</h3>
      <div class="row align-items-center">
        <div class="col-12 col-md-6">
          <div class="single_product_thumb">
            @if ($product['images']->count())
              <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators menu-control">
                  @foreach($product['images'] as $key => $image)
                    <li class="{{ $key == 0 ? 'active' : '' }} control-item" data-target="#product_details_slider" data-slide-to="{{$key}}" style="background-image: url({{$image->path}});"></li>
                  @endforeach
                </ol>
                <div class="carousel-inner">
                  @foreach($product['images'] as $key => $image)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                      <img class="d-block w-100 detail-img" src="{{$image->path}}" alt="Slide">
                    </div>
                  @endforeach
                </div>
              </div>
            @else
              <img class="content-image img-fluid d-block mx-auto size-product" src="{{ config('define.image_default_product') }}" alt="">                
            @endif
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="quick-view-content">
            <div class="top">
              <h3 class="head">{{ $product['product']['name']}}</h3>
              <div class="price d-flex align-items-center">
                <span class="lnr lnr-tag"></span>
                @if($product['product']['price'])
                  <span class="ml-10" id="js-price">{{ formatCurrencyVN($product['product']['price']) }}</span>
                  <del class="ml-10" id="js-original-price">{{ formatCurrencyVN($product['product']['original_price']) }}</del>
                @else
                  <span class="ml-10" id="js-price">{{ formatCurrencyVN($product['product']['original_price']) }}</span>
                @endif
              </div>
              <div class="review">
                <span class="rating-content">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <span style="width: {{ $product['product']['avg_rating']/5*100 }}%">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </span>
                </span>
                <span>({{ $product['product']['total_review'] }} {{ __('index.detail.review.comment') }})</span>
              </div>
              <div class="category">{{ trans('product.category')}}: <span>{{ $product['category']['name'] }}</span></div>
              <div class="available">{{ trans('product.quantity')}}: <span id="js-inventory">{{ $product['product']['inventory'] }}</span></div>
            </div>
            <div class="middle">
              <p class="content">{{ $product['product']['description'] }}</p>
            </div>
            <div class="add-cart">
              <div class="row">
                <div class="form-group col-md-6">
                  <label>{{ trans('product.color')}}: </label>
                  <select id="js-color" class="form-control">
                    <option value="">{{ trans('product.select_color')}}</option>
                    @foreach($product['colors'] as $color)
                      <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>{{ trans('product.size')}}: </label>
                  <select id="js-size" class="form-control">
                  </select>
                </div>
              </div>
              <div class="d-flex align-items-center mt-30">
                <label>{{ trans('product.quantity')}}: </label>
                <div class="form-group col-md-6">
                  <input id="js-quantity" type="number" min="0" class="select-number ml-15 form-control" value="0" />
                </div>
              </div>
              <div class="d-flex mt-20">
              <a href="javascript:void(0)" data-product-id="{{ $product['product']['id'] }}" class="view-btn color-2 js-add-cart"><span>{{ trans('product.add_cart')}}</span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container mb-100">
    <div class="details-tab-navigation d-flex justify-content-center mt-30">
      <ul class="nav nav-tabs" id="my-tab" role="tablist">
        <li>
          <a class="nav-link active" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews">{{ __('index.detail.review.title') }}</a>
        </li>
      </ul>
    </div>
    <div class="tab-content" id="my-tab-content">
      <div class="tab-pane fade show active" id="reviews" role="tabpanel" aria-labelledby="reviews">
        <div class="review-wrapper">
          <div class="review-header mb-30">
            <div class="row">
              <div class="col-lg-4">
                <h4 class="text-center">{{ __('index.detail.review.avg_rating') }}</h4>
                <p class="total-review-point">{{ $product['product']['avg_rating'] }}/5</p>
                <p class="item-rating text-center">
                  <span class="rating-content">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <span style="width: {{ $product['product']['avg_rating']/5*100 }}%">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                  </span>
                </p>
                <p class="total-comment text-center">({{ $product['product']['total_review'] }} {{ __('index.detail.review.comment') }})</p>
              </div>
              <div class="col-lg-4">
                <div class="item rate-5">
                  <span class="rating-num">{{ \App\Models\Review::NUMBER_STAR['FIVE'] }}</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: {{ $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['FIVE']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['FIVE'])->total/$product['product']['total_review']*100 : 0 }}%"></div>
                  </div>
                  <span class="rating-num-total">{{ $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['FIVE']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['FIVE'])->total/$product['product']['total_review']*100 : 0 }}%</span>
                </div>
                <div class="item rate-4">
                  <span class="rating-num">{{ \App\Models\Review::NUMBER_STAR['FOUR'] }}</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: {{ $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['FOUR']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['FOUR'])->total/$product['product']['total_review']*100 : 0 }}%"></div>
                  </div>
                  <span class="rating-num-total">{{ $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['FOUR']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['FOUR'])->total/$product['product']['total_review']*100 : 0 }}%</span>
                </div>
                <div class="item rate-3">
                  <span class="rating-num">{{ \App\Models\Review::NUMBER_STAR['THREE'] }}</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: {{ $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['THREE']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['THREE'])->total/$product['product']['total_review']*100 : 0 }}%"></div>
                  </div>
                  <span class="rating-num-total">{{ $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['THREE']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['THREE'])->total/$product['product']['total_review']*100 : 0 }}%</span>
                </div>
                <div class="item rate-2">
                  <span class="rating-num">{{ \App\Models\Review::NUMBER_STAR['TWO'] }}</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: {{ $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['TWO']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['TWO'])->total/$product['product']['total_review']*100 : 0 }}%"></div>
                  </div>
                  <span class="rating-num-total">{{ $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['TWO']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['TWO'])->total/$product['product']['total_review']*100 : 0 }}%</span>
                </div>
                <div class="item rate-1">
                  <span class="rating-num">{{ \App\Models\Review::NUMBER_STAR['ONE'] }}</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: {{ $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['ONE']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['ONE'])->total/$product['product']['total_review']*100 : 0 }}%"></div>
                  </div>
                  <span class="rating-num-total">{{ $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['ONE']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['ONE'])->total/$product['product']['total_review']*100 : 0 }}%</span>
                </div>
              </div>
              <div class="col-lg-4">
                <h4 class="text-center">{{ __('index.detail.review.share') }}</h4>
                <button class="btn btn-default js-btn-review">{{ __('index.detail.review.write') }}</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Product Details -->
  <script>
    var getSizesByColorId = "{{ url('get-sizes-by-color-id') }}";
    var option_default = "{{ __('index.quick_view.default_option') }}";
  </script>
@endsection