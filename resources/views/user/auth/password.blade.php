@extends('user.module.master')
@section('content')
  <div class="content-wrapper p-t-50">
    @include('user.module.sidebar')
    <div class="content">
      <section class="content-header">
        <h2 class="box-title text-uppercase">@lang('user.manage_account')</h2>
      </section>
      <section class="">
        @include('user.module.message')
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">@lang('user.change_password')</h3>
              </div>
                <form method="POST" role="form" enctype="multipart/form-data" action="{{ route('user.password') }}" class="form-create col-sm-4 m-b-50">
                  @csrf
                  <div class="box-body row">
                    <div class="form-group">
                      <label for="current_password">@lang('user.table.current_password') *</label>
                      <input type="password" name="current_password" class="form-control">
                      @if ($errors->has('current_password'))
                        <span class="help-block">{{ $errors->first('current_password') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="new_password">@lang('user.table.new_password') *</label>
                      <input type="password" name="new_password" class="form-control">
                      @if ($errors->has('new_password'))
                        <span class="help-block">{{ $errors->first('new_password') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="confirm_password">@lang('user.table.confirm_password') *</label>
                      <input type="password" name="confirm_password" class="form-control">
                      @if ($errors->has('confirm_password'))
                        <span class="help-block">{{ $errors->first('confirm_password') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('common.submit')</button>
                    <button type="reset" class="btn btn-secondry">@lang('common.reset')</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection
