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
                  <th style="width: 100px">@lang('comment.table.action')</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Bui Van Thanh</td>
                  <td>San pham 1</td>
                  <td>Toi da mua nhieu san pham</td>
                  <td>San pham tot</td>
                  <td>
                      <form class="form-inline" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('@lang('common.message.del_question')')">@lang('common.delete')</button>
                      </form>
                    </td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Bui Van Thanh</td>
                    <td>San pham 1</td>
                    <td>Toi da mua nhieu san pham</td>
                    <td>San pham tot</td>
                    <td>
                      <form class="form-inline" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('@lang('common.message.del_question')')">@lang('common.delete')</button>
                      </form>
                    </td>
                  </tr>
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
