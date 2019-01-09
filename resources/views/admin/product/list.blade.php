@extends('admin.module.master')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-uppercase">Quản lý sản phẩm</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box-top">
          <a class="btn btn-success btn-md" href="#">Thêm mới</a>
          </div>
        </div>
        <div class="col-xs-12">
          {{-- @include('admin.module.message') --}}
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách sản phẩm</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Tên danh mục</th>
                    <th>Tổng lượng</th>
                    <th>Đã bán</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Sản phẩm 1</td>
                    <td>10000 Đ</td>
                    <th>Giày nam</th>
                    <td>100</td>
                    <td>10</td>
                    <td>
                        <button class="btn btn-info btn-xs">
                          <a href="#" style="color: #fff;">Chi tiết</a>
                        </button>
                        <button type="submit" class="btn btn-primary btn-xs"> Sửa</button>
                        <button type="submit" class="btn btn-danger btn-xs"> Xóa</button>
                      </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Sản phẩm 2</td>
                    <td>10000 Đ</td>
                    <th>Giày nữ</th>
                    <td>100</td>
                    <td>10</td>
                    <td>
                        <button class="btn btn-info btn-xs">
                          <a href="#" style="color: #fff;">Chi tiết</a>
                        </button>
                        <button type="submit" class="btn btn-primary btn-xs"> Sửa</button>
                        <button type="submit" class="btn btn-danger btn-xs"> Xóa</button>
                      </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Sản phẩm 3</td>
                    <td>10000 Đ</td>
                    <th>Giày nam</th>
                    <td>100</td>
                    <td>10</td>
                    <td>
                      <button class="btn btn-info btn-xs">
                        <a href="#" style="color: #fff;">Chi tiết</a>
                      </button>
                      <button type="submit" class="btn btn-primary btn-xs"> Sửa</button>
                      <button type="submit" class="btn btn-danger btn-xs"> Xóa</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div lass="row">link</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>
@endsection
