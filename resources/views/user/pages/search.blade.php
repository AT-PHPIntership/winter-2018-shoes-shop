@extends('user.module.master')
@section('content')
  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb">
    <div class="container">
      <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
        <div class="col-first">
          <h1>{{ __('search.search.title') }}</h1>
          <nav class="d-flex align-items-center justify-content-start">
            <a href="index.html">{{ __('search.search.home') }}<i class="fa fa-caret-right" aria-hidden="true"></i></a>
            <a href="category.html">{{ __('search.search.title') }}</a>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Area -->
  <div class="container">
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <!-- List Products -->
        <section class="lattest-product-area pb-40 category-list mb-100">
          <h3>{{ __('search.search.result') }}: {{ $products->total() }} {{ __('search.search.product') }}</h3>
          <div class="row">
            @foreach ($products as $product)
              <div class="col-xl-3 col-lg-6 col-md-12 col-sm-6 single-product">
                <div class="content">
                  <div class="content-overlay"></div>
                  <img class="content-image img-fluid d-block mx-auto size-product" src="{{ $product->images->first() ? $product->images->first()->path : config('define.image_default_product') }}" alt="">
                  <div class="content-details fadeIn-bottom">
                    <div class="bottom d-flex align-items-center justify-content-center">
                      <a href="#"><span class="lnr lnr-cart"></span></a>
                      <a href="#" data-toggle="modal" data-target="#modal-product" data-product="{{ $product->id }}"><span class="lnr lnr-frame-expand"></span></a>
                    </div>
                  </div>
                </div>
                <div class="price">
                  <h5>{{ $product->name }}</h5>
                  <p>{{ $product->promotions->last() ? formatCurrencyVN(($product->original_price * (100 - $product->promotions->last()->percent))/100) : formatCurrencyVN($product->original_price) }} <del class="text-gray">{{ $product->promotions->last() ? formatCurrencyVN($product->original_price) : '' }}</del></p>
                </div>
              </div>
            @endforeach
          </div>
          <div class="pagination-sm">
            {{ $products->links() }}
          </div>
        </section>
        <!-- End List Products -->
      </div>
    </div>
  </div>
  <script>
    var option_default = "{{ __('index.quick_view.default_option') }}";
    var getDetailProduct = "{{ url('get-detail-product') }}";
  </script>
@endsection
