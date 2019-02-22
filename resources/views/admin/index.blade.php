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
              <p>@lang('statistical.product.title')</p>
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
              <span class="info-box-number">{{ $arrRevenue['revenueThisDay'] }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('statistical.revenue.thisWeek')</span>
              <span class="info-box-number">{{ $arrRevenue['revenueThisWeek'] }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('statistical.revenue.thisMonth')</span>
              <span class="info-box-number">{{ $arrRevenue['revenueThisMonth'] }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">@lang('statistical.revenue.thisYear')</span>
              <span class="info-box-number">{{ $arrRevenue['revenueThisYear'] }}</span>
            </div>
          </div>
        </div>
      </div>
      {{-- <h4>@lang('statistical.top_sell.title') 
        <span class="badge bg-green">@lang('statistical.top_sell.sold')</span>
        <span class="badge bg-red">@lang('statistical.top_sell.remain')</span>
      </h4>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <div class="info-box-content no-mg">
              <span class="info-box-text">@lang('statistical.top_sell.thisDay')</span>
              @foreach ($arrTopSell['topSellThisDay'] as $key => $topSell)
                <b class="b-block">
                  <a href="">{{ ($key + 1).'. '.$topSell->name }}</a>
                  <span class="pull-right badge bg-red">{{ $topSell->product_quantity - $topSell->total_sold }}</span>
                  <span class="pull-right badge bg-green">{{ $topSell->total }}</span>
                </b>                 
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <div class="info-box-content no-mg">
              <span class="info-box-text">@lang('statistical.top_sell.thisWeek')</span>
              @foreach ($arrTopSell['topSellThisWeek'] as $key => $topSell)
                <b class="b-block">
                  <a href="">{{ ($key + 1).'. '.$topSell->name }}</a>
                  <span class="pull-right badge bg-red">{{ $topSell->product_quantity - $topSell->total_sold }}</span>
                  <span class="pull-right badge bg-green">{{ $topSell->total }}</span>
                </b>                {{ __('order.status.confirmed') }}
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <div class="info-box-content no-mg">
              <span class="info-box-text">@lang('statistical.top_sell.thisMonth')</span>
              @foreach ($arrTopSell['topSellThisMonth'] as $key => $topSell)
                <b class="b-block">
                  <a href="">{{ ($key + 1).'. '.$topSell->name }}</a>
                  <span class="pull-right badge bg-red">{{ $topSell->product_quantity - $topSell->total_sold }}</span>
                  <span class="pull-right badge bg-green">{{ $topSell->total }}</span>
                </b>                 
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <div class="info-box-content no-mg">
              <span class="info-box-text">@lang('statistical.top_sell.thisYear')</span>
              @foreach ($arrTopSell['topSellThisYear'] as $key => $topSell)
                <b class="b-block">
                  <a href="">{{ ($key + 1).'. '.$topSell->name }}</a>
                  <span class="pull-right badge bg-red">{{ $topSell->product_quantity - $topSell->total_sold }}</span>
                  <span class="pull-right badge bg-green">{{ $topSell->total }}</span>
                </b>                 
              @endforeach
            </div>
          </div>
        </div>
      </div> --}}
      <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('order.order') }}</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="col-md-8">
                <canvas id="pieChart"></canvas>
              </div>
              <div class="col-md-4">
                <ul class="chart-legend clearfix">
                  <li><i class="fa fa-circle-o text-yellow"></i> {{ __('order.status.pending') }}</li>
                  <li><i class="fa fa-circle-o text-green"></i> {{ __('order.status.confirmed') }}</li>
                  <li><i class="fa fa-circle-o text-maroon"></i> {{ __('order.status.processing') }}</li>
                  <li><i class="fa fa-circle-o text-olive"></i> {{ __('order.status.quality_check') }}</li>
                  <li><i class="fa fa-circle-o text-purple"></i> {{ __('order.status.dispatched_item') }}</li>
                  <li><i class="fa fa-circle-o text-navy"></i> {{ __('order.status.delivered') }}</li>
                  <li><i class="fa fa-circle-o text-red"></i> {{ __('order.status.canceled') }}</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
    var confirmed = {
      'title' : "{{ __('order.status.confirmed') }}",
      'quantity' : "{{ $arrQuantityOrder['confirmed'] }}",
    };
    var processing = {
      'title' : "{{ __('order.status.processing') }}",
      'quantity' : "{{ $arrQuantityOrder['processing'] }}",
    };
    var quality_check = {
      'title' : "{{ __('order.status.quality_check') }}",
      'quantity' : "{{ $arrQuantityOrder['quality_check'] }}",
    };
    var dispatched_item = {
      'title' : "{{ __('order.status.dispatched_item') }}",
      'quantity' : "{{ $arrQuantityOrder['dispatched_item'] }}",
    };
    var delivered = {
      'title' : "{{ __('order.status.delivered') }}",
      'quantity' : "{{ $arrQuantityOrder['delivered'] }}",
    };
    var canceled = {
      'title' : "{{ __('order.status.canceled') }}",
      'quantity' : "{{ $arrQuantityOrder['canceled'] }}",
    };
    var pending = {
      'title' : "{{ __('order.status.pending') }}",
      'quantity' : "{{ $arrQuantityOrder['pending'] }}",
    };
  </script>
@endsection
