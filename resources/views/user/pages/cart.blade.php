@extends('user.module.master')
@section('content')
  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb">
    <div class="container">
      <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
        <div class="col-first">
          <h1>{{ __('cart.title') }}</h1>
          <nav class="d-flex align-items-center justify-content-start">
            <a href="index.html">{{ __('cart.home') }}<i class="fa fa-caret-right" aria-hidden="true"></i></a>
            <a href="cart.html">{{ __('cart.title') }}</a>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Area -->
  <!-- Start Cart Area -->
  <div class="container">
    <div class="cart-title">
      <div class="row">
        <div class="col-md-5">
          <h6 class="ml-15">{{ __('cart.table.product') }}</h6>
        </div>
        <div class="col-md-2">
          <h6>{{ __('cart.table.price') }}</h6>
        </div>
        <div class="col-md-2">
          <h6>{{ __('cart.table.quantity') }}</h6>
        </div>
        <div class="col-md-2">
          <h6>{{ __('cart.table.total') }}</h6>
        </div>
        <div class="col-md-1">
          <h6>{{ __('cart.table.action') }}</h6>
        </div>
      </div>
    </div>
    <div class="list-cart-item">
    </div>
    <div class="cupon-area d-flex align-items-center justify-content-end flex-wrap">
      <div class="cuppon-wrap d-flex align-items-center flex-wrap">
        <div class="cupon-code">
          <input type="text" class="js-input-code">
          <button class="view-btn color-2 js-apply-code"><span>{{ __('cart.code.apply') }}</span></button>
        </div>
        <a href="#" class="view-btn color-2 have-btn"><span>{{ __('cart.code.question') }}</span></a>
      </div>
    </div>
    <div class="subtotal-area d-flex align-items-center justify-content-end">
      <div class="title text-uppercase">{{ __('cart.table.subtotal') }}</div>
      <div class="subtotal" id="cart-sub-total-price"></div>
    </div>
    <div class="shipping-area d-flex justify-content-end">
      <button class="view-btn color-2 mt-10"><span>{{ __('cart.checkout') }}</span></button>
    </div>
  </div>
  <!-- End Cart Area -->
@endsection