@extends('user.module.master')
@section('content')
  <div class="content-wrapper mt-60">
    @include('user.module.sidebar')
    <div class="content">
      <section class="content-header">
        <h3 class="box-title text-uppercase text-center">@lang('user.manage_account')</h3>
      </section>
      <section class="">
        @include('user.module.message')
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h4>@lang('user.show')</h4>
              </div>
              <form class="m-b-50" method="POST" role="form" enctype="multipart/form-data" action="{{ route('user.profile') }}">
                @csrf
                <div class="box-body row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">@lang('user.table.email') *</label>
                      <input type="email" name="email" class="form-control" disabled value="{{ $user->email }}">
                      @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="name">@lang('user.table.name') *</label>
                      <input type="text" name="name" class="form-control" value="{{ $user->profile->name }}">
                      @if ($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="gender">@lang('user.table.gender')</label>
                      <select name="gender" class="form-control">
                        <option value="{{ \App\Models\Profile::OTHER }}" {{ $user->profile->gender === config('define.gender.other') ? "selected": "" }}>@lang('user.gender.other')</option>
                        <option value="{{ \App\Models\Profile::MALE }}" {{ $user->profile->gender === config('define.gender.male') ? "selected": "" }}>@lang('user.gender.male')</option>
                        <option value="{{ \App\Models\Profile::FEMALE }}" {{ $user->profile->gender === config('define.gender.female') ? "selected": "" }}>@lang('user.gender.female')</option>
                      </select>
                      @if ($errors->has('gender'))
                        <span class="help-block">{{ $errors->first('gender') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="phonenumber">@lang('user.table.phone') *</label>
                      <input type="text" name="phonenumber" class="form-control" value="{{ $user->profile->phonenumber }}">
                      @if ($errors->has('phonenumber'))
                        <span class="help-block">{{ $errors->first('phonenumber') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="address">@lang('user.table.address') *</label>
                      <input type="text" name="address" class="form-control" value="{{ $user->profile->address }}">
                      @if ($errors->has('address'))
                        <span class="help-block">{{ $errors->first('address') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="avatar">@lang('user.table.avatar')</label><br>
                      <div class="p-20">
                        <img id="image-preview" height="250px" width="250px" alt="avatar" src="{{ $user->profile->avatar }}">
                      </div>
                      <input type="file" name="avatar" accept="image/gif, image/jpg, image/jpeg, image/png" onchange="previewImage(this);">
                      @if ($errors->has('avatar'))
                        <span class="help-block">{{ $errors->first('avatar') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <button type="submit" class="form-control btn btn-primary">@lang('common.submit')</button>
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
  <script src="{!! asset('public/js/script.js') !!}"></script>
@endsection
