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
          <div class="box-top">
            <a class="btn btn-success btn-md" href="{{ route('admin.users.create') }}">@lang('common.new')</a>
          </div>
        </div>
        <div class="col-md-12">
          @include('admin.module.message')
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('user.list.title')</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">@lang('user.table.id')</th>
                  <th>@lang('user.table.email')</th>
                  <th>@lang('user.table.name')</th>
                  <th>@lang('user.table.role')</th>
                  <th style="width: 140px">@lang('user.table.action')</th>
                </tr>
                @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->profile->name }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        <a class="btn btn-info btn-xs" href="{{ route('admin.users.show', $user->id) }}">@lang('common.show')</a>
                        <a class="btn btn-primary btn-xs" href="{{ route('admin.users.edit', $user->id)}}">@lang('common.edit')</a>
                        <form class="form-inline" action="{{ route('admin.users.destroy', ['id' => $user->id]) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          @if ($user->role_id != \App\Models\Role::ADMIN_ROLE)
                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('@lang('common.message.del_question')')">@lang('common.delete')</button>
                          @endif
                        </form>
                    </td>
                  </tr>
                @endforeach
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                  {{ $users->links() }}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
