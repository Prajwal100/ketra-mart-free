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
                            <li class="breadcrumb-item active" aria-current="page">Add Data</li>
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
                            <form action="{{route('why-choose-us.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row clearfix">

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <textarea rows="5" class="form-control" placeholder="Write something.." name="description" required>{{old('description')}}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-sm-12 mt-3" >
                                       <div class="form-group">
                                           <label for="status">Status <span class="text-danger">*</span></label>
                                           <select name="status" class="form-control select2 form-select" data-placeholder="Choose one">
                                               <option value="active" {{old('status')=='active' ? 'selected' : ''}}>Active</option>
                                               <option value="inactive" {{old('status') == 'inactive' ? 'selected' : ''}} >Inactive</option>
                                           </select>
                                       </div>
                                    </div>
                                    <div class="col-12 form-group mg-t-8 mt-2">
                                        <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Create Data</button>
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
