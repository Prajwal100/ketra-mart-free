<div class="modal-body p-0 added-to-cart">
    <div class="text-center text-success mb-4">
        <i class="las la-check-circle la-3x"></i>
        <h5>Item added to your cart!</h5>
    </div>
    <div class="media mb-3">
        <img src="{{ asset($data['image']) }}"  class="img-fluid rounded-lg mr-4" alt="Product Image">
        <div class="media-body pt-3 text-left m-auto">
            <h6 class="product-title" style="
            height: 40px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;"
            >
                {{  $product->title  }}
            </h6>
            <div class="mt-3">
                <div class="d-flex align-items-center">
                    <h6 class="text-muted mb-0">Price:</h6>
                    <span class="price ml-auto">{{ Helper::currency_converter($price*$quantity) }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mt-2 d-none d-lg-block">
        <a href="{{ route('home') }}" class="btn btn-outline-cart w-auto mr-2">Back to shopping</a>
        <a href="{{ route('cart') }}" class="btn secondary-btn text-white">Go to your cart</a>
    </div>

    <div class="text-right mt-2 d-flex d-block d-lg-none">
        <a href="{{ route('home') }}" style="font-size: 10px;height: auto;" class="d-flex btn btn-outline-cart mr-2">Back to shopping</a>
        <a href="{{ route('cart') }}" style="font-size: 10px;height: auto;width: 65%" class="btn secondary-btn text-white">Go to your cart</a>
    </div>
</div>
