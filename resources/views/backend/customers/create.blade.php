@extends('backend.layouts.master')

@section('content')
    <!-- Breadcubs Area Start Here -->

    <div class="breadcrumbs-area">
        <h3>Banner</h3>
        <ul>
            <li>
                <a href="{{route('home')}}">Home</a>
            </li>
            <li>Banner Add Form</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts._error_notify')
        </div>
    </div>
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">

        <div class="card-body">
            <form class="new-added-form" action="{{route('banner.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-xl-8 col-lg-8 col-8 form-group">
                        <label>Heading</label>
                        <input type="text" placeholder="Enter top heading" class="form-control" name="heading" value="{{old('heading')}}">
                    </div>
                    <div class="col-xl-4 col-lg-4 col-4 form-group">
                        <label>Heading Color</label>
                        <input type="color"  class="form-control" name="heading_color" value="{{old('heading_color')}}">
                    </div>

                    <div class="col-xl-8 col-lg-8 col-8 form-group">
                        <label>Subheading</label>
                        <input type="text" placeholder="Enter sub heading" class="form-control" name="subheading" value="{{old('subheading')}}">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-4 form-group">
                        <label>Subheading Color</label>
                        <input type="color"  class="form-control" name="subheading_color" value="{{old('subheading_color')}}">
                    </div>

                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                        <label>URL</label>
                        <input type="text" placeholder="Enter url" class="form-control" name="url" value="{{old('url')}}">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-4 form-group">
                        <label>Button Text</label>
                        <input type="text" placeholder="Enter button text" class="form-control" name="btn_text" value="{{old('btn_text')}}">
                    </div>
                    <div class="col-xl-4 col-lg-4 col-4 form-group">
                        <label>Button Color</label>
                        <input type="color"  class="form-control" name="btn_text_color" value="{{old('btn_text_color')}}">
                    </div>
                    <div class="col-xl-4 col-lg-4 col-4 form-group">
                        <label>Button BG Color</label>
                        <input type="color"  class="form-control" name="btn_text_bg_color" value="{{old('btn_text_bg_color')}}">
                    </div>

                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                        <label>Banner Type *</label>
                        <select class="select2" name="banner_type">
                                <option value="home" selected>Home</option>
                                <option value="popup" >Popup</option>
                                <option value="promo" >Promo</option>
                        </select>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="">Banner Image *</label>
                            <input required type="file" name="image" class="dropify" id="input-file-now" data-height="150" data-default-file="{{old('image')}}">
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-12 form-group">
                        <label>Status *</label>
                        <select class="select2" name="status">
                            <option value="active" {{old('status')=='active' ? 'selected' : ''}}>Active</option>
                            <option value="inactive" {{old('status')=='inactive' ? 'selected' : ''}}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Admit Form Area End Here -->
@endsection
