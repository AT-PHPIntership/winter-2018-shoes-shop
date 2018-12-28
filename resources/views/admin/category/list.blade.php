@extends('admin.module.masterpage')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-uppercase">@lang('category.manage')</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div style="padding: 16px 0;">
            <button class="btn btn-success btn-sm ad-click-event">@lang('common.new')</button>
          </div>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">@lang('category.list')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>@lang('common.table.num')</th>
                    <th>@lang('category.name')</th>
                    <th>@lang('category.parent_name')</th>
                    <th>@lang('common.table.action')</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                  <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent ? $category->parent->name : "-" }}</td>
                    <td>
                      <button><a href="#">Sửa</a></button>
                      <button><a href="#">Xóa</a></button>
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
