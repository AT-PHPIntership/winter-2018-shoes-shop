<!-- start footer Area -->		
<footer class="footer-area section-gap">
  <div class="container">
    <div class="row">
      <div class="col-lg-3  col-md-6 col-sm-6">
        <div class="single-footer-widget">
          <h6>{{ __('index.footer.about_us.title') }}</h6>
          <p>
            {{ __('index.footer.about_us.content') }}
          </p>
        </div>
      </div>
      <div class="col-lg-3  col-md-6 col-sm-6">
        <div class="single-footer-widget">
          <h6>{{ __('index.footer.news_letter.title') }}</h6>
          <p>{{ __('index.footer.news_letter.content') }}</p>
        </div>
      </div>
      <div class="col-lg-3  col-md-6 col-sm-6">
        <div class="single-footer-widget mail-chimp">
          <h6 class="mb-20">{{ __('index.footer.instagram.title') }}</h6>
          <ul class="instafeed d-flex flex-wrap">
            <li><img src="{{ asset('public/img/i1.jpg') }}" alt=""></li>
            <li><img src="{{ asset('public/img/i2.jpg') }}" alt=""></li>
            <li><img src="{{ asset('public/img/i3.jpg') }}" alt=""></li>
            <li><img src="{{ asset('public/img/i4.jpg') }}" alt=""></li>
            <li><img src="{{ asset('public/img/i5.jpg') }}" alt=""></li>
            <li><img src="{{ asset('public/img/i6.jpg') }}" alt=""></li>
            <li><img src="{{ asset('public/img/i7.jpg') }}" alt=""></li>
            <li><img src="{{ asset('public/img/i8.jpg') }}" alt=""></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="single-footer-widget">
          <h6>{{ __('index.footer.follow_us.title') }}</h6>
          <div class="footer-social d-flex align-items-center">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-dribbble"></i></a>
            <a href="#"><i class="fa fa-behance"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
      <p class="footer-text m-0">
        {{ __('index.footer.copy_right.title') }} &copy;<script>document.write(new Date().getFullYear());</script> {{ __('index.footer.copy_right.content') }} {{ __('index.footer.copy_right.by') }}</a>
      </p>
    </div>
  </div>
</footer>
