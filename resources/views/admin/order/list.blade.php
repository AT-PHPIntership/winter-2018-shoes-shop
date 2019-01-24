@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          @lang('order.title')
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-2">
          <div class="box-top">
            <a class="btn btn-success btn-md" href="">@lang('common.new')</a>
          </div>
        </div>
        <div class="col-md-12">
          @include('admin.module.message')
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('order.list.title')</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th class="w-10">@lang('order.table.id')</th>
                  <th>@lang('order.table.user')</th>
                  <th>@lang('order.table.code')</th>
                  <th>@lang('order.table.amount')</th>
                  <th>@lang('order.table.created_at')</th>
                  <th>@lang('order.table.delivered_at')</th>
                  <th>@lang('order.table.status')</th>
                  <th class="w-100">@lang('order.table.action')</th>
                </tr>
                @foreach ($orders as $order)
                  <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user !== null ? $order->user->profile->name : $order->buyer_name }}</td>
                    <td>{{ $order->code !== null ? $order->code->name : '' }}</td>
                    <td>{{ $order->amount }}</td>
                    <td>{{ formatDateVN($order->created_at) }}</td>
                    <td>{{ formatDateVN($order->delivered_at) }}</td>
                    <td>
                      @switch($order->status)
                        @case(\App\Models\Order::CONFIRMED_STATUS)
                          <span class="label label-primary">@lang('order.status.confirmed')</span>
                          @break
                        @case(\App\Models\Order::PROCESSING_STATUS)
                          <span class="label bg-maroon">@lang('order.status.processing')</span>
                          @break
                        @case(\App\Models\Order::QUALITY_CHECK_STATUS)
                          <span class="label bg-olive">@lang('order.status.quality_check')</span>
                          @break
                        @case(\App\Models\Order::DISPATCHED_ITEM_STATUS)
                          <span class="label bg-purple">@lang('order.status.dispatched_item')</span>
                          @break
                        @case(\App\Models\Order::DELIVERED_STATUS)
                          <span class="label bg-navy">@lang('order.status.delivered')</span>
                          @break
                        @case(\App\Models\Order::CANCELED_STATUS)
                          <span class="label label-danger">@lang('order.status.canceled')</span>
                          @break
                        @default
                          <span class="label label-warning">@lang('order.status.pending')</span>
                          @break
                      @endswitch
                    </td>
                    <td>
                      <a class="btn btn-info btn-xs" href="">@lang('common.show')</a>
                      <form class="form-inline" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('@lang('common.message.del_question')')">@lang('common.delete')</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                {{ $orders->links() }}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
