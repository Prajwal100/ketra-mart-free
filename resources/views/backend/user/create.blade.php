@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header pt-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h5 class="text-uppercase">Add Admin</h5>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    @include('backend.layouts._error_notify')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body p-4">
                            <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Full name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Name" name="name" value="{{old('name')}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Email Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Email address" name="email" value="{{old('email')}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" placeholder="Enter 6 characters" name="password">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" placeholder="Repeat password" name="password_confirmation">
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
                                            <button type="submit" class="btn btn-info create-btn">Create Admin</button>
                                            <button type="reset" class="btn btn-outline-danger cancel-btn">Cancel</button>
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
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>

    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection
