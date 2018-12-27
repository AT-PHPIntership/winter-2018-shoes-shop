@extends('admin.module.masterpage')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-uppercase"> Quản lý danh mục</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div style="padding: 16px 0;">
            <button class="btn btn-success btn-sm ad-click-event">Thêm mới</button>
          </div>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách danh mục</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Danh mục cha</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Giày nam</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Giày thể thao</td>
                    <td>Giày nam</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Giày tây</td>
                    <td>Giày nam</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Giày nữ</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Giày cao gót</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>Phụ kiện</td>
                    <td>-</td>
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
