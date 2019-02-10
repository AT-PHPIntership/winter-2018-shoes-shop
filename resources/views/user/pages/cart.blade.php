@extends('user.module.master')
@section('content')
  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb">
    <div class="container">
      <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
        <div class="col-first">
          <h1>Shopping Cart</h1>
          <nav class="d-flex align-items-center justify-content-start">
            <a href="index.html">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
            <a href="cart.html">Shopping Cart</a>
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
        <div class="col-md-6">
          <h6 class="ml-15">Product</h6>
        </div>
        <div class="col-md-2">
          <h6>Price</h6>
        </div>
        <div class="col-md-2">
          <h6>Quantity</h6>
        </div>
        <div class="col-md-2">
          <h6>Total</h6>
        </div>
      </div>
    </div>
    <div class="list-cart-item">
      <div class="cart-single-item">
        <div class="row align-items-center">
          <div class="col-md-6 col-12">
            <div class="product-item d-flex align-items-center">
              <img id="cart-product-image" src="{{ config('define.image_default_product') }}" class="img-fluid img-product-cart" alt="">
              <div class="row">
                <h6 class="col-md-12" id="cart-product-name">Pixelstore fresh Blackberry</h6>
                <h6 class="col-md-12">Màu: <span id="cart-color">Đỏ</span> | Size: <span id="cart-size">43</span></h6>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-6">
            <div id="cart-product-price" class="price">$360.00</div>
          </div>
          <div class="col-md-2 col-6">
            <div class="quantity-container d-flex align-items-center mt-15">
              <input type="text" id="cart-product-quantity" class="quantity-amount" value="1" />
              <div class="arrow-btn d-inline-flex flex-column">
                <button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
                <button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-12">
            <div class="total" id="cart-total-price">$720.00</div>
          </div>
        </div>
      </div>
    </div>
    <div class="cupon-area d-flex align-items-center justify-content-between flex-wrap">
      <a href="#" class="view-btn color-2"><span>Update Cart</span></a>
      <div class="cuppon-wrap d-flex align-items-center flex-wrap">
        <div class="cupon-code">
          <input type="text">
          <button class="view-btn color-2"><span>Apply</span></button>
        </div>
        <a href="#" class="view-btn color-2 have-btn"><span>Have a Coupon?</span></a>
      </div>
    </div>
    <div class="subtotal-area d-flex align-items-center justify-content-end">
      <div class="title text-uppercase">Subtotal</div>
      <div class="subtotal" id="cart-sub-total-price">$2160.00</div>
    </div>
    <div class="shipping-area d-flex justify-content-end">
      <button class="view-btn color-2 mt-10"><span>Checkout</span></button>
    </div>
  </div>
  <!-- End Cart Area -->
@endsection