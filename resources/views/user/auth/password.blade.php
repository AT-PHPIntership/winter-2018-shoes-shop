@extends('user.module.master')
@section('content')
  <div class="content-wrapper mt-60">
    @include('user.module.sidebar')
    <div class="content">
      <section class="content-header">
        <h3 class="box-title text-uppercase text-center">@lang('user.manage_account')</h3>
      </section>
      <section>
        @include('user.module.message')
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h4>@lang('user.change_password')</h4>
              </div>
              <form class="mb-150" method="POST" role="form" enctype="multipart/form-data" action="{{ route('user.password') }}">
                @csrf
                <div class="box-body row">
                  <div class="col-md-12">
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
                </div>
                <div class="row plr-10">
                  <div class="col-md-4">
                    <div class="form-group">
                      <button type="submit" class="form-control btn btn-primary">@lang('common.submit')</button>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <button type="reset" class="form-control btn btn-warning">@lang('common.reset')</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection
