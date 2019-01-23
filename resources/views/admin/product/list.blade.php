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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>{{ trans('common.table.num')}}</th>
                    <th>{{ trans('product.name')}}</th>
                    <th>{{ trans('product.price')}}</th>
                    <th>{{ trans('product.category')}}</th>
                    <th>{{ trans('product.quantity')}}</th>
                    <th>{{ trans('product.total_sold')}}</th>
                    <th>{{ trans('common.table.action')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $key => $product)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->original_price }}</td>
                      <td>{{ $product->category->name }}</td>
                      <td>{{ $product->quantity }}</td>
                      <td>{{ $product->total_sold }}</td>
                      <td>
                          <button class="btn btn-info btn-xs">
                          <a href="{{ route('admin.product.show', $product->id)}}" style="color: #fff;">{{ trans('common.detail')}}</a>
                          </button>
                          <button type="" class="btn btn-primary btn-xs">{{ trans('common.edit')}}</button>
                          <button type="" class="btn btn-danger btn-xs">{{ trans('common.delete')}}</button>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div lass="row">{{ $products->links() }}</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>
@endsection
