
@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('layouts._error_notify')
                    </div>
                </div>
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">
                        <a href="{{route('coupon.index')}}" class="btn btn-primary me-2"><i class="fe fe-arrow-left"></i> Go Back</a>
                    </h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Coupon</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Edit Coupon</div>
                            </div>
                            <form class="new-added-form" action="{{route('coupon.update',$coupon->id)}}" method="post">
                                @csrf
                                @method('patch')

                                <div class="card-body">
                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Coupon title:</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Enter coupon title" class="form-control" name="title" value="{{$coupon->title}}">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Coupon code *:</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Enter coupon code" class="form-control" name="code" value="{{$coupon->code}}">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Discount Type * :</label>
                                        <div class="col-md-9">
                                            <select name="type" class="form-control form-select select2" data-bs-placeholder="Select discount type">
                                                <option value="fixed" {{$coupon->type=='fixed' ? 'selected': ''}}>Amount</option>
                                                <option value="percent" {{$coupon->type=='percent' ? 'selected': ''}}>Percent</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Value:</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Enter value" class="form-control"  name="value" value="{{$coupon->value}}">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Start Date:</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="yyyy-mm-dd" autocomplete="off" name="start_date" class="form-control air-datepicker"
                                                   data-position='bottom right' value="{{$coupon->start_date}}">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Expire Date:</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="yyyy-mm-dd" autocomplete="off" name="expire_date" class="form-control air-datepicker"
                                                   data-position='bottom right' value="{{$coupon->expire_date}}">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <!--Row-->
                                    <div class="row">
                                        <label class="col-md-3 form-label mb-4">Status * :</label>
                                        <div class="col-md-9">
                                            <select name="status" class="form-control select2 form-select" data-placeholder="Choose one">
                                                <option value="active" {{$coupon->status=='active' ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{$coupon->status=='inactive' ? 'selected' : ''}}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--End Row-->
                                </div>
                                <div class="card-footer">
                                    <!--Row-->
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                            <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Update Coupon</button>
                                        </div>
                                    </div>
                                    <!--End Row-->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /ROW-1 CLOSED -->
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
@endsection
