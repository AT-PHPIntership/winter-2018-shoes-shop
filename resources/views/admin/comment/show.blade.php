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
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('comment.show.title')</h3>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="box-body">
                  <p><b>@lang('comment.table.parent_id'):</b> {{ $comment->content }}</p>
                  <p><b>@lang('comment.table.user'):</b> {{ $comment->user->profile->name }}</p>
                  <p><b>@lang('comment.table.product'):</b> {{ $comment->product->name }}</p>
                </div>
              </div>
              <div class="col-md-12">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('comment.show.list_child_comment')</h3>
                </div>
                <div class="box-body">
                  @if (!$comment->children->isEmpty())
                    <table class="table table-bordered">
                      <tr class="row">
                        <th class="col-md-1">@lang('comment.table.id')</th>
                        <th class="col-md-2">@lang('comment.table.user')</th>
                        <th class="col-md-5">@lang('comment.table.content')</th>
                        <th class="col-md-2">@lang('comment.table.created_at')</th>
                        <th class="col-md-1">@lang('comment.table.status')</th>
                        <th class="col-md-1">@lang('comment.table.action')</th>
                      </tr>
                      @foreach ($comment->children as $childComment)
                        <tr class="row">
                          <td class="col-md-1">{{ $childComment->id }}</td>
                          <td class="col-md-2">{{ $childComment->user->profile->name }}</td>
                          <td class="col-md-5">{{ $childComment->content }}</td>
                          <td class="col-md-2">{{ $childComment->created_at->format('h:i:m m-d-Y') }}</td>
                          <td class="col-md-1">
                            <button data-id="{{ $comment->id }}" data-status="{{ $comment->status }}" class="js-status-cmt btn btn-block {{ $comment->status == \App\Models\Comment::ACTIVE_STATUS ? 'btn-primary' : 'btn-warning' }} btn-xs">{{ $comment->status == \App\Models\Comment::ACTIVE_STATUS ? __('comment.table.active') : __('comment.table.blocked') }}</button>
                          </td>
                          <td class="col-md-1">
                            <form class="form-inline" action="{{ route('admin.comments.destroy', ['id' => $comment->id]) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('@lang('common.message.del_question')')">@lang('common.delete')</button>
                            </form>
                          </td>
                        </tr>  
                      @endforeach
                    </table>  
                  @else
                    <p>@lang('comment.show.no_child_comment')</p>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
<script>
  var changeStatus = "{{ url('admin/comments/change-status') }}";
  var active = "{{ __('comment.table.active') }}";
  var blocked = "{{ __('comment.table.blocked') }}";
</script>
