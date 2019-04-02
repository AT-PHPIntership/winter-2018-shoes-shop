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
          </div>
          <div class="pagination" id="js-pagi-filter">
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
          <div class="common-filter">
            <div class="head">Xếp hạng</div>
            <form action="#">
              <ul class="list-size row">
                <li data-star="{{ \App\Models\Review::NUMBER_STAR['FIVE'] }}" class="mgb-5 col-lg-12 col-md-12 js-rating">
                  <span class="rating-content">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <span style="width: 100%">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                  </span>
                  <span class="ml-5 rating-title">5 sao</span>
                </li>
                <li data-star="{{ \App\Models\Review::NUMBER_STAR['FOUR'] }}" class="mgb-5 col-lg-12 col-md-12 js-rating">
                  <span class="rating-content">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <span style="width: 80%">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                  </span>
                  <span class="ml-5 rating-title">Ít nhất 4 sao</span>
                </li>
                <li data-star="{{ \App\Models\Review::NUMBER_STAR['THREE'] }}" class="mgb-5 col-lg-12 col-md-12 js-rating">
                  <span class="rating-content">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <span style="width: 60%">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                  </span>
                  <span class="ml-5 rating-title">Ít nhất 3 sao</span>
                </li>
                <li data-star="{{ \App\Models\Review::NUMBER_STAR['TWO'] }}" class="mgb-5 col-lg-12 col-md-12 js-rating">
                  <span class="rating-content">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <span style="width: 60%">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                  </span>
                  <span class="ml-5 rating-title">Ít nhất 2 sao</span>
                </li>
                <li data-star="{{ \App\Models\Review::NUMBER_STAR['ONE'] }}" class="mgb-5 col-lg-12 col-md-12 js-rating">
                  <span class="rating-content">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <span style="width: 60%">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                  </span>
                  <span class="ml-5 rating-title">Ít nhất 1 sao</span>
                </li>
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
    var detailProductUrl = "{{ url('detail') }}";
  </script>
  <script src="{{ asset('public/js/filter-product.js') }}"></script>
@endsection
