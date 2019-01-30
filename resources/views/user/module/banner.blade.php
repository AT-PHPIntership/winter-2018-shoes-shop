<!-- start banner Area -->
<section class="banner-area relative no-bg" id="home">
  <div class="container-fluid">
    <!-- <div class="row"> -->
    <!-- <div class="row fullscreen align-items-center justify-content-center"> -->
    <!-- <div class="col-lg-6 col-md-12 d-flex align-self-end img-right no-padding">
      <img class="img-fluid" src="img/header-img.png" alt="">
      </div>
      <div class="banner-content col-lg-6 col-md-12">
      <h1 class="title-top"><span>Flat</span> 75%Off</h1>
      <h1 class="text-uppercase">
          It’s Happening <br>
          this Season!
      </h1>
      <button class="primary-btn text-uppercase"><a href="#">Purchase Now</a></button>
      </div>							 -->
    <div class="col-lg-12">
      <div id="carousel-slider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-slider" data-slide-to="1"></li>
          <li data-target="#carousel-slider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100 size-slide" src="{{ asset('public/img/banner.jpg') }}" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100 size-slide" src="{{ asset('public/img/banner4.jpg') }}" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100 size-slide" src="{{ asset('public/img/banner5.jpg') }}" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carousel-slider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-slider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  </div>
</section>
<!-- End banner Area -->