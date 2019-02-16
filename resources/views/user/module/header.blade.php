<!-- Start Header Area -->
<header class="default-header">
  <div class="menutop-wrap">
    <div class="menu-top container">
      <div class="d-flex justify-content-between align-items-center">
        <ul class="list">
          <li><a href="tel:+12312-3-1209">{{ __('index.header.contact.phone') }}</a></li>
          <li><a href="mailto:support@colorlib.com">{{ __('index.header.contact.email') }}</a></li>
        </ul>
        <ul class="list-user">
          @if(Auth::user())
            <li class="item-user">
              <a href="#">
                <span class="hidden-xs">@lang('admin.header.hello') {{ Auth::user()->profile->name }}</span>
              </a>
              <ul class="list-info">
                <li>
                  <a href="#" class="btn btn-default btn-flat">@lang('admin.header.per-info')</a>
                  <a href="{{ route('user.logout') }}" class="btn btn-default btn-flat">{{ trans('login.logout') }}</a>
                </li>
              </ul>
            </li>
          @else
            <li class="item-user"><a href="{{ route('user.login') }}">{{ trans('login.login') }}</a></li>
          @endif          
        </ul>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg  navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#">
      <img src="{{ asset('public/img/logo.png') }}" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="nav-left collapse navbar-collapse align-items-center" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li><a href="#home">{{ __('index.header.home') }}</a></li>
          @foreach ($parentCategories as $parentCategory)
            <li class="dropdown">
              <a href="" id="navbardrop" data-toggle="dropdown">{{ $parentCategory->name }}</a>
              @if ($parentCategory->children->count())
                <div class="dropdown-menu">
                  @foreach ($parentCategory->children as $subCategory)
                    <a class="dropdown-item" href="#">{{ $subCategory->name }}</a>
                  @endforeach
                </div>
              @endif
            </li>
          @endforeach
        </ul>
      </div>
      <div class="collapse navbar-collapse justify-content-end align-items-center">
        <ul class="navbar-nav">
          <li>
            <div class="form-search">
              <input type="text" name="search" class="ip-search" placeholder="{{ __('index.header.search') }}">
              <button class="btn-search"><i class="lnr lnr-pencil"></i></button>
            </div>
          </li>
          <li>
            <a class="show-cart" href="{{ route('user.cart') }}">
              <span class="lnr lnr-cart s-30"></span>
              <span id="js-total-item">0</span>
            </a>
          </li>              
        </ul>
      </div>
    </div>
  </nav>
</header>
<!-- End Header Area -->
