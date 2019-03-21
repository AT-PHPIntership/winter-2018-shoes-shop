@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          @lang('review.title')
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
              <h3 class="box-title">@lang('review.list.title')</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">@lang('review.table.id')</th>
                  <th id="user-name">@lang('review.table.user')</th>
                  <th>@lang('review.table.product')</th>
                  <th>@lang('review.table.content')</th>
                  <th>@lang('review.table.created_at')</th>
                  <th>@lang('review.table.status')</th>
                  <th style="width: 100px">@lang('review.table.action')</th>
                </tr>
                @foreach ($reviews as $review)
                  <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->user->profile->name }}</td>
                    <td>{{ $review->product->name }}</td>
                    <td>{{ $review->content }}</td>
                    <td>{{ formatDateVN($review->created_at) }}</td>
                    <td>
                      <button data-id="{{ $review->id }}" data-status="{{ $review->status }}" class="js-status-cmt btn btn-block {{ $review->status == \App\Models\review::ACTIVE_STATUS ? 'btn-primary' : 'btn-warning' }} btn-xs">{{ $review->status == \App\Models\review::ACTIVE_STATUS ? __('review.table.active') : __('review.table.blocked') }}</button>
                    </td>
                    <td>
                      <form class="form-inline" action="{{ route('admin.reviews.destroy', ['id' => $review->id]) }}" method="POST">
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
                {{ $reviews->links() }}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
