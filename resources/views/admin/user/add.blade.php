@extends('admin.module.masterpage')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          @lang('user.title')
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('user.add.title')</h3>
            </div>
            <form method="POST" role="form" enctype="multipart/form-data" action="{{ route('admin.users.store') }}">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">@lang('user.table.email') *</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{ old('email') }}">
                  @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">@lang('user.table.password') *</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                  @if ($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputConfirmPassword1">@lang('user.table.confirm_password') *</label>
                  <input type="password" name="confirm_password" class="form-control" id="exampleInputConfirmPassword1">
                  @if ($errors->has('confirm_password'))
                    <span class="help-block">{{ $errors->first('confirm_password') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputName">@lang('user.table.name') *</label>
                  <input type="text" name="name" class="form-control" id="exampleInputName" value="{{ old('name') }}">
                  @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputGender">@lang('user.table.gender')</label>
                  <select name="gender" class="form-control" id="exampleInputGender">
                    <option value="0">@lang('user.gender.other')</option>
                    <option value="1">@lang('user.gender.male')</option>
                    <option value="2">@lang('user.gender.female')</option>
                  </select>
                  @if ($errors->has('gender'))
                    <span class="help-block">{{ $errors->first('gender') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputPhoneNumber">@lang('user.table.phone')</label>
                  <input type="text" name="phonenumber" class="form-control" id="exampleInputPhoneNumber" value="{{ old('phonenumber') }}">
                  @if ($errors->has('phone'))
                    <span class="help-block">{{ $errors->first('phone') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputAddress">@lang('user.table.address')</label>
                  <input type="text" name="address" class="form-control" id="exampleInputAddress" value="{{ old('address') }}">
                  @if ($errors->has('address'))
                    <span class="help-block">{{ $errors->first('address') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputAvatar">@lang('user.table.avatar')</label>
                  <input type="file" name="avatar" id="exampleInputAvatar">
                  @if ($errors->has('avatar'))
                    <span class="help-block">{{ $errors->first('avatar') }}</span>
                  @endif
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">@lang('user.button.add')</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
