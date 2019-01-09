@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          @lang('code.title')
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
              <h3 class="box-title">@lang('code.add.title')</h3>
            </div>
            <form method="POST" role="form" action="{{ route('admin.codes.store') }}">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputName">@lang('code.table.name') *</label>
                  <input type="text" name="name" class="form-control" id="exampleInputName" value="{{ old('name') }}">
                  @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputCategory">@lang('code.table.category') *</label>
                  <select name="category_id" class="form-control" id="exampleInputCategory">
                    <option value="">@lang('code.null')</option>
                    {{-- <option value="null">@lang('code.null')</option> --}}
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('category_id'))
                    <span class="help-block">{{ $errors->first('category_id') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputPercent">@lang('code.table.percent') *</label>
                  <input type="number" name="percent" class="form-control" id="exampleInputPercent" value="{{ old('percent') }}">
                  @if ($errors->has('percent'))
                    <span class="help-block">{{ $errors->first('percent') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputDescription">@lang('code.table.description')</label>
                  <input type="text" name="description" class="form-control" id="exampleInputDescription" value="{{ old('description') }}">
                  @if ($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputTimes">@lang('code.table.times') *</label>
                  <input type="number" name="times" class="form-control" id="exampleInputTimes" value="{{ old('times') }}">
                  @if ($errors->has('times'))
                    <span class="help-block">{{ $errors->first('times') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputStart_date">@lang('code.table.start_date') *</label>
                  <input type="datetime-local" name="start_date" class="form-control" id="exampleInputStart_date" value="{{ old('start_date') }}">
                  @if ($errors->has('start_date'))
                    <span class="help-block">{{ $errors->first('start_date') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputEnd_date">@lang('code.table.end_date') *</label>
                  <input type="datetime-local" name="end_date" class="form-control" id="exampleInputEnd_date" value="{{ old('end_date') }}">
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