@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          @lang('category.list')
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
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('category.trash')</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">@lang('category.table.id')</th>
                  <th>@lang('category.table.name')</th>
                  <th>@lang('category.table.parent_name')</th>
                  <th style="width: 140px">{{ trans('common.table.action') }}</th>
                </tr>
                @foreach ($categories as $category)
                  <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent ? $category->parent->name : "-" }}</td>
                    <td>
                        <form class="form-inline" action="{{ route('admin.categories.restore', ['id' => $category->id]) }}" method="POST">
                          @csrf
                          @method('PATCH')
                          <button type="submit" class="btn btn-info btn-xs">@lang('common.restore')</button>
                        </form>
                        <form class="form-inline" action="{{ route('admin.categories.force-delete', ['id' => $category->id]) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('@lang('common.message.del_question')')">@lang('common.delete')</button>
                        </form>
                    </td>
                  </tr>
                @endforeach
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                  {{ $categories->links() }}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
