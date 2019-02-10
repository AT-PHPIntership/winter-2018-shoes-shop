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
        <div class="col-md-5">
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
        <div class="col-md-1">
          <h6>Action</h6>
        </div>
      </div>
    </div>
    <div class="list-cart-item">
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
      <div class="subtotal" id="cart-sub-total-price"></div>
    </div>
    <div class="shipping-area d-flex justify-content-end">
      <button class="view-btn color-2 mt-10"><span>Checkout</span></button>
    </div>
  </div>
  <!-- End Cart Area -->
@endsection