<!-- Modal Quick Product View -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="container relative bg-white">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      <div class="product-quick-view">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div id="quick-view-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block" src="{{ asset('public/img/q1.jpg') }}" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block" src="{{ asset('public/img/q1.jpg') }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block" src="{{ asset('public/img/q1.jpg') }}" alt="Third slide">
                </div>
              </div>
              <a class="carousel-control-prev" href="#quick-view-carousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon bg-rgba" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#quick-view-carousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon bg-rgba" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="quick-view-content">
              <div class="top">
                <h3 id="modal-name" class="head"></h3>
                <div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10" id="modal-price">$149.99</span></div>
                <div class="category">Danh mục: <span id="modal-category"></span></div>
                <div class="available">Còn lại: <span id="modal-inventory"></span></div>
              </div>
              <div class="middle">
                <p class="content" id="modal-description"></p>
                <a href="#" class="view-full">Chi tiết <span class="lnr lnr-arrow-right"></span></a>
              </div>
              <div class="bottom no-bg">
                <div class="color-picker d-flex align-items-center">
                  Color: 
                  <div class="default-select ml-15">
                    <select id="modal-color">
                      <option value="1">Xanh</option>
                      <option value="1">Vang</option>
                    </select>
                  </div>
                </div>
                <div class="size-picker d-flex align-items-center mt-15">
                  Size: 
                  <div class="default-select ml-15">
                    <select id="modal-size">
                      <option value="1">43</option>
                      <option value="1">44</option>
                    </select>
                  </div>
                </div>
                <div class="quantity-container d-flex align-items-center mt-15">
                  Quantity:
                  <input type="text" id="modal-quantity" class="quantity-amount ml-15" value="1" />
                  <div class="arrow-btn d-inline-flex flex-column">
                    <button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
                    <button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
                  </div>
                </div>
                <div class="d-flex mt-20">
                  <a href="javascript:void(0)" class="genric-btn primary js-addcart"><span>Add to Cart</span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>