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
                            <li class="breadcrumb-item active" aria-current="page">Update Payment Methods</li>
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
                    <div class="col-sm-6">

                        <div class="card p-4">
                            <h4 class="pb-3">Paypal Payment Gateway</h4>

                            <form class="form-horizontal" action="{{ route('payment.method.update') }}" method="POST">
                                <input type="hidden" name="payment_method" value="paypal">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label class="col-from-label">Paypal Sandbox Mode</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label  class="switch">
                                            <input class="status" value="1" name="paypal_sandbox" type="checkbox" @if (\App\Models\Setting::first()->paypal_sandbox == 1)
                                            checked
                                                @endif>
                                            <span
                                                class="slider round"></span>
                                        </label>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="PAYPAL_CLIENT_ID">
                                    <div class="col-md-12">
                                        <label class="col-from-label">Paypal Client Id</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="PAYPAL_CLIENT_ID" value="{{  env('PAYPAL_CLIENT_ID') }}" placeholder="Paypal Client ID" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="PAYPAL_CLIENT_SECRET">
                                    <div class="col-md-12">
                                        <label class="col-from-label">Paypal Client Secret</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="PAYPAL_CLIENT_SECRET" value="{{  env('PAYPAL_CLIENT_SECRET') }}" placeholder="Paypal Client Secret" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="PAYPAL_PAYMENT">
                                    <div class="col-md-12">
                                        <label class="col-from-label">Display in frontend</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label  class="switch">
                                            <input class="status" value="1" name="PAYPAL_PAYMENT" type="checkbox" @if (env('PAYPAL_PAYMENT') == "1")
                                            checked
                                                @endif>
                                            <span
                                                class="slider round"></span>
                                        </label>

                                    </div>
                                </div>

                                <div class="col-12 form-group mg-t-8 mt-2">
                                    <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Update Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card p-4">
                            <h4 class="pb-3">Stripe Payment Gateway</h4>

                            <form class="form-horizontal" action="{{ route('payment.method.update') }}" method="POST">
                                <input type="hidden" name="payment_method" value="stripe">
                                @csrf
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="STRIPE_PUBLISH">
                                    <div class="col-md-4">
                                        <label class="col-from-label">Publish Key</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="STRIPE_PUBLISH" value="{{  env('STRIPE_PUBLISH') }}" placeholder="Strip publish key" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="STRIPE_SECRET">
                                    <div class="col-md-4">
                                        <label class="col-from-label">Stripe Secret</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="STRIPE_SECRET" value="{{  env('STRIPE_SECRET') }}" placeholder="Stripe Secret Key" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="STRIPE_PAYMENT">
                                    <div class="col-md-12">
                                        <label class="col-from-label">Display in frontend</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label  class="switch">
                                            <input class="status" value="1" name="STRIPE_PAYMENT" type="checkbox" @if (env('STRIPE_PAYMENT') == "1")
                                            checked
                                                @endif>
                                            <span
                                                class="slider round"></span>
                                        </label>

                                    </div>
                                </div>
                                <div class="col-12 form-group mg-t-8 mt-2">
                                    <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Update Data</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card p-4">
                            <h4 class="pb-3">Razor Payment Gateway</h4>

                            <form class="form-horizontal" action="{{ route('payment.method.update') }}" method="POST">
                                <input type="hidden" name="payment_method" value="razor">
                                @csrf
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="RAZOR_KEY">
                                    <div class="col-md-4">
                                        <label class="col-from-label">Razor Key</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="RAZOR_KEY" value="{{  env('RAZOR_KEY') }}" placeholder="Razor key" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="RAZOR_SECRET">
                                    <div class="col-md-4">
                                        <label class="col-from-label">Razor Secret</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="RAZOR_SECRET" value="{{  env('RAZOR_SECRET') }}" placeholder="Razor Secret Key" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="RAZOR_PAYMENT">
                                    <div class="col-md-12">
                                        <label class="col-from-label">Display in frontend</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label  class="switch">
                                            <input class="status" value="1" name="RAZOR_PAYMENT" type="checkbox" @if (env('RAZOR_PAYMENT') == "1")
                                            checked
                                                @endif>
                                            <span
                                                class="slider round"></span>
                                        </label>

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
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
@endsection

@section('styles')
    <style>
        label{
            font-weight: bold;
        }
    </style>
@endsection

@section('scripts')

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

@endsection
