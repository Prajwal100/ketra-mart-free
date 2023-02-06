@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Orders</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Orders</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h2 class="title1458">Invoice <a href="{{route('orders.index')}}" class="btn btn-primary me-2"><i class="fe fe-arrow-left"></i> Go Back</a>
                        </h2>
                    </div>
                    <div class="card-body invoice-content">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="ordr-date">
                                    <b>OrderID:</b> #{{$order->order_number}}<br>
                                    <b>Order Date :</b> {{\Carbon\Carbon::parse($order->created_at)->format('d F, Y')}}<br>
                                    <b>Name :</b> {{ucfirst($order->first_name)}} {{ucfirst($order->last_name)}}<br>
                                    <b>Phone number :</b> {{$order->phone}}<br>
                                    <b>Email Address :</b> {{$order->email}}<br>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="ordr-date">
                                    <b>Bill Address :</b><br>
                                    {{$order->address}},
                                    {{$order->address2}},<br>
                                    {{$order->state}},
                                    {{$order->country}},<br>
                                    {{$order->postcode}}<br>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="ordr-date">
                                    <b>Shipping Address :</b><br>
                                    {{$order->saddress}},
                                    {{$order->saddress2}},<br>
                                    {{$order->sstate}},
                                    {{$order->scountry}},<br>
                                    {{$order->spostcode}}<br>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12 mt-5">
                                <div class="card card-static-2 mb-30 mt-30">
                                    <div class="card-title-2">
                                        <h4>Recent Orders</h4>
                                    </div>
                                    <div class="card-body-table">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table ucp-table table-hover">
                                                <thead>
                                                <tr>
                                                    <th style="width:130px">S.N.</th>
                                                    <th>Item</th>
                                                    <th>Variation</th>
                                                    <th>Image</th>
                                                    <th style="width:150px" class="text-center">Price</th>
                                                    <th style="width:150px" class="text-center">Qty</th>
                                                    <th style="width:100px" class="text-center">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->orderDetails as $item)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>
                                                                <a href="{{route('product.detail',$item->product->slug)}}" target="_blank">{{ucfirst($item->product->title)}}</a>
                                                            </td>
                                                            <td>
                                                                {{$item['variation']}}
                                                            </td>
                                                            <td>
                                                                <img src="{{asset($item->product->thumbnail_image)}}" width="100" alt="">
                                                            </td>
                                                            <td class="text-center">{{Helper::currency_converter($item->price / $item->quantity)}}</td>
                                                            <td class="text-center">{{$item->quantity}}</td>
                                                            <td class="text-center">{{Helper::currency_converter($item->price)}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 " >
                                @if($order->note)
                                    <div class="border p-3">
                                        <h6 style="text-decoration: underline">Customer Note</h6>
                                        <p>{!! html_entity_decode($order->note) !!}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-5">
                                <div class="row">
                                    <div class="col-4">
                                        <strong>Sub Total :</strong>
                                    </div>
                                    <div class="col-8">
                                        {{Helper::currency_converter($order->subtotal)}}
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <strong>Shipping Fees :</strong>
                                    </div>
                                    <div class="col-8">
                                        {{Helper::currency_converter($order->delivery_charge)}}
                                    </div>
                                </div>

                                <div class="row mt-3">

                                    <div class="col-4">
                                        <strong>Coupon Discount :</strong>
                                    </div>
                                    <div class="col-8">
                                        {{Helper::currency_converter($order->coupon)}}
                                    </div>
                                </div>
                                <div class="row mt-3">

                                    <div class="col-4">
                                        <strong>Total Amount :</strong>
                                    </div>
                                    <div class="col-8">
                                        {{Helper::currency_converter($order->total_amount)}}
                                    </div>

                                </div>

                                <div class="row mt-4">
                                    <div class="col-4">
                                        <strong>Status :</strong>
                                    </div>
                                    <div class="col-8">
                                        <form action="{{route('order.status')}}" id="order-status" method="post">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            <select class="form-control select2 form-select" name="order_status" id="">
                                                {{-- Pending order--}}
                                                @if($order->order_status=='process' || $order->order_status=='delivered' || $order->order_status=='cancelled' )
                                                    <option disabled value="pending" {{$order->order_status=='pending' ? 'selected' : ''}}>Pending</option>
                                                @else
                                                    <option value="pending" {{$order->order_status=='pending' ? 'selected' : ''}}>Pending</option>
                                                @endif

                                                {{-- Process Order --}}
                                                @if($order->order_status=='delivered' || $order->order_status=='cancelled' )
                                                    <option disabled value="process" {{$order->order_status=='process' ? 'selected' : ''}}>Process</option>
                                                @else
                                                    <option value="process" {{$order->order_status=='process' ? 'selected' : ''}}>Process</option>
                                                @endif

                                                {{-- Delivered Order --}}
                                                @if($order->order_status=='cancelled' )
                                                    <option disabled value="delivered" {{$order->order_status=='delivered' ? 'selected' : ''}}>Delivered</option>
                                                @else
                                                    <option value="delivered" {{$order->order_status=='delivered' ? 'selected' : ''}}>Delivered</option>
                                                @endif

                                                {{-- Order cancelled --}}
                                                @if($order->order_status=='delivered')
                                                    <option disabled value="cancelled" {{$order->order_status=='cancelled' ? 'selected' : ''}}>Cancelled</option>
                                                @else
                                                    <option value="cancelled" {{$order->order_status=='cancelled' ? 'selected' : ''}}>Cancelled</option>
                                                @endif
                                            </select>
                                            <button id="status_btn" class="btn btn-success me-2 mt-3 create-btn"><i class="fa fa-sync"></i> Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
@endsection
@section('styles')
    <style>
        .key{
            color: #2b8286;
        }
        .value{
            font-weight:bold;
        }
        .detail{
            position: relative;
        }
        .detail a{
            border-bottom: 1px dotted #55a2a6;
        }
        .detail:hover .detail_info{
            display: block;
        }
        .detail_info{
            display: none;

            position: absolute;
            top: 0px;
            left: 50px;
            width: 200px;
            padding: 12px 15px;
            text-align: left;
            background-color: #d7fdff!important;
            border: 1px solid #55a2a6!important;
            border-radius: 4px;
        }

        .detail_info li{
            list-style: none;
        }


    </style>
@endsection

@section('scripts')
    <script>
        $('#status_btn').click(function () {
            $('#status_btn').html('<i class="fas fa-spinner fa-spin"></i> Updating..');
            $('#order-status').submit();
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/jquery.magnific-popup.min.js" integrity="sha512-+m6t3R87+6LdtYiCzRhC5+E0l4VQ9qIT1H9+t1wmHkMJvvUQNI5MKKb7b08WL4Kgp9K0IBgHDSLCRJk05cFUYg==" crossorigin="anonymous"></script>

    <script>
        $('.custom-image').magnificPopup({
            type: 'image'
            // other options
        });
    </script>
@endsection
