@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          @lang('comment.title')
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
              <h3 class="box-title">@lang('comment.list.title')</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">@lang('comment.table.id')</th>
                  <th>@lang('comment.table.user')</th>
                  <th>@lang('comment.table.product')</th>
                  <th>@lang('comment.table.content')</th>
                  <th>@lang('comment.table.parent_id')</th>
                  <th>@lang('comment.table.created_at')</th>
                  <th>@lang('comment.table.updated_at')</th>
                  <th style="width: 100px">@lang('comment.table.action')</th>
                </tr>
                @foreach ($comments as $comment)
                  <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->user->profile->name }}</td>
                    <td>{{ $comment->product->name }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->parent ? $comment->parent->content : '' }}</td>
                    <td>{{ \Carbon\Carbon::parse($comment->created_at)->format(config('define.datetime_vn')) }}</td>
                    <td>{{ \Carbon\Carbon::parse($comment->updated_at)->format(config('define.datetime_vn')) }}</td>
                    <td>
                      <form class="form-inline" action="" method="POST">
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

              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
