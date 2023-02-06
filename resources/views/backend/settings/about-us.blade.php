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
                            <li class="breadcrumb-item active" aria-current="page">Update About Us</li>
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
                            <form action="{{route('about.us.update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="row clearfix">

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Top Description</label>
                                            <textarea  class="form-control description" placeholder="Write some meta description..." rows="15" name="description1">@isset($aboutUs) {{$aboutUs->description1}} @else {{old('description1')}} @endisset</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="">Bottom Description</label>
                                            <textarea   class="form-control description" placeholder="Write some meta description..." rows="15" name="description2">@isset($aboutUs) {{$aboutUs->description2}} @else {{old('description2')}} @endisset</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="">Top Background Image</label>
                                            <input type="file" name="image1" class="dropify" id="input-file-now" data-height="80" data-default-file="@isset($aboutUs) {{asset('storage/frontend/images/settings/'.$aboutUs->image1)}}@endisset" value="@isset($aboutUs){{asset('storage/frontend/images/settings/'.$aboutUs->image1)}}@endisset">
                                        </div>
                                    </div>



                                    <div class="col-lg-6 col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="">Bottom Background Image</label>
                                            <input type="file" name="image2" class="dropify" id="input-file-now" data-height="80" data-default-file="@isset($aboutUs){{asset('storage/frontend/images/settings/'.$aboutUs->image2)}}@endisset" value="Hello">
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
