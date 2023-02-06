@extends('frontend.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center pt-70 pb-70 flex-column align-items-center">
                    <h3>Razor payment</h3><br>
                    <!-- <div class="panel-body text-center"> -->
                    <form action="{!! route('payment') !!}" method="POST">
                        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZOR_KEY') }}"
                            data-amount="{{ $order->total_amount * 100 }}" data-currency={{ session('system_default_currency_info')->code }}
                            data-buttontext="{{ session('system_default_currency_info')->symbol }}{{ $order->total_amount }} Pay Now"
                            data-name={{ get_settings('site_title') }} data-description="Payment"
                            data-prefill.name="{{ $order->first_name }} {{ $order->last_name }}" data-prefill.email="{{ $order->email }}"
                            data-theme.color="hsl(358deg 100% 68%)"></script>
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .razorpay-payment-button {
            background: teal;
            padding: 8px 16px;
            color: white;
            border-radius: 4px;
            border: 0;
        }
    </style>
@endpush
