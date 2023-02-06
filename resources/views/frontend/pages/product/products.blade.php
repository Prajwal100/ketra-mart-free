@extends('frontend.layouts.master')

@section('content')
    <main class="main-content">
        <div class="container">
        <!-- BreadCrumb Section -->
            <div class="page-title-area">
                <div class="page-title-content">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li>{{$breadcrumb}}</li>

                    </ul>
                </div>
            </div>
            <!-- BreadCrumb Section Ends-->
        </div>

        <!-- Product List -->
        <section class="products-area products-collections-area pb-70">
            <div class="container">

                <form action="" id="search-form" method="get">
                    <div class="row">
                        <!-- Filter Sidebar -->
                        <div class="col-lg-3 col-md-12">
                            <div class="accordion widget-area" id="accordionFilter">
                                @if (count($selected_attribute_values) > 0 || $min_price != null || $max_price != null)
                                    <div class="widget filter-list-widget">
                                        <h3 class="widget-title">Filter <a href="{{ request()->url() }}"><span
                                                    onclick="" class="float-right">Clear All</span></a> </h3>
                                        <!-- Selected Filters -->
                                        <div class="selected-filters-wrap-list mt-3">
                                            <ul>
                                                @foreach ($selected_attribute_values as $key => $item)
                                                    @php
                                                        $url = request()->fullUrl();
                                                    @endphp
                                                    <li><a href="{{ Str::replace("attribute_values%5B$key%5D=$item", '', $url) }}"
                                                           class="clear-filter" data-id="{{ $item }}"><i
                                                                class='bx bx-x'></i>
                                                            {{ \App\Models\AttributeValue::find($item)->name }}</a></li>
                                                @endforeach
                                                @if ($min_price != null || $max_price != null)
                                                    <li><a
                                                            href="{{ request()->fullUrlWithQuery(['min_price' => null, 'max_price' => null]) }}"><i
                                                                class='bx bx-x'></i>
                                                            ${{ $min_price }}-${{ $max_price }}</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                @if (count($attribute_with_color) > 0)
                                <!-- Color Filters -->
                                    <div class="accordion-item widget color-list-widget">
                                        <div class="accordion-button active" data-toggle="collapse"
                                             data-target="#filterColor" aria-expanded="true" aria-controls="filterColor">
                                            <h3 class="widget-title">Color</h3>
                                            <div class="accordion-marker"><i class="bx bx-minus"></i></div>
                                        </div>
                                        <ul id="filterColor" class="collapse show color-list-row"
                                            data-parent="#accordionFilter">
                                            @foreach ($attribute_with_color as $key => $color)
                                                <label class="aiz-megabox pl-0 mr-2 attribute-filter" data-toggle="tooltip"
                                                       data-title="{{ $color->name }}">
                                                    <input type="checkbox" name="attribute_values[]"
                                                           value="{{ $color->id }}" onchange="filter()"
                                                           @if (isset($selected_attribute_values) && in_array($color->id, $selected_attribute_values)) checked @endif>
                                                    <span
                                                        class="aiz-megabox-elem d-flex align-items-center justify-content-center mb-2">
                                                        <span class="size-30px d-inline-block"
                                                              style="border-radius:50%;background: {{ $color->color_code }};"></span>
                                                    </span>
                                                </label>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif


                                @foreach ($attributes as $key => $attribute)
                                    <div class="accordion-item widget collections-list-widget">
                                        <div class="accordion-button active" data-toggle="collapse"
                                             data-target="#filterHemline{{ $key }}" aria-expanded="true"
                                             aria-controls="filterHemline">
                                            <h3 class="widget-title">{{ ucfirst($attribute->name) }}</h3>
                                            <div class="accordion-marker"><i class="bx bx-plus"></i></div>
                                        </div>
                                        <ul id="filterHemline{{ $key }}"
                                            class="collapse show collections-list-row" data-parent="#accordionFilter">
                                            @foreach ($attribute['attribute_values'] as $key => $value)
                                                <label class="aiz-checkbox attribute-filter"
                                                       for="attribute-{{ $value->id }}">
                                                    <input type="checkbox" name="attribute_values[]" onchange="filter()"
                                                           value="{{ $value->id }}" id="attribute-{{ $value->id }}"
                                                           @if (isset($selected_attribute_values) && in_array($value->id, $selected_attribute_values)) checked @endif>
                                                    <span class="aiz-square-check"></span>
                                                    <span class="attribute_name">{{ $value->name }}</span>
                                                </label>
                                            @endforeach
                                        </ul>
                                    </div>
                            @endforeach

                            <!-- Price Filter -->
                                <div class="accordion-item widget price-list-widget">
                                    <div class="accordion-button active" data-toggle="collapse" data-target="#filterPrice"
                                         aria-expanded="true" aria-controls="filterPrice">
                                        <h3 class="widget-title">Price</h3>
                                        <div class="accordion-marker"><i class="bx bx-minus"></i></div>
                                    </div>
                                    <div id="filterPrice" class="collapse show collection-filter-by-price">
                                        <div class="aiz-range-slider">
                                            <div id="input-slider-range"
                                                 data-range-value-min="@if (count(\App\Models\Product::query()->get()) < 1) 0 @else {{ \App\Models\Product::query()->get()->min('purchase_price') }} @endif"
                                                 data-range-value-max="@if (count(\App\Models\Product::query()->get()) < 1) 0 @else {{ \App\Models\Product::query()->get()->max('purchase_price') }} @endif">
                                            </div>

                                            <div class="row mt-4 mx-1">
                                                <div class="col-6">
                                                    <div class="price-box">
                                                        <span class="range-slider-value value-low fs-14 fw-600 opacity-70"
                                                              @if (isset($min_price)) data-range-value-low="{{ $min_price }}"
                                                              @else
                                                              data-range-value-low="0" @endif
                                                              id="input-slider-range-value-low"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="price-box">
                                                        <span class="range-slider-value value-high fs-14 fw-600 opacity-70"
                                                              @if (isset($max_price)) data-range-value-high="{{ $max_price }}"
                                                              @elseif($products->max('purchase_price') > 0)
                                                              data-range-value-high="{{ \App\Models\Product::where('status', 'active')->max('purchase_price') }}"
                                                              @else
                                                              data-range-value-high="0" @endif
                                                              id="input-slider-range-value-high"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="min_price"
                                                   value="@isset($min_price) {{ $min_price }} @endisset">
                                            <input type="hidden" name="max_price"
                                                   value="@isset($max_price) {{ $max_price }} @endisset">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Filter Sidebar Ends-->
                        <div class="col-lg-9 col-md-12">
                            <div class="products-filter-options">
                                <div class="row align-items-center mt-2">
                                    <div class="col-6 col-lg-6 col-md-6">
                                        <div class="products-ordering-list product-page-per-view">
                                            <select name="sortBy" id="" class="form-control">
                                                <option value="">Default Sorting</option>
                                                <option value="a-z" @isset($sort_by) @if($sort_by=='a-z') selected @endif @endisset>Sort by A - Z Order</option>
                                                <option value="z-a"  @isset($sort_by) @if($sort_by=='z-a') selected @endif @endisset>Sort by Z - A Order</option>
                                                <option value="latest"  @isset($sort_by) @if($sort_by=='latest') selected @endif @endisset>Sort by Latest</option>
                                                <option value="oldest" @isset($sort_by) @if($sort_by=='oldest') selected @endif @endisset>Sort by Oldest</option>
                                                <option value="low-high" @isset($sort_by) @if($sort_by=='low-high') selected @endif @endisset>Sort by Price: Low to High</option>
                                                <option value="high-low" @isset($sort_by) @if($sort_by=='high-low') selected @endif @endisset>Sort by Price: High to Low</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 float-right">
                                        <div class="d-lg-flex d-md-flex d-none align-items-center justify-content-end ">
                                            <p class="product-page-per-view">Select
                                                <select  id="" name="per_page">
                                                    <option value="9" {{$perpage==9 ? 'selected' : ''}}>9</option>
                                                    <option value="18" {{$perpage==18 ? 'selected' : ''}}>18</option>
                                                    <option value="27" {{$perpage==27 ? 'selected' : ''}}>27</option>
                                                    <option value="36" {{$perpage==36 ? 'selected' : ''}}>36</option>
                                                    <option value="45" {{$perpage==45 ? 'selected' : ''}}>45</option>
                                                </select>
                                                of {{count($products)}}
                                            </p>
                                        </div>
                                        <span class="d-flex  align-items-center justify-content-end  sub-title d-lg-none"><a href="javascript:void(0)"
                                                                             data-toggle="modal" data-target="#productsFilterModal"><i
                                                    class='bx bx-filter-alt'></i>
                                                    Filter</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="shop_wrapper">
                                <div id="products-collections-filter" class="">
                                    <section class="products-area">
                                        <div class="row">
                                            @forelse($products as $key=>$item)
                                                <div class="col-6 col-md-4" id="products-view-filter{{$key}}">
                                                    @include('frontend.partials._single_product')
                                                </div>

                                            @empty
                                                <div
                                                    class="w-100 d-flex justify-content-center align-items-center flex-column">
                                                    <img src="https://cdn.dribbble.com/users/88213/screenshots/8560585/media/7263b7aaa8077a322b0f12a7cd7c7404.png?compress=1&resize=400x300"
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
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- Product List Ends-->

        {{-- Filter For Mobile View --}}
        <div class="modal full fade productsFilterModal show" id="productsFilterModal" tabindex="-1" role="dialog"
             aria-modal="true">
            <div class="modal-dialog" role="document">
                <form action="" id="search-form-mobile" method="get">
                    <div class="modal-content">
                        <div class="col-12 d-flex align-items-center justify-content-between p-0">
                            <h6 class="widget-title m-0">Filter</h6>
                            <div class="buttons d-flex align-items-center justify-content-end w-100">
                                <a href="{{ request()->url() }}" type="button" class="mr-2 btn btn-outline btn-clear"
                                   style="font-size: 10px;
                                        width: fit-content;
                                        height: 2rem;">
                                    <span aria-hidden="true">Clear All</span>
                                </a>
                                <button type="submit" class="btn secondary-btn sign-up-btn">
                                    <span aria-hidden="true"><i class='bx bx-check bx-flashing'></i> Done</span>
                                </button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="accordion widget-area" id="accordionFilter">
                                <div class="widget filter-list-widget">
                                {{-- <h3 class="widget-title">Filter <a href="{{request()->url()}}"><span onclick="" class="float-right">Clear All</span></a> </h3> --}}
                                <!-- Selected Filters -->
                                    @if (count($selected_attribute_values) > 0 || $min_price != null || $max_price != null)

                                        <div class="selected-filters-wrap-list ">
                                            <ul>

                                                @foreach ($selected_attribute_values as $key => $item)
                                                    @php
                                                        $url = request()->fullUrl();
                                                    @endphp
                                                    <li><a
                                                            href="{{ Str::replace("attribute_values%5B$key%5D=$item", '', $url) }}"><i
                                                                class='bx bx-x'></i>
                                                            {{ \App\Models\AttributeValue::find($item)->name }}</a></li>
                                                @endforeach
                                                @if ($min_price != null || $max_price != null)
                                                    <li><a
                                                            href="{{ request()->fullUrlWithQuery(['min_price' => null, 'max_price' => null]) }}"><i
                                                                class='bx bx-x'></i>
                                                            ${{ $min_price }}-${{ $max_price }}</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif

                                </div>

                                @if (count($attribute_with_color) > 0)

                                    <div class="accordion-item widget color-list-widget">
                                        <div class="accordion-button active" data-toggle="collapse"
                                             data-target="#filterColorMobile" aria-expanded="true"
                                             aria-controls="filterColorMobile">
                                            <h3 class="widget-title">Color</h3>
                                            <div class="accordion-marker"><i class="bx bx-minus"></i></div>
                                        </div>
                                        <ul id="filterColorMobile" class="collapse show color-list-row"
                                            data-parent="#accordionFilter">
                                            @foreach ($attribute_with_color as $key => $color)
                                                <label class="aiz-megabox pl-0 mr-2 attribute-filter"
                                                       data-title="{{ $color->name }}">
                                                    <input type="checkbox" name="attribute_values[]"
                                                           value="{{ $color->id }}" {{-- onchange="mobileFilter()" --}}
                                                           @if (isset($selected_attribute_values) && in_array($color->id, $selected_attribute_values)) checked @endif>
                                                    <span
                                                        class="aiz-megabox-elem d-flex align-items-center justify-content-center mb-2">
                                                        <span class="size-30px d-inline-block"
                                                              style="border-radius:50%;background: {{ $color->color_code }};"></span>
                                                    </span>
                                                </label>
                                            @endforeach
                                        </ul>
                                    </div>

                                @endif


                                @foreach ($attributes as $key => $attribute)
                                    <div class="accordion-item widget collections-list-widget active">
                                        <div class="accordion-button" data-toggle="collapse"
                                             data-target="#filterAttributeMobile{{ $key }}" aria-expanded="true"
                                             aria-controls="filterHemlineMobile">
                                            <h3 class="widget-title">{{ ucfirst($attribute->name) }}</h3>
                                            <div class="accordion-marker"><i class="bx bx-minus"></i></div>
                                        </div>
                                        <div id="filterAttributeMobile{{ $key }}" class="collapse show ">
                                            <ul class="collections-list-row" data-parent="#accordionFilter">
                                                @foreach ($attribute['attribute_values'] as $key => $value)
                                                    <label class="aiz-mobile-checkbox attribute-filter"
                                                           for="attribute-mobile-{{ $value->id }}">
                                                        <input type="checkbox" name="attribute_values[]"
                                                               value="{{ $value->id }}"
                                                               id="attribute-mobile-{{ $value->id }}"
                                                               {{-- onchange="mobileFilter();" --}}
                                                               @if (isset($selected_attribute_values) && in_array($value->id, $selected_attribute_values)) checked @endif>
                                                        <span class="aiz-square-mobile-check"></span>
                                                        <span class="attribute_name">{{ $value->name }}</span>
                                                    </label>
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>
                            @endforeach
                            <!-- Price Filter -->
                                <div class="accordion-item widget price-list-widget">
                                    <div class="accordion-button" data-toggle="collapse" data-target="#filterMobilePrice"
                                         aria-expanded="true" aria-controls="filterMobilePrice">
                                        <h3 class="widget-title">Price</h3>
                                        <div class="accordion-marker"><i class="bx bx-minus"></i></div>
                                    </div>
                                    <div id="filterMobilePrice" class="collapse show collection-filter-by-price">
                                        <div class="aiz-range-slider-mobile">
                                            <div id="input-slider-range-mobile"
                                                 data-range-value-min-mobile="@if (count(\App\Models\Product::query()->get()) < 1) 0 @else {{ \App\Models\Product::query()->get()->min('purchase_price') }} @endif"
                                                 data-range-value-max-mobile="@if (count(\App\Models\Product::query()->get()) < 1) 0 @else {{ \App\Models\Product::query()->get()->max('purchase_price') }} @endif">
                                            </div>

                                            <div class="row mt-4 mx-1">
                                                <div class="col-6 price-box">
                                                    <span class="range-slider-value value-low fs-14 fw-600 opacity-70"
                                                          @if (isset($min_price)) data-range-value-low-mobile="{{ $min_price }}"
                                                          @else
                                                          data-range-value-low-mobile="0" @endif
                                                          id="input-slider-range-value-low-mobile"></span>
                                                </div>
                                                <div class="col-6 price-box">
                                                    <span class="range-slider-value value-high fs-14 fw-600 opacity-70"
                                                          @if (isset($max_price)) data-range-value-high-mobile="{{ $max_price }}"
                                                          @elseif($products->max('purchase_price') > 0)
                                                          data-range-value-high-mobile="{{ \App\Models\Product::where('status', 'active')->max('purchase_price') }}"
                                                          @else
                                                          data-range-value-high-mobile="0" @endif
                                                          id="input-slider-range-value-high-mobile"></span>
                                                </div>
                                            </div>
                                            <input type="hidden" class="min_price" name="min_price"
                                                   value="@isset($min_price) {{ $min_price }} @endisset">
                                            <input type="hidden" class="max_price" name="max_price"
                                                   value="@isset($max_price) {{ $max_price }} @endisset">
                                        </div>
                                        {{-- <input type="hidden" name="min_price" value=""> --}}
                                        {{-- <input type="hidden" name="max_price" value=""> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection

@push('styles')

    <style>
        .pagination-area .page-numbers.prev,.pagination-area .page-numbers.next{
            margin-left:0;
            margin-right:0;
        }
        .wishlist-btn{
            right:92px;
        }

        /* smaller and bigger view*/
        .shop_toolbar_btn > button {
            margin-right: 10px;
            border: 0;
            background: inherit;
        }
        .shop_toolbar_btn > button.btn-grid-3 {
            background: url(../frontend/assets/images/icons/bkg_grid.webp) no-repeat scroll center center;
            width: 20px;
            height: 20px;
        }
        .shop_toolbar_btn > button.btn-grid-3.active {
            background: url(../frontend/assets/images/icons//bkg_grid_hover.webp) no-repeat scroll center center !important;
        }
        .shop_toolbar_btn > button.btn-grid-4 {
            background: url(../frontend/assets/images/icons/bkg_grid4.webp) no-repeat scroll center center;
            width: 26px;
            height: 22px;
        }
        .shop_toolbar_btn > button.btn-grid-4.active {
            background: url(../frontend/assets/images/icons/bkg_grid4_hover.webp) no-repeat scroll center center !important;
        }
        @media only screen and (min-width: 992px) and (max-width: 1199px) {
            .shop_toolbar_btn > button.btn-grid-4 {
                display: none;
            }
        }
        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .shop_toolbar_btn > button.btn-grid-4 {
                display: none;
            }
        }


        ul.list{
            height: 300px !important;
            overflow-y: scroll !important;
        }
        .noUi-horizontal .noUi-handle {
            width: 10px;
            height: 32px;
            top: -12px;
        }

        .noUi-handle {
            background: #FF8082;
            border-radius: 8px;
            cursor: default;
            box-shadow: none;
            border: 0;
        }

        .noUi-target {
            background: #FFF2F3;
            border: none;
        }

        .noUi-handle:before,
        .noUi-handle:after {
            display: none;
        }

        .noUi-handle:after {
            left: 17px;
        }

        .noUi-horizontal {
            height: 10px;
        }

        html:not([dir="rtl"]) .noUi-horizontal .noUi-handle {
            right: -8px;
            left: auto;
        }

        /*PRICE SLIDER UI*/
        .price-box {
            border: 1px solid #ddd;
            padding: 5px 14px;
            border-radius: 4px;
        }

        .aiz-range-slider .noUi-connect,
        .aiz-range-slider-mobile .noUi-connect {
            background: #FF8082;
        }

        .range-slider-value {
            font-size: 16px !important;
        }

    /*  ATTRIBUTES UI  */
        /*aiz megabox*/
        .aiz-megabox {
            position: relative;
            cursor: pointer;
        }

        .aiz-megabox input {
            position: absolute;
            z-index: -1;
            opacity: 0;
            top: 8px;
            left: 10px;
        }

        .aiz-megabox .aiz-megabox-elem {
            border: 1px solid #e2e5ec;
            border-radius: 50%;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
            border-radius: 50%;
            padding: 2px;
        }

        .aiz-megabox>input:checked~span .aiz-rounded-check:after,
        .aiz-megabox>input:checked~span .aiz-square-check:after {
            visibility: visible;
            opacity: 1;
        }

        .aiz-megabox>input:checked~.aiz-megabox-elem,
        .aiz-megabox>input:checked~.aiz-megabox-elem {
            border-color: black;
        }

        .size-30px {
            width: 30px;
        }

        .size-30px {
            height: 30px;
        }

        /*checkbox attributes*/
        .aiz-checkbox,
        .aiz-mobile-checkbox {
            display: block;
            position: relative;
            padding-left: 28px;
            margin-bottom: 10px;
            cursor: pointer;
            font-size: 0.875rem;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .aiz-checkbox>input,
        .aiz-radio>input,
        .aiz-mobile-checkbox>input {
            position: absolute;
            z-index: -1;
            opacity: 0;
        }

        .aiz-checkbox .aiz-square-check,
        .aiz-mobile-checkbox .aiz-square-mobile-check {
            position: absolute;
            top: 0px;
            left: 0;
        }

        .aiz-square-check,
        .aiz-square-mobile-check {
            border-radius: 3px;
        }

        .attribute_name {
            font-size: 16px;
            font-weight: 600;
        }

        .aiz-square-check,
        .aiz-square-mobile-check {
            background: 0 0;
            position: relative;
            height: 16px;
            width: 16px;
            padding: 10px;
            border: 1px solid #d1d7e2;
        }

        .aiz-checkbox>input:checked~.aiz-square-check:after,
        .aiz-radio>input:checked~.aiz-square-check:after,
        .aiz-mobile-checkbox>input:checked~.aiz-square-mobile-check:after {
            visibility: visible;
            opacity: 1;

        }

        .aiz-checkbox>input:checked~.aiz-square-check,
        .aiz-mobile-checkbox>input:checked~.aiz-square-mobile-check {
            background: #FF7277 !important;
            border: 0;
        }

    </style>

{{--  color filter  --}}
<style>

    .checkbox-alphanumeric::after,
    .checkbox-alphanumeric::before {
        content: '';
        display: table;
    }

    .checkbox-alphanumeric::after {
        clear: both;
    }

    .checkbox-alphanumeric input {
        left: -9999px;
        position: absolute;
    }

    .checkbox-alphanumeric label {
        width: 2.25rem;
        float: left;
        padding: 6px 0;
        margin-right: 0.375rem;
        display: block;
        color: #818a91;
        font-size: 0.875rem;
        font-weight: 400;
        text-align: center;
        /* background: transparent; */
        text-transform: uppercase;
        border: 1px solid #e6e6e6;
        border-radius: 2px;
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        transition: all 0.3s ease;
        transform: scale(0.95);
    }

    .checkbox-alphanumeric-circle label {
        border-radius: 100%;
    }

    .checkbox-alphanumeric label > img {
        max-width: 100%;
    }

    .checkbox-alphanumeric label:hover {
        cursor: pointer;
        border-color: #FF5A60;
    }

    .checkbox-alphanumeric input:checked ~ label {
        transform: scale(1.1);
        background: #FF5A60 !important;
        color: white;
    }

    .checkbox-alphanumeric--style-1 label {
        width: auto;
        padding-left: 1rem;
        padding-right: 1rem;
        border-radius: 4px;
    }

    .d-table.checkbox-alphanumeric--style-1 {
        width: 100%;
    }

    .d-table.checkbox-alphanumeric--style-1 label {
        width: 100%;
    }



    .aiz-megabox {
        position: relative;
        cursor: pointer;
    }
    .aiz-megabox input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }
    .aiz-megabox .aiz-megabox-elem {
        border: 1px solid #e2e5ec;
        border-radius:50% !important;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        padding: 2px;
    }
    .aiz-megabox > input:checked ~ span .aiz-rounded-check:after,
    .aiz-megabox > input:checked ~ span .aiz-square-check:after {
        visibility: visible;
        opacity: 1;
    }

    .aiz-megabox > input:checked ~ .aiz-megabox-elem,
    .aiz-megabox > input:checked ~ .aiz-megabox-elem {
        border-color: var(--primary);
    }
    .size-30px {
        height: 30px;
    }
    .size-30px {
        width: 30px;
    }
    .color-rounded {
        border-radius: 50%!important;
        margin:0 !important;
    }
</style>

@endpush
@push('scripts')
    <script>

        function filter() {
            $("#search-form").submit();
        }
        function mobileFilter() {
            $("#search-form-mobile").submit();
        }
        //Desktop price slider
        if ($(".aiz-range-slider")[0]) {
            $(".aiz-range-slider").each(function() {
                var c = document.getElementById("input-slider-range"),
                    d = document.getElementById("input-slider-range-value-low"),
                    e = document.getElementById("input-slider-range-value-high"),
                    f = [d, e];

                noUiSlider.create(c, {
                    start: [
                        parseInt(d.getAttribute("data-range-value-low")),
                        parseInt(e.getAttribute("data-range-value-high")),
                    ],
                    connect: !0,
                    range: {
                        min: 0,
                        max: parseInt(c.getAttribute("data-range-value-max")),
                    },
                }),

                    c.noUiSlider.on("update", function(a, b) {
                        f[b].textContent = a[b];
                    }),
                    c.noUiSlider.on("change", function(a, b) {
                        rangefilter(a);
                    });
            });
        }

        function rangefilter(arg) {
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }

        //Mobile Price Slider
        if ($(".aiz-range-slider-mobile")[0]) {
            $(".aiz-range-slider-mobile").each(function() {
                var c = document.getElementById("input-slider-range-mobile"),
                    d = document.getElementById("input-slider-range-value-low-mobile"),
                    e = document.getElementById("input-slider-range-value-high-mobile"),
                    f = [d, e];

                noUiSlider.create(c, {
                    start: [
                        parseInt(d.getAttribute("data-range-value-low-mobile")),
                        parseInt(e.getAttribute("data-range-value-high-mobile")),
                    ],
                    connect: !0,
                    range: {
                        min: 0,
                        max: parseInt(c.getAttribute("data-range-value-max-mobile")),
                    },
                }),

                    c.noUiSlider.on("update", function(a, b) {
                        f[b].textContent = a[b];
                    }),
                    c.noUiSlider.on("change", function(a, b) {
                        rangefilterMobile(a);
                    });
            });
        }

        function rangefilterMobile(arg) {
            $('.min_price').val(arg[0]);
            $('.max_price').val(arg[1]);
            // mobileFilter();
        }
        $(document).on('change', '.product-page-per-view select', function(){
            var perpage = $('select[name=per_page]').val();

            var sortBy = $('select[name=sortBy]').val();

            getFilteredData(perpage,sortBy);
        });


        function getFilteredData(perpage=`{{$perpage}}`,sortBy=`{{$sortBy}}`, min = null, max = null,){
            $("#overlay, #overlay2").fadeIn(300);
            $.ajax({
                url: "{{ route('product.filter')}}",
                method: "get",
                data: {'perpage':perpage,'sortBy':sortBy,'searched_value':"{{$query}}", 'min_price': min,
                    'max_price': max,},
                beforeSend:function(){
                    $('.loading').show();
                },
                complete:function(){
                    $('.loading').hide();
                },
                success: function(result){
                    $('.ajax-preloader').addClass('d-none');
                    $('.shop_wrapper').html(result);

                }
            }).done(function() {
                setTimeout(function(){
                    $("#overlay, #overlay2").fadeOut(300);
                },500);
            });
        }
    </script>
@endpush
