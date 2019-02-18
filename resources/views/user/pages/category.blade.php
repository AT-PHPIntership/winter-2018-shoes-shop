@extends('user.module.master')
@section('content')
  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb">
    <div class="container">
      <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
        <div class="col-first">
          <h1>{{ __('index.category.title') }}</h1>
          <nav class="d-flex align-items-center justify-content-start">
            <a href="{{ route('user.index') }}">{{ __('index.header.home') }}<i class="fa fa-caret-right" aria-hidden="true"></i></a>
            <a href="javascript:void(0)" id="active-category" data-id="{{ $category->id }}">{{ $category->name }}</a>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Area -->
  <div class="container">
    <div class="row">
      <div class="col-xl-9 col-lg-8 col-md-7">
        <h3 class="mb-10">{{ __('index.category.list_product') }}</h3>
        <!-- Start Filter Bar -->
        <div class="row">
          <div class="col-lg-3 col-md-12 col-sm-6">
            <select class="form-control form-control-sm js-slt-sort">
              <option value="">{{ __('index.category.sort.title') }}</option>
              <option value="name-asc">{{ __('index.category.sort.name_asc') }}</option>
              <option value="name-desc">{{ __('index.category.sort.name_desc') }}</option>
              <option value="price-asc">{{ __('index.category.sort.price_asc') }}</option>
              <option value="price-desc">{{ __('index.category.sort.price_desc') }}</option>
              <option value="updated-asc">{{ __('index.category.sort.updated_asc') }}</option>
              <option value="updated-desc">{{ __('index.category.sort.updated_desc') }}</option>
            </select>
          </div>
          <div class="col-lg-9 col-md-12 col-sm-6">
            <span>{{ __('index.category.sort.filter_by') }}: </span>
            <ul class="active-filter-list">
            </ul>
          </div>
        </div>
        <!-- End Filter Bar -->
        <!-- Start Best Seller -->
        <section class="lattest-product-area pb-40 category-list">
          <div class="row" id="list-product">
            @foreach ($products as $product)
              <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
                <div class="content">
                  <div class="content-overlay"></div>
                  <img class="content-image img-fluid d-block mx-auto size-product" src="{{ $product->images->first() ? $product->images->first()->path : config('define.image_default_product') }}" alt="">
                  <div class="content-details fadeIn-bottom">
                    <div class="bottom d-flex align-items-center justify-content-center">
                      <a href="#"><span class="lnr lnr-cart"></span></a>
                      <a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
                    </div>
                  </div>
                </div>
                <div class="price">
                  <h5>{{ $product->name }}</h5>
                  <p>{{ $product->promotions->first() ? ($product->original_price * $product->promotions->first()->percent)/100 : $product->original_price }}đ <del class="text-gray">{{ $product->promotions->first() ? $product->original_price.'đ' : '' }}</del></p>
                </div>
              </div>
            @endforeach
          </div>
        </section>
        <!-- End Best Seller -->
      </div>
      <div class="col-xl-3 col-lg-4 col-md-5">
        <div class="sidebar-filter mt-50">
          <div class="common-filter">
            <div class="head">{{ __('index.category.price.title') }}</div>
            <div class="price-range-area">
              <div id="price-range"></div>
              <div class="value-wrapper d-flex">
                <div class="price">{{ __('index.category.price.title') }}:</div>
                <div id="lower-value"></div>
                <span>đ</span>
                <div class="to">{{ __('index.category.price.to') }}</div>
                <div id="upper-value"></div>
                <span>đ</span>
              </div>
            </div>
          </div>
          <div class="common-filter">
            <div class="head">{{ __('index.category.color.title') }}</div>
            <form action="#">
              <ul class="list-color row">
                @foreach ($colors as $color)
                  <li class="mgb-5 col-lg-6 col-md-6">
                    <div class="primary-checkbox in-bl">
                      <input class="pixel-radio js-common js-ck-color" type="checkbox" data-id="color:{{ $color->id }}" name="color"><label class="default-checkbox"></label>
                    </div>
                    <span class="ml-5">{{ $color->name }}</span>
                  </li>                 
                @endforeach
              </ul>
            </form>
          </div>
          <div class="common-filter">
            <div class="head">{{ __('index.category.size.title') }}</div>
            <form action="#">
              <ul class="list-size row">
                @foreach ($sizes as $size)
                <li class="mgb-5 col-lg-4 col-md-4">
                    <div class="primary-checkbox in-bl">
                      <input class="pixel-radio js-common js-ck-size" type="checkbox" data-id="size:{{ $size->id }}" name="size"><label class="default-checkbox"></label>
                    </div>
                    <span class="ml-5">{{ $size->size }}</span>
                  </li>
                @endforeach
              </ul>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var filterProductUrl = "{{ url('category/filterProduct') }}";
    var option_default = "{{ __('index.quick_view.default_option') }}";
    var getDetailProduct = "{{ url('get-detail-product') }}";
  </script>
@endsection
