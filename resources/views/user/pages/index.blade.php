@extends('user.module.master')
@section('content')
  @include('user.module.banner')
  <!-- Start category Area -->
  <section class="category-area section-gap section-gap" id="catagory">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-40">
          <div class="title text-center">
            <h1 class="mb-10">Danh mục</h1>
            {{-- <p>Who are in extremely love with eco friendly system.</p> --}}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-8 mb-10">
          <div class="row category-bottom">
            <div class="col-lg-6 col-md-6 mb-30">
              <div class="content">
                <a href="#" target="_blank">
                  <div class="content-overlay"></div>
                  <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/banner_men.jpg') }}" alt="">
                  <div class="content-details fadeIn-bottom">
                    <h3 class="content-title">Giày nam</h3>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-30">
              <div class="content">
                <a href="#" target="_blank">
                  <div class="content-overlay"></div>
                  <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/banner_women.jpg') }}" alt="">
                  <div class="content-details fadeIn-bottom">
                    <h3 class="content-title">Gày nữ</h3>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="content">
                <a href="#" target="_blank">
                  <div class="content-overlay"></div>
                  <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/c3.jpg') }}" alt="">
                  <div class="content-details fadeIn-bottom">
                    <h3 class="content-title">Giày trẻ em</h3>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 mb-10">
          <div class="content">
            <a href="#" target="_blank">
              <div class="content-overlay"></div>
              <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/c4.jpg') }}" alt="">
              <div class="content-details fadeIn-bottom">
                <h3 class="content-title">Phụ kiện</h3>
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
              <a class="text-white" href="">Giày nam</a>
            </h2>
            <ul class="child-cat">
              @foreach ($childsCatForMen as $childCatForMen)
                <li>
                  <h3>
                    <a class="text-white" href="">{{ $childCatForMen->name }}</a>
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
                    <a href="#" data-toggle="modal" data-target="#exampleModal" data-product="{{ $productForMen->id }}"><span class="lnr lnr-frame-expand"></span></a>
                  </div>
                </div>
              </div>
              <div class="price">
                <h5 class="text-white">{{ $productForMen->name }}</h5>
                <p class="text-white">{{ $productForMen->promotions->first() ? ($productForMen->original_price * $productForMen->promotions->first()->percent)/100 : $productForMen->original_price }}đ <del class="text-gray">{{ $productForMen->promotions->first() ? $productForMen->original_price.'đ' : '' }}</del></p>
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
            <a href="">Giày nữ</a>
          </h2>
          <ul class="child-cat">
            @foreach ($childsCatForWomen as $childCatForWomen)
              <li>
                <h3>
                  <a class="text-white" href="">{{ $childCatForWomen->name }}</a>
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
                    <a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
                  </div>
                </div>
              </div>
              <div class="price">
                <h5>{{ $productForWomen->name }}</h5>
                <p>{{ $productForWomen->promotions->first() ? ($productForWomen->original_price * $productForWomen->promotions->first()->percent)/100 : $productForWomen->original_price }}đ <del class="text-gray">{{ $productForWomen->promotions->first() ? $productForWomen->original_price.'đ' : '' }}</del></p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  <!-- End women-product Area -->
  <!-- Start Count Down Area -->
  <div class="countdown-area">
    <div class="container">
      <div class="countdown-content">
        <div class="title text-center">
          <h1 class="mb-10">Exclusive Hot Deal Ends in:</h1>
          <p>Who are in extremely love with eco friendly system.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-4 col-lg-4"></div>
        <div class="col-xl-6 col-lg-7">
          <div class="countdown d-flex justify-content-center justify-content-md-end" id="js-countdown">
            <div class="countdown-item">
              <div class="countdown-timer js-countdown-days time" aria-labelledby="day-countdown">
              </div>
              <div class="countdown-label" id="day-countdown">Days</div>
            </div>
            <div class="countdown-item">
              <div class="countdown-timer js-countdown-hours" aria-labelledby="hour-countdown">
              </div>
              <div class="countdown-label" id="hour-countdown">Hours</div>
            </div>
            <div class="countdown-item">
              <div class="countdown-timer js-countdown-minutes" aria-labelledby="minute-countdown">
              </div>
              <div class="countdown-label" id="minute-countdown">Minutes</div>
            </div>
            <div class="countdown-item">
              <div class="countdown-timer js-countdown-seconds" aria-labelledby="second-countdown">
              </div>
              <div class="countdown-label text" id="second-countdown">Seconds</div>
            </div>
            <a href="#" class="view-btn primary-btn2"><span>Shop Now</span></a>
            <img src="{{ asset('public/img/cd.png') }}" class="img-fluid cd-img" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Count Down Area -->
  <!-- Start related-product Area --> 
  <section class="related-product-area section-gap" id="latest">
    <div class="container">
      <div class="related-content">
        <div class="title text-center">
          <h2 class="mb-10">Sản phẩm mới</h2>
        </div>
      </div>
      <div class="row">
        @foreach ($newProducts as $newProduct)
          <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
            <div class="single-search-product d-flex">
              <a href="#"><img src="{{ $newProduct->images->first() ? $newProduct->images->first()->path : config('define.image_default_product') }}" alt=""></a>
              <div class="desc">
                <a href="#" class="title">{{ $newProduct->name }}</a>
                <div class="price"><span class="lnr lnr-tag"></span> {{ $newProduct->promotions->first() ? ($newProduct->original_price * $newProduct->promotions->first()->percent)/100 : $newProduct->original_price }}đ <del>{{ $newProduct->promotions->first() ? $newProduct->original_price.'đ' : '' }}</del></div>
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
        <h2 class="mb-10">Sản phẩm bán chạy</h2>
      </div>
    </div>
    <div class="row">
      @foreach ($topSellProducts as $topSellProduct)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
          <div class="single-search-product d-flex">
            <a href="#"><img src="{{ $topSellProduct->images->first() ? $topSellProduct->images->first()->path : config('define.image_default_product') }}" alt=""></a>
            <div class="desc">
              <a href="#" class="title">{{ $topSellProduct->name }}</a>
              <div class="price"><span class="lnr lnr-tag"></span> {{ $topSellProduct->promotions->first() ? ($topSellProduct->original_price * $topSellProduct->promotions->first()->percent)/100 : $topSellProduct->original_price }}đ <del>{{ $topSellProduct->promotions->first() ? $topSellProduct->original_price.'đ' : '' }}</del></div>
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
  <script>var getDetailProduct = "{{ url('getDetailProduct') }}"</script>  
@endsection