@extends('user.module.master')
@section('content')
  <div class="content-wrapper p-t-50">
    @include('user.module.sidebar')
    <div class="content">
      <section class="content-header">
        <h1 class="box-title text-uppercase">@lang('user.manage_order')</h1>
      </section>
      <section class="orders">
      </section>
    </div>
  </div>
@endsection
