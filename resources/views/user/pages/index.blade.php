@extends('user.module.master')
@section('content')
  @include('user.module.banner')
  <!-- Start category Area -->
  <section class="category-area section-gap section-gap" id="catagory">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-40">
          <div class="title text-center">
            <h1 class="mb-10">Shop for Different Categories</h1>
            <p>Who are in extremely love with eco friendly system.</p>
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
                  <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/c1.jpg') }}" alt="">
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
                  <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/c2.jpg') }}" alt="">
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
              <li>
                <h3>
                  <a class="text-white" href="">Giày thể thao nam</a>
                </h3>
              </li>
              <li>
                <h3>
                  <a class="text-white" href="">Dép nam</a>
                </h3>
              </li>
              <li>
                <h3>
                  <a class="text-white" href="">Sandal nam</a>
                </h3>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 single-product">
          <div class="content">
            <div class="content-overlay"></div>
            <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/l1.jpg') }}" alt="">
            <div class="content-details fadeIn-bottom">
              <div class="bottom d-flex align-items-center justify-content-center">
                <a href="#"><span class="lnr lnr-cart"></span></a>
                <a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
              </div>
            </div>
          </div>
          <div class="price">
            <h5 class="text-white">Long Sleeve shirt</h5>
            <h3 class="text-white">$150.00 <del class="text-gray">$100.00</del></h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 single-product">
          <div class="content">
            <div class="content-overlay"></div>
            <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/l2.jpg') }}" alt="">
            <div class="content-details fadeIn-bottom">
              <div class="bottom d-flex align-items-center justify-content-center">
                <a href="#"><span class="lnr lnr-cart"></span></a>
                <a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
              </div>
            </div>
          </div>
          <div class="price">
            <h5 class="text-white">Long Sleeve shirt</h5>
            <h3 class="text-white">$150.00</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 single-product">
          <div class="content">
            <div class="content-overlay"></div>
            <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/l3.jpg') }}" alt="">
            <div class="content-details fadeIn-bottom">
              <div class="bottom d-flex align-items-center justify-content-center">
                <a href="#"><span class="lnr lnr-cart"></span></a>
                <a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
              </div>
            </div>
          </div>
          <div class="price">
            <h5 class="text-white">Long Sleeve shirt</h5>
            <h3 class="text-white">$150.00</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 single-product">
          <div class="content">
            <div class="content-overlay"></div>
            <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/l4.jpg') }}" alt="">
            <div class="content-details fadeIn-bottom">
              <div class="bottom d-flex align-items-center justify-content-center">
                <a href="#"><span class="lnr lnr-cart"></span></a>
                <a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
              </div>
            </div>
          </div>
          <div class="price">
            <h5 class="text-white">Long Sleeve shirt</h5>
            <h3 class="text-white">$150.00</h3>
          </div>
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
            <li>
              <h3>
                <a href="">Giày thể thao nữ</a>
              </h3>
            </li>
            <li>
              <h3>
                <a href="">Dép nữ</a>
              </h3>
            </li>
            <li>
              <h3>
                <a href="">Giày búp bê</a>
              </h3>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 single-product">
          <div class="content">
            <div class="content-overlay"></div>
            <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/l5.jpg') }}" alt="">
            <div class="content-details fadeIn-bottom">
              <div class="bottom d-flex align-items-center justify-content-center">
                <a href="#"><span class="lnr lnr-cart"></span></a>
                <a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
              </div>
            </div>
          </div>
          <div class="price">
            <h5>Long Sleeve shirt</h5>
            <h3>$150.00</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 single-product">
          <div class="content">
            <div class="content-overlay"></div>
            <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/l6.jpg') }}" alt="">
            <div class="content-details fadeIn-bottom">
              <div class="bottom d-flex align-items-center justify-content-center">
                <a href="#"><span class="lnr lnr-cart"></span></a>
                <a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
              </div>
            </div>
          </div>
          <div class="price">
            <h5>Long Sleeve shirt</h5>
            <h3>$150.00 <del class="text-gray">$100.00</del></h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 single-product">
          <div class="content">
            <div class="content-overlay"></div>
            <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/l7.jpg') }}" alt="">
            <div class="content-details fadeIn-bottom">
              <div class="bottom d-flex align-items-center justify-content-center">
                <a href="#"><span class="lnr lnr-cart"></span></a>
                <a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
              </div>
            </div>
          </div>
          <div class="price">
            <h5>Long Sleeve shirt</h5>
            <h3>$150.00</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 single-product">
          <div class="content">
            <div class="content-overlay"></div>
            <img class="content-image img-fluid d-block mx-auto" src="{{ asset('public/img/l8.jpg') }}" alt="">
            <div class="content-details fadeIn-bottom">
              <div class="bottom d-flex align-items-center justify-content-center">
                <a href="#"><span class="lnr lnr-cart"></span></a>
                <a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
              </div>
            </div>
          </div>
          <div class="price">
            <h5>Long Sleeve shirt</h5>
            <h3>$150.00</h3>
          </div>
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
            <img src="img/cd.png" class="img-fluid cd-img" alt="">
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
        <h1 class="mb-10">Sản phẩm mới</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r1.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r2.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r3.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r4.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r5.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r6.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r7.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r8.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End related-product Area -->
  <!-- Start related-product Area --> 
  <section class="related-product-area section-gap" id="latest">
    <div class="container">
    <div class="related-content">
      <div class="title text-center">
        <h1 class="mb-10">Sản phẩm bán chạy</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r5.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r6.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r7.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r8.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r9.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r10.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r11.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="single-search-product d-flex">
          <a href="#"><img src="{{ asset('public/img/r12.jpg') }}" alt=""></a>
          <div class="desc">
            <a href="#" class="title">Black lace Heels</a>
            <div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End related-product Area -->
  <!-- Start brand Area -->
  <section class="brand-area pb-100">
    <div class="container">
      <div class="row logo-wrap">
        <a class="col single-img" href="#">
        <img class="d-block mx-auto" src="img/br1.png" alt="">
        </a>
        <a class="col single-img" href="#">
        <img class="d-block mx-auto" src="img/br2.png" alt="">
        </a>
        <a class="col single-img" href="#">
        <img class="d-block mx-auto" src="img/br3.png" alt="">
        </a>
        <a class="col single-img" href="#">
        <img class="d-block mx-auto" src="img/br4.png" alt="">
        </a>
        <a class="col single-img" href="#">
        <img class="d-block mx-auto" src="img/br5.png" alt="">
        </a>
      </div>
    </div>
  </section>
  <!-- End brand Area -->    
@endsection