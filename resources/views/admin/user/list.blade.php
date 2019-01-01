@extends('admin.module.masterpage')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          @lang('user.title')
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('user.list.title')</h3>
              <a class="btn btn-success btn-xs" href="">@lang('user.button.add')</a>   
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="@lang('user.placeholder.search')">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">@lang('user.table.id')</th>
                  <th>@lang('user.table.email')</th>
                  <th>@lang('user.table.name')</th>
                  <th>@lang('user.table.gender')</th>
                  <th>@lang('user.table.phone')</th>
                  <th style="width: 50px">@lang('user.table.avatar')</th>
                  <th>@lang('user.table.role')</th>
                  <th style="width: 100px">@lang('user.table.action')</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>buivanthanh@gmail.com</td>
                  <td>Bui Van Thanh</td>
                  <td>Nam</td>
                  <td>0792760420</td>
                  <td>
                    <img class="direct-chat-img" src="https://lorempixel.com/200/200/?10668" alt="">
                  </td>
                  <td>Admin</td>
                  <td>
                    <a class="btn btn-primary btn-xs" href="">@lang('user.button.edit')</a>
                    <a class="btn btn-danger btn-xs" href="">@lang('user.button.delete')</a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>buivanthanh@gmail.com</td>
                  <td>Bui Van Thanh</td>
                  <td>Nam</td>
                  <td>0792760420</td>
                  <td>
                    <img class="direct-chat-img" src="https://lorempixel.com/200/200/?10668" alt="">
                  </td>
                  <td>Admin</td>
                  <td>
                    <a class="btn btn-primary btn-xs" href="">@lang('user.button.edit')</a>
                    <a class="btn btn-danger btn-xs" href="">@lang('user.button.delete')</a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>buivanthanh@gmail.com</td>
                  <td>Bui Van Thanh</td>
                  <td>Nam</td>
                  <td>0792760420</td>
                  <td>
                    <img class="direct-chat-img" src="https://lorempixel.com/200/200/?10668" alt="">
                  </td>
                  <td>Admin</td>
                  <td>
                    <a class="btn btn-primary btn-xs" href="">@lang('user.button.edit')</a>
                    <a class="btn btn-danger btn-xs" href="">@lang('user.button.delete')</a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>buivanthanh@gmail.com</td>
                  <td>Bui Van Thanh</td>
                  <td>Nam</td>
                  <td>0792760420</td>
                  <td>
                    <img class="direct-chat-img" src="https://lorempixel.com/200/200/?10668" alt="">
                  </td>
                  <td>Admin</td>
                  <td>
                    <a class="btn btn-primary btn-xs" href="">@lang('user.button.edit')</a>
                    <a class="btn btn-danger btn-xs" href="">@lang('user.button.delete')</a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>buivanthanh@gmail.com</td>
                  <td>Bui Van Thanh</td>
                  <td>Nam</td>
                  <td>0792760420</td>
                  <td>
                    <img class="direct-chat-img" src="https://lorempixel.com/200/200/?10668" alt="">
                  </td>
                  <td>Admin</td>
                  <td>
                    <a class="btn btn-primary btn-xs" href="">@lang('user.button.edit')</a>
                    <a class="btn btn-danger btn-xs" href="">@lang('user.button.delete')</a>
                  </td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
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
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection