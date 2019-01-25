@extends('admin.module.master')
@section('content')
{{-- @dd($product->description) --}}
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-uppercase">{{ trans('product.manage')}}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          @include('admin.module.message')
        </div>
      </div>
      <div class="row"> 
        <div class="col-xs-12">
          <!-- ./product info box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ trans('product.edit')}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" enctype='multipart/form-data' method='POST' action="{{ route('admin.product.update', $product->id) }}">
              @csrf
              @method('PUT')
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-6">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="name">{{ trans('product.name')}}</label>
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                        @if ($errors->has('name'))
                          <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label>{{ trans('product.category')}}</label>
                        <select class="form-control" name="category_id">
                          @foreach($categories as $category)
                            <option {{ ($category->id == $product->category_id) ? "selected" : ""}} value={{$category->id}}>{{$category->name}}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                          <span class="help-block">{{ $errors->first('category_id') }}</span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="price">{{ trans('product.price')}}</label>
                        <input type="text" class="form-control" name="original_price" value="{{ $product->original_price }}">
                        @if ($errors->has('original_price'))
                          <span class="help-block">{{ $errors->first('original_price') }}</span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label>{{ trans('product.description')}}</label>
                        <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                      </div>
                      <div class="form-group">
                        <label>{{ trans('product.images')}}</label>
                        <div class="product-images">
                          <div id="image_preview">
                            @foreach($product->images as $key => $image)
                              <img src="{{ $image->path }}" class="detail-img" alt="Product image">
                            @endforeach
                          </div>
                          <input type="file" id="upload_file" name="upload_file[]"
                           accept="image/gif, image/jpg, image/jpeg, image/png" onchange="preview_image();" multiple/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="detail-type">
                      <label>{{ trans('product.detail_type')}}</label>
                      <div class="margin-b-10">
                        <button type="button" id="add-detail" class="btn btn-success"> + </button>
                        <ul class="detail-menu list-unstyled" id="show-detail">                          
                          @foreach($product->productDetails as $detail)
                            <li class="js-row row margin-y-10">
                              <div class="col-xs-4">
                                <select name="color_id[]" id="color" class="form-control" placeholder="Chọn màu">
                                  @foreach($colors as $val)
                                    <option {{ ($val->id == $detail->color_id) ? "selected" : ""}} value="{{ $val->id}}">{{ $val->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="col-xs-4">
                                <select name="size_id[]" class="form-control" placeholder="Chọn size">
                                  @foreach($sizes as $val)
                                    <option {{ ($val->id == $detail->size_id) ? "selected" : ""}} value="{{ $val->id}}">{{ $val->size}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="col-xs-3">
                                <input name="quantity_type[]" value="{{ $detail->quantity}}" type="quantity_type" class="form-control" placeholder="Số lượng">
                              </div>
                              <div class="col-xs-1">
                                <button type="button" class="js-btn-remove btn"> x </button>
                              </div>
                            </li>
                          @endforeach
                        </ul>
                        @if ($errors->has('color_id'))
                          <span class="help-block">{{ $errors->first('color_id') }}</span>
                        @endif
                        @if ($errors->has('size_id'))
                          <span class="help-block">{{ $errors->first('size_id') }}</span>
                        @endif
                        @if ($errors->has('quantity_type'))
                          <span class="help-block">{{ $errors->first('quantity_type') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">{{ trans('common.submit')}}</button>
                <button type="reset" class="btn btn-default">{{ trans('common.reset')}}</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>
  <script src="{!! asset('admin/js/product_detail.js') !!}"></script>
@endsection
