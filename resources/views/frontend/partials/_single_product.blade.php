<div class="item">
    <div class="single-products-box">
        <div class="products-image">
            @php
                $photo = json_decode($item->images);
            @endphp
            <a href="{{ route('product.detail', $item->slug) }}">
                @if ($item->product_label != null)
                    <div
                        class="
                @if ($item->product_label == 'hot') hot-tag
                   @elseif($item->product_label == 'sale')
                    sale-tag
                    @else
                    new-tag @endif
                    ">
                        {{ $item->product_label }}
                    </div>
                @endif
                <img style="border:1px solid #ddd"
                    src="{{ $item->thumbnail_image ? asset($item->thumbnail_image) : Helper::DefaultImage() }}"
                    class="main-image" alt="image">

                <img style="border:1px solid #ddd"
                    src="
                                                            {{ $photo != null ? ($photo[0] != null ? asset($photo[0]) : asset($photo[1])) : Helper::DefaultImage() }}"
                    class="hover-image" alt="image">
            </a>
        </div>
        <div class="products-content">
            <div class="wishlist-btn">
                <a href="javascript:;" class="add_to_wishlist" data-product-id="{{ $item->id }}"
                    id="add_to_wishlist_{{ $item->id }}">
                    @php
                        if (\Illuminate\Support\Facades\Auth::check()) {
                            $already_wishlist = \App\Models\Wishlist::where('user_id', auth()->user()->id)
                                ->where('product_id', $item->id)
                                ->first();
                        } else {
                            $already_wishlist = null;
                        }
                    @endphp
                    @if ($already_wishlist != null)
                        <i class="bx bxs-heart wishlist-icon" style="color:#FF757B"></i>
                    @else
                        <i class='bx bxs-heart wishlist-icon'></i>
                    @endif
                </a>
            </div>
            <h3><a href="{{ route('product.detail', $item->slug) }}">{{ ucfirst($item->title) }}</a></h3>
            <div class="price">
                @if ($item->discount > 0)
                    <span class="new-price">{{ Helper::currency_converter($item->purchase_price) }}</span>
                    <span class="old-price">{{ Helper::currency_converter($item->unit_price) }}</span>
                @else
                    <span class="equal-price">{{ Helper::currency_converter($item->purchase_price) }}</span>
                @endif
            </div>
            <div class="star-rating d-none">
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
            </div>
        </div>
    </div>
</div>
