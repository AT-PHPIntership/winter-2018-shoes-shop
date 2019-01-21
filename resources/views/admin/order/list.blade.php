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
                  <th>@lang('order.table.price')</th>
                  <th>@lang('order.table.ordered_at')</th>
                  <th>@lang('order.table.shipped_at')</th>
                  <th>@lang('order.table.status')</th>
                  <th class="w-100">@lang('order.table.action')</th>
                </tr>
                @foreach ($orders as $order)
                  <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->profile->name }}</td>
                    <td>{{ $order->code->name }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->ordered_at }}</td>
                    <td>{{ $order->shipped_at }}</td>
                    <td><span class="badge bg-yellow">{{ $order->status }}</span></td>
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
