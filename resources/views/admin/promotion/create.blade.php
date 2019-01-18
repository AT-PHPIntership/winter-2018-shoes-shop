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
          @include('admin.module.message')
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('promotion.add.title')</h3>
            </div>
            <form method="POST" role="form" action="{{ route('admin.promotions.store') }}">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="promotion-ip-name">@lang('promotion.table.name') *</label>
                  <input type="text" name="name" class="form-control" id="promotion-ip-name" value="{{ old('name') }}">
                  @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="promotion-ip-percent">@lang('promotion.table.percent') *</label>
                  <input type="number" name="percent" class="form-control" id="promotion-ip-percent" value="{{ old('percent') }}">
                  @if ($errors->has('percent'))
                    <span class="help-block">{{ $errors->first('percent') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="promotion-txt-description">@lang('promotion.table.description')</label>
                  <textarea name="description" class="form-control" id="promotion-txt-description">{{ old('description') }}</textarea>
                  @if ($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="promotion-slt-product">@lang('promotion.table.product')</label>
                  <select class="form-control select2" multiple="multiple" data-placeholder="@lang('promotion.select')"
                          style="width: 100%;">
                    @foreach ($products as $product)
                      <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('product_id'))
                    <span class="help-block">{{ $errors->first('product_id') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="promotion-ip-maxsell">@lang('promotion.table.max_sell') *</label>
                  <input type="number" name="max_sell" class="form-control" id="promotion-ip-maxsell" value="{{ old('times') }}">
                  @if ($errors->has('max_sell'))
                    <span class="help-block">{{ $errors->first('max_sell') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="promotion-ip-startdate">@lang('promotion.table.start_date') *</label>
                  <input type="date" name="start_date" class="form-control" id="promotion-ip-startdate" value="{{ old('start_date') }}">
                  @if ($errors->has('start_date'))
                    <span class="help-block">{{ $errors->first('start_date') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="promotion-ip-enddate">@lang('promotion.table.end_date') *</label>
                  <input type="date" name="end_date" class="form-control" id="promotion-ip-enddate" value="{{ old('end_date') }}">
                  @if ($errors->has('end_date'))
                    <span class="help-block">{{ $errors->first('end_date') }}</span>
                  @endif
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">@lang('common.new')</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection