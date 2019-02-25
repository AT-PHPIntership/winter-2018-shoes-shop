@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header mb-10">
      <h1>
          {{ __('statistical.product.title') }}
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">{{ __('statistical.product.inventory_product') }}</a></li>
              <li><a href="#tab_2" data-toggle="tab">{{ __('statistical.product.top_sell_product') }}</a></li>
              <li><a href="#tab_3" data-toggle="tab">{{ __('statistical.product.over_product') }}</a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <b>{{ __('statistical.product.inventory_product') }}:</b>
                <a class="btn btn-default btn-xs" href="{{ route('admin.statisticals.product.export', ['str' => 'inventory']) }}">CSV <i class="fa fa-download"></i></a>
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>{{ __('statistical.product.id') }}</th>
                      <th>{{ __('statistical.product.name') }}</th>
                      <th>{{ __('statistical.product.category') }}</th>
                      <th>{{ __('statistical.product.price') }}</th>
                      <th>{{ __('statistical.product.quantity') }}</th>
                      <th>{{ __('statistical.product.total_sold') }}</th>
                      <th>{{ __('statistical.product.inventory') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($inventoryProducts->take(10) as $key => $product)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ formatCurrencyVN($product->original_price) }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->total_sold }}</td>
                        <td class="txt-red">{{ $product->inventory }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="tab_2">
                <b>{{ __('statistical.product.top_sell_product') }}:</b>
                <a class="btn btn-default btn-xs" href="{{ route('admin.statisticals.product.export', ['str' => 'top_sell']) }}">CSV <i class="fa fa-download"></i></a>
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>{{ __('statistical.product.id') }}</th>
                      <th>{{ __('statistical.product.name') }}</th>
                      <th>{{ __('statistical.product.category') }}</th>
                      <th>{{ __('statistical.product.price') }}</th>
                      <th>{{ __('statistical.product.quantity') }}</th>
                      <th>{{ __('statistical.product.total_sold') }}</th>
                      <th>{{ __('statistical.product.inventory') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($topSellProducts->take(10) as $key => $product)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ formatCurrencyVN($product->original_price) }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td class="txt-red">{{ $product->total_sold }}</td>
                        <td>{{ $product->quantity - $product->total_sold }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="tab_3">
                <b>{{ __('statistical.product.over_product') }}:</b>
                <a class="btn btn-default btn-xs" href="{{ route('admin.statisticals.product.export', ['str' => 'over']) }}">CSV <i class="fa fa-download"></i></a>
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>{{ __('statistical.product.id') }}</th>
                      <th>{{ __('statistical.product.name') }}</th>
                      <th>{{ __('statistical.product.category') }}</th>
                      <th>{{ __('statistical.product.price') }}</th>
                      <th>{{ __('statistical.product.quantity') }}</th>
                      <th>{{ __('statistical.product.total_sold') }}</th>
                      <th>{{ __('statistical.product.inventory') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($overProducts->take(10) as $key => $product)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ formatCurrencyVN($product->original_price) }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->total_sold }}</td>
                        <td class="txt-red">{{ $product->inventory }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>var showRevenueUrl = "{{ url('admin/statisticals/revenue') }}";</script>
  <script src="{{ asset('admin/js/show-revenue.js') }}"></script>
@endsection
