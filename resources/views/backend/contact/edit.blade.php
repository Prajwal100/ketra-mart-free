@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Edit Banners</h2>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card p-4">
                        <div class="body">
                            <form action="{{route('banners.update',$banner->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Banner Heading</label>
                                            <input type="text" class="form-control" placeholder="Banner heading" name="title" value="{{$banner->title}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">URL</label>
                                            <input type="text" class="form-control" placeholder="URL" name="slug" value="{{$banner->slug}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <textarea id="description" class="form-control" placeholder="Write something.." name="description">{{$banner->description}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Banner Image <span class="text-danger">*</span></label>
                                            <input type="file" name="image" class="dropify" id="input-file-now" data-height="100" data-default-file="{{asset($banner->image_path)}}" value="{{asset($banner->image_path)}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-12" >
                                        <div class="form-group">
                                            <label for="status">Condition <span class="text-danger">*</span></label>
                                            <select name="condition" class="form-control show-tick">
                                                <option value="home" {{$banner->condition=='home' ? 'selected' : ''}}>Home Banner</option>
                                                <option value="promo" {{$banner->condition == 'promo' ? 'selected' : ''}} >Promo Banner</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-12" >
                                        <div class="form-group">
                                            <label for="status">Text Position <span class="text-danger">*</span></label>
                                            <select name="position" class="form-control show-tick">
                                                <option value="left" {{$banner->position=='left' ? 'selected' : ''}}>Left Position</option>
                                                <option value="center" {{$banner->position == 'center' ? 'selected' : ''}} >Center Position</option>
                                                <option value="right" {{$banner->position == 'right' ? 'selected' : ''}} >Right Position</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#description').summernote({
            placeholder:'Write something'
        });
    </script>
@endsection
