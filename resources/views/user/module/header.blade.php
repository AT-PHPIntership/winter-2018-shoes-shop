<!-- Start Header Area -->
<header class="default-header">
  <div class="menutop-wrap">
    <div class="menu-top container">
      <div class="d-flex justify-content-between align-items-center">
        <ul class="list">
          <li><a href="tel:+12312-3-1209">+12312-3-1209</a></li>
          <li><a href="mailto:support@colorlib.com">support@colorlib.com</a></li>
        </ul>
        <ul class="list">
          @if(Auth::user())
            <li class="dropdown user user-menu" style="width: 285px;">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">@lang('admin.header.hello') {{ Auth::user()->profile->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">@lang('admin.header.per-info')</a>
                  </div>
                  <div class="pull-right">
                  <a href="{{ route('user.logout') }}" class="btn btn-default btn-flat">{{ trans('login.logout') }}</a>
                  </div>
                </li>
              </ul>
            </li>
          @else
            <li><a href="{{ route('user.login') }}">{{ trans('login.login') }}</a></li>
          @endif          
        </ul>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg  navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#">
      <img src="img/logo.png" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse align-items-center" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li><a href="#home">Home</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Nam
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Giày thể thao nam</a>
              <a class="dropdown-item" href="#">Dép nam</a>
              <a class="dropdown-item" href="#">Sandal nam</a>
            </div>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Nữ
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Giày thể thao nữ</a>
              <a class="dropdown-item" href="#">Dép nữ</a>
              <a class="dropdown-item" href="#">Giày búp bê</a>
            </div>
          </li>
          <li><a href="#">Phụ kiện</a></li>
          <!-- Dropdown -->
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Pages
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="category.html">Category</a>
              <a class="dropdown-item" href="single.html">Single</a>
              <a class="dropdown-item" href="cart.html">Cart</a>
              <a class="dropdown-item" href="checkout.html">Checkout</a>
              <a class="dropdown-item" href="confermation.html">Confermation</a>
              <a class="dropdown-item" href="login.html">Login</a>
              <a class="dropdown-item" href="tracking.html">Tracking</a>
              <a class="dropdown-item" href="generic.html">Generic</a>
              <a class="dropdown-item" href="elements.html">Elements</a>
            </div>
          </li>
        </ul>
      </div>
      <div class="collapse navbar-collapse justify-content-end align-items-center">
        <ul class="navbar-nav">
          <li>
            <div class="form-search">
              <input type="text" name="search" class="ip-search" placeholder="Tìm kiếm">
              <button class="btn-search"><i class="lnr lnr-pencil"></i></button>
            </div>
          </li>
          <li>
            <a class="show-cart" href="">
              <span class="lnr lnr-cart s-30"></span>
              <!-- <span class="js-cnt-item">0</span> -->
            </a>
          </li>              
        </ul>
      </div>
    </div>
  </nav>
</header>
<!-- End Header Area -->