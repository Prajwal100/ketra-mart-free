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
                            <li class="breadcrumb-item active" aria-current="page">Update Social Logins</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="row pb-4">
                    <div class="col-md-12">
                        @include('layouts._error_notify')
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 h6">Google Login Credential</h5>
                            </div>
                            <div class="body p-4">
                                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="GOOGLE_CLIENT_ID">
                                        <div class="col-lg-4">
                                            <label class="col-from-label">Client ID</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="GOOGLE_CLIENT_ID" value="{{  env('GOOGLE_CLIENT_ID') }}" placeholder="Google Client ID" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="GOOGLE_CLIENT_SECRET">
                                        <div class="col-lg-4">
                                            <label class="col-from-label">Client Secret</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="GOOGLE_CLIENT_SECRET" value="{{  env('GOOGLE_CLIENT_SECRET') }}" placeholder="Google Client Secret" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="GOOGLE_URL">
                                        <div class="col-lg-4">
                                            <label class="col-from-label">Google Redirect URL</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="GOOGLE_URL" value="{{  env('GOOGLE_URL') }}" placeholder="Google Redirect URL" required>
                                        </div>
                                    </div>

                                    <div class="col-12 form-group mg-t-8 mt-2">
                                        <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Update Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 h6">Facebook Login Credential</h5>
                            </div>
                            <div class="body p-4">
                                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="FACEBOOK_CLIENT_ID">
                                        <div class="col-lg-4">
                                            <label class="col-from-label">Client ID</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="FACEBOOK_CLIENT_ID" value="{{  env('FACEBOOK_CLIENT_ID') }}" placeholder="Facebook Client ID'" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="FACEBOOK_CLIENT_SECRET">
                                        <div class="col-lg-4">
                                            <label class="col-from-label">Client Secret</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="FACEBOOK_CLIENT_SECRET" value="{{  env('FACEBOOK_CLIENT_SECRET') }}" placeholder="Facebook Client Secret" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="FACEBOOK_URL">
                                        <div class="col-lg-4">
                                            <label class="col-from-label">Facebook Redirect URL</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="FACEBOOK_URL" value="{{  env('FACEBOOK_URL') }}" placeholder="Facebook Redirect URL" required>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group mg-t-8 mt-2">
                                        <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Update Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
@endsection
