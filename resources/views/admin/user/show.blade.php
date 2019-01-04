@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          @lang('user.show')
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-5 col-md-offset-3">
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ $user->profile->avatar }}" alt="User profile picture">
              <h3 class="profile-username text-center">{{ $user->profile->name }}</h3>
              <table class="table table-bordered">
                <tr>
                  <th>#</th>
                  <th>@lang('user.table.info')</th>
                </tr>
                <tr>
                  <td>@lang('user.table.id')</td>
                  <td>{{ $user->id }}</td>
                </tr>
                <tr>
                  <td>@lang('user.table.email')</td>
                  <td>{{ $user->email }}</td>
                </tr>
                <tr>
                  <td>@lang('user.table.name')</td>
                  <td>{{ $user->profile->name }}</td>
                </tr>
                <tr>
                  <td>@lang('user.table.role')</td>
                  <td>{{ $user->role->name }}</td>
                </tr>
                <tr>
                  <td>@lang('user.table.gender')</td>
                  <td>
                    @if ($user->profile->gender === \App\Models\Profile::OTHER)
                      @lang('profile.gender.other')
                    @elseif ($user->profile->gender === \App\Models\Profile::MALE)
                      @lang('profile.gender.male')
                    @else
                      @lang('profile.gender.female')
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>@lang('user.table.phone')</td>
                  <td>{{ $user->profile->phonenumber }}</td>
                </tr>
                <tr>
                  <td>@lang('user.table.address')</td>
                  <td>{{ $user->profile->address }}</td>
                </tr>
                <tr>
                    <td><a class="btn btn-warning btn-xs" href="{{ route('admin.users.index') }}">@lang('common.back')</a></td>
                    <td><a class="btn btn-primary btn-xs" href="">@lang('common.edit')</a></td>
                  </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
