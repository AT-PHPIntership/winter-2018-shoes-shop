@extends('user.module.master')
@section('content')
  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb">
    <div class="container">
      <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
        <div class="col-first">
          <h1>{{ __('checkout.confermation.title') }}</h1>
          <nav class="d-flex align-items-center justify-content-start">
            <a href="index.html">{{ __('checkout.home') }}<i class="fa fa-caret-right" aria-hidden="true"></i></a>
            <a href="confermation.html">{{ __('checkout.confermation.title') }}</a>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Area -->
  <!-- Start Checkout Area -->
  <div class="container">
    <div class="confermation">
      <p class="text-center"><b>{{ __('checkout.confermation.thanks') }}</b></p>
      <p class="text-center"><a href="{{ route('user.orders') }}">{{ __('checkout.confermation.your_order') }}</a></p>
    </div>
  </div>
  <!-- End Checkout Area -->
@endsection