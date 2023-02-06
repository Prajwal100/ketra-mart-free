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
                        <li class="breadcrumb-item active">My Address</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- My Account Area -->
    <section class="my-account-area section_padding_100_50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="my-account-navigation mb-50">
                        @include('frontend.user.sidebar')
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="my-account-content mb-50">
                        <p>The following addresses will be used on the checkout page by default.</p>
                        <div class="row">
                            <div class="col-md-12">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                                <div class="address-card">
                                    <h6 class="mb-3">Billing Address</h6>
                                    <address>
                                        @if($user->address || $user->address2 ||$user->state || $user->country ||$user->postcode)
                                        {{$user->address}}, {{$user->address2}} <br>
                                        {{$user->state}} <br>
                                        {{$user->country}}, {{$user->postcode}}
                                        <br>
                                        @else
                                            <p class="text-danger">Please add your billing address.</p>
                                        @endif
                                    </address>
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editAddress">Edit Address</a>
                                </div>

                                {{--Address Model--}}
                                <div class="modal fade" id="editAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false" style="background:rgba(0,0,0,.5);z-index: 999999999999;">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Address</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('billing.address',$user->id)}}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Address</label>
                                                            <textarea name="address" id="" class="form-control" placeholder="eg. Kadaghari">{{$user->address}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Address 2 (optional)</label>
                                                            <input name="address2" id="" class="form-control" placeholder="eg. Kathmandu" value="{{$user->address2}}"></input>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Country</label>
                                                            <input name="country" id="" class="form-control" placeholder="eg. Nepal" value="{{$user->country}}"></input>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Postcode</label>
                                                            <input name="postcode" id="" class="form-control" placeholder="eg. 44600" value="{{$user->postcode}}"></input>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">State</label>
                                                            <input name="state" id="" class="form-control" placeholder="eg. state1" value="{{$user->state}}"></input>
                                                        </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info">Save address</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="address-card">
                                    <h6 class="mb-3">Shipping Address</h6>
                                    <address>
                                        @if($user->saddress || $user->saddress2 ||$user->sstate || $user->scountry ||$user->spostcode)

                                        {{$user->saddress}}, {{$user->saddress2}}  <br>
                                        {{$user->sstate}}<br>
                                        {{$user->scountry}},{{$user->spostcode}}
                                        <br>
                                        @else
                                            <p class="text-danger">Please add your shipping address.</p>
                                        @endif

                                    </address>
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editSAddress">Edit Address</a>
                                </div>
                                <div class="modal fade" id="editSAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false" style="background:rgba(0,0,0,.5);">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Shipping Address</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('shipping.address',$user->id)}}" method="post">
                                                @csrf

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">Shipping Address</label>
                                                        <textarea name="saddress" id="" class="form-control" placeholder="eg. Kadaghari">{{$user->saddress}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping Address2</label>
                                                        <input name="saddress2" id="" class="form-control" placeholder="eg. Kathmandu">{{$user->saddress2}}</input>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping Country</label>
                                                        <input name="scountry" id="" class="form-control" placeholder="eg. Nepal">{{$user->scountry}}</input>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping Postcode</label>
                                                        <input name="spostcode" id="" class="form-control" placeholder="eg. 44600">{{$user->spostcode}}</input>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping State</label>
                                                        <input name="sstate" id="" class="form-control" placeholder="eg. state1">{{$user->sstate}}</input>
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info">Save Address</button>
                                                </div>
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
    </section>
    <!-- My Account Area -->

@endsection

@section('styles')
    <style>
        .footer_area{
            z-index: -1;
        }
    </style>

    @endsection
