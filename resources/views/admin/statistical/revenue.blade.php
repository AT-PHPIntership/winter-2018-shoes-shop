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
        <div class="col-md-2">
          <div class="box-top">
            <a class="btn btn-primary btn-md" href=""><i class="fa fa-download"> CSV</i></a>
          </div>
        </div>
        <form action="{{ route('admin.statisticals.revenue') }}" method="GET">
          @csrf
          <div class="col-md-2">
            <div class="box-top">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="from_date" class="form-control pull-right" id="datepicker-from" placeholder="Từ ngày">
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="box-top">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="to_date" class="form-control pull-right" id="datepicker-to" placeholder="Đến ngày">
              </div>
            </div>
          </div>
          <div class="col-md-1">
            <div class="box-top">
              <button type="submit" class="btn btn-default"><i class="fa fa-repeat"></i></button>
            </div>
          </div>
        </form>
      </div>
      <div class="row">
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
                @if (isset($orders))
                  <tbody>
                    @php
                      $total = 0;
                    @endphp
                    @foreach ($orders as $key => $order)
                      <tr>
                        <td>{{ ($key + 1).'.' }}</td>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user ? $order->user->profile->name : $order->customer_name }}</td>
                        <td>{{ $order->code ? $order->code->name : '' }}</td>
                        <td>{{ formatDateVN($order->created_at) }}</td>
                        <td>{{ formatDateVN($order->delivered_at) }}</td>
                        <td>{{ formatCurrencyVN($order->total_amount) }}</td>
                        @php
                          $total += $order->total_amount;
                        @endphp
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="6">{{ __('statistical.revenue.order_total_all') }}</th>
                      <th>{{ formatCurrencyVN($total) }}</th>
                    </tr>
                  </tfoot>
                @endif
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
