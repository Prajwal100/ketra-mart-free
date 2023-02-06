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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body p-4">
                            <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="MAIL_DRIVER">
                                    <label class="col-md-3 col-form-label">Type</label>
                                    <div class="col-md-12">
                                        <select class="form-control aiz-selectpicker mb-2 mb-md-0" name="MAIL_DRIVER" onchange="checkMailDriver()">
                                            <option value="sendmail" @if (env('MAIL_DRIVER') == "sendmail") selected @endif>SendMail</option>
                                            <option value="smtp" @if (env('MAIL_DRIVER') == "smtp") selected @endif>SMTP</option>
                                            <option value="mailgun" @if (env('MAIL_DRIVER') == "mailgun") selected @endif>Mailgun</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="smtp">
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="MAIL_HOST">
                                        <div class="col-md-3">
                                            <label class="col-from-label">MAIL HOST</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="MAIL_HOST"value="{{  env('MAIL_HOST') }}" placeholder="MAIL_HOST">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="MAIL_PORT">
                                        <div class="col-md-3">
                                            <label class="col-from-label">MAIL PORT</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="MAIL_PORT" value="{{  env('MAIL_PORT') }}" placeholder="MAIL PORT">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="MAIL_USERNAME">
                                        <div class="col-md-3">
                                            <label class="col-from-label">MAIL USERNAME</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="MAIL_USERNAME" value="{{  env('MAIL_USERNAME') }}" placeholder="MAIL USERNAME">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                                        <div class="col-md-3">
                                            <label class="col-from-label">MAIL PASSWORD</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{  env('MAIL_PASSWORD') }}" placeholder="MAIL PASSWORD">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                                        <div class="col-md-3">
                                            <label class="col-from-label">MAIL ENCRYPTION</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{  env('MAIL_ENCRYPTION') }}" placeholder="MAIL ENCRYPTION">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                                        <div class="col-md-3">
                                            <label class="col-from-label">MAIL FROM ADDRESS</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="MAIL_FROM_ADDRESS" value="{{  env('MAIL_FROM_ADDRESS') }}" placeholder="MAIL FROM ADDRESS">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                                        <div class="col-md-3">
                                            <label class="col-from-label">MAIL FROM NAME</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="MAIL_FROM_NAME"  value="{{  env('MAIL_FROM_NAME') }}" placeholder="MAIL_FROM_NAME">
                                        </div>
                                    </div>
                                </div>
                                <div id="mailgun">
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="MAILGUN_DOMAIN">
                                        <div class="col-md-3">
                                            <label class="col-from-label">MAILGUN DOMAIN</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="MAILGUN_DOMAIN" value="{{  env('MAILGUN_DOMAIN') }}" placeholder="MAILGUN DOMAIN">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="types[]" value="MAILGUN_SECRET">
                                        <div class="col-md-3">
                                            <label class="col-from-label">MAILGUN SECRET</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="MAILGUN_SECRET" value="{{  env('MAILGUN_SECRET') }}" placeholder="MAILGUN SECRET">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-info create-btn">Save Configuration</button>
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

@push('scripts')

    <script type="text/javascript">
        $(document).ready(function(){
            checkMailDriver();
        });
        function checkMailDriver(){
            if($('select[name=MAIL_DRIVER]').val() == 'mailgun'){
                $('#mailgun').show();
                $('#smtp').hide();
            }
            else{
                $('#mailgun').hide();
                $('#smtp').show();
            }
        }
    </script>

@endpush
