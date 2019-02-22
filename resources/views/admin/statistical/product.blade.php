@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          {{ __('statistical.product.title') }}
      </h1>
    </section>
    <section class="content">
      <div class="row mb-100">
        <div class="col-md-6">
          <div class="clearfix">
            <div class="pull-left">
              <div class="box-top">
                <h4><b>Tồn kho</b></h4>
              </div>
            </div>
            <form action="{{ route('admin.statisticals.revenue') }}" method="GET">
              @csrf
              <div class="pull-right">
                <div class="box-top">
                  <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-download"> CSV</i></button>
                </div>
              </div>
            </form>
          </div>
          <div class="box">
            <div class="box-body">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>{{ __('statistical.product.id') }}</th>
                    <th>{{ __('statistical.product.name') }}</th>
                    <th>{{ __('statistical.product.category') }}</th>
                    <th>{{ __('statistical.product.price') }}</th>
                    <th>{{ __('statistical.product.quantity') }}</th>
                    <th>{{ __('statistical.product.inventory') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products->take(10) as $key => $product)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $product->id }}</td>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->category->name }}</td>
                      <td>{{ formatCurrencyVN($product->original_price) }}</td>
                      <td class="text-center">{{ $product->quantity }}</td>
                      <td class="text-center txt-red">{{ $product->quantity - $product->total_sold }}</td>
                    </tr>
                  @endforeach
                </tbody>
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
