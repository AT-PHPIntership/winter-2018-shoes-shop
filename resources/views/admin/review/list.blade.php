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
                  <th>@lang('review.table.score_rating')</th>
                  <th>@lang('review.table.title')</th>
                  <th>@lang('review.table.content')</th>
                  <th>@lang('review.table.created_at')</th>
                  <th>@lang('review.table.status')</th>
                  <th style="width: 100px">@lang('review.table.action')</th>
                </tr>
                @foreach ($reviews as $review)
                  <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->user->profile->name }} @if ($review->is_buy) <i class="fa fa-check-circle green"></i> @endif</td>
                    <td>{{ $review->product->name }}</td>
                    <td>{{ $review->star }}</td>
                    <td>{{ $review->title }}</td>
                    <td>
                      <p>{{ $review->content }} <i class="fa fa-thumbs-up"></i><span>{{ $review->likes ? $review->likes->count() : 0 }}</span></p>
                      @if ($review->images)
                        <p>
                          @foreach ($review->images as $image)
                            <img class="review-img" src="{{ $image->path }}" alt="">                            
                          @endforeach
                        </p>
                      @endif
                    </td>
                    <td>{{ formatDateVN($review->created_at) }}</td>
                    <td>
                      <button data-id="{{ $review->id }}" data-status="{{ $review->status }}" class="js-status-cmt btn btn-block {{ $review->status == \App\Models\Review::ACTIVE_STATUS ? 'btn-primary' : 'btn-warning' }} btn-xs">{{ $review->status == \App\Models\Review::ACTIVE_STATUS ? __('review.table.active') : __('review.table.blocked') }}</button>
                    </td>
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
                {{ $reviews->links() }}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
