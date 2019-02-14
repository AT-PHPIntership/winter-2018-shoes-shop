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
    {{-- <form action="{{ route('user.handleCheckout') }}" method="POST" class="billing-form mb-100"> --}}
      {{-- @csrf --}}
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <h3 class="billing-title mt-20 mb-10">{{ __('checkout.billing_details') }}</h3>
          <div class="row">
            <div class="col-lg-6">
              <input type="text" class="customer-name common-input" name="customer_name" placeholder="{{ __('checkout.customer.name') }}*" onfocus="this.placeholder=''" onblur="this.placeholder = '{{ __('checkout.customer.name') }}*'">
              {{-- @if ($errors->has('customer_name'))
                <span class="help-block">{{ $errors->first('customer_name') }}</span>
              @endif --}}
            </div>
            <div class="col-lg-6">
              <input type="text" class="phone-number common-input" name="phone_number" placeholder="{{ __('checkout.customer.phone_number') }}*" onfocus="this.placeholder=''" onblur="this.placeholder = '{{ __('checkout.customer.phone_number') }}*'">
              {{-- @if ($errors->has('phone_number'))
                <span class="help-block">{{ $errors->first('phone_number') }}</span>
              @endif --}}
            </div>
            <div class="col-lg-12">
              <input type="text" class="shipping-address common-input" name="shipping_address" placeholder="{{ __('checkout.customer.address') }}*" onfocus="this.placeholder=''" onblur="this.placeholder = '{{ __('checkout.customer.address') }}*'">
              {{-- @if ($errors->has('shipping_address'))
                <span class="help-block">{{ $errors->first('shipping_address') }}</span>
              @endif --}}
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="order-wrapper mt-50">
            <h3 class=" mb-10">{{ __('checkout.order') }}</h3>
            <table class="w-100 table">
              <thead>
                <tr class="row">
                  <th class="col-lg-6">{{ __('cart.table.product') }}</th>
                  <th class="col-lg-2">{{ __('cart.table.quantity') }}</th>
                  <th class="col-lg-4">{{ __('cart.table.total') }}</th>
                </tr>
              </thead>
              <tbody class="list-checkout-item">
              </tbody>
              <tfoot>
                <tr class="row">
                  <td class="col-lg-8">{{ __('cart.table.sub_amount') }}</td>
                  <td class="col-lg-4"><span id="checkout-sub-amount"></span></td>
                </tr>
                <tr class="row">
                  <td class="col-lg-8">{{ __('cart.code.title') }} (<small id="checkout-code-name"></small>)</td>
                  <td class="col-lg-4">-<span id="checkout-code-decrease"></span></td>
                </tr>
                <tr class="row">
                  <td class="col-lg-8">{{ __('cart.table.amount') }}</td>
                  <td class="col-lg-4"><span id="checkout-amount"></span></td>
                </tr>
                <tr class="row">
                  <td class="col-lg-12">
                    <button type="submit" id="js-handle-checkout" class="view-btn color-2 w-100 mt-20"><span>{{ __('checkout.title') }}</span></button>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    {{-- </form> --}}
  </div>
  <!-- End Billing Details Form -->
  <script src="{{ asset('public/js/show-checkout.js') }}"></script>
  <script>var handleCheckoutUrl = "{{ url('/checkout/handle-checkout') }}";</script>
@endsection