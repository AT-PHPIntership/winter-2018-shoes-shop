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
      <h3>{{ trans('product.product_detail') }}</h3>
      <div class="row align-items-center">
        <div class="col-12 col-md-6">
          <div class="single_product_thumb">
            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators menu-control">
                @foreach($product['images'] as $key => $image)
                  <li class="{{ $key == 0 ? 'active' : '' }} control-item" data-target="#product_details_slider" data-slide-to="{{$key}}" style="background-image: url({{$image->path}});"></li>
                @endforeach
              </ol>
              <div class="carousel-inner">
                @foreach($product['images'] as $key => $image)
                  <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img class="d-block w-100" src="{{$image->path}}" alt="Slide">
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="quick-view-content">
            <div class="top">
              <h3 class="head">{{ $product['product']['name']}}</h3>
              <div class="price d-flex align-items-center">
                <span class="lnr lnr-tag"></span>
                @if($product['product']['price'])
                  <span class="ml-10">{{ formatCurrencyVN($product['product']['original_price']) }}</span>
                  <span class="ml-10">{{ formatCurrencyVN($product['product']['price']) }}</span>
                @else
                  <span class="ml-10">{{ formatCurrencyVN($product['product']['original_price']) }}</span>
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
                    <option>{{ trans('product.select_color')}}</option>
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
                  <input id="js-quantity" type="number" class="select-number ml-15 form-control" value="1" />
                </div>
              </div>
              <div class="d-flex mt-20">
              <a href="javascript:void(0)" data-product-id="{{ $product['product']['id'] }}" class="view-btn color-2"><span>{{ trans('product.add_cart')}}</span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="comment-content">
      <h3>Bình luận</h3>
      <div class="row">
        <div class="col-xl-6">
          <div class="total-comment">
            <div class="single-comment">
              <div class="user-details d-flex align-items-center flex-wrap">
                <img src="{{ config('define.image_default_product') }}" class="img-fluid order-1 order-sm-1" alt="">
                <div class="user-name order-3 order-sm-2">
                  <h5>Blake Ruiz</h5>
                  <span>12th Feb, 2017 at 05:56 pm</span>
                </div>
                <a href="#" class="view-btn color-2 reply order-2 order-sm-3"><i class="fa fa-reply" aria-hidden="true"></i><span>Reply</span></a>
              </div>
              <p class="user-comment">
                Acres of Diamonds… you’ve read the famous story, or at least had it related to you. A farmer hears tales of diamonds and begins dreaming of vast riches. He sells his farm and hikes off over the horizon, never to be heard from again.
              </p>
            </div>
            <div class="single-comment reply-comment">
              <div class="user-details d-flex align-items-center flex-wrap">
                <img src="{{ config('define.image_default_product') }}" class="img-fluid order-1 order-sm-1" alt="">
                <div class="user-name order-3 order-sm-2">
                  <h5>Logan May</h5>
                  <span>12th Feb, 2017 at 05:56 pm</span>
                </div>
                <a href="#" class="view-btn color-2 reply order-2 order-sm-3"><i class="fa fa-reply" aria-hidden="true"></i><span>Reply</span></a>
              </div>
              <p class="user-comment">
                Acres of Diamonds… you’ve read the famous story, or at least had it related to you. A farmer hears tales of diamonds and begins dreaming of vast riches. He sells his farm and hikes off over the horizon, never to be heard from again.
              </p>
            </div>
            <div class="single-comment">
              <div class="user-details d-flex align-items-center flex-wrap">
                <img src="{{ config('define.image_default_product') }}" class="img-fluid order-1 order-sm-1" alt="">
                <div class="user-name order-3 order-sm-2">
                  <h5>Aaron Anderson</h5>
                  <span>12th Feb, 2017 at 05:56 pm</span>
                </div>
                <a href="#" class="view-btn color-2 reply order-2 order-sm-3"><i class="fa fa-reply" aria-hidden="true"></i><span>Reply</span></a>
              </div>
              <p class="user-comment">
                Acres of Diamonds… you’ve read the famous story, or at least had it related to you. A farmer hears tales of diamonds and begins dreaming of vast riches. He sells his farm and hikes off over the horizon, never to be heard from again.
              </p>
            </div>
          </div>
        </div>
        {{-- <div class="col-xl-6">
          <div class="add-review">
            <h3>Post a comment</h3>
            <form action="#" class="main-form">
              <input type="text" placeholder="Your Full name" onfocus="this.placeholder=''" onblur="this.placeholder = 'Your Full name'" required class="common-input">
              <input type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" placeholder="Email Address" onfocus="this.placeholder=''" onblur="this.placeholder = 'Email Address'" required class="common-input">
              <input type="text" placeholder="Phone Number" onfocus="this.placeholder=''" onblur="this.placeholder = 'Phone Number'" required class="common-input">
              <textarea placeholder="Messege" onfocus="this.placeholder=''" onblur="this.placeholder = 'Messege'" required class="common-textarea"></textarea>
              <button class="view-btn color-2"><span>Submit Now</span></button>
            </form>
          </div>
        </div> --}}
      </div>
    </div>
  </div>
  <!-- End Product Details -->
  <script>var option_default = "{{ __('index.quick_view.default_option') }}";</script>
  <script>var getSizesByColorId = "{{ url('get-sizes-by-color-id') }}";</script>  
@endsection