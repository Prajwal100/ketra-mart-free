@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Why Choose</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="row pb-4">
                    <div class="col-md-12">
                        @include('layouts._error_notify')
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card p-4">
                            <form action="{{route('why-choose-us.update',$whychoose->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row clearfix">
                                    <div class="row">
                                        <label class="col-md-3 form-label mb-4">Description :</label>
                                        <div class="col-md-9">
                                            <textarea rows="5" class="form-control" placeholder="Content" name="description">{{$whychoose->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <label class="col-md-3 form-label mb-4">Status * :</label>
                                        <div class="col-md-9">
                                            <select name="status" class="form-control select2 form-select" data-placeholder="Choose one">
                                                <option value="active" {{$whychoose->status=='active' ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{$whychoose->status=='inactive' ? 'selected' : ''}}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group mg-t-8 mt-2">
                                        <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Update Data</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>

            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
@endsection
