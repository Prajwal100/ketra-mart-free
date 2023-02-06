@if (\App\Models\Wishlist::where('user_id', auth()->user()->id)->count() > 0)

    <table class="table table-bordered table-hover">
    <thead>
    <th>S.N</th>
    <th>Image</th>
    <th>Product Name</th>
    <th>Price</th>
    <th>Action</th>
    </thead>
    <tbody id="wishlist_html">
        @foreach (\App\Models\Wishlist::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get() as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <img src="{{ asset($item->product['thumbnail_image']) }}" class="pro-imgase" alt=""
                     style="max-width: 100px">
            </td>
            <td>
                <a
                    href="{{ route('product.detail', $item->product['slug']) }}">{{ ucfirst($item->product['title']) }}</a>
            </td>
            <td>
                {{ Helper::currency_converter($item->product['purchase_price']) }}
            </td>
            <td>
                <a href="javascript:;" onclick="removeWishlist('{{ $item['product_id'] }}')"
                   class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@else
    <div class="empty-cart d-flex flex-column align-items-center justify-content-center pb-40">
        <img width="200px" src="{{asset('frontend/assets/images/main/empty-cart.webp')}}" class="img-fluid" >
        <p >
            YOU DON'T HAVE ANY ITEMS IN
            YOUR WISHLIST.
        </p>
    </div>
@endif
