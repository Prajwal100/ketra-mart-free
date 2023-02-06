@extends('frontend.layouts.master')
@section('meta_title', get_settings('site_title') . ' || Checkout')

@section('content')
    <main class="container main-content checkout-content my-5">
        <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-md-9 col-md-offset-3">
                <div id="msform">
                    <!-- progressbar -->
                    <ul id="progressbar" class="step-by pt-2 pb-2 pr-4 pl-4">
                        <li class="active"><a href="{{ route('cart') }}">Shopping Cart</a></li>
                        <li class="active"><a href="{{ route('checkout') }}">Checkout</a></li>
                        <li class=""><a href="javascript:void(0);">Order Complete</a></li>
                    </ul>

                    {{-- Place Order Page --}}
                    <div class="">
                        @include('layouts._error_notify')
                    </div>
                    <div id="checkout">
                        @include('frontend.pages.checkout._inner_checkout', ['user' => $user])
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
@push('styles')
    <style>
        .cart-table {
            overflow-x: auto !important;
        }

        .cart-table table tbody tr td {
            white-space: unset;
        }

        table .product-name a {
            color: #000;
            height: 45px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box !important;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .payment-metho-radio li {
            padding: 10px 20px;
            border: 1px solid hsl(0deg 0% 95%);
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .payment-metho-radio input[type=radio]:after {
            content: "";
            display: block;
            position: absolute;
            transition: transform var(--d-t, .3s) var(--d-t-e, ease), opacity var(--d-o, .2s);
            opacity: var(--o, 0);
            width: 5px;
            height: 9px;
            border: 2px solid var(--active-inner);
            border-top: 0;
            border-left: 0;
            left: 7px;
            top: 4px;
            transform: rotate(var(--r, 20deg));
        }

        .payment-metho-radio input[type=radio] {

            height: 20px;
            outline: 0;
            vertical-align: top;
            position: relative;
            margin: 0 !important;
            cursor: pointer;
            border: 1px solid var(--bc, var(--border));
            background: var(--b, var(--background));
            transition: background .3s, border-color .3s;
            width: 20px !important;
            border-radius: 3px;
        }

        .payment-metho-radio label {
            margin: 0 !important;
        }

        .payment-meth {
            display: none;
            border: 1px solid hsl(0deg 0% 95%);
            padding: 20px;
            margin-top: 15px;
        }

        .shipping_address {
            display: none;
        }
    </style>
@endpush
@push('scripts')
    <!--  For Stripe Payment -->
    <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
    <script>
        $(function() {
            var $form = $("#payment-form");

            $(document).on('submit',"#payment-form", function(e) {
                console.log($form);

                if ($('input[name="payment_method"]:checked').val() == 'stripe') {
                    if (!$form.data('cc-on-file')) {
                        e.preventDefault();
                        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                        Stripe.createToken({
                            number: $('#card_number').val(),
                            cvc: $('#card_cvc').val(),
                            exp_month: $('#card_month').val(),
                            exp_year: $('#card_year').val()
                        }, stripeResponseHandler);
                    }
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('#js-stripe-error')
                        .find('.alert')
                        .text(response.error.message);
                    $('#js-stripe-error').show();
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $('.js-stripe').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        })
    </script>
    <script>
        // payment method
        $(document).on('click', 'input[name="payment_method"]', function() {
            var $value = $(this).attr('value');
            $('.payment-meth').slideUp();
            $('[data-method="' + $value + '"]').slideDown();
        });


        //shipping method
        function set_shipping_id(id) {
            @if (session()->has('cart'))
                @foreach (session()->get('cart') as $key => $item)
                    let key = '{{ $key }}';
                    @break
                @endforeach
            @else
                key = '0'
            @endif

            $.ajax({
                url: '{{ route('set.shipping.method') }}',
                dataType: 'json',
                type: 'GET',
                data: {
                    key: key,
                    id: id,
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                complete: function() {
                    $('#loading').hide();
                },
                success: function(response) {
                    if (response.status) {
                        $('#checkout').html(response['checkout']);

                        $.notify({
                            message: '<i class="fas fa-check-circle"></i> Success: Shipping method selected',
                        }, {
                            type: 'info',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({
                                    'width': 'auto',
                                    'height': 'auto'
                                });
                            },
                        });

                    } else {
                        $.notify({
                            message: "<i class='fas fa-times-circle'></i> Something went wrong, Please try again!",
                        }, {
                            type: 'danger',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({
                                    'width': 'auto',
                                    'height': 'auto'
                                });
                            },
                        });
                    }
                }
            })
        }
    </script>
    <script>
            $(document).on('change','#different-address',function(e) {
                e.preventDefault();
                if (this.checked) {
                    $('.shipping_address').slideUp();
                    $('.shipping_address').slideDown();

                } else {
                    $('.shipping_address').slideDown();
                    $('.shipping_address').slideUp();
                }
            });
    </script>
@endpush
