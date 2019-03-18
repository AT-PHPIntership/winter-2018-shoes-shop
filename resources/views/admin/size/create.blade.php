@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          @lang('size.title')
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
              <h3 class="box-title">@lang('size.add.title')</h3>
            </div>
            <form method="POST" role="form" action="{{ route('admin.sizes.store') }}">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="size-input-size">@lang('size.table.name') *</label>
                  <input type="number" name="name" class="form-control" id="size-input-size" value="{{ old('name') }}">
                  @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
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
