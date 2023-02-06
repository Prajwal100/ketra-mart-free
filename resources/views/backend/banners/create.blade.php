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
                            <li class="breadcrumb-item active" aria-current="page">Add Banner</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Add New Banner</div>
                            </div>
                            <form class="new-added-form" action="{{route('banner.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Content :</label>
                                        <div class="col-md-9">
                                            <textarea placeholder="Enter content" class="form-control summernote" name="content" >{{old('content')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">URL :</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Enter url" class="form-control" name="url" value="{{old('url')}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Banner Type * :</label>
                                        <div class="col-md-9">
                                            <select name="banner_type" class="form-control form-select select2" data-bs-placeholder="Select Banner">
                                                <option value="home" selected>Home</option>
                                                <option value="popup" >Popup</option>
                                                <option value="promo" >Promo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Row -->
                                    <div class="row">
                                        <label class="col-md-3 form-label mb-4">Banner Image * :</label>
                                        <div class="col-md-9 mb-4">
                                            <input required type="file" name="image" class="dropify" id="input-file-now" data-height="150" data-default-file="{{old('image')}}">
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
                                            <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Add Banner</button>
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
