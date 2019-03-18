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
        <p>{{ __('login.have_account') }} <a data-toggle="collapse" href="#checkout-login" aria-expanded="false" aria-controls="checkout-login">{{ __('login.login_here') }}</a></p>
      </div>
      <div class="collapse" id="checkout-login">
        <div class="checkout-login-collapse d-flex flex-column">
          <form method="POST" action="{{ route('user.login') }}" class="d-block">
            @csrf
            <div class="row">
              <div class="col-lg-4">
                <input  type="email" name="email" placeholder="{{ __('login.email') }}*" onfocus="this.placeholder=''" onblur="this.placeholder = '{{ __('login.email') }}*'" required class="common-input mt-10">
                @if ($errors->has('email'))
                  <span class="cl-red">{{ $errors->first('email') }}</span>
                @endif
              </div>
              <div class="col-lg-4">
                <input type="password" name="password" placeholder="{{ __('login.password') }}*" onfocus="this.placeholder=''" onblur="this.placeholder = '{{ __('login.password') }}*'" required class="common-input mt-10">
                @if ($errors->has('password'))
                  <span class="cl-red">{{ $errors->first('password') }}</span>
                @endif
              </div>
            </div>
            <div class="d-flex align-items-center flex-wrap">
              <button class="view-btn color-2 mt-20 mr-20"><span>{{ __('login.login') }}</span></button>
              <div class="mt-20">
                <input type="checkbox" name="remember" class="pixel-checkbox" id="login-1">
                <label for="login-1">{{ __('login.remember_me') }}</label>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Checkout Area -->
  <!-- Start Billing Details Form -->
  <div class="container checkout-content">
    <div class="row">
      <div class="col-lg-6 col-md-6">
        <h3 class="billing-title mt-20 mb-10">{{ __('checkout.billing_details') }}</h3>
        <div class="row">
          <h5 class="col-lg-12">{{ __('checkout.customer.info') }} <small class="user-email" data-id="{{ Auth::user() ? Auth::user()->id : '' }}">{{ Auth::user() ? Auth::user()->email : '' }}</small></h5>
          <div class="col-lg-6">
            <b class="mt-10 d-block">{{ __('checkout.customer.name') }}* <span class="error err-customer-name"></span></b>
            <input type="text" value="{{ Auth::user() ? Auth::user()->profile->name : '' }}" class="customer-name common-input" name="customer_name" placeholder="{{ __('checkout.customer.name') }}" onfocus="this.placeholder=''" onblur="this.placeholder = '{{ __('checkout.customer.name') }}'">
          </div>
          <div class="col-lg-6">
            <b class="mt-10 d-block">{{ __('checkout.customer.phone_number') }}* <span class="error err-phone-number"></span></b>
            <input type="text" value="{{ Auth::user() ? Auth::user()->profile->phonenumber : '' }}" class="phone-number common-input" name="phone_number" placeholder="{{ __('checkout.customer.phone_number') }}" onfocus="this.placeholder=''" onblur="this.placeholder = '{{ __('checkout.customer.phone_number') }}'">
          </div>
          <div class="col-lg-12">
            <b class="mt-10 d-block">{{ __('checkout.customer.address') }}* <span class="error err-shipping-address"></span></b>
            <input type="text" value="{{ Auth::user() ? Auth::user()->profile->address : '' }}" class="shipping-address common-input" name="shipping_address" placeholder="{{ __('checkout.customer.address') }}" onfocus="this.placeholder=''" onblur="this.placeholder = '{{ __('checkout.customer.address') }}'">
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
                  <p class="message-checkout"></p>
                  <span class="pull-left d-none" id="js-your-cart"><a href="{{ route('user.orders') }}">{{ __('cart.your_cart') }}</a></span>
                  <button type="submit" id="js-handle-checkout" class="view-btn color-2 w-100 mt-20"><span>{{ __('checkout.title') }}</span></button>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- End Billing Details Form -->
  <script>
    var handleCheckoutUrl = "{{ url('/checkout/handle-checkout') }}";
    var required = "{{ __('checkout.message.required') }}";
    var errPhoneNumber = "{{ __('checkout.message.err_phone_number') }}"
    var confermationUrl = "{{ url('/checkout/confermation') }}";
  </script>
  <script src="{{ asset('public/js/show-checkout.js') }}"></script>
@endsection