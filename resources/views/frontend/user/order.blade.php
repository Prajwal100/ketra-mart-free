@extends('frontend.layouts.master')

@section('content')


    <!-- Breadcumb Area -->
    <div class="breadcumb_area d-none">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>My Account</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- My Account Area -->
    <section class="my-account-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="my-account-navigation mb-50">
                        @include('frontend.user.sidebar')
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="my-account-content mb-50">
                        <div class="cart-table">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">Order Number</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($orders)>0)
                                        @foreach($orders as $order)
                                            <tr>
                                                <th scope="row">
                                                    #{{$order->order_number}}
                                                </th>
                                                <td>
                                                    {{\Carbon\Carbon::parse($order->created_at)->format('d M Y')}}
                                                </td>
                                                <td>
                                                    {{ucfirst($order->condition)}}
                                                </td>
                                                <td>$ {{number_format($order->total_amount,2)}}</td>
                                                <td>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target=".viewOrder" class="btn btn-info btn-sm m-2"><i class="fa fa-eye"></i> view detail</a>
                                                </td>

                                                {{--view detail order--}}

                                                <div class="modal fade viewOrder" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Order Number #{{$order->order_number}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p><b>Sub Total : </b>Rs. {{number_format($order->sub_total,2)}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p><b>Coupon : </b>Rs. {{number_format($order->coupon,2)}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p><b>Delivery Charge : </b>Rs. {{number_format($order->delivery_charge,2)}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p><b>Total Amount : </b>Rs. {{number_format($order->total_amount,2)}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p><b>Payment Method : </b>{{$order->payment_method}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p><b>Payment Status : </b><span class="badge badge-{{$order->payment_status=='paid' ? 'success' : 'danger'}}">{{ucfirst($order->payment_status)}}</span></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row pb-3">
                                                                    <div class="col-md-6">
                                                                        <h5 style="text-decoration: underline">Billing Address :</h5>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <h5 style="text-decoration: underline">Shipping Address :</h5>
                                                                    </div>
                                                                </div>
                                                               <div class="row">
                                                                   <div class="col-md-6">
                                                                       <p><b>First Name : </b>{{ucfirst($order->first_name)}}</p>
                                                                   </div>
                                                                   <div class="col-md-6">
                                                                       <p><b>First Name : </b>{{ucfirst($order->sfirst_name)}}</p>
                                                                   </div>

                                                               </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p><b>Last Name : </b>{{ucfirst($order->last_name)}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p><b>Last Name : </b>{{ucfirst($order->slast_name)}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                   <div class="col-md-6">
                                                                       <p><b>Email : </b>{{$order->email}}</p>
                                                                   </div>
                                                                    <div class="col-md-6">
                                                                       <p><b>Email : </b>{{$order->semail}}</p>
                                                                   </div>

                                                               </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p><b>Phone : </b>{{$order->phone}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p><b>Phone : </b>{{$order->sphone}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                   <div class="col-md-6">
                                                                       <p><b>Address : </b>{{$order->address}}</p>
                                                                   </div>
                                                                    <div class="col-md-6">
                                                                       <p><b>Address : </b>{{$order->saddress}}</p>
                                                                   </div>

                                                               </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p><b>Address2 : </b>{{$order->address2}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p><b>Address2 : </b>{{$order->saddress2}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                   <div class="col-md-6">
                                                                       <p><b>State : </b>{{$order->state}}</p>
                                                                   </div>
                                                                   <div class="col-md-6">
                                                                       <p><b>State : </b>{{$order->sstate}}</p>
                                                                   </div>
                                                               </div> <div class="row">
                                                                   <div class="col-md-6">
                                                                       <p><b>Postcode : </b>{{$order->postcode}}</p>
                                                                   </div>
                                                                    <div class="col-md-6">
                                                                        <p><b>Postcode : </b>{{$order->spostcode}}</p>
                                                                    </div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                No order found!
                                            </td>
                                        </tr>
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->
@endsection
