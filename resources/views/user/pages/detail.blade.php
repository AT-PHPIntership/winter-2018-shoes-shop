@extends('user.module.master')
@section('content')
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
              <ol class="carousel-indicators menu-control" >
                <li class="active control-item" data-target="#product_details_slider" data-slide-to="0" style="background-image: url(upload/1548831458-Giay_the_thao_sieu_mem_4.jpg);">
                </li>
                <li class="control-item" data-target="#product_details_slider" data-slide-to="1" style="background-image: url(upload/1548831458-Giay_the_thao_sieu_mem_4.jpg);">
                </li>
                <li class="control-item" data-target="#product_details_slider" data-slide-to="2" style="background-image: url(upload/1548831458-Giay_the_thao_sieu_mem_4.jpg);">
                </li>
                <li class="control-item" data-target="#product_details_slider" data-slide-to="3" style="background-image: url(upload/1548831458-Giay_the_thao_sieu_mem_4.jpg);">
                </li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="upload/1548831458-Giay_the_thao_sieu_mem_4.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="upload/1548831458-Giay_the_thao_sieu_mem_4.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="upload/1548831458-Giay_the_thao_sieu_mem_4.jpg" alt="Third slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="upload/1548831458-Giay_the_thao_sieu_mem_4.jpg" alt="Fourth slide">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="quick-view-content">
            <div class="top">
              <h3 class="head">Giày thể thao nam IDE siêu mềm</h3>
              <div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10">$149.99</span></div>
              <div class="category">Danh mục: <span>Giày thể thao nam</span></div>
            </div>
            <div class="middle">
              <p class="content">Chất liệu mặt trong: Vải khử mùi.<br>
                Chất liệu mặt ngoài: Vải sợi thoáng khí cao cấp.<br>
                Chất liệu đế: Cao su tổng hợp.<br>
                Size: Đủ size dành cho nam</p>
            </div>
            <div class="add-cart">
              <div class="row">
                <div class="form-group col-md-6 form-select" id="default-select">
                  <label>Chọn màu: </label>
                  <select>
                    <option value="1">City</option>
                    <option value="1">Dhaka</option>
                    <option value="1">Dilli</option>
                    <option value="1">Newyork</option>
                    <option value="1">Islamabad</option>
                  </select>
                </div>
                <div class="form-group col-md-6 form-select" id="default-select">
                  <label>Chọn size: </label>
                  <select>
                    <option value="1">City</option>
                    <option value="1">Dhaka</option>
                    <option value="1">Dilli</option>
                    <option value="1">Newyork</option>
                    <option value="1">Islamabad</option>
                  </select>
                </div>
              </div>
              <div class="quantity-container d-flex align-items-center mt-30">
                <label>Số lượng: </label>
                <input type="text" class="quantity-amount ml-15" value="1" />
                <div class="arrow-btn d-inline-flex flex-column">
                    <button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
                    <button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
                </div>
              </div>
              <div class="d-flex mt-20">
                  <a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Product Details -->
@endsection