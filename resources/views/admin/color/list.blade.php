@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          @lang('color.title')
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-2">
          <div class="box-top">
            <a class="btn btn-success btn-md" href="{{ route('admin.colors.create') }}">@lang('common.new')</a>
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
              <h3 class="box-title">@lang('color.list.title')</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th>@lang('color.table.id')</th>
                  <th>@lang('color.table.name')</th>
                  <th style="width: 100px">@lang('color.table.action')</th>
                </tr>
                @foreach ($colors as $color)
                  <tr>
                    <td>{{ $color->id }}</td>
                    <td>{{ $color->name }}</td><td>
                      <a class="btn btn-primary btn-xs" href="{{ route('admin.colors.edit', ['id' => $color->id]) }}">@lang('common.edit')</a>
                      <form class="form-inline" action="{{ route('admin.colors.destroy', ['id' => $color->id]) }}" method="POST">
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
                  {{ $colors->links() }}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
