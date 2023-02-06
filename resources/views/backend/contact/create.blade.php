@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header pt-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Add Banners</h4>
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
                    <div class="card">
                        <div class="body p-4">
                            <form action="{{route('banners.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Banner Heading </label>
                                            <input type="text" class="form-control" placeholder="Heading" name="title" value="{{old('title')}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">URL</label>
                                            <input type="text" class="form-control" placeholder="URL" name="slug" value="{{old('slug')}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <textarea id="description" class="form-control" placeholder="Write something.." name="description">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Banner Image <span class="text-danger">*</span></label>
                                            <input type="file" name="image" class="dropify" id="input-file-now" data-height="100" data-default-file="{{old('image')}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-12" >
                                        <div class="form-group">
                                            <label for="status">Condition <span class="text-danger">*</span></label>
                                            <select name="condition" class="form-control show-tick">
                                                <option value="home" {{old('condition')=='home' ? 'selected' : ''}}>Home Banner</option>
                                                <option value="promo" {{old('condition') == 'promo' ? 'selected' : ''}} >Promo Banner</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-12" >
                                        <div class="form-group">
                                            <label for="status">Text Position <span class="text-danger">*</span></label>
                                            <select name="position" class="form-control show-tick">
                                                <option value="left" {{old('position')=='left' ? 'selected' : ''}}>Left Position</option>
                                                <option value="center" {{old('position') == 'center' ? 'selected' : ''}} >Center Position</option>
                                                <option value="right" {{old('position') == 'right' ? 'selected' : ''}} >Right Position</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-12" >
                                       <div class="form-group">
                                           <label for="status">Status <span class="text-danger">*</span></label>
                                           <select name="status" class="form-control show-tick">
                                               <option value="active" {{old('status')=='active' ? 'selected' : ''}}>Active</option>
                                               <option value="inactive" {{old('status') == 'inactive' ? 'selected' : ''}} >Inactive</option>
                                           </select>
                                       </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                           <button type="submit" class="btn btn-info">Create Banner</button>
                                           <button type="reset" class="btn btn-outline-danger">Cancel</button>
                                       </div>
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
