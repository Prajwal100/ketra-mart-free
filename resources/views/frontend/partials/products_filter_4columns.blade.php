<div id="products-collections-filter" class="">
    <section class="products-area">
        <div class="row change_grid">
            @forelse($products as $key=>$item)
                <div class="col-sm-6 col-md-3 col-lg-3" id="products-view-filter{{$key}}">
                    @include('frontend.partials._single_product')
                </div>

            @empty
                <div
                    class="w-100 d-flex justify-content-center align-items-center flex-column">
                    <img
                        src="https://cdn.dribbble.com/users/88213/screenshots/8560585/media/7263b7aaa8077a322b0f12a7cd7c7404.png?compress=1&resize=400x300"
                        class="img-fluid">
                    <p class="px-5">Sorry, we couldn't find the product as per your filter
                        settings.
                        Please try different filter settings.</p>
                </div>

            @endforelse

        </div>
    </section>
</div>
<div class="pagination-area d-flex align-items-center justify-content-between">
    {{$products->appends($_GET)->links('vendor.pagination.custom')}}
</div>
