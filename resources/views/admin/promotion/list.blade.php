@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          @lang('promotion.title')
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-2">
          <div class="box-top">
            <a class="btn btn-success btn-md" href="">@lang('common.new')</a>
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
              <h3 class="box-title">@lang('promotion.list.title')</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">@lang('promotion.table.id')</th>
                  <th>@lang('promotion.table.name')</th>
                  <th>@lang('promotion.table.percent')</th>
                  <th>@lang('promotion.table.description')</th>
                  <th>@lang('promotion.table.max_sell')</th>
                  <th>@lang('promotion.table.total_sold')</th>
                  <th>@lang('promotion.table.start_date')</th>
                  <th>@lang('promotion.table.end_date')</th>
                  <th style="width: 140px">@lang('promotion.table.action')</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Năm 2019</td>
                  <td>10%</td>
                  <td>Đợt 1</td>
                  <td>100</td>
                  <td>30</td>
                  <td>11/01/2019</td>
                  <td>15/01/2019</td>
                  <td>
                    <a class="btn btn-info btn-xs" href="">@lang('common.show')</a>
                    <a class="btn btn-primary btn-xs" href="">@lang('common.edit')</a>                            
                    <form class="form-inline" action="" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('@lang('common.message.del_question')')">@lang('common.delete')</button>
                    </form>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Năm 2019</td>
                  <td>10%</td>
                  <td>Đợt 1</td>
                  <td>100</td>
                  <td>30</td>
                  <td>11/01/2019</td>
                  <td>15/01/2019</td>
                  <td>
                    <a class="btn btn-info btn-xs" href="">@lang('common.show')</a>
                    <a class="btn btn-primary btn-xs" href="">@lang('common.edit')</a>                            
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