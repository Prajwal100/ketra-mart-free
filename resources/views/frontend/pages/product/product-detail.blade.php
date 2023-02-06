@extends('frontend.layouts.master')

@section('meta_title'){{ $product->meta_title ?? $product->title }}@stop

@section('meta_description'){{ $product->meta_description }}@stop

@section('meta_keywords'){{ $product->keywords }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $product->meta_title }}">
    <meta itemprop="description" content="{{ $product->meta_description }}">
    <meta itemprop="image" content="{{ asset($product->featured_image) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $product->meta_title }}">
    <meta name="twitter:description" content="{{ $product->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset($product->featured_image) }}">
    <meta name="twitter:data1" content="{{ $product->price }}">
    <meta name="twitter:label1" content="Price">

@endsection

@section('content')
    <main class="main-content details-content">

        <!-- BreadCrumb Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>
                            <a href="{{ route('product.category', $product->category['slug']) }}">{{ ucfirst($product->category['title']) }}</a>
                        </li>
                        <li>{{ ucfirst($product->title) }}</li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- BreadCrumb Area  Ends-->


        <section class="product-details-area pb-70">
            <div class="container">
                <div class="row">
                    <!-- Thumbnail Slider -->
                    <div class="col-lg-6 col-md-12">
                        <div class="product__details__images module-gallery">

                            @php
                                $images=$product->images ? json_decode($product->images) : [];
                                array_unshift($images,$product->thumbnail_image);

                            @endphp

                            <div class="row slider-wrapper mt-1">
                                <ul class="col-3 slider-thumb noPad noMar">
                                    @if ($images)
                                        @foreach ($images as $image)
                                            @if ($image != null) <img src="{{ $image != null ? asset($image) : '' }}"
                                                                            alt=""></li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>

                                <ul class="col-12 col-md-9 slider-preview noPad noMar">
                                    @if ($images)
                                        @foreach ($images as $image)
                                            @if ($image != null)
                                                <li class="type-image"><img src="{{ $image != null ? asset($image) : '' }}"
                                                                            alt=""></li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                            <div class="slider-wrapper d-none">
                                <ul class="slider-thumb">
                                    @if ($images)
                                        @foreach ($images as $image)
                                            @if ($image != null)
                                                <li class="type-image"><img src="{{ $image != null ? asset($image) : '' }}"
                                                                            alt=""></li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>

                                <ul class="slider-preview">
                                    @if ($images)
                                        @foreach ($images as $image)
                                            @if ($image != null)
                                                <li class="type-image"><img style="border:1px solid #ddd;"
                                                                            src="{{ $image != null ? asset($image) : '' }}"
                                                                            alt=""></li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="social-link-icons mt-3 d-flex align-items-center">

                                <p class="font-weight-bold">Share this:</p>
                                {{--                                <a href="{{\Jorenvh\Share\ShareFacade::currentPage()->pinterest()->getRawLinks()}}" target="_blank" class="pinterest-bg"><i class="fab fa-pinterest"></i></a> --}}
                                {{--                                <a href="{{\Jorenvh\Share\ShareFacade::currentPage()->facebook()->getRawLinks()}}" target="_blank" class="facebook-bg"><i class="fab fa-facebook-f"></i></a> --}}
                                {{--                                <a href="{{\Jorenvh\Share\ShareFacade::currentPage()->twitter()->getRawLinks()}}" target="_blank" class="twitter-bg"><i class="fab fa-twitter"></i></a> --}}
                            </div>
                        </div>
                    </div>
                    <!-- Thumbnail Slider Ends-->

                    <div class="col-lg-6 col-md-12 details-wrapper__right">
                        <form id="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="products-details-desc">


                                <div class="wishlist-btn details__wishlist-btn d-block d-md-none">
                                    <a href="javascript:void(0)" class="add_to_wishlist"
                                       data-product-id="{{ $product->id }}" id="add_to_wishlist_{{ $product->id }}">
                                        @php
                                            if(\Illuminate\Support\Facades\Auth::check()){
                                                $already_wishlist=\App\Models\Wishlist::where('user_id',auth()->user()->id)->where('product_id',$product->id)->first();
                                            }
                                             else{
                                                 $already_wishlist=null;
                                             }
                                        @endphp
                                        @if ($already_wishlist != null)
                                            <i class="bx bxs-heart wishlist-icon" style="color:#FF757B"></i>
                                        @else
                                            <i class='bx bxs-heart wishlist-icon'></i>
                                        @endif
                                    </a>
                                </div>

                                <h3>{{ ucfirst($product->title) }}</h3>

                                <!-- Product Price -->
                                <div class="price">
                                    @if ($product->variation)
                                        <span class="new-price">{{ Helper::get_price_range($product) }}</span>
                                    @else
                                        <span
                                            class="new-price">{{ Helper::currency_converter($product->purchase_price) }}</span>
                                    @endif
                                    @if ($product->discount > 0 && home_discounted_price($product))
                                        <span class="old-price">{{ Helper::currency_converter($product->unit_price) }}</span>
                                    @endif
                                </div>
                                <hr>

                                <p>
                                    {!! html_entity_decode($product->summary) !!}
                                </p>
                                <hr>

                            @if ($product->variation)

                                @if (count(json_decode($product->colors)) > 0)
                                    <!-- Product Colors -->
                                        <div class="products-details-title d-flex justify-content-between">
                                            <span class="float-left">Color:</span>
                                        </div>
                                        <div class="clearfix"></div>
                                        <!-- Select Options in Mobile View -->
                                        <div class="products-color-select mt-2 d-md-none d-block color-select"
                                             data-toggle="modal" data-target="#AllColors">
                                            {{--                                            <select class="wide" id="mobile-select-color"> --}}
                                            <select class="form-control" id="mobile-select-color" disabled>
                                                @foreach (json_decode($product->colors) as $key => $color)
                                                    <option value="{{ $color }}">
                                                        {{ \App\Models\AttributeValue::where('color_code', $color)->first()->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="products-color-switch d-md-block d-none">
                                            <ul class="color-list-row">
                                                @foreach (json_decode($product->colors) as $key => $color)
                                                    <li>
                                                        <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-placement="bottom"
                                                               data-title="{{ \App\Models\AttributeValue::where('color_code', $color)->first()->name }}">
                                                            <input
                                                                required
                                                                type="radio"
                                                                name="color"
                                                                value="{{ $color }}"
                                                                @if ($key == 0) checked @endif
                                                            >
                                                            <span
                                                                class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center mb-2">
                                                            <span class="size-30px d-inline-block color-rounded"
                                                                  style="background: {{ $color }};"></span>
                                                        </span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- Product Sizes -->
                                        @if ($product->choice_options != null)
                                            <div class="products-size-wrapper">
                                                @foreach (array_reverse(json_decode($product->choice_options)) as $key => $choice)
                                                    @php
                                                        $title=\App\Models\Attribute::find($choice->attribute_id)->name
                                                    @endphp
                                                    @if ($title == 'Size' || $title == 'size')
                                                        <div class="d-md-block d-none">
                                                            <div
                                                                class="products-details-title d-flex justify-content-between">

                                                                <span class="float-left">{{ $title }}:</span>

                                                            </div>
                                                            @if ($choice != null && $choice->values != null)
                                                                <ul class="checkbox-alphanumeric checkbox-alphanumeric--style-1 ">
                                                                    @foreach ($choice->values as $key => $option)
                                                                        <li class="pl-0 mr-0">
                                                                            <label style="margin-right: -20px;">
                                                                                <input type="radio" required
                                                                                       id="size_item"
                                                                                       name="attribute_id_{{ $choice->attribute_id }}"
                                                                                       value="{{ $option }}"
                                                                                       @if ($key == 0) checked @endif>
                                                                                <span
                                                                                    class="aiz-megabox-elem">{{ $option }}</span>
                                                                            </label>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </div>

                                                        <!-- Select Options For Sizes in Mobile View -->
                                                        <div
                                                            class="products-details-title d-flex justify-content-between d-md-none d-block">
                                                            <span class="float-left">Size:</span>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div
                                                            class="products-color-select mt-2 d-md-none d-block color-select"
                                                            data-toggle="modal" data-target="#AllSizes">
                                                            <select class="form-control" id="mobile-select-size"
                                                                    disabled>
                                                                @foreach ($choice->values as $key => $option)
                                                                    <option value="{{ $option }}">
                                                                        {{ $option }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                <div
                                    class="row products-details-title total-price d-none d-md-flex justify-content-between mt-4"
                                    id="chosen_price_div">
                                    <div class="col-12 d-flex align-items-center">
                                        <span class="pr-2">Total Price:</span>
                                        <div class="product-price for-total-price">
                                            <h5 class="chosen_price  mb-1"></h5>
                                        </div>
                                    </div>

                                </div>

                                <!--Product Quantity -->
                                <div class="products-add-to-cart mt-3">
                                    <p class="title font-weight-normal">Qty</p>
                                    <div class="input-counter">
                                        <span class="minus-btn btn-number" data-type="minus" data-field="quantity"><i
                                                class='bx bx-minus'></i></span>
                                        <input type="text" class="input-number" name="quantity" value="1" min="1"
                                               max="100">
                                        <span class="plus-btn btn-number" data-type="plus" data-field="quantity"><i
                                                class='bx bx-plus'></i></span>
                                    </div>

                                    <!-- Add to Cart Button -->
                                       <button type="button" onclick="addToCart()"
                                               class="default-btn  secondary-btn add-to-cart-btn d-none d-lg-inline-block"> Add to
                                           Cart <span class="bx bx-right-arrow-alt float-right"></span></button>
                                       <button type="button" data-quantity="1" data-id="{{ $product->id }}" id="add_to_wishlist_{{ $product->id }}"
                                               class="default-btn  primary-btn add-to-cart-btn add_to_wishlist ml-2 d-none d-lg-inline-block" style="height: 50px;"> Add to
                                           Wishlist <span class="bx bx-right-arrow-alt float-right"></span></button>

                                        <button type="button" onclick="addToCart()"
                                                class="default-btn  secondary-btn add-to-cart-btn d-md-inline-block d-lg-none"><i class="bx bx-cart-alt"></i></button>
                                        <button type="button" data-quantity="1" data-id="{{ $product->id }}" id="add_to_wishlist_{{ $product->id }}"
                                                class="default-btn  primary-btn add-to-cart-btn add_to_wishlist ml-2 d-md-inline-block d-lg-none" style="height: 50px;"><i class="bx bx-heart"></i></button>
                                </div>

                                <!-- Product Descriptions -->
                                <div class="products-details-accordion">
                                    <ul class="accordion">
                                        @if ($product->shipping_time || $product->processing_time)
                                            <li class="accordion-item">
                                                <a class="accordion-title active" href="javascript:void(0)">
                                                    Processing & Shipping
                                                    <i class='bx bx-plus float-right'></i>
                                                </a>
                                                <div class="accordion-content show">
                                                    <div class="processing-time">
                                                        <i class='bx bx-time-five'></i>
                                                        <span>Processing Time: {{ $product->processing_time }} Business Days</span>
                                                    </div>
                                                    <div class="shipping-time">
                                                        <i class='bx bxs-plane-take-off'></i>
                                                        <span>Shipping Time: {{ $product->shipping_time }} Business Days</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                        <li class="accordion-item">
                                            <a class="accordion-title" href="javascript:void(0)">
                                                Features
                                                <i class='bx bx-plus float-right'></i>
                                            </a>
                                            <div class="accordion-content">
                                                {!! html_entity_decode($product->features) !!}
                                            </div>
                                        </li>
                                        <li class="accordion-item">
                                            <a class="accordion-title" href="javascript:void(0)">
                                                Description
                                                <i class='bx bx-plus float-right'></i>
                                            </a>
                                            <div class="accordion-content">
                                                {!! html_entity_decode($product->description) !!}
                                            </div>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>


    @if (count($product->rel_prods) > 1)
        <!-- Recommended -->
            <section class="products-area recommended pt-100 pb-5">
                <div class="container">
                    <div class="section-title">
                        <!-- <span class="sub-title">Shop Now</span> -->
                        <h2>Recommended
                        </h2>
                    </div>

                    <div class="owl-carousel owl-theme products-slider">
                        @foreach ($product->rel_prods as $item)
                            @if ($item->id != $product->id)
                                @include('frontend.partials._single_product',compact('item'))
                            @endif
                        @endforeach
                    </div>

                </div>
            </section>
    @endif

    </main>
    <!-- Size Chart Modal -->
    @include('frontend.partials._size_modal',compact('product'))
    <!-- Size Chart Modal Ends-->

    <!-- Color Chart Modal -->
    @include('frontend.partials._color_modal',compact('product'))
    <!-- Color Chart Modal Ends-->



    {{--    <!-- All Colors --> --}}
    <div class="modal fade customSizeModal" id="AllColors" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog m-3 " role="document">
            <div class="modal-content">
                <div class="modal-body modal-allColors p-0">
                    <div class="d-flex justify-content-between">
                        <div class="img-wrapper">
                            <img
                                src="{{ $product->featured_image != null ? asset($product->featured_image) : Helper::DefaultImage() }}"
                                alt="">
                        </div>
                        <div class="content-wrapper w-100">
                            <div class="text-right">
                                <button type="button" id="close_modal" class="btn secondary-btn btn-save text-white">
                                    <i class="bx bx-check bx-flashing"></i>
                                    Save
                                </button>
                            </div>
                            <div class="ml-3">
                                <div class="text-muted mb-1">
                                    Picked Color:
                                </div>
                                <div class="picked-color">
                                    <span class="picked-color-circle"></span>
                                    <span class="text-dark ml-2 picked-color-name">Aliceblue</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="border-dashed"/>
                    <div class="all-colors-list">
                        <h6>All Colors ({{ count(json_decode($product->colors)) }})</h6>
                        <div class="products-color-switch">
                            <ul class="color-list-row">
                                @foreach (json_decode($product->colors) as $key => $color)
                                    <li>
                                        <label class="aiz-megabox pl-0 mr-2"
                                               data-title="{{ \App\Models\AttributeValue::where('color_code', $color)->first()->name }}">
                                            <input
                                                type="radio"
                                                name="color"
                                                class="product_detail_color_pick"
                                                value="{{ $color }}"
                                                data-color_code="{{ $color }}"
                                                data-color_name="{{ \App\Models\AttributeValue::where('color_code', $color)->first()->name }}"
                                                @if ($key == 0) checked @endif
                                            >
                                            <span
                                                class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center mb-2">
                                                <span class="size-30px d-inline-block color-rounded"
                                                      style="background: {{ $color }}"></span>
                                            </span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    <!-- All Sizes --> --}}
    <div class="modal fade customSizeModal" id="AllSizes" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog h-100" role="document">
            <div class="modal-content h-100">
                <div class="modal-body modal-allSizes p-0">
                    <div class="d-flex justify-content-between">

                        <div class="content-wrapper w-100">
                            <div class="text-right">
                                <button type="button" data-dismiss="modal"
                                        class="btn secondary-btn btn-save text-white">
                                    <i class="bx bx-check bx-flashing"></i>
                                    Save
                                </button>
                            </div>
                            <h5>Select Size</h5>

                        </div>
                    </div>
                    <div class="all-colors-list">
                        <ul class="checkbox-alphanumeric checkbox-alphanumeric--style-2 row">
                            @if ($product->choice_options != null)
                                @foreach (array_reverse(json_decode($product->choice_options)) as $key => $choice)
                                    @php
                                        $title=\App\Models\Attribute::find($choice->attribute_id)->name
                                    @endphp
                                    @if ($choice != null && $choice->values != null && ($title == 'Size' || $title == 'size'))
                                        @foreach ($choice->values as $key => $option)
                                            <li class="pl-0 mr-0 col-6">
                                                <label class="d-block">
                                                    <input type="radio" required
                                                           class="product_detail_size_pick"
                                                           data-size="{{ $option }}"
                                                           data-attribute_id="{{ $choice->attribute_id }}"
                                                           name="attribute_id_{{ $choice->attribute_id }}"
                                                           value="{{ $option }}"
                                                           @if ($key == 0) checked @endif>
                                                    <span class="aiz-megabox-elem">{{ $option }}</span>
                                                </label>
                                            </li>
                                        @endforeach
                                    @endif
                                @endforeach @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('frontend.partials._review_modal', compact('product'))
@endsection

@push('styles')
    <style>

            @media only screen and (max-width: 768px) {
                .modal-dialog-centered {
                    margin: 20px !important;
                }

                .sizeGuideModal .modal-content, .colorChartModal .modal-content {
                    padding: 16px;
                }
            }

            .for-total-price .chosen_price{
                color:hsl(358deg 100% 68%) !important;
                font-weight: 700;
                margin: 0 !important;
            }
            .color-item {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-flex: 0;
                -ms-flex: none;
                flex: none;
                width: 104px;
            }

            .color-item .color-block {
                border-radius: 50%;
                width: 40px;
                height: 40px;
                overflow: hidden;
                background: pink;
            }

            {{--    mobile color preview    --}}
            .color-preview {
                height: 12px;
                width: 12px;
                display: inline-block;
                margin-right: 5px;
                margin-left: 3px;
                margin-top: 12px;
            }

            .select2-container {
                width: 100% !important;
            }

            ul.list {
                height: 300px;
                overflow-y: scroll !important;
            }
        </style>

        {{--  color filter  --}}
        <style>
            .customize-size span {
                font-weight: 600;
                color: #000000;
            }

            .checkbox-alphanumeric::after,
            .checkbox-alphanumeric::before {
                content: '';
                display: table;
            }

            .checkbox-alphanumeric::after {
                clear: both;
            }

            .checkbox-alphanumeric input {
                opacity: 0;
            }

            .checkbox-alphanumeric span {
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

            .checkbox-alphanumeric--style-2 span {
                width: auto;
                padding-left: 1rem;
                padding-right: 1rem;
                border-radius: 4px;
                height: 3rem;
                float: unset;
                margin-right: 0;
                padding: 15px 0;
                font-size: 15px;
            }

            .checkbox-alphanumeric--style-2 label {
                margin: 0;
            }

            .checkbox-alphanumeric-circle span {
                border-radius: 100%;
            }

            .checkbox-alphanumeric span > img {
                max-width: 100%;
            }

            .checkbox-alphanumeric span:hover {
                cursor: pointer;
                border-color: #FF5A60;
            }

            .checkbox-alphanumeric input:checked ~ span {
                /*transform: scale(1.1);*/
                background: #FF5A60 !important;
                color: white;
            }

            .checkbox-alphanumeric--style-1 span {
                width: auto;
                padding-left: 1rem;
                padding-right: 1rem;
                border-radius: 4px;
                height: 2rem;
            }

            .d-table.checkbox-alphanumeric--style-1 {
                width: 100%;
            }

            .d-table.checkbox-alphanumeric--style-1 span {
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
                border-radius: 50% !important;
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
                border-color: hsl(358deg 100% 68%) !important;
            }


            /*All attributes*/
            .aiz-megabox-attribute {
                position: relative;
                cursor: pointer;
            }

            .aiz-megabox-attribute input {
                position: absolute;
                z-index: -1;
                opacity: 0;
            }

            .aiz-megabox-attribute .aiz-megabox-attribute-element {
                border: 1px solid #e2e5ec;
                -webkit-transition: all 0.3s ease;
                transition: all 0.3s ease;
                padding: 2px;
            }

            .aiz-megabox-attribute > input:checked ~ span .aiz-rounded-check:after,
            .aiz-megabox-attribute > input:checked ~ span .aiz-square-check:after {
                visibility: visible;
                opacity: 1;

            }

            .aiz-megabox-attribute > input:checked ~ .aiz-megabox-attribute-element,
            .aiz-megabox-attribute > input:checked ~ .aiz-megabox-attribute-element {
                border-color: black;
            }

            /*End attributes css*/

            .size-30px {
                height: 30px;
            }

            .size-30px {
                width: 30px;
            }

            .color-rounded {
                border-radius: 50% !important;
                margin: 0 !important;
            }

            /*aiz megabox*/
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
                border-radius: 0.25rem;
                -webkit-transition: all 0.3s ease;
                transition: all 0.3s ease;
                border-radius: 0.25rem;
            }

            .aiz-megabox > input:checked ~ span .aiz-rounded-check:after,
            .aiz-megabox > input:checked ~ span .aiz-square-check:after {
                visibility: visible;
                opacity: 1;
            }

        </style>
@endpush
@push('scripts')
    <script type="text/javascript">
        var main_site = "{{ url('/') }}";
    </script>
        <script>
            //cart counter
            $(".input-counter").each(function() {
                var spinner = jQuery(this),
                    input = spinner.find('input[type="text"]'),
                    btnUp = spinner.find(".plus-btn"),
                    btnDown = spinner.find(".minus-btn"),
                    min = input.attr("min"),
                    max = input.attr("max");
                btnUp.on("click", function() {
                    var oldValue = parseFloat(input.val());
                    if (oldValue >= max) {
                        var newVal = oldValue;
                    } else {
                        var newVal = oldValue + 1;
                    }
                    spinner.find("input").val(newVal);
                    spinner.find("input").trigger("change");
                });
                btnDown.on("click", function() {
                    var oldValue = parseFloat(input.val());
                    if (oldValue <= min) {
                        var newVal = oldValue;
                    } else {
                        var newVal = oldValue - 1;
                    }
                    spinner.find("input").val(newVal);
                    spinner.find("input").trigger("change");
                });
            });

            $('.add-to-cart').click(function(e) {
                var product_id = $(this).data('id');
                var product_price = $(this).data('price');
                var product_quantity = $(this).data('quantity');
                var token = "{{ csrf_token() }}";
                var path = "{{ route('single.cart.store') }}";

                $.ajax({
                    url: path,
                    dataType: "JSON",
                    type: "POST",
                    data: {
                        _token: token,
                        product_id: product_id,
                        product_price: product_price,
                        product_quantity: product_quantity,
                    },
                    beforeSend: function() {

                        $('#loading').show();
                    },
                    complete: function() {
                        $('#loading').hide();
                        $('#add_to_cart' + product_id).html('Added In Cart');
                    },
                    success: function(response) {
                        var message =
                            '<i class="fas fa-check-circle"></i> Successfully added to your shopping cart! ';

                        if (response['status'] == 'already') {
                            $.notify({
                                message: response['message'],
                            }, {
                                type: 'warning',
                                allow_dismiss: false,
                                delay: 2800,
                                animate: {
                                    enter: 'animated flipInY',
                                    exit: 'animated flipOutX'
                                },
                                onShow: function() {
                                    this.css({
                                        'width': 'auto',
                                        'height': 'auto'
                                    });
                                },
                            });
                            return false;
                        }
                        if (response['status']) {
                            $('body #header').html(response['header']);
                            $.notify({
                                message: message,
                            }, {
                                type: 'info',
                                allow_dismiss: false,
                                delay: 2800,
                                animate: {
                                    enter: 'animated flipInY',
                                    exit: 'animated flipOutX'
                                },
                                onShow: function() {
                                    this.css({
                                        'width': 'auto',
                                        'height': 'auto'
                                    });
                                },
                            });
                        } else {
                            $.notify({
                                message: '<i class="fas fa-times-circle"></i>'.response['message'],
                            }, {
                                type: 'danger',
                                allow_dismiss: false,
                                delay: 2800,
                                animate: {
                                    enter: 'animated flipInY',
                                    exit: 'animated flipOutX'
                                },
                                onShow: function() {
                                    this.css({
                                        'width': 'auto',
                                        'height': 'auto'
                                    });
                                },
                            });
                        }

                    },
                    error: function(err) {
                        alert(err);
                    }
                })
            })
        </script>


        <script>
            //close the modal when we click save button
            $(document).ready(function() {
                $('#close_modal').on('click', function() {
                    $('#AllColors').modal('hide');
                });
            });
            $(document).on('click', '.product_detail_color_pick', function(e) {
                // e.preventDefault()
                var color_code = $(this).data('color_code');
                var color_name = $(this).data('color_name');
                if (color_code != null) {
                    $('.picked-color-circle').css('background-color', color_code);
                    $('.picked-color-name').html(color_name)
                    $('.picked-color-name').val(color_name)
                }
                $('input[name="color"]').val(color_code);


                // var formObj = document.getElementById('mobile-select-color');
                // alert(JSON.stringify($('#add-to-cart-form').serializeArray()))
                $("#mobile-select-color").val(color_code).change();
                $("select").niceSelect('update');

                // $('#mobile-select-color option[value=color_code]').attr('selected','selected');
                // $('#mobile-select-color option[value="#ffffff"]').attr("selected", "selected");
                // $("#mobile-select-color").val("#ffffff");

                getVariantPrice();
            });
            $(document).on('click', '.product_detail_size_pick', function(e) {
                // e.preventDefault()
                var size = $(this).data('size');
                var attribute_id = $(this).data('attribute_id');
                console.log(attribute_id);
                if (size != null) {
                    $("#mobile-select-size").val(size).change();

                }
                $("select").niceSelect('update');

                var size_name = 'attribute_id_' + attribute_id;

                $('#size_item').val(size);
                getVariantPrice();
            });


            // function selectElement(id, valueToSelect) {
            //     let element = document.getElementById(id);
            //     console.log(JSON.stringify(element.value));
            //     element.value = valueToSelect;
            // }
        </script>

        {{--  mobile color select  --}}
        <script>
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function(m) {
                    return m;
                }
            });
            $('.demo-select2').select2({});

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state.text;
            }
        </script>

        <script>
            $('.load-more').click(function() {
                var total_result = parseInt($(".load-more").attr('data-totalResult'));
                var total_currentResult = $('.review-item').length;
                var product_id = {{ $product->id }};
                $.ajax({
                    type: 'get',
                    url: main_site + '/product-more-reviews/' + product_id,
                    data: {
                        skip: total_currentResult,
                    },
                    beforeSend: function() {
                        $('#loading').show();
                    },
                    complete: function() {
                        $('#loading').hide();
                    },
                    success: function(response) {
                        if (response['status']) {
                            $('#reviews').append(response['data']);
                            if (total_currentResult == total_result) {
                                $('.load-more').addClass('d-none');
                            } else {
                                $('.load-more').removeClass('d-none');
                            }
                        } else {
                            alert('server error');
                        }
                    }
                })
            })
        </script>
        <script>
            getVariantPrice();
            $('#add-to-cart-form input').on('change', function() {
                getVariantPrice();
            });

            // check the validity
            function checkAddToCartValidity() {
                var names = {};
                $('#add-to-cart-form input:radio').each(function() { // find unique names
                    names[$(this).attr('name')] = true;
                });
                var count = 0;
                $.each(names, function() { // then count them
                    count++;
                });
                console.log(count);
                if ($('#add-to-cart-form input:radio:checked').length == count) {
                    return true;
                }
                return false;
            }

            // add to cart
            function addToCart(form_id = 'add-to-cart-form') {
                $('#addToCart-modal-body').html(null);
                if (true) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('add.to.cart') }}',
                        data: $('#' + form_id).serializeArray(),
                        beforeSend: function() {
                            $('#loading').show();
                        },
                        complete: function() {
                            $('#loading').hide();
                        },
                        success: function(response) {
                            console.log(response);
                            var message =
                                '<i class="fas fa-check-circle"></i> Successfully added to your shopping cart! ';
                            if (response['status'] == 'already') {
                                $.notify({
                                    message: response['message'],
                                }, {
                                    type: 'warning',
                                    allow_dismiss: false,
                                    delay: 2800,
                                    animate: {
                                        enter: 'animated flipInY',
                                        exit: 'animated flipOutX'
                                    },
                                    onShow: function() {
                                        this.css({
                                            'width': 'auto',
                                            'height': 'auto'
                                        });
                                    },
                                });
                                return false;
                            }
                            if (response['status']) {
                                $('#addedToCart').modal();
                                $('#modal-size').removeClass('modal-lg');
                                $('body #header').html(response['header']);
                                $('body #nav').html(response['nav']);
                                $('#addToCart-modal-body').html(response['view']);
                            } else {
                                $.notify({
                                    message: '<i class="fas fa-times-circle"></i>'.response['message'],
                                }, {
                                    type: 'danger',
                                    allow_dismiss: false,
                                    delay: 2800,
                                    animate: {
                                        enter: 'animated flipInY',
                                        exit: 'animated flipOutX'
                                    },
                                    onShow: function() {
                                        this.css({
                                            'width': 'auto',
                                            'height': 'auto'
                                        });
                                    },
                                });
                            }
                        },
                    });
                    // modal.modal('show');
                } else {
                    $.notify({
                        message: '<i class="fas fa-times-circle"></i> ' + 'Sorry: Please choose all the options',
                    }, {
                        type: 'danger',
                        allow_dismiss: false,
                        delay: 2800,
                        animate: {
                            enter: 'animated flipInY',
                            exit: 'animated flipOutX'
                        },
                        onShow: function() {
                            this.css({
                                'width': 'auto',
                                'height': 'auto'
                            });
                        },
                    })
                }
            }

            // cartQuantityInitalize
            function cartQuantityInitialize() {
                $('.btn-number').click(function(e) {
                    e.preventDefault();
                    fieldName = $(this).attr('data-field');
                    type = $(this).attr('data-type');
                    var input = $("input[name='" + fieldName + "']");
                    var currentVal = parseInt(input.val());
                    if (!isNaN(currentVal)) {
                        if (type == 'minus') {
                            if (currentVal > input.attr('min')) {
                                input.val(currentVal - 1).change();
                            }
                            if (parseInt(input.val()) == input.attr('min')) {
                                $(this).attr('disabled', true);
                            }
                        } else if (type == 'plus') {
                            if (currentVal < input.attr('max')) {
                                input.val(currentVal + 1).change();
                            }
                            if (parseInt(input.val()) == input.attr('max')) {
                                $(this).attr('disabled', true);
                            }
                        }
                    } else {
                        input.val(0);
                    }
                });
                $('.input-number').focusin(function() {
                    $(this).data('oldValue', $(this).val());
                });
                $('.input-number').change(function() {
                    minValue = parseInt($(this).attr('min'));
                    maxValue = parseInt($(this).attr('max'));
                    valueCurrent = parseInt($(this).val());
                    var name = $(this).attr('name');
                    if (valueCurrent >= minValue) {
                        $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                    } else {
                        alert('Sorry, the minimum value was reached');
                        $(this).val($(this).data('oldValue'));
                    }
                    if (valueCurrent <= maxValue) {
                        $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                    } else {
                        alert('Sorry, stock limit exceeded.');
                        $(this).val($(this).data('oldValue'));
                    }
                });
                $(".input-number").keydown(function(e) {
                    // Allow: backspace, delete, tab, escape, enter and .
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                        // Allow: Ctrl+A
                        (e.keyCode == 65 && e.ctrlKey === true) ||
                        // Allow: home, end, left, right
                        (e.keyCode >= 35 && e.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
            }

            function getVariantPrice() {
                if ($('#add-to-cart-form input[name=quantity]').val() > 0) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: '{{ route('variant_price') }}',
                        data: $('#add-to-cart-form').serializeArray(),
                        success: function(data) {
                            console.log(data);
                            $('#add-to-cart-form #chosen_price_div').removeClass('d-none');
                            $('#add-to-cart-form #chosen_price_div .chosen_price').html(data.price);
                            $('#available-quantity').html(data.quantity);
                            $('.cart-qty-field').attr('max', data.quantity);
                        }
                    });
                }
            }

            function checkAddToCartValidity() {
                var names = {};
                $('#add-to-cart-form input:radio').each(function() { // find unique names
                    names[$(this).attr('name')] = true;
                });
                var count = 0;
                $.each(names, function() { // then count them
                    count++;
                });
                if ($('input:radio:checked').length == count) {
                    return true;
                }
                return false;
            }
        </script>
@endpush
