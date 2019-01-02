@extends('admin.module.masterpage')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          @lang('user.title')
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          {{-- @if (session()->has('message'))
            <div class="alert alert-info fade in alert-dismissible alert-message">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                <strong>{{ session('message') }}</strong>
            </div>
            <script type="text/javascript">
              setTimeout(function(){
                document.getElementById("alert-message").innerHTML = '';
              }, 3000);
            </script>
          @endif --}}
          @if (session()->has('message'))
            <div id="alert-message">
              <strong style="padding: 10px 20px; display: block;">{{ session('message') }}</strong>
            </div>
            <script type="text/javascript">
              setTimeout(function(){
                document.getElementById("alert-message").innerHTML = '';
              }, 3000);
            </script>
          @endif 
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('user.list.title')</h3>
              <a class="btn btn-success btn-xs" href="{{ route('admin.users.create')}}">@lang('user.button.add')</a>            
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="@lang('user.placeholder.search')">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">@lang('user.table.id')</th>
                  <th>@lang('user.table.email')</th>
                  <th>@lang('user.table.name')</th>
                  <th>@lang('user.table.gender')</th>
                  <th>@lang('user.table.phone')</th>
                  <th style="width: 50px">@lang('user.table.avatar')</th>
                  <th>@lang('user.table.role')</th>
                  <th style="width: 100px">@lang('user.table.action')</th>
                </tr>
                @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->profile->name }}</td>
                    <td>{{ $user->profile->gender }}</td>
                    <td>{{ $user->profile->phonenumber }}</td>
                    <td>
                      <img class="direct-chat-img" src="/upload/{{ $user->profile->avatar }}" alt="">
                    </td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                      <a class="btn btn-primary btn-xs" href="{{ route('admin.users.edit', $user->id)}}">@lang('user.button.edit')</a>
                      <a class="btn btn-danger btn-xs" href="{{ route('admin.users.destroy', $user->id)}}">@lang('user.button.delete')</a>
                    </td>
                  </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                  {{ $users->links() }}
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
