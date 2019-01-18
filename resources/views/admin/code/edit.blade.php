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
              <h3 class="box-title">@lang('code.edit.title')</h3>
            </div>
            <form method="POST" role="form" action="{{ route('admin.codes.update', ['id' => $code->id]) }}">
              @csrf
              @method('PUT')
              <div class="box-body">
                <div class="form-group">
                  <label for="code-input-name">@lang('code.table.name') *</label>
                  <input type="text" name="name" class="form-control" id="code-input-name" value="{{ $code->name }}">
                  @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="code-slt-category">@lang('code.table.category') *</label>
                  <select name="category_id" class="form-control" id="code-slt-category">
                    <option value="" {{ !$code->category_id ? "selected": "" }}>@lang('code.null')</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}" {{ $code->category_id == $category->id ? "selected": "" }}>{{ $category->name }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('category_id'))
                    <span class="help-block">{{ $errors->first('category_id') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="code-input-percent">@lang('code.table.percent') *</label>
                  <input type="number" name="percent" class="form-control" id="code-input-percent" value="{{ $code->percent }}">
                  @if ($errors->has('percent'))
                    <span class="help-block">{{ $errors->first('percent') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="code-txt-description">@lang('code.table.description')</label>
                  <textarea class="form-control" name="description" id="code-txt-description">{{ $code->description }}</textarea>
                  @if ($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="code-input-times">@lang('code.table.times') *</label>
                  <input type="number" name="times" class="form-control" id="code-input-times" value="{{ $code->times }}">
                  @if ($errors->has('times'))
                    <span class="help-block">{{ $errors->first('times') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="code-input-startdate">@lang('code.table.start_date') *</label>
                  <input type="date" name="start_date" class="form-control" id="code-input-startdate" value="{{ $code->start_date }}">
                  @if ($errors->has('start_date'))
                    <span class="help-block">{{ $errors->first('start_date') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="code-input-enddate">@lang('code.table.end_date') *</label>
                  <input type="date" name="end_date" class="form-control" id="code-input-enddate" value="{{ $code->end_date }}">
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
