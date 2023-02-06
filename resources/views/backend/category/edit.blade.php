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
                        <a href="{{route('categories.index')}}" class="btn btn-primary me-2"><i class="fe fe-arrow-left"></i> Go Back</a>
                    </h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Category</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Edit Category</div>
                            </div>
                            <form class="new-added-form" action="{{route('categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <div class="card-body">
                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Name * :</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Enter name" class="form-control" name="title" value="{{$category->title}}" id="title">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Slug * :</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Enter slug" class="form-control" name="slug" value="{{$category->slug}}" id="slug">
                                        </div>
                                    </div>


                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Parent Category :</label>
                                        <div class="col-md-9">
                                            <select name="parent_id" class="form-control form-select select2" data-bs-placeholder="Select Category">
                                                <option value="0">No Parent</option>
                                            @foreach ($categories as $acategory)
                                                    <option value="{{ $acategory->id }}" {{$acategory->id==$category->parent_id ? 'selected ' : ''}}>{{ $acategory->title }}</option>
{{--                                                    @foreach ($acategory->childrenCategories as $childCategory)--}}
{{--                                                        @include('backend.category.child_category', ['child_category' => $childCategory,'category'=>$category])--}}
{{--                                                    @endforeach--}}
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Position * :</label>
                                        <div class="col-md-9">
                                            <input type="number" placeholder="Enter in ascending order" class="form-control" name="position" value="{{$category->position}}">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Featured :</label>
                                        <div class="col-md-9">
                                            <label class="custom-switch form-switch mb-0">
                                                <input type="checkbox" class="custom-switch-input" name="featured" value="1" {{$category->featured==1 ? 'checked' : ''}}>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Yes</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Is Menu :</label>
                                        <div class="col-md-9">
                                            <label class="custom-switch form-switch mb-0">
                                                <input type="checkbox" class="custom-switch-input" name="is_menu" value="1" {{$category->is_menu==1 ? 'checked' : ''}}>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Yes</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Row -->
                                    <div class="row">
                                        <label class="col-md-3 form-label mb-4">Banner:</label>
                                        <div class="col-md-9 mb-4">
                                            <input  type="file" name="banner" class="dropify" id="input-file-now" data-height="150" data-default-file="{{asset($category->banner)}}">
                                        </div>
                                    </div>
                                    <!--End Row-->

                                    <div class="row">
                                        <label class="col-md-3 form-label mb-4">Icon :</label>
                                        <div class="col-md-9 mb-4">
                                            <input  type="file" name="icon" class="dropify" id="input-file-now" data-height="150" data-default-file="{{asset($category->icon)}}">
                                        </div>
                                    </div>




                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Meta title :</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Enter meta title" class="form-control" name="meta_title" value="{{$category->meta_title}}">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Meta description :</label>
                                        <div class="col-md-9">
                                            <textarea  placeholder="Enter meta description"  rows="6" class="form-control" name="meta_description" >{{$category->meta_title}}</textarea>
                                        </div>
                                    </div>

                                    <!--Row-->
                                    <div class="row">
                                        <label class="col-md-3 form-label mb-4">Status * :</label>
                                        <div class="col-md-9">

                                            <select name="status" class="form-control select2 form-select" data-placeholder="Choose one">
                                                <option value="active" {{$category->status=='active' ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{$category->status=='inactive' ? 'selected' : ''}}>Inactive</option>
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
                                            <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Update Category</button>
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
