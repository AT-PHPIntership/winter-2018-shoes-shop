@extends('user.module.master')
@section('content')
  <div class="content-wrapper p-60">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          @include('user.module.message')
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">@lang('user.register_account')</h3>
            </div>
            <form method="POST" role="form" enctype="multipart/form-data" action="{{ route('user.register') }}">
              @csrf
              <div class="box-body row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputName">@lang('user.table.name') *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                      <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputGender">@lang('user.table.gender')</label>
                    <select name="gender" class="form-control">
                      <option value="">@lang('user.select')</option>
                      <option value="{{ \App\Models\Profile::OTHER }}">@lang('user.gender.other')</option>
                      <option value="{{ \App\Models\Profile::MALE }}">@lang('user.gender.male')</option>
                      <option value="{{ \App\Models\Profile::FEMALE }}">@lang('user.gender.female')</option>
                    </select>
                    @if ($errors->has('gender'))
                      <span class="help-block">{{ $errors->first('gender') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPhoneNumber">@lang('user.table.phone') *</label>
                    <input type="text" name="phonenumber" class="form-control" value="{{ old('phonenumber') }}">
                    @if ($errors->has('phonenumber'))
                      <span class="help-block">{{ $errors->first('phonenumber') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputAddress">@lang('user.table.address') *</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                    @if ($errors->has('address'))
                      <span class="help-block">{{ $errors->first('address') }}</span>
                    @endif
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">@lang('user.table.email') *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                      <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">@lang('user.table.password') *</label>
                    <input type="password" name="password" class="form-control">
                    @if ($errors->has('password'))
                      <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputConfirmPassword1">@lang('user.table.confirm_password') *</label>
                    <input type="password" name="confirm_password" class="form-control">
                    @if ($errors->has('confirm_password'))
                      <span class="help-block">{{ $errors->first('confirm_password') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputAvatar">@lang('user.table.avatar')</label>
                    <input type="file" name="avatar" accept="image/gif, image/jpg, image/jpeg, image/png">
                    @if ($errors->has('avatar'))
                      <span class="help-block">{{ $errors->first('avatar') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">@lang('user.register')</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
