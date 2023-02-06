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
                        <a href="{{route('banner.index')}}" class="btn btn-primary me-2"><i class="fe fe-arrow-left"></i> Go Back</a>
                    </h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Shipping</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Add New Shipping</div>
                            </div>
                            <form class="new-added-form" action="{{route('shipping.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Shipping Address :</label>
                                        <div class="col-md-9">
                                            <input type="text" required class="form-control" placeholder="Shipping Address" name="shipping_address" value="{{old('shipping_address')}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Delivery Time (approx) :</label>
                                        <div class="col-md-9">
                                            <input type="text" required class="form-control" placeholder="Deliver Time" name="delivery_time" value="{{old('delivery_time')}}">
                                        </div>
                                    </div>

                                    <!-- Row -->
                                    <div class="row">
                                        <label class="col-md-3 form-label mb-4">Delivery Charge * :</label>
                                        <div class="col-md-9 mb-4">
                                            <input type="number" required step="any" class="form-control" placeholder="Deliver Charge" name="delivery_charge" value="{{old('delivery_charge')}}">
                                        </div>
                                    </div>
                                    <!--End Row-->

                                    <!--Row-->
                                    <div class="row">
                                        <label class="col-md-3 form-label mb-4">Status * :</label>
                                        <div class="col-md-9">

                                            <select name="status" class="form-control select2 form-select" data-placeholder="Choose one">
                                                <option value="active" {{old('status')=='active' ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{old('status')=='inactive' ? 'selected' : ''}}>Inactive</option>
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
                                            <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Add Shipping</button>
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
