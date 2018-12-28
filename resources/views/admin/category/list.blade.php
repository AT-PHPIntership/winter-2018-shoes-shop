@extends('admin.module.masterpage')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-uppercase">@lang('category.manage')</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div style="padding: 16px 0;">
            <button class="btn btn-success btn-sm ad-click-event">@lang('category.new')</button>
          </div>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">@lang('category.list')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>@lang('category.table.num')</th>
                    <th>@lang('category.table.category_name')</th>
                    <th>@lang('category.table.category_parent')</th>
                    <th>@lang('category.table.action')</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Giày nam</td>
                    <td>-</td>
                    <td>
                      <button><a href="#">Sửa</a></button>
                      <button><a href="#">Xóa</a></button>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Giày thể thao</td>
                    <td>Giày nam</td>
                    <td>
                      <button><a href="#">Sửa</a></button>
                      <button><a href="#">Xóa</a></button>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Giày tây</td>
                    <td>Giày nam</td>
                    <td>
                      <button><a href="#">Sửa</a></button>
                      <button><a href="#">Xóa</a></button>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Giày nữ</td>
                    <td>-</td>
                    <td>
                      <button><a href="#">Sửa</a></button>
                      <button><a href="#">Xóa</a></button>
                    </td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Giày cao gót</td>
                    <td>-</td>
                    <td>
                      <button><a href="#">Sửa</a></button>
                      <button><a href="#">Xóa</a></button>
                    </td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>Phụ kiện</td>
                    <td>-</td>
                    <td>
                      <button><a href="#">Sửa</a></button>
                      <button><a href="#">Xóa</a></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>
@endsection
