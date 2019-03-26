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
                <h4 class="text-center">Đánh giá trung bình</h4>
                <p class="total-review-point">5/5</p>
                <p class="item-rating text-center">
                  <span class="rating-content">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <span style="width: 76%">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                  </span>
                </p>
                <p class="total-comment text-center">(16 nhận xét)</p>
              </div>
              <div class="col-lg-4">
                <div class="item rate-5">
                  <span class="rating-num">5</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: 75%"></div>
                  </div>
                  <span class="rating-num-total">75%</span>
                </div>
                <div class="item rate-4">
                  <span class="rating-num">4</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: 60%"></div>
                  </div>
                  <span class="rating-num-total">60%</span>
                </div>
                <div class="item rate-3">
                  <span class="rating-num">3</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: 50%"></div>
                  </div>
                  <span class="rating-num-total">50%</span>
                </div>
                <div class="item rate-2">
                  <span class="rating-num">2</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: 10%"></div>
                  </div>
                  <span class="rating-num-total">10%</span>
                </div>
                <div class="item rate-1">
                  <span class="rating-num">1</span>
                  <div class="rating-progress">
                    <div class="rating-progress-bar color-1" style="width: 10%"></div>
                  </div>
                  <span class="rating-num-total">10%</span>
                </div>
              </div>
              <div class="col-lg-4">
                <h4 class="text-center">Chia sẻ nhận xét về sản phẩm</h4>
                <button class="btn btn-default js-btn-review">Viết nhận xét của bạn</button>
              </div>
            </div>
          </div>
          <div class="review-form mt-10 mb-30">
            <div class="row">
              <div class="col-lg-6">
                <form action="" method="POST" id="add-review-form" enctype='multipart/form-data'>
                  <div class="review-rate">
                    <label>1. Đánh giá của bạn về sản phẩm này:</label>
                    <div id="full-stars-example-two">
                      <div class="rating-group">
                         <input disabled checked class="rating-input rating-input--none" name="rating3" id="rating3-none" value="0" type="radio">
                         <label aria-label="1 star" class="rating-label" for="rating3-1"><i class="rating-icon rating-icon--star fa fa-star"></i></label>
                         <input class="rating-input" name="rating3" id="rating3-1" value="1" type="radio">
                         <label aria-label="2 stars" class="rating-label" for="rating3-2"><i class="rating-icon rating-icon--star fa fa-star"></i></label>
                         <input class="rating-input" name="rating3" id="rating3-2" value="2" type="radio">
                         <label aria-label="3 stars" class="rating-label" for="rating3-3"><i class="rating-icon rating-icon--star fa fa-star"></i></label>
                         <input class="rating-input" name="rating3" id="rating3-3" value="3" type="radio">
                         <label aria-label="4 stars" class="rating-label" for="rating3-4"><i class="rating-icon rating-icon--star fa fa-star"></i></label>
                         <input class="rating-input" name="rating3" id="rating3-4" value="4" type="radio">
                         <label aria-label="5 stars" class="rating-label" for="rating3-5"><i class="rating-icon rating-icon--star fa fa-star"></i></label>
                         <input class="rating-input" name="rating3" id="rating3-5" value="5" type="radio">
                      </div>
                    </div>
                  </div>
                  <div class="review-title form-group">
                    <label for="review-title">2. Tiêu đề của nhận xét:</label>
                    <input type="text" name="title" class="form-control input-sm" id="review-title" placeholder="Nhập tiêu đề nhận xét (Không bắt buộc)">
                  </div>
                  <div class="review-content form-group">
                    <label for="review-content">3. Viết bình luận của bạn vào bên dưới:</label>
                    <textarea name="content" class="form-control input-sm" id="review-content" placeholder="Nhận xét của bạn về sản phẩm này" rows="6"></textarea>
                  </div>
                  <div class="review-content form-group">
                    <label for="review-content">Thêm hình sản phẩm nếu có (tối đa 5 hình)</label>
                    <input type="file" name="upload_img[]" id="btn-file" multiple>
                    <span class="btn-fake">Chọn hình</span>
                    <p class="err-rv error-image">
                      <small></small>
                    </p>
                    <div class="wrapper-img">
                      {{-- <div class="img-content">
                        <img class="img-preview" src="/public/images/demo_avatar.png" alt="">
                        <span class="rm-img"><i class="fa fa-times-circle"></i></span>
                      </div> --}}
                    </div>
                    <div class="action">
                      <button type="submit" class="btn btn-default js-add-review">Gửi nhận xét</button>
                    </div>
                    <p>* Nhận xét sẽ được kiểm duyệt.</p>
                  </div>
                </form>    
              </div>
              <div class="col-lg-6"></div>
            </div>
          </div>
          <div class="review-content">
            <div class="review-filter mb-10">
              <div class="row">
                <div class="col-md-2">
                  <p>Chọn xem nhận xét:</p>
                </div>
                <div class="col-md-2">
                  <select class="form-control form-control-sm">
                    <option value="">Mới nhất</option>
                    <option value="">Hữu ích</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <select class="form-control form-control-sm">
                    <option value="">Tất cả khách hàng</option>
                    <option value="">Khách hàng đã mua</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <select class="form-control form-control-sm">
                    <option value="">Tất cả sao</option>
                    <option value="">5 sao</option>
                    <option value="">4 sao</option>
                    <option value="">3 sao</option>
                    <option value="">2 sao</option>
                    <option value="">1 sao</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="review-list">
              <div class="review-item">
                <div class="row">
                  <div class="col-md-2 text-center">
                    <div class="user-avatar">
                      <img src="/admin/images/default_avatar.png" alt="">
                    </div>
                    <p class="user-name">Thanh Bui V.</p>
                    <p class="date-review">3 tháng trước</p>
                  </div>
                  <div class="col-md-10">
                    <div class="rv-info">
                      <div class="rv-rating">
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <p class="rv-title">Lorem Ipsum</p>
                      <p class="rv-buy-already">
                        <img src="/public/images/icon_verified.png" alt="">
                        <span>Verified Purchase</span>
                      </p>
                      <p class="rv-content">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                      <div class="rv-image">
                        <img src="/admin/images/default_avatar.png" alt="">
                        <img src="/admin/images/default_avatar.png" alt="">
                        <img src="/admin/images/default_avatar.png" alt="">
                      </div>
                      <div class="rv-like">
                        <button class="js-btn-like"><i class="fa fa-thumbs-up active"></i></button>
                        <span class="rv-total-like active">43</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="review-item">
                <div class="row">
                  <div class="col-md-2 text-center">
                    <div class="user-avatar">
                      <img src="/admin/images/default_avatar.png" alt="">
                    </div>
                    <p class="user-name">Thanh Bui V.</p>
                    <p class="date-review">3 tháng trước</p>
                  </div>
                  <div class="col-md-10">
                    <div class="rv-info">
                      <div class="rv-rating">
                        <span>
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star active"></i>
                          <i class="fa fa-star"></i>
                        </span>
                      </div>
                      <p class="rv-title">Lorem Ipsum</p>
                      <p class="rv-buy-already">
                        <img src="/public/images/icon_verified.png" alt="">
                        <span>Verified Purchase</span>
                      </p>
                      <p class="rv-content">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                      <div class="rv-image">
                        <img src="/public/images/demo_avatar.png" alt="">
                        <img src="/public/images/demo_avatar.png" alt="">
                        <img src="/public/images/demo_avatar.png" alt="">
                      </div>
                      <div class="rv-like">
                        <button class="js-btn-like"><i class="fa fa-thumbs-up active"></i></button>
                        <span class="rv-total-like active">43</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="review-item">
                <div class="row">
                  <div class="col-md-2 text-center">
                    <div class="user-avatar">
                      <img src="/admin/images/default_avatar.png" alt="">
                    </div>
                    <p class="user-name">Thanh Bui V.</p>
                    <p class="date-review">3 tháng trước</p>
                  </div>
                  <div class="col-md-10">
                    <div class="rv-info">
                      <div class="rv-rating">
                        <span>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </span>
                      </div>
                      <p class="rv-title">Lorem Ipsum</p>
                      <p class="rv-buy-already">
                        <img src="/public/images/icon_verified.png" alt="">
                        <span>Verified Purchase</span>
                      </p>
                      <p class="rv-content">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                      <div class="rv-image">
                        <img src="/public/images/demo_avatar.png" alt="">
                        <img src="/public/images/demo_avatar.png" alt="">
                        <img src="/public/images/demo_avatar.png" alt="">
                      </div>
                      <div class="rv-like">
                        <button class="js-btn-like"><i class="fa fa-thumbs-up active"></i></button>
                        <span class="rv-total-like active">43</span>
                      </div>
                    </div>
                  </div>
                </div>
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
  <script src="{{ asset('public/js/review.js') }}"></script>
@endsection