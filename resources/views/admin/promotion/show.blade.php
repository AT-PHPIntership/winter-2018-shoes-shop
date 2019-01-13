@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          @lang('promotion.title')
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('promotion.show.title')</h3>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="box-body">
                  <p><b>@lang('promotion.table.name'):</b> {{ $promotion->name }}</p>
                  <p><b>@lang('promotion.table.percent'):</b> {{ $promotion->percent }}%</p>
                  <p><b>@lang('promotion.table.description'):</b> {{ $promotion->description }}</p>
                  <p><b>@lang('promotion.table.max_sell'):</b> {{ $promotion->max_sell }}</p>
                  <p><b>@lang('promotion.table.total_sold'):</b> {{ $promotion->total_sold }}</p>
                  <p><b>@lang('promotion.table.start_date'):</b> {{ convertToDateVN($promotion->start_date) }}</p>
                  <p><b>@lang('promotion.table.end_date'):</b> {{ convertToDateVN($promotion->end_date) }}</p>
                  <a class="btn btn-warning btn-xs" href="{{ route('admin.promotions.index') }}">@lang('common.back')</a>
                  <a class="btn btn-primary btn-xs" href="">@lang('common.edit')</a>
                </div>
              </div>
              <div class="col-md-6">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('promotion.show.list-product')</h3>
                </div>
                <div class="box-body">
                  @if (!$promotion->products->isEmpty())
                    <table class="table table-bordered">
                      <tr>
                        <th style="width: 10px">@lang('promotion.table.id')</th>
                        <th>@lang('promotion.table.product')</th>
                        <th>@lang('promotion.table.category')</th>
                      </tr>
                      @foreach ($promotion->products as $product)
                        <tr>
                          <td>{{ $product->id }}</td>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->category->name }}</td>
                        </tr>  
                      @endforeach
                    </table>  
                  @else
                    <p>@lang('promotion.show.no-product')</p>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection