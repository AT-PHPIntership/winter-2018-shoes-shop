<!-- Modal Quick Product View -->
<div class="modal fade" id="modal-product" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="container relative bg-white">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      <div class="product-quick-view">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div id="quick-view-carousel" class="carousel slide" data-ride="carousel">
              <div id="js-image" class="carousel-inner">
              </div>
              <a class="carousel-control-prev" href="#quick-view-carousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon bg-rgba" aria-hidden="true"></span>
              <span class="sr-only">{{ __('index.quick_view.previous') }}</span>
              </a>
              <a class="carousel-control-next" href="#quick-view-carousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon bg-rgba" aria-hidden="true"></span>
              <span class="sr-only">{{ __('index.quick_view.next') }}</span>
              </a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="quick-view-content">
              <div class="top">
                <h3 id="js-name" class="head"></h3>
                <div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10" id="js-price"></span> <del id="js-original-price" class="ml-10"></del></div>
                <div class="category">{{ __('index.quick_view.category') }}: <span id="js-category"></span></div>
                <div class="available">{{ __('index.quick_view.inventory') }}: <span id="js-inventory"></span></div>
              </div>
              <div class="middle">
                <p class="content" id="js-description"></p>
                <a href="" id="js-link-detail" class="view-full">{{ __('index.quick_view.detail') }} <span class="lnr lnr-arrow-right"></span></a>
              </div>
              <div class="bottom no-bg">
                <div class="d-flex align-items-center">
                    {{ __('index.quick_view.color') }}: 
                  <div class="ml-15 form-group">
                    <select class="form-control" id="js-color">
                      <option value="">{{ __('index.quick_view.default_option') }}</option>
                    </select>
                  </div>
                </div>
                <div class="d-flex align-items-center mt-15">
                    {{ __('index.quick_view.size') }}: 
                  <div class="ml-15 form-group">
                    <select class="form-control" id="js-size">
                      <option value="">{{ __('index.quick_view.default_option') }}</option>
                    </select>
                  </div>
                </div>
                <div class="d-flex align-items-center mt-15">
                    {{ __('index.quick_view.quantity') }}:
                  <input type="number" id="js-quantity" min="0" class="form-control w-30 ml-15" value="0"/>
                </div>
                <div class="d-flex mt-20">
                  <a href="javascript:void(0)" data-product-id="" class="genric-btn primary js-add-cart"><span>{{ __('index.quick_view.add_to_cart') }}</span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var getSizesByColorId = "{{ url('get-sizes-by-color-id') }}";
    var detailProductUrl = "{{ url('detail') }}";  
  </script>
</div>