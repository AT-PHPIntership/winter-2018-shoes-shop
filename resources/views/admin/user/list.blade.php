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
        <div class="col-md-2">
          <div class="box-top">
            <a class="btn btn-success btn-md" href="{{ route('admin.users.create') }}">@lang('common.new')</a>
          </div>
        </div>
        <div class="col-md-5">
          {{-- <div class="box-top">
            <div class="al-error">
              <strong>Thêm mới thành công</strong>  
            </div>
          </div> --}}
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('user.list.title')</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="@lang('user.placeholder.search')">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
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
                        <a class="btn btn-primary btn-xs" href="">@lang('common.edit')</a>
                        <a class="btn btn-danger btn-xs" href="">@lang('common.delete')</a>
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
