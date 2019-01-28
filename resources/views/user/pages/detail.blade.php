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
              <div class="col-lg-6">
                <div class="quick-view-carousel-details">                  
                  <div class="item">
                    <img src="upload/Giay_the_thao_sieu_mem_2.jpg" height="300px" width="400px" alt="Product image">
                  </div>
                  <div class="item">
                    <img src="upload/Giay_the_thao_sieu_mem_3.jpg" height="300px" width="400px" alt="Product image">
                  </div>
                  <div class="item">
                    <img src="upload/Giay_the_thao_sieu_mem_4.jpg" height="300px" width="400px" alt="Product image">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="quick-view-content">
                  <div class="top">
                    <h3 class="head">Giày thể thao nam IDE siêu mềm</h3>
                    <div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10">$149.99</span></div>
                    <div class="category">Danh mục: <span>Giày thể thao nam</span></div>
                    <div class="available">Tình trạng: <span>Còn hàng</span></div>
                  </div>
                  <div class="middle">
                    <p class="content">Chất liệu mặt trong: Vải khử mùi.<br>
                      Chất liệu mặt ngoài: Vải sợi thoáng khí cao cấp.<br>
                      Chất liệu đế: Cao su tổng hợp.<br>
                      Size: Đủ size dành cho nam</p>
                  </div>
                  <div class="d-flex mt-20">
                    <a href="#" class="view-btn color-2"><span>Thêm vào giỏ hàng</span></a>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>
@endsection