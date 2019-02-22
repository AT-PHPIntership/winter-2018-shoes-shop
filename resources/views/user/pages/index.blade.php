@extends('user.module.master')
@section('content')
  @include('user.module.banner')
  <!-- Start category Area -->
  <section class="category-area section-gap section-gap" id="catagory">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-40">
          <div class="title text-center">
            <h2 class="mb-10">{{ __('index.category.title') }}</h1>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-8 mb-10">
          <div class="row category-bottom">
            <div class="col-lg-6 col-md-6 mb-30">
              <div class="content">
                <a href="javascript:void(0)" target="_blank">
                  <div class="content-overlay"></div>
                  <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/banner_men.jpg') }}" alt="">
                  <div class="content-details fadeIn-bottom">
                    <h3 class="content-title">{{ __('index.shoes.men') }}</h3>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-30">
              <div class="content">
                <a href="javascript:void(0)" target="_blank">
                  <div class="content-overlay"></div>
                  <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/banner_women.jpg') }}" alt="">
                  <div class="content-details fadeIn-bottom">
                    <h3 class="content-title">{{ __('index.shoes.women') }}</h3>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="content">
                <a href="javascript:void(0)" target="_blank">
                  <div class="content-overlay"></div>
                  <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/banner_kid.jpg') }}" alt="">
                  <div class="content-details fadeIn-bottom">
                    <h3 class="content-title">{{ __('index.shoes.kid') }}</h3>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 mb-10">
          <div class="content">
            <a href="javascript:void(0)" target="_blank">
              <div class="content-overlay"></div>
              <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/banner_accessory.jpg') }}" alt="">
              <div class="content-details fadeIn-bottom">
                <h3 class="content-title">{{ __('index.shoes.accessories') }}</h3>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End category Area -->
  <!-- Start men-product Area -->
  <section class="men-product-area section-gap relative" id="men">
    <div class="overlay overlay-bg"></div>
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-40">
          <div class="title text-center">
            <h2 class="mb-10 parent-cat">
              <a class="text-white" href="javascript:void(0)">{{ __('index.shoes.men') }}</a>
            </h2>
            <ul class="child-cat">
              @foreach ($childsCatForMen as $childCatForMen)
                <li>
                  <h3>
                    <a class="text-white" href="{{ route('user.category', ['id' => $childCatForMen->id]) }}">{{ $childCatForMen->name }}</a>
                  </h3>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="product-owl owl-carousel">
          @foreach ($productsForMen as $productForMen)
            <div class="item single-product">
              <div class="content">
                <div class="content-overlay"></div>
                <img class="content-image img-fluid d-block mx-auto size-product" src="{{ $productForMen->images->first() ? $productForMen->images->first()->path : config('define.image_default_product') }}" alt="">
                <div class="content-details fadeIn-bottom">
                  <div class="bottom d-flex align-items-center justify-content-center">
                    <a href="#"><span class="lnr lnr-cart"></span></a>
                    <a href="#" data-toggle="modal" data-target="#modal-product" data-product="{{ $productForMen->id }}"><span class="lnr lnr-frame-expand"></span></a>
                  </div>
                </div>
              </div>
              <div class="price">
                <h5 class="text-white">{{ $productForMen->name }}</h5>
                <p class="text-white">{{ $productForMen->promotions->last() ? formatCurrencyVN(($productForMen->original_price * (100 - $productForMen->promotions->last()->percent))/100) : formatCurrencyVN($productForMen->original_price) }} <del class="text-gray">{{ $productForMen->promotions->last() ? formatCurrencyVN($productForMen->original_price) : '' }}</del></p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  <!-- End men-product Area -->
  <!-- Start women-product Area -->
  <section class="women-product-area section-gap" id="women">
    <div class="container">
      <div class="countdown-content pb-40">
        <div class="title text-center">
          <h2 class="mb-10 parent-cat">
            <a href="javascript:void(0)">{{ __('index.shoes.women') }}</a>
          </h2>
          <ul class="child-cat">
            @foreach ($childsCatForWomen as $childCatForWomen)
              <li>
                <h3>
                  <a class="text-white" href="{{ route('user.category', ['id' => $childCatForWomen->id]) }}">{{ $childCatForWomen->name }}</a>
                </h3>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="product-owl owl-carousel">
          @foreach ($productsForWomen as $productForWomen)
            <div class="item single-product">
              <div class="content">
                <div class="content-overlay"></div>
                <img class="content-image img-fluid d-block mx-auto size-product" src="{{ $productForWomen->images->first() ? $productForWomen->images->first()->path : config('define.image_default_product') }}" alt="">
                <div class="content-details fadeIn-bottom">
                  <div class="bottom d-flex align-items-center justify-content-center">
                    <a href="#"><span class="lnr lnr-cart"></span></a>
                    <a href="#" data-toggle="modal" data-target="#modal-product"  data-product="{{ $productForWomen->id }}"><span class="lnr lnr-frame-expand"></span></a>
                  </div>
                </div>
              </div>
              <div class="price">
                <h5>{{ $productForWomen->name }}</h5>
                <p>{{ $productForWomen->promotions->last() ? formatCurrencyVN(($productForWomen->original_price * (100 - $productForWomen->promotions->last()->percent))/100) : formatCurrencyVN($productForWomen->original_price) }} <del class="text-gray">{{ $productForWomen->promotions->last() ? formatCurrencyVN($productForWomen->original_price) : '' }}</del></p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  <!-- End women-product Area -->
  <!-- Start related-product Area --> 
  <section class="related-product-area section-gap" id="latest">
    <div class="container">
      <div class="related-content">
        <div class="title text-center">
          <h2 class="mb-10">{{ __('index.product.new') }}</h2>
        </div>
      </div>
      <div class="row">
        @foreach ($newProducts as $newProduct)
          <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
            <div class="single-search-product d-flex">
              <a href="#"><img src="{{ $newProduct->images->first() ? $newProduct->images->first()->path : config('define.image_default_product') }}" alt=""></a>
              <div class="desc">
                <a href="#" class="title">{{ $newProduct->name }}</a>
                <div class="price"><span class="lnr lnr-tag"></span> {{ $newProduct->promotions->last() ? formatCurrencyVN(($newProduct->original_price * (100 - $newProduct->promotions->last()->percent))/100) : formatCurrencyVN($newProduct->original_price) }} <del>{{ $newProduct->promotions->last() ? formatCurrencyVN($newProduct->original_price) : '' }}</del></div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- End related-product Area -->
  <!-- Start related-product Area --> 
  <section class="related-product-area section-gap" id="latest">
    <div class="container">
    <div class="related-content">
      <div class="title text-center">
        <h2 class="mb-10">{{ __('index.product.top_sell') }}</h2>
      </div>
    </div>
    <div class="row">
      @foreach ($topSellProducts as $topSellProduct)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
          <div class="single-search-product d-flex">
            <a href="#"><img src="{{ $topSellProduct->images->first() ? $topSellProduct->images->first()->path : config('define.image_default_product') }}" alt=""></a>
            <div class="desc">
              <a href="#" class="title">{{ $topSellProduct->name }}</a>
              <div class="price"><span class="lnr lnr-tag"></span> {{ $topSellProduct->promotions->last() ? formatCurrencyVN(($topSellProduct->original_price * (100 - $topSellProduct->promotions->last()->percent))/100) : formatCurrencyVN($topSellProduct->original_price) }} <del>{{ $topSellProduct->promotions->last() ? formatCurrencyVN($topSellProduct->original_price) : '' }}</del></div>
            </div>
          </div>
        </div>
      @endforeach
  </section>
  <!-- End related-product Area -->
  <!-- Start brand Area -->
  <section class="brand-area pb-100">
    <div class="container">
      <div class="row logo-wrap">
        <a class="col single-img" href="#">
        <img class="d-block mx-auto" src="{{ asset('public/img/br1.png') }}" alt="">
        </a>
        <a class="col single-img" href="#">
        <img class="d-block mx-auto" src="{{ asset('public/img/br2.png') }}" alt="">
        </a>
        <a class="col single-img" href="#">
        <img class="d-block mx-auto" src="{{ asset('public/img/br3.png') }}" alt="">
        </a>
        <a class="col single-img" href="#">
        <img class="d-block mx-auto" src="{{ asset('public/img/br4.png') }}" alt="">
        </a>
        <a class="col single-img" href="#">
        <img class="d-block mx-auto" src="{{ asset('public/img/br5.png') }}" alt="">
        </a>
      </div>
    </div>
  </section>
  <!-- End brand Area -->  
  <script>var option_default = "{{ __('index.quick_view.default_option') }}";</script>
  <script>var getDetailProduct = "{{ url('get-detail-product') }}";</script>  
@endsection
