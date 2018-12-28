@extends('admin.module.masterpage')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-uppercase">{{ trans('category.manage') }}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div style="padding: 16px 0;">
            <button class="btn btn-success btn-sm ad-click-event">
              <a href="{{ route('category.create')}}" style="color: #fff;">{{  trans('common.new') }}</a>
            </button>
          </div>
          @if (session()->has('message'))
            <div id="alert-message">
              <strong style="padding: 10px 20px; display: block;">{{ session('message') }}</strong>
            </div>
            <script type="text/javascript">
              setTimeout(function(){
                document.getElementById("alert-message").innerHTML = '';
              }, 2000);
            </script>
          @endif
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{  trans('category.list') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>{{  trans('common.table.num') }}</th>
                    <th>{{  trans('category.name') }}</th>
                    <th>{{  trans('category.parent_name') }}</th>
                    <th>{{  trans('common.table.action') }}</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                  <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent ? $category->parent->name : "-" }}</td>
                    <td>
                      <button>
                        <a href="{{ route('category.edit', 1)}}" style="color: #fff;">{{  trans('common.edit') }}</a>
                      <button><a href="#">{{  trans('common.delete') }}</a></button>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div lass="row">{{$categories->links()}}</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>
@endsection
