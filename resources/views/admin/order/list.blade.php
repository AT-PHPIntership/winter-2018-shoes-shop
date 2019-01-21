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
                  <th>@lang('order.table.ship_to')</th>
                  <th>@lang('order.table.phone_to')</th>
                  <th>@lang('order.table.ordered_at')</th>
                  <th>@lang('order.table.shipped_at')</th>
                  <th>@lang('order.table.status')</th>
                  <th class="w-140">@lang('order.table.action')</th>
                </tr>
                @foreach ($orders as $order)
                  <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->id }}</td>
                    <td>FSSDK</td>
                    <td>1000000</td>
                    <td>10 Nguyễn Văn Thoại, Đà Nẵng</td>
                    <td>0905678965</td>
                    <td>22/01/2019</td>
                    <td>25/01/2019</td>
                    <td><span class="badge bg-yellow">Đang chờ</span></td>
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
                  
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
