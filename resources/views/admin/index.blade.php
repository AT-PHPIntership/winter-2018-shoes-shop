@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        @lang('admin.index.home')
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $arrTotal['totalOrder'] }}</h3>
              <p>@lang('statistical.order')</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-bag"></i>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">@lang('statistical.more_info') <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $arrTotal['totalProduct'] }}</h3>
              <p>@lang('statistical.product')</p>
            </div>
            <div class="icon">
              <i class="fa fa-black-tie"></i>
            </div>
            <a href="" class="small-box-footer">@lang('statistical.more_info') <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $arrTotal['totalUser'] }}</h3>
              <p>@lang('statistical.user')</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">@lang('statistical.more_info') <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $arrTotal['totalComment'] }}</h3>
              <p>@lang('statistical.comment')</p>
            </div>
            <div class="icon">
              <i class="fa fa-comments"></i>
            </div>
            <a href="" class="small-box-footer">@lang('statistical.more_info') <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <h4>@lang('statistical.revenue.title')</h4>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('statistical.revenue.thisDay')</span>
              <span class="info-box-number">{{ $arrRevenue['revenueThisDay'] }}đ</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('statistical.revenue.thisWeek')</span>
              <span class="info-box-number">{{ $arrRevenue['revenueThisWeek'] }}đ</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('statistical.revenue.thisMonth')</span>
              <span class="info-box-number">{{ $arrRevenue['revenueThisMonth'] }}đ</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('statistical.revenue.thisYear')</span>
              <span class="info-box-number">{{ $arrRevenue['revenueThisYear'] }}đ</span>
            </div>
          </div>
        </div>
      </div>
      <h4>@lang('statistical.top_sell.title')</h4>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-arrow-circle-up"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('statistical.top_sell.thisDay')</span>
              <b class="b-block">Bitis Hunter (3)</b>
              <b class="b-block">Midnight (10)</b>
              <b class="b-block">Giày Sandal A54 (12)</b>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-arrow-circle-up"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('statistical.top_sell.thisWeek')</span>
              <span class="info-box-number">{{ $arrRevenue['revenueThisWeek'] }}đ</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-arrow-circle-up"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('statistical.top_sell.thisMonth')</span>
              <span class="info-box-number">{{ $arrRevenue['revenueThisMonth'] }}đ</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-arrow-circle-up"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('statistical.top_sell.thisYear')</span>
              <span class="info-box-number">{{ $arrRevenue['revenueThisYear'] }}đ</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
