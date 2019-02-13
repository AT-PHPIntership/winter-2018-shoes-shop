@extends('user.module.master')
@section('content')
  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb">
    <div class="container">
      <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
        <div class="col-first">
          <h1>{{ __('checkout.title') }}</h1>
          <nav class="d-flex align-items-center justify-content-start">
            <a href="index.html">{{ __('checkout.home') }}<i class="fa fa-caret-right" aria-hidden="true"></i></a>
            <a href="checkout.html">{{ __('checkout.title') }}</a>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Area -->
  <!-- Start Checkout Area -->
  <div class="container">
    <div class="checkput-login">
      <div class="top-title">
        <p>Returning Customer? <a data-toggle="collapse" href="#checkout-login" aria-expanded="false" aria-controls="checkout-login">Click here to login</a></p>
      </div>
      <div class="collapse" id="checkout-login">
        <div class="checkout-login-collapse d-flex flex-column">
          <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing & Shipping section.</p>
          <form action="#" class="d-block">
            <div class="row">
              <div class="col-lg-4">
                <input type="text" placeholder="Username or Email*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Username or Email*'" required class="common-input mt-10">
              </div>
              <div class="col-lg-4">
                <input type="password" placeholder="Password*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Password*'" required class="common-input mt-10">
              </div>
            </div>
            <div class="d-flex align-items-center flex-wrap">
              <button class="view-btn color-2 mt-20 mr-20"><span>Login</span></button>
              <div class="mt-20">
                <input type="checkbox" class="pixel-checkbox" id="login-1">
                <label for="login-1">Remember me</label>
              </div>
            </div>
          </form>
          <a href="#" class="mt-10">Lost your password?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- End Checkout Area -->
  <!-- Start Billing Details Form -->
  <div class="container">
    <form action="#" class="billing-form mb-100">
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <h3 class="billing-title mt-20 mb-10">{{ __('checkout.billing_details') }}</h3>
          <div class="row">
            <div class="col-lg-6">
              <input type="text" placeholder="{{ __('checkout.customer.name') }}*" onfocus="this.placeholder=''" onblur="this.placeholder = '{{ __('checkout.customer.name') }}*'" required class="common-input">
            </div>
            <div class="col-lg-6">
              <input type="text" placeholder="{{ __('checkout.customer.phone_number') }}*" onfocus="this.placeholder=''" onblur="this.placeholder = '{{ __('checkout.customer.phone_number') }}*'" required class="common-input">
            </div>
            <div class="col-lg-12">
              <input type="text" placeholder="{{ __('checkout.customer.address') }}*" onfocus="this.placeholder=''" onblur="this.placeholder = '{{ __('checkout.customer.address') }}*'" required class="common-input">
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="order-wrapper mt-50">
            <h3 class=" mb-10">{{ __('checkout.order') }}</h3>
            <table class="w-100 table">
              <thead>
                <tr class="row">
                  <th class="col-lg-4">{{ __('cart.table.product') }}</th>
                  <th class="col-lg-4">{{ __('cart.table.quantity') }}</th>
                  <th class="col-lg-4">{{ __('cart.table.total') }}</th>
                </tr>
              </thead>
              <tbody>
                <tr class="row">
                  <td class="col-lg-4"><b>Nike 3</b> (<span>Đỏ</span>-<span>43</span>)</td>
                  <td class="col-lg-4">2</td>
                  <td class="col-lg-4">1.254.200</td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="row">
                  <td class="col-lg-8">{{ __('cart.table.sub_amount') }}</td>
                  <td class="col-lg-4"><span id="cart-sub-amount"></span></td>
                </tr>
                <tr class="row">
                  <td class="col-lg-8">{{ __('cart.code.title') }}</td>
                  <td class="col-lg-4"><span id="cart-code-percent"></span></td>
                </tr>
                <tr class="row">
                  <td class="col-lg-8">{{ __('cart.table.amount') }}</td>
                  <td class="col-lg-4"><span id="cart-amount"></span></td>
                </tr>
                <tr class="row">
                  <td class="col-lg-12">
                    <button type="submit" class="view-btn color-2 w-100 mt-20"><span>{{ __('checkout.title') }}</span></button>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- End Billing Details Form -->
@endsection