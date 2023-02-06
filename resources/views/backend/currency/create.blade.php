@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header pt-3">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h5 class="text-uppercase"><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"></a>Add Currency</h5>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    @include('backend.layouts._error_notify')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card p-4">
                        <div class="body">
                            <form action="{{route('currency.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Currency name <span class="text-danger">*</span></label>
                                            <input required type="text" class="form-control" placeholder="US dollar" name="name" value="{{old('name')}}" >
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Currency Symbol <span class="text-danger">*</span></label>
                                            <input required type="text" class="form-control" placeholder="$" name="symbol" value="{{old('symbol')}}" >
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Currency Code <span class="text-danger">*</span></label>
                                            <input required type="text" class="form-control" placeholder="USD" name="code" value="{{old('code')}}" >
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Exchange Rate <span class="text-danger">*</span></label>
                                            <input required type="text" class="form-control" placeholder="100" name="exchange_rate" value="{{old('exchange_rate')}}" >
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Flag</label>
                                            <input required type="file" name="flag" class="dropify" data-height="100"  value="{{old('flag')}}">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control show-tick">
                                        <option value="active" {{old('status')=='active' ? 'selected' : ''}}>Active</option>
                                        <option value="inactive" {{old('status') == 'inactive' ? 'selected' : ''}} >Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info create-btn">Create Category</button>
                                    <button type="reset" class="btn btn-outline-danger cancel-btn">Cancel</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('styles')
    <style>
        label{
            font-weight: bold;
        }
    </style>
@endsection
