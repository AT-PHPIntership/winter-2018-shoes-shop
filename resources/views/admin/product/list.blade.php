@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-uppercase">{{ trans('product.manage')}}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box-top">
            <a class="btn btn-success btn-md" href="{{ route('admin.product.create')}}">{{ trans('common.new')}}</a>
            <a class="btn btn-success btn-md" href="{{route('admin.product.import')}}">{{ trans('common.upload')}}</a>
            <a class="btn btn-success btn-md" href="{{route('admin.product.export.sample')}}"><i class="fa fa-download">{{ trans('common.sample')}}</i></a>
          </div>
        </div>
        <div class="col-xs-12">
          @include('admin.module.message')
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ trans('product.list')}}</h3>
              <a class="btn btn-default btn-xs" href="{{ route('admin.product.export.data', ['str' => 'inventory']) }}">CSV <i class="fa fa-download"></i></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>{{ trans('product.id')}}</th>
                    <th>{{ trans('product.name')}}</th>
                    <th>{{ trans('product.price')}}</th>
                    <th>{{ trans('product.category')}}</th>
                    <th>{{ trans('product.quantity')}}</th>
                    <th>{{ trans('product.total_sold')}}</th>
                    <th>{{ trans('common.table.action')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                    <tr>
                      <td>{{ $product->id }}</td>
                      <td>{{ $product->name }}</td>
                      <td>{{ formatCurrencyVN($product->original_price) }}</td>
                      <td>{{ $product->category->name }}</td>
                      <td>{{ $product->quantity }}</td>
                      <td>{{ $product->total_sold }}</td>
                      <td>
                          <button class="btn btn-info btn-xs">
                            <a href="{{ route('admin.product.show', $product->id)}}" class="text-white">{{ trans('common.detail')}}</a>
                          </button>
                          <button type="button" class="btn btn-primary btn-xs">
                            <a href="{{ route('admin.product.edit', $product->id)}}" class="text-white">{{ trans('common.edit')}}</a>
                          </button>
                          <form class="form-inline" action="{{ route('admin.product.destroy', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('@lang('common.message.del_question')')">{{ trans('common.delete') }}</button>
                          </form>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                  {{ $products->links() }}
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>
@endsection
