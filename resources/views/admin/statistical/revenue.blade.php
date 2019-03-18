@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          {{ __('statistical.revenue.title') }}
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <form action="{{ route('admin.statisticals.revenue') }}" method="GET">
          @csrf
          <div class="col-md-2">
            <div class="box-top">
              <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-download"> CSV</i></button>
            </div>
          </div>
          <div class="col-md-2">
            <div class="box-top">
              <div class="input-group date wp-from-date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="from_date" autocomplete="off" class="form-control pull-right js-from-date" id="datepicker-from" placeholder="Từ ngày" required>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="box-top">
              <div class="input-group date wp-to-date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="to_date" autocomplete="off" class="form-control pull-right js-to-date" id="datepicker-to" placeholder="Đến ngày" required>
              </div>
            </div>
          </div>
        </form>
        <div class="col-md-1">
          <div class="box-top">
            <a id="js-show-revenue" href="javascript:void(0)" class="btn btn-default"><i class="fa fa-repeat"></i></a>
          </div>
        </div>
      </div>
      <div class="row mb-100">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 60px">#</th>
                    <th>{{ __('statistical.revenue.order_id') }}</th>
                    <th>{{ __('statistical.revenue.user_name') }}</th>
                    <th>{{ __('statistical.revenue.code_name') }}</th>
                    <th>{{ __('statistical.revenue.order_created_at') }}</th>
                    <th>{{ __('statistical.revenue.order_delivered_at') }}</th>
                    <th>{{ __('statistical.revenue.order_total_amount') }}</th>
                  </tr>
                </thead>
                <tbody id="js-body-order">
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="6">{{ __('statistical.revenue.order_total_all') }}</th>
                    <th id="total-all"></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>var showRevenueUrl = "{{ url('admin/statisticals/revenue') }}";</script>
  <script src="{{ asset('admin/js/show-revenue.js') }}"></script>
@endsection
