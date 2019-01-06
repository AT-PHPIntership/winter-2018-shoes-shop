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
            <a class="btn btn-success btn-md" href="">@lang('common.new')</a>
          </div>
        </div>
        <div class="col-md-5">
          <div class="box-top">
            <div class="al-success">
              <strong>Thêm mới thành công</strong>  
            </div> 
          </div>
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
                <tr>
                  <td>1</td>
                  <td>Code</td>
                  <td>Null</td>
                  <td>10%</td>
                  <td>Năm mới 2019</td>
                  <td>100</td>
                  <td>10:12:12 04/01/2019</td>
                  <td>10:12:12 08/01/2019</td>
                  <td>
                    <a class="btn btn-primary btn-xs" href="">@lang('common.edit')</a>
                    <a class="btn btn-danger btn-xs" href="">@lang('common.delete')</a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Code</td>
                  <td>Null</td>
                  <td>10%</td>
                  <td>Năm mới 2019</td>
                  <td>100</td>
                  <td>10:12:12 04/01/2019</td>
                  <td>10:12:12 08/01/2019</td>
                  <td>
                    <a class="btn btn-primary btn-xs" href="">@lang('common.edit')</a>
                    <a class="btn btn-danger btn-xs" href="">@lang('common.delete')</a>
                  </td>
                </tr>
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection