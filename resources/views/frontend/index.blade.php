@extends('frontend.layouts.master')
@section('content')
    <!-- Hero Slider Starts -->
    @if (count($banners) > 0)
        <div class="home-slides owl-carousel owl-theme">
            @foreach ($banners as $banner)
                <a href="">
                    <div class="main-banner" style="background-image:url({{ asset($banner->image) }})">
                        <div class="d-table">
                            <div class="d-table-cell">
                                <div class="container">
                                    <div class="main-banner-content">
                                        {!! html_entity_decode($banner->content) !!}
                                        <div id="heroNav" class="hero-owl-nav"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
    <!-- Hero Slider Ends -->
    @if ($categories->count() > 0)
        <section class="categories-area d-md-block pt-40">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">Popular</span>
                    <h2>Categories</h2>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="owl-carousel owl-theme categories-slides">
                                @foreach ($categories as $cat)
                                    <div class="single-category-box" data-slick-index="7" aria-hidden="false" tabindex="0"
                                        style="width: 166px;">
                                        <figure class=" img-hover-scale overflow-hidden">
                                            <a href="{{ route('product.category', $cat->slug) }}" tabindex="0"><img
                                                    src="{{ $cat->banner ? asset($cat->banner) : Helper::DefaultImage() }}"
                                                    alt="category-image"></a>
                                        </figure>
                                        <h5><a href="{{ route('product.category', $cat->slug) }}"
                                                tabindex="0">{{ ucfirst($cat->title) }}</a></h5>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($featured_product->count() > 0)
        <section class="products-area pt-20">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">Featured</span>
                    <h2>Products
                        <a href="{{route('viewAllProducts','featured')}}" class="view-all">View All</a>
                    </h2>
                </div>
                <div class="owl-carousel owl-theme products-slides home_products">
                    @foreach ($featured_product as $item)
                        @include('frontend.partials._single_product', compact('item'))
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($featured_category)
        <!-- Occasion Dresses -->
        <section class="products-area pt-20">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">Shop Now</span>
                    <h2>{{ ucfirst($featured_category->title) }}
                        <a href="{{ route('product.category', $featured_category->slug) }}" class="view-all">View All</a>
                    </h2>
                </div>
                <div class="owl-carousel owl-theme products-slides">
                    @foreach ($featured_category->products as $item)
                        @include('frontend.partials._single_product', compact('item'))
                    @endforeach

                </div>
            </div>
        </section>
    @endif


    @if ($promo_banners)
        <section class="products-area">

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="banner-bg wow fadeIn animated animated animated"
                            style="background-image: url({{ asset($promo_banners->image) }}); visibility: visible;background-position: center;
                                 background-size: cover;
                                 padding: 50px;">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if ($latest_products->count() > 0)
        <section class="products-area pt-20">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">Latest</span>
                    <h2>Products
                        <a href="{{route('viewAllProducts','latest')}}" class="view-all">View All</a>
                    </h2>
                </div>
                <div class="owl-carousel owl-theme products-slides home_products">
                    @foreach ($latest_products as $item)
                        @include('frontend.partials._single_product', compact('item'))
                    @endforeach
                </div>
            </div>
        </section>
    @endif



@endsection

@push('styles')
    <style>
        .offer-content p {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            margin-bottom: 24px;
            height: 54px;
        }
    </style>
@endpush
