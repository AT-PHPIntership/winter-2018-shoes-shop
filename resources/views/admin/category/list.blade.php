@extends('admin.module.master')
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
          <div class="box-top">
          <a class="btn btn-success btn-md" href="{{ route('admin.category.create')}}">{{ trans('common.new') }}</a>
          </div>
        </div>
        <div class="col-xs-12">
          @include('admin.module.message')
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ trans('category.list') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>{{ trans('common.table.num') }}</th>
                    <th>{{ trans('category.table.name') }}</th>
                    <th>{{ trans('category.table.parent_name') }}</th>
                    <th>{{ trans('common.table.action') }}</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($categories as $key => $category)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent ? $category->parent->name : "-" }}</td>
                    <td>
                      <button class="btn btn-primary btn-xs">
                        <a href="{{ route('admin.category.edit', $category->id)}}" style="color: #fff;">{{  trans('common.edit') }}</a>
                      </button>
                      {{ Form::model($category, ['url' => ['admin/category', $category->id], 'method'=> 'DELETE', 'enctype' => 'multipart/form-data', 'style' => 'display: inline-block;'])}}
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('{{trans('common.message.confirm_delete')}}')">{{  trans('common.delete') }}</button>
                      {{ Form::close()}}
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div lass="row">{{ $categories->links() }}</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>
@endsection
