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
            <form method="POST" role="form" action="{{ route('admin.promotions.update', $promotion) }}">
              @csrf
              @method('PUT')
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputName">@lang('promotion.table.name') *</label>
                  <input type="hidden" name="id" value="{{ $promotion->id }}">
                  <input type="text" name="name" class="form-control" id="exampleInputName" value="{{ $promotion->name }}">
                  @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputPercent">@lang('promotion.table.percent') *</label>
                  <input type="number" name="percent" class="form-control" id="exampleInputPercent" value="{{ $promotion->percent }}">
                  @if ($errors->has('percent'))
                    <span class="help-block">{{ $errors->first('percent') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputDescription">@lang('promotion.table.description')</label>
                  <input type="text" name="description" class="form-control" id="exampleInputDescription" value="{{ $promotion->description }}">
                  @if ($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputProduct">@lang('promotion.table.product')</label>
                  <select class="form-control select2" multiple="multiple" data-placeholder="@lang('promotion.select')"
                          style="width: 100%;">
                    @foreach ($products as $product)
                      @if (!$promotion->products->isEmpty())
                        @foreach ($promotion->products as $item)
                          <option value="{{ $product->id }}" {{ $product->id === $item->id ? "selected": "" }}>{{ $product->name }}</option>                        
                        @endforeach  
                      @else
                        <option value="{{ $product->id }}">{{ $product->name }}</option>  
                      @endif
                    @endforeach
                  </select>
                  @if ($errors->has('product'))
                    <span class="help-block">{{ $errors->first('product') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputMax_sell">@lang('promotion.table.max_sell') *</label>
                  <input type="number" name="max_sell" class="form-control" id="exampleInputMax_sell" value="{{ $promotion->max_sell }}">
                  @if ($errors->has('max_sell'))
                    <span class="help-block">{{ $errors->first('max_sell') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputStart_date">@lang('promotion.table.start_date') *</label>
                  <input type="date" name="start_date" class="form-control" id="exampleInputStart_date" value="{{ $promotion->start_date }}">
                  @if ($errors->has('start_date'))
                    <span class="help-block">{{ $errors->first('start_date') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputEnd_date">@lang('promotion.table.end_date') *</label>
                  <input type="date" name="end_date" class="form-control" id="exampleInputEnd_date" value="{{ $promotion->end_date }}">
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