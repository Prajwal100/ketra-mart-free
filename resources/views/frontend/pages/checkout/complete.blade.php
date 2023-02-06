@extends('frontend.layouts.master')
@section('meta_title', get_settings('site_title') . ' | Order Placed')

@section('content')

    <main class="main order">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-9 col-md-offset-3">
                <div id="msform">
                    <ul id="progressbar" class="step-by pt-2 pb-2 pr-4 pl-4">
                        <li class="active"><a href="{{ route('cart') }}">Shopping Cart</a></h3>
                        <li class="active"><a href="{{ route('checkout') }}">Checkout</a></h3>
                        <li class="active"><a href="javascript:void(0);">Order Complete</a></h3>
                    </ul>

                    <fieldset>
                        <div class="container mt-8">
                            <img src="{{ asset('frontend/assets/images/order-confirmed.svg') }}" alt="Order Confirmed"
                                class="order-confirmed-img">
                            <div class="order-message">
                                Thank you, Your order has been received!!
                            </div>
                            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
                                rel="stylesheet" />

                            <div class="order-invoice container bg-shadow mt-3">
                                <div class="page-header">
                                    <h6 class="page-title">
                                        Order ID: <strong>{{ $order->order_number }}</strong>
                                    </h6>

                                    <div class="page-tools">
                                        <div class="action-buttons">
                                            <a class="btn bg-white btn-light"
                                                href="{{ route('invoice.download', $order->id) }}" data-title="Print">
                                                <i class="mr-1 fa fa-print"></i>
                                                Print
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="container px-0">
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="row text-left">
                                                <div class="col-md-6">
                                                    <b>Billing Address:</b>

                                                    <div class="address-detail text-grey-m2">
                                                        <div class="my-1">
                                                            {{ ucfirst($order->first_name) }}
                                                            {{ ucfirst($order->last_name) }}
                                                        </div>
                                                        <div class="my-1">
                                                            {{ $order->address }} & {{ $order->address2 }}
                                                        </div>

                                                        <div class="my-1">
                                                            {{ $order->state }},
                                                            {{ $order->country }},{{ $order->postcode }}
                                                        </div>
                                                        <div class="my-1"><i
                                                                class="fa fa-phone fa-flip-horizontal text-secondary"></i>
                                                            <b class="text-600">{{ $order->phone }}</b>
                                                        </div>
                                                        <div class="my-1"><i
                                                                class="fa fa-envelope fa-flip-horizontal text-secondary"></i>
                                                            <b class="text-600">{{ $order->email }}</b>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-6 justify-content-end">
                                                    <b>Shipping Address:</b>

                                                    <div class="address-detail text-grey-m2">
                                                        <div class="my-1">
                                                            {{ ucfirst($order->first_name) }}
                                                            {{ ucfirst($order->last_name) }}
                                                        </div>
                                                        <div class="my-1">
                                                            {{ $order->saddress }} & {{ $order->saddress2 }}
                                                        </div>

                                                        <div class="my-1">
                                                            {{ $order->sstate }},
                                                            {{ $order->scountry }},{{ $order->spostcode }}
                                                        </div>
                                                        <div class="my-1"><i
                                                                class="fa fa-phone fa-flip-horizontal text-secondary"></i>
                                                            <b class="text-600">{{ $order->phone }}</b>
                                                        </div>
                                                        <div class="my-1"><i
                                                                class="fa fa-envelope fa-flip-horizontal text-secondary"></i>
                                                            <b class="text-600">{{ $order->email }}</b>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="mt-4">
                                                <h6 class="text-left pt-3">Order Details</h6>
                                                <div class="order-details mb-1">
                                                    <div class="table-responsive" style="height: 100%">
                                                        <table class="table">
                                                            <thead class="bgc-default text-white">
                                                                <tr>
                                                                    <th>S.N</th>
                                                                    <th scope="col">Product</th>
                                                                    <th scope="col">Variation</th>
                                                                    <th scope="col">Description</th>
                                                                    <th scope="col">Qty</th>
                                                                    <th scope="col">Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($order->orderDetails as $key => $orderDetail)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td class="product-thumbnail">
                                                                            <a
                                                                                href="{{ route('product.detail', $orderDetail->product['slug']) }}">
                                                                                <img style="border:1px solid #ddd; height: 4rem"
                                                                                    src="{{ asset($orderDetail->product->thumbnail_image) }}"
                                                                                    alt="item">
                                                                            </a>
                                                                        </td>
                                                                        <td class="product-name">
                                                                            @php
                                                                                $Ptitle = $orderDetail->product['title'];
                                                                                $variation = $orderDetail['variation'];
                                                                            @endphp
                                                                            <a
                                                                                href="{{ route('product.detail', $orderDetail->product['slug']) }}">{{ ucfirst($Ptitle) }}</a>
                                                                        </td>
                                                                        <td>{{$variation}}</td>
                                                                        <td class="product-quantity">
                                                                            {{ $orderDetail->quantity }}</td>
                                                                        <td class="product-price">
                                                                            <span
                                                                                class="unit-amount">{{ Helper::currency_converter($orderDetail->price) }}</span>
                                                                        </td>

                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <hr />


                                                <div class="row summary mb-4">
                                                    <div class="col-md-6 text-left">
                                                        <div class="text-grey-m2 mt-3">
                                                            <b>
                                                                Invoice:
                                                            </b>
                                                            <div class="my-2"><i
                                                                    class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                                                <span class="text-600 text-90">ID:</span>
                                                                {{ $order->order_number }}
                                                            </div>

                                                            <div class="my-2"><i
                                                                    class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                                                <span class="text-600 text-90">Issue Date:</span>
                                                                {{ \Carbon\Carbon::parse($order->created_at)->format('F d, Y') }}
                                                            </div>

                                                            <div class="my-2"><i
                                                                    class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                                                <span class="text-600 text-90">Status:</span> <span
                                                                    class="badge badge-warning badge-pill py-1">{{ ucfirst($order->order_status) }}</span>
                                                            </div>
                                                            <div class="my-2"><i
                                                                    class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                                                <span class="text-600 text-90">Payment Method:</span>
                                                                {{ $order->payment_method == 'cod' ? 'Cash on delivery' : ucfirst($order->payment_method) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul class="total-summary-list">
                                                            <li class="subtotal">
                                                                <span class="key">SUBTOTAL ({{ $order->quantity }}
                                                                    ITEM): </span>
                                                                <span
                                                                    class="value">{{ Helper::currency_converter($order->subtotal) }}</span>
                                                            </li>

                                                            <li class="charges ">
                                                                <span class="key">Coupon Discount:</span>
                                                                <span
                                                                    class="value">{{ Helper::currency_converter($order->coupon) }}</span>
                                                            </li>

                                                            <li class="charges">
                                                                <span class="key">Shipping Fee:</span>
                                                                <span class="value"
                                                                    data-value="0">{{ Helper::currency_converter($order->delivery_charge) }}</span>
                                                            </li>

                                                            <li class="grand-total">
                                                                <span class="key">GRAND TOTAL:</span>
                                                                <span
                                                                    class="value">{{ Helper::currency_converter($order->total_amount) }}</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="track-order text-right">
                                                    <span
                                                        class="text-secondary-d1 text-105 float-left d-none d-lg-block">Thank
                                                        you for shopping with us!!</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('home') }}" class="btn btn-icon-left btn-back btn-md my-5"><span
                                    class="bx bx-left-arrow-alt mr-3" style="vertical-align: middle"></span> Back to
                                Home</a>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main -->
@endsection

@push('styles')
    <style>
        .key {
            color: #2b8286;
        }

        .value {
            font-weight: bold;
        }

        .detail {
            position: relative;
        }

        .detail a {
            border-bottom: 1px dotted #55a2a6;
        }

        .order-details {
            height: 200px;
        }
    </style>
@endpush
