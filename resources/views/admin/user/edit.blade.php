@extends('admin.module.master')
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
          @include('admin.module.message')
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('user.edit.title')</h3>
            </div>
            <form method="post" role="form" enctype="multipart/form-data" action="{{ route('admin.users.update', $user->id) }}">
              @csrf
              @method('PUT')
              <div class="box-body">
                <div class="form-group">
                  <label>@lang('user.table.email')</label>
                  <input type="text" readonly class="form-control" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName">@lang('user.table.name') *</label>
                  <input type="text" name="name" class="form-control" id="exampleInputName" value="{{ $user->profile->name }}">
                  @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                @if (Auth::user()->id == $user->id)
                  <div class="form-group">
                    <label for="ip-old-password">@lang('user.table.old_password')</label>
                    <input type="password" name="current_password" class="form-control" id="ip-old-password">
                    @if ($errors->has('current_password'))
                      <span class="help-block">{{ $errors->first('current_password') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="ip-password">@lang('user.table.password')</label>
                    <input type="password" name="password" class="form-control" id="ip-password">
                    @if ($errors->has('password'))
                      <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="ip-confirm-password">@lang('user.table.confirm_password')</label>
                    <input type="password" name="password_confirmation" class="form-control" id="ip-confirm-password">
                    @if ($errors->has('password_confirmation'))
                      <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                  </div>
                @endif
                <div class="form-group">
                  <label for="exampleInputGender">@lang('user.table.gender')</label>
                  <select name="gender" class="form-control" id="exampleInputGender">
                    <option value="{{ \App\Models\Profile::OTHER }}" {{ $user->profile->gender === config('define.gender.other') ? "selected": "" }}>@lang('user.gender.other')</option>
                    <option value="{{ \App\Models\Profile::MALE }}" {{ $user->profile->gender === config('define.gender.male') ? "selected": "" }}>@lang('user.gender.male')</option>
                    <option value="{{ \App\Models\Profile::FEMALE }}" {{ $user->profile->gender === config('define.gender.female') ? "selected": "" }}>@lang('user.gender.female')</option>
                  </select>
                  @if ($errors->has('gender'))
                    <span class="help-block">{{ $errors->first('gender') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputPhoneNumber">@lang('user.table.phone')</label>
                  <input type="text" name="phonenumber" class="form-control" id="exampleInputPhoneNumber" value="{{ $user->profile->phonenumber }}">
                  @if ($errors->has('phonenumber'))
                    <span class="help-block">{{ $errors->first('phonenumber') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputAddress">@lang('user.table.address')</label>
                  <input type="text" name="address" class="form-control" id="exampleInputAddress" value="{{ $user->profile->address }}">
                  @if ($errors->has('address'))
                    <span class="help-block">{{ $errors->first('address') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputAvatar">@lang('user.table.avatar')</label>
                  @if (isset($user->profile->avatar))
                    <div class="block-img">
                      @if (!empty($user->profile->avatar))
                        <img class="profile-user-img no-mg img-responsive img-circle" src="{{ $user->profile->avatar }}" alt="">                          
                      @endif
                    </div>
                  @endif
                  <input type="file" name="avatar" id="exampleInputAvatar" onchange="previewAvatar();">
                  @if ($errors->has('avatar'))
                    <span class="help-block">{{ $errors->first('avatar') }}</span>
                  @endif
                  <div class="block-img" id="preview-avatar">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputRole">@lang('user.table.role') *</label>
                  <select name="role_id" class="form-control" id="exampleInputRole">
                    @foreach ($roles as $role)
                      <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? "selected": "" }}>{{ $role->name }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('role_id'))
                    <span class="help-block">{{ $errors->first('role_id') }}</span>
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
