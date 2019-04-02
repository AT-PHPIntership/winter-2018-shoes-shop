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
          <a class="nav-link active" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments">{{ __('index.detail.comment.title') }}</a>
        </li>
        <li>
          <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews">{{ __('index.detail.review.title') }}</a>
        </li>
      </ul>
    </div>
    <div class="tab-content" id="my-tab-content">
      <div class="tab-pane fade show active" id="comments" role="tabpanel" aria-labelledby="comments">
        <div class="review-wrapper">
          <div class="row">
            <div class="col-xl-6">
              <div class="total-comment">
                <ul class="comment-list">
                </ul>
                <div class="load-more" id="js-load-more-comment">
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="add-review">
                <h3>{{ __('index.detail.comment.post') }}</h3>
                @if (Auth::check())
                  <div class="main-form">
                    <textarea id="js-comment-content" class="common-textarea" placeholder="{{ __('index.detail.comment.content') }}" onfocus="this.placeholder=''" onblur="this.placeholder = '{{ __('index.detail.comment.content') }}'"></textarea>
                    <span class="mess-error comment-error"></span>
                    <a href="javascript:void(0)" id="js-add-comment" data-user-id="{{ Auth::user()->id }}" data-product-id="{{ request()->route('id') }}" class="view-btn color-2 btn-comment"><span>{{ __('index.detail.comment.submit') }}</span></a>
                  </div>
                  <span></span>
                @else
                  <b>{{ __('index.detail.comment.login') }}</b>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade show" id="reviews" role="tabpanel" aria-labelledby="reviews">
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
              @php
                if ($product['product']['total_review']) {
                  $perRating5 = ceil($totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['FIVE']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['FIVE'])->total/$product['product']['total_review']*100 : 0);
                  $perRating4 = ceil($totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['FOUR']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['FOUR'])->total/$product['product']['total_review']*100 : 0);
                  $perRating3 = ceil($totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['THREE']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['THREE'])->total/$product['product']['total_review']*100 : 0);
                  $perRating2 = ceil($totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['TWO']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['TWO'])->total/$product['product']['total_review']*100 : 0);
                  $perRating1 = ceil($totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['ONE']) ? $totalRating->firstWhere('star', \App\Models\Review::NUMBER_STAR['ONE'])->total/$product['product']['total_review']*100 : 0);
                } else {
                  $perRating5 = $perRating4 = $perRating3 = $perRating2 = $perRating1 = 0;
                }
              @endphp
              <div class="col-lg-4">
                <div class="item rate-5">
                  <span class="rating-num">{{ \App\Models\Review::NUMBER_STAR['FIVE'] }}</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: {{ $perRating5 }}%"></div>
                  </div>
                  <span class="rating-num-total">{{ $perRating5 }}%</span>
                </div>
                <div class="item rate-4">
                  <span class="rating-num">{{ \App\Models\Review::NUMBER_STAR['FOUR'] }}</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: {{ $perRating4 }}%"></div>
                  </div>
                  <span class="rating-num-total">{{ $perRating4 }}%</span>
                </div>
                <div class="item rate-3">
                  <span class="rating-num">{{ \App\Models\Review::NUMBER_STAR['THREE'] }}</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: {{ $perRating3 }}%"></div>
                  </div>
                  <span class="rating-num-total">{{ $perRating3 }}%</span>
                </div>
                <div class="item rate-2">
                  <span class="rating-num">{{ \App\Models\Review::NUMBER_STAR['TWO'] }}</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: {{ $perRating2 }}%"></div>
                  </div>
                  <span class="rating-num-total">{{ $perRating2 }}%</span>
                </div>
                <div class="item rate-1">
                  <span class="rating-num">{{ \App\Models\Review::NUMBER_STAR['ONE'] }}</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: {{ $perRating1 }}%"></div>
                  </div>
                  <span class="rating-num-total">{{ $perRating1 }}%</span>
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
  <div id="notification">
    <i class="fa fa-check"></i> <span>{{ __('index.detail.comment.success') }}</span>
  </div>
  <script>
    var getSizesByColorId = "{{ url('get-sizes-by-color-id') }}";
    var option_default = "{{ __('index.quick_view.default_option') }}";
    var addCommentUrl = "{{ url('detail/add-comment') }}";
    var getListCommentUrl = "{{ url('detail/get-list-comment') }}";
    var removeCommentUrl = "{{ url('detail/remove-comment') }}";
    var required = "{{ __('index.detail.comment.required') }}";
    var txtSubmit = "{{ __('index.detail.comment.submit') }}";
    var txtContent = "{{ __('index.detail.comment.content') }}";
    var txtCmtSuccess = "{{ __('index.detail.comment.success') }}";
    var txtAdminCmtSuccess = "{{ __('index.detail.comment.admin_success') }}";
    var userLogin = {
      id : "{{ Auth::user()->id ?? null }}",
      role : "{{ Auth::user()->role_id ?? null }}",
    };
    var txtNoComment = "{{ __('index.detail.comment.empty') }}";
    var txtLoadMore = "{{ __('index.detail.comment.load_more') }}";
    var txtReply = "{{ __('index.detail.comment.reply') }}";
    var txtDeleteCmtSuccess = "{{ __('common.message.delete_success') }}";
    var txtQuesDelCmt = "{{ __('common.message.del_question') }}";
  </script>
  <script src="{{ asset('public/js/comment-product.js') }}"></script> 
@endsection
