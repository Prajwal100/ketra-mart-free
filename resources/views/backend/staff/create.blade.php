
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
                            <li class="breadcrumb-item active" aria-current="page">Add Staff</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        @include('layouts._error_notify')
                    </div>
                </div>
                <!-- ROW-1 OPEN -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Add Blog</div>
                            </div>
                            <form class="new-added-form" action="{{route('staff.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Name *:</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Enter name" class="form-control" name="name" value="{{old('name')}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Email *:</label>
                                        <div class="col-md-9">
                                            <input type="email" placeholder="Enter email" class="form-control" name="email" value="{{old('email')}}">
                                        </div>
                                    </div>


                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Password * :</label>
                                        <div class="col-md-9">
                                            <input type="password" placeholder="Enter atleast 6 character" class="form-control" name="password">
                                        </div>
                                    </div>


                                    <!--Row-->
                                    <div class="row">
                                        <label class="col-md-3 form-label mb-4">Role * :</label>
                                        <div class="col-md-9">
                                            <select name="role_id" class="form-control select2 form-select" data-placeholder="Choose one">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" >{{ $role->name }}</option>
                                                @endforeach
                                            </select>
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
                                            <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Add Staff</button>
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
