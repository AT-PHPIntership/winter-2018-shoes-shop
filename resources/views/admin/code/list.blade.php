@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          @lang('code.title')
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-2">
          <div class="box-top">
            <a class="btn btn-success btn-md" href="{{ route('admin.codes.create') }}">@lang('common.new')</a>
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
              <h3 class="box-title">@lang('code.list.title')</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">@lang('code.table.id')</th>
                  <th>@lang('code.table.name')</th>
                  <th>@lang('code.table.category')</th>
                  <th>@lang('code.table.percent')</th>
                  <th>@lang('code.table.description')</th>
                  <th>@lang('code.table.times')</th>
                  <th>@lang('code.table.start_date')</th>
                  <th>@lang('code.table.end_date')</th>
                  <th style="width: 100px">@lang('code.table.action')</th>
                </tr>
                @foreach ($codes as $code)
                  <tr>
                    <td>{{ $code->id }}</td>
                    <td>{{ $code->name }}</td>
                    @if ($code->category_id == null)
                      <td>@lang('code.null')</td>
                    @else
                      <td>{{ $code->category->name }}</td>
                    @endif
                    <td>{{ $code->percent }}%</td>
                    <td>{{ $code->description }}</td>
                    <td>{{ $code->times }}</td>
                    <td>{{ date("H:i d-m-Y", strtotime($code->start_date)) }}</td>
                    <td>{{ date("H:i d-m-Y", strtotime($code->end_date)) }}</td>
                    <td>
                      <a class="btn btn-primary btn-xs" href="{{ route('admin.codes.edit', $code->id) }}">@lang('common.edit')</a>
                      <a class="btn btn-danger btn-xs" href="">@lang('common.delete')</a>
                    </td>
                  </tr>
                @endforeach
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                  {{ $codes->links() }}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection