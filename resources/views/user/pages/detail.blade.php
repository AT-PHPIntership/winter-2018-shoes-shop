@extends('user.module.master')
@section('content')
{{-- @dd($product) --}}
  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb" style="margin-top: 55px">
    <div class="container">
      <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
        <div>
          <h2 class="text-white py-3">Giày thể thao nam IDE siêu mềm</h2>
          <nav class="d-flex align-items-center justify-content-start">
            <a href="index.html">Trang chủ<i class="fa fa-caret-right" aria-hidden="true"></i></a>
            <span class="text-white">Sản phẩm</span>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Area -->
  <!-- Start Product Details -->
  <div class="container">
    <div class="product-quick-view">
      <div class="row align-items-center">
        <div class="col-12 col-md-6">
          <div class="single_product_thumb">
            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators menu-control">
                @foreach($product->images as $key => $image)
                  <li class="active control-item" data-target="#product_details_slider" data-slide-to="{{$key}}" style="background-image: url({{$image->path}});">
                  </li>
                @endforeach
              </ol>
              <div class="carousel-inner">
                @foreach($product->images as $key => $image)
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="{{$image->path}}" alt="Slide">
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="quick-view-content">
            <div class="top">
              {{-- <h3 class="head">Giày thể thao nam IDE siêu mềm</h3> --}}
              <h3 class="head">{{ $product->name }}</h3>
              <div class="price d-flex align-items-center">
                <span class="lnr lnr-tag"></span>
                <span class="ml-10">{{ $product->original_price }} VNĐ</span>
                {{-- <span class="ml-10">$149.99</span> --}}
              </div>
              {{-- <div class="category">Danh mục: <span>Giày thể thao nam</span></div> --}}
              <div class="category">{{ trans('product.category')}}: <span>{{ $product->category->name }}</span></div>
              @if($product->quantity = $product->total_sold)
                <div class="available">{{ trans('product.status')}}: <span>{{ trans('product.out_stock')}}</span></div>
              @else
                <div class="available">{{ trans('product.status')}}: <span>{{ trans('product.in_stock')}}</span></div>
              @endif
            </div>
            <div class="middle">
              <p class="content">{{ $product->description }}</p>
            </div>
            <div class="add-cart">
              <div class="row">
                <div class="form-group col-md-6 form-select" id="default-select">
                  <label>{{ trans('product.select_color')}}: </label>
                  <select>
                    @foreach($colors as $color)
                      <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6 form-select" id="default-select">
                  <label>{{ trans('product.select_size')}}: </label>
                  <select>
                      @foreach($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->size }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="quantity-container d-flex align-items-center mt-30">
                <label>{{ trans('product.quantity')}}: </label>
                <input type="text" class="quantity-amount ml-15" value="1" />
                <div class="arrow-btn d-inline-flex flex-column">
                    <button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
                    <button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
                </div>
              </div>
              <div class="d-flex mt-20">
              <a href="#" class="view-btn color-2"><span>{{ trans('product.add_cart')}}</span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Product Details -->
@endsection