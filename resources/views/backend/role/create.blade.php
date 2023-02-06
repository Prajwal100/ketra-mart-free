@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">
                        <a href="{{route('staff.index')}}" class="btn btn-primary me-2"><i class="fe fe-arrow-left"></i> Go Back</a>
                    </h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Role</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        @include('layouts._error_notify')
                    </div>
                </div>
                <!-- Role Form Area Start Here -->
                <div class="card height-auto">

                    <div class="card-body">
                        <form class="new-added-form" action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                    <label>Name *</label>
                                    <input type="text" placeholder="Enter name" class="form-control" name="name" value="{{old('name')}}">
                                </div>


                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                    <label>Permissions *</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="checkbox" name="permissions[]" value="banner">
                                                <label for=""><small>Banner Management </small></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="checkbox" name="permissions[]" value="category">
                                                <label for=""><small>Category Management</small> </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="checkbox" name="permissions[]" value="product">
                                                <label for=""><small>Product Management</small> </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="checkbox" name="permissions[]" value="order">
                                                <label for=""><small>Order Management</small> </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="checkbox" name="permissions[]" value="review">
                                                <label for=""><small>Review Management</small> </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="checkbox" name="permissions[]" value="coupon">
                                                <label for=""><small>Coupon Management</small> </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="checkbox" name="permissions[]" value="staff">
                                                <label for=""><small>Staff Management</small> </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="checkbox" name="permissions[]" value="customer">
                                                <label for=""><small>Customer Management</small> </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="checkbox" name="permissions[]" value="settings">
                                                <label for=""><small>General Settings</small> </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Add Role</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Admit Form Area End Here -->
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
@endsection
