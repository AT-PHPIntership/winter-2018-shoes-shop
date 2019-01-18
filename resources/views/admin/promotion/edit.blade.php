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
              <h3 class="box-title">@lang('promotion.edit.title')</h3>
            </div>
            <form method="POST" role="form" action="">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="promotion-ip-name">@lang('promotion.table.name') *</label>
                  <input type="text" name="name" class="form-control" id="promotion-ip-name" value="{{ $promotion->name }}">
                  @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="promotion-ip-percent">@lang('promotion.table.percent') *</label>
                  <input type="number" name="percent" class="form-control" id="promotion-ip-percent" value="{{ $promotion->percent }}">
                  @if ($errors->has('percent'))
                    <span class="help-block">{{ $errors->first('percent') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="promotion-ip-description">@lang('promotion.table.description')</label>
                  <textarea name="description" class="form-control" id="promotion-ip-description">{{ $promotion->description }}</textarea>
                  @if ($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="promotion-slt-product">@lang('promotion.table.product')</label>
                  <select class="form-control select2" multiple="multiple" data-placeholder="@lang('promotion.select')"
                          style="width: 100%;">
                    @foreach ($products as $product)
                      @foreach ($promotion->products as $item)
                        <option value="{{ $product->id }}" {{ $product->id === $item->id ? "selected": "" }}>{{ $product->name }}</option>                        
                      @endforeach
                    @endforeach
                  </select>
                  @if ($errors->has('product'))
                    <span class="help-block">{{ $errors->first('product') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="promotion-ip-maxsell">@lang('promotion.table.max_sell') *</label>
                  <input type="number" name="max_sell" class="form-control" id="promotion-ip-maxsell" value="{{ $promotion->max_sell }}">
                  @if ($errors->has('max_sell'))
                    <span class="help-block">{{ $errors->first('max_sell') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="promotion-ip-startdate">@lang('promotion.table.start_date') *</label>
                  <input type="date" name="start_date" class="form-control" id="promotion-ip-startdate" value="{{ $promotion->start_date }}">
                  @if ($errors->has('start_date'))
                    <span class="help-block">{{ $errors->first('start_date') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="promotion-ip-enddate">@lang('promotion.table.end_date') *</label>
                  <input type="date" name="end_date" class="form-control" id="promotion-ip-enddate" value="{{ $promotion->end_date }}">
                  @if ($errors->has('end_date'))
                    <span class="help-block">{{ $errors->first('end_date') }}</span>
                  @endif
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">@lang('common.edit')</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection