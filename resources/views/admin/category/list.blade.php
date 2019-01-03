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
              <strong style="padding: 10px 20px; display: block; color: #f00">{{ session('message') }}</strong>
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
              <!-- search form (Optional) -->
              <div class="box-tools">
                <form action="{{ route('category.search')}}" method="post">
                @csrf
                @method('POST')
                  <div class="input-group input-group-sm" style="width: 350px;">
                    <input type="text" name="data_search" class="form-control pull-right" placeholder="Search">
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.search form -->
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
                @php
                  $num =1;
                @endphp
                @foreach($categories as $category)
                  <tr>
                    <td>{{ $num++ }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent ? $category->parent->name : "-" }}</td>
                    <td>
                      <button class="btn btn-primary btn-xs">
                        <a href="{{ route('category.edit', $category->id)}}" style="color: #fff;">{{  trans('common.edit') }}</a>
                      </button>
                      {{ Form::model($category, ['url' => ['/category', $category->id], 'method'=> 'DELETE', 'enctype' => 'multipart/form-data', 'style' => 'display: inline-block;'])}}
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('{{trans('common.message.confirm_delete')}}')">{{  trans('common.delete') }}</button>
                      {{ Form::close()}}
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
