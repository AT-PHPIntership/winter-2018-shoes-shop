@extends('user.module.master')
@section('content')
  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb">
    <div class="container">
      <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
        <div class="col-first">
          <h1>Danh mục</h1>
          <nav class="d-flex align-items-center justify-content-start">
            <a href="{{ route('user.index') }}">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
            <a href="javascript:void(0)">Fashon Category</a>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Area -->
  <div class="container">
    <div class="row">
      <div class="col-xl-9 col-lg-8 col-md-7">
        {{-- <h2>Danh sách sản phẩm</h2> --}}
        <!-- Start Filter Bar -->
        <div class="row">
          <div class="col-lg-3 col-md-12 col-sm-6">
            <select class="form-control form-control-sm">
              <option value="1">A-Z</option>
              <option value="1">Z-A</option>
            </select>
          </div>
          <div class="col-lg-9 col-md-12 col-sm-6">
            <span>Lọc theo: </span>
            <ul class="active-filter">
              <li class="filter-list ml-10"><i class="fa fa-window-close" aria-hidden="true"></i>Gionee</li>
              <li class="filter-list ml-10"><i class="fa fa-window-close" aria-hidden="true"></i>Black</li>
              <li class="filter-list ml-10"><i class="fa fa-window-close" aria-hidden="true"></i>Black</li>
              <li class="filter-list ml-10"><i class="fa fa-window-close" aria-hidden="true"></i>Black</li>
              <li class="filter-list ml-10"><i class="fa fa-window-close" aria-hidden="true"></i>Black</li>
            </ul>
          </div>
        </div>
        <!-- End Filter Bar -->
        <!-- Start Best Seller -->
        <section class="lattest-product-area pb-40 category-list">
          <div class="row" id="list-product">
            @foreach ($products as $product)
              <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
                <div class="content">
                  <div class="content-overlay"></div>
                  <img class="content-image img-fluid d-block mx-auto size-product" src="{{ $product->images->first() ? $product->images->first()->path : config('define.image_default_product') }}" alt="">
                  <div class="content-details fadeIn-bottom">
                    <div class="bottom d-flex align-items-center justify-content-center">
                      <a href="#"><span class="lnr lnr-cart"></span></a>
                      <a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
                    </div>
                  </div>
                </div>
                <div class="price">
                  <h5>{{ $product->name }}</h5>
                  <p>{{ $product->promotions->first() ? ($product->original_price * $product->promotions->first()->percent)/100 : $product->original_price }}đ <del class="text-gray">{{ $product->promotions->first() ? $product->original_price.'đ' : '' }}</del></p>
                </div>
              </div>
            @endforeach
          </div>
        </section>
        <!-- End Best Seller -->
        <!-- Start Filter Bar -->
        {{-- <div class="filter-bar d-flex flex-wrap align-items-center public-pag"> --}}
          {{-- <ul class="pagination pagination-sm no-margin pull-right public-pag"> --}}
            {{-- {{ $products->links() }} --}}
          {{-- </ul> --}}
        {{-- </div> --}}
        <!-- End Filter Bar -->
      </div>
      <div class="col-xl-3 col-lg-4 col-md-5">
        {{-- <div class="sidebar-categories">
          <div class="head">Browse Categories</div>
          <ul class="main-categories">
            @foreach ($parentCategories as $parentCategory)
              <li class="main-nav-list">
                <a data-toggle="collapse" href="#cat-{{ $parentCategory->id }}" aria-expanded="false" aria-controls="cat-{{ $parentCategory->id }}"><span class="lnr lnr-arrow-right"></span>{{ $parentCategory->name }}<span class="number">({{ $parentCategory->products->count() }})</span></a>
                @if ($parentCategory->children->count())
                  <ul class="collapse" id="cat-{{ $parentCategory->id }}" data-toggle="collapse" aria-expanded="false" aria-controls="cat-{{ $parentCategory->id }}">
                    @foreach ($parentCategory->children as $subCategory)
                      <li class="main-nav-list child"><a href="{{ route('user.listProductByCatId', ['id' => $subCategory->id]) }}">{{ $subCategory->name }}<span class="number">({{ $subCategory->products->count() }})</span></a></li>
                    @endforeach
                  </ul>
                @endif
              </li>
            @endforeach
          </ul>
        </div> --}}
        <div class="sidebar-filter mt-50">
          {{-- <div class="common-filter">
            <div class="head">Brands</div>
            <form action="#">
              <ul>
                <li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label for="apple">Apple<span>(29)</span></label></li>
                <li class="filter-list"><input class="pixel-radio" type="radio" id="asus" name="brand"><label for="asus">Asus<span>(29)</span></label></li>
                <li class="filter-list"><input class="pixel-radio" type="radio" id="gionee" name="brand"><label for="gionee">Gionee<span>(19)</span></label></li>
                <li class="filter-list"><input class="pixel-radio" type="radio" id="micromax" name="brand"><label for="micromax">Micromax<span>(19)</span></label></li>
                <li class="filter-list"><input class="pixel-radio" type="radio" id="samsung" name="brand"><label for="samsung">Samsung<span>(19)</span></label></li>
              </ul>
            </form>
          </div> --}}
          <div class="common-filter">
            <div class="head">Color</div>
            <form action="#">
              <ul class="list-color">
                @foreach ($colors as $color)
                  <li class="filter-list"><input class="pixel-radio js-radio-color" type="radio" data-id="{{ $color->id }}" name="color"><label for="black">{{ $color->name }}</label></li>                  
                @endforeach
              </ul>
            </form>
          </div>
          <div class="common-filter">
            <div class="head">Size</div>
            <form action="#">
              <ul class="list-size">
                @foreach ($sizes as $size)
                  <li class="filter-list"><input class="pixel-radio js-radio-size" type="radio" data-id="{{ $size->id }}" name="color"><label for="black">{{ $size->size }}</label></li>                  
                @endforeach
              </ul>
            </form>
          </div>
          {{-- <div class="common-filter">
            <div class="head">Price</div>
            <div class="price-range-area">
              <div id="price-range"></div>
              <div class="value-wrapper d-flex">
                <div class="price">Price:</div>
                <span>$</span>
                <div id="lower-value"></div>
                <div class="to">to</div>
                <span>$</span>
                <div id="upper-value"></div>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
  <script>var productsByCatAndColorUrl = "{{ url('category/getProductsByColorIdAndCategoryId') }}";</script>
@endsection
