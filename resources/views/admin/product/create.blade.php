@extends('admin.module.master')
@section('content')
{{-- @dd($categories); --}}
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-uppercase">{{ trans('product.manage')}}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row"> 
        <div class="col-xs-12">
          <!-- ./product info box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tạo mới sản phẩm</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" enctype='multipart/form-data'>
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-6">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name">
                      </div>
                      <div class="form-group">
                        <label>Danh mục</label>
                        <select class="form-control">
                          @foreach($categories as $category)
                            <option value={{$category->id}}>{{$category->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" class="form-control" name="price">
                      </div>
                      <div class="form-group">
                        <label for="quantity">Số lượng</label>
                        <input type="text" class="form-control" name="quantity">
                      </div>                
                      <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="3"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="detail-type">
                      <label>Chi tiết từng loại</label>
                      <div class="margin-b-10">
                        <button type="button" id="add-detail" class="btn btn-success"> + </button>
                        <ul class="detail-menu list-unstyled" id="show-detail">
                          <li class="row margin-y-10">
                            <div class="col-xs-4">
                              <select class="form-control" placeholder="Chọn màu">                                
                                @foreach($colors as $color)
                                  <option value={{$color->id}}>{{$color->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-xs-4">
                              <select class="form-control" placeholder="Chọn size">
                                @foreach($sizes as $size)
                                  <option value={{$size->id}}>{{$size->size}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-xs-3">
                              <input name="quantity_type" type="quantity_type" class="form-control" placeholder="Số lượng">
                            </div>                      
                            <div class="col-xs-1">
                              <button type="button" class="btn"> x </button>
                            </div>
                          </li>
                          <li class="row margin-y-10">
                            <div class="col-xs-4">
                              <select class="form-control" placeholder="Chọn màu">                                
                                @foreach($colors as $color)
                                  <option value={{$color->id}}>{{$color->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-xs-4">
                              <select class="form-control" placeholder="Chọn size">
                                @foreach($sizes as $size)
                                  <option value={{$size->id}}>{{$size->size}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-xs-3">
                              <input name="quantity_type" type="quantity_type" class="form-control" placeholder="Số lượng">
                            </div>                      
                            <div class="col-xs-1">
                              <button type="button" class="btn"> x </button>
                            </div>
                          </li>
                          <li class="row margin-y-10">
                            <div class="col-xs-4">
                              <select class="form-control" placeholder="Chọn màu">                                
                                @foreach($colors as $color)
                                  <option value={{$color->id}}>{{$color->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-xs-4">
                              <select class="form-control" placeholder="Chọn size">
                                @foreach($sizes as $size)
                                  <option value={{$size->id}}>{{$size->size}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-xs-3">
                              <input name="quantity_type" type="quantity_type" class="form-control" placeholder="Số lượng">
                            </div>                      
                            <div class="col-xs-1">
                              <button type="button" class="btn"> x </button>
                            </div>
                          </li>
                          <li class="row margin-y-10">
                            <div class="col-xs-4">
                              <select class="form-control" placeholder="Chọn màu">                                
                                @foreach($colors as $color)
                                  <option value={{$color->id}}>{{$color->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-xs-4">
                              <select class="form-control" placeholder="Chọn size">
                                @foreach($sizes as $size)
                                  <option value={{$size->id}}>{{$size->size}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-xs-3">
                              <input name="quantity_type" type="quantity_type" class="form-control" placeholder="Số lượng">
                            </div>                      
                            <div class="col-xs-1">
                              <button type="button" class="btn"> x </button>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <br>
                    <br>
                    <div class="product-images">
                      <label>Hình ảnh sản phẩm</label>
                      <div class="form-group">
                        <div id="image_preview"></div>
                        <input type="file" id="upload_file" name="upload_file[]" onchange="preview_image();" multiple/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="submit" class="btn btn-default">Reset</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>
  <script src="{!! asset('admin/js/script.js') !!}"></script>
@endsection
