@extends('admin.module.master')
@section('content')
<style>
  .product-menu {
    list-style-type: none;
  }
  .product-item {
    padding: 5px 10px;
    float: left;
  }
  .product-img {
    height: 80px;
    width: 80px;
  }
  .product-picture {
    height: 250px;
    width: 250px
  }

</style>
{{-- @dd($product->images->first()) --}}
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-uppercase">{{ trans('product.manage')}}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- . information box -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title text-uppercase">{{ trans('product.info')}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-7">
                  <p><strong>{{ $product->name}}</strong></p>
                  <p>{{ trans('product.price')}}: {{ $product->original_price}} VNĐ</p>
                  <p>{{ trans('product.quantity')}}: {{ $product->quantity}}</p>
                  <p>{{ trans('product.total_sold')}}: {{ $product->total_sold}}</p>                  
                  <p>{{ trans('product.description')}}: {{ $product->description ? $product->description : '-'}}</p>
                  <ul class="product-menu">
                    @foreach($product->images as $key => $image)
                      <li class="product-item"><img src="{{ $image->path }}" class="product-img" alt="Product image"></li>
                    @endforeach
                  </ul>
                </div>
                <div class="col-md-5">
                  <div class="picture">
                    <img src="{{ $product->images->first()->path }}" class="product-picture" alt="Product image">
                  </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.information box -->
          <!-- .detail box -->
          <div class="box">
              <div class="box-header">
                <h3 class="box-title text-uppercase">{{ trans('product.detail')}}</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>{{ trans('common.table.num')}}</th>
                      <th>{{ trans('product.name')}}</th>
                      <th>{{ trans('product.color')}}</th>
                      <th>{{ trans('product.size')}}</th>
                      <th>{{ trans('product.quantity')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($product->productDetails as $key => $detail)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $detail->color->name }}</td>
                        <td>{{ $detail->size->size }}</td>
                        <td>{{ $detail->quantity }}</td>                
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div lass="row"></div>
              <!-- /.box-body -->
            </div>
            <!-- /.detail box -->
        </div>
      </div>
    </section>
  </div>
@endsection
