@extends('frontend.layouts.master')
<style>
    @media screen and (max-width: 991px) {
        .mobile__cart-table .cart-item .product-title {
            font-size: 22px;
        }



        .btn-continue {
            border: 1px solid #d6d6d6!important;
        }

        .btn-outline a {
            display: flex;
            align-items: center;
            font-family: 'Roboto';
        }

        .cart-table {
            display: none!important;
        }

        .ptb-70 {
            padding-top: 14px;
        }

        .product-details .color,
        .product-details .size {
            color: #999999;
        }

        .product-details .color span,
        .product-details .size span {
            color: #000;
            margin-left: 1rem;
        }

        .input-counter {
            width: 50%!important;
        }

        .input-counter span {
            top: 5px!important;
            width: 32px!important;
            height: 25px!important;
            font-size: 12px!important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-counter input {
            height: 38px!important;
        }

        .price span {
            color: #FF5A60;
            font-weight: 700;
            font-size: 16px;
        }

        .checkout-btn-wrapper button {
            width: 100%;
        }

        .footer-area {
            display: none;
        }
    }

    @media screen and (max-width: 767px) {
        .mobile__cart-table .cart-item .product-title {
            font-size: 16px;
        }

        .form-control,
        .input-group {
            max-width: 100% !important;
        }
    }
</style>
@section('content')

    <!--====== Main Content Starts======-->
    <main class="main-content">

        <!-- BreadCrumb Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li class="text-uppercase">Shopping Cart</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- BreadCrumb Area  Ends-->

        <!-- Continue Shopping Button -->
        <div class="btn-wrapper m-4 d-inline-flex d-lg-none">
            <button class="btn btn-continue optional-btn">
                <a href="{{route('home')}}"> <i class='bx bxs-chevron-left'></i>
                    <span>
                        Continue Shopping
                    </span>
                </a>
            </button>
        </div>
        <!-- Continue Shopping Button -->

        <!-- Cart Area -->
        <section class="cart-area ptb-70">
            <div class="container" id="cart_list">
                @include('frontend.layouts._cart-lists')
            </div>
        </section>
        <!-- Cart Area Ends-->

    </main>
@endsection

@push('styles')
    <style>
        .form-wrapper .form-group .apply-coupon-btn,.submit-comment{
            width: 80px;
        }
        .empty-cart img{
            height: 200px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        //shipping method
        function set_shipping_id(id) {
            @if(session()->has('cart'))
                @foreach(session()->get('cart') as $key => $item)
                    let key = '{{$key}}';
                @break
                @endforeach
            @else
                key='0'
            @endif

            $.ajax({
                    url:'{{route('set.shipping.method')}}',
                    dataType:'json',
                    type:'GET',
                    data:{
                        key:key,
                        id:id,
                    },
                    beforeSend:function () {
                        $('#loading').show();
                    },
                    complete:function () {
                        $('#loading').hide();
                    },
                    success:function(response){
                        if(response.status){
                            $('#cart_list').html(response.data);

                            $.notify({
                                message:'<i class="fas fa-check-circle"></i> Success: Shipping method selected',
                            },{
                                type: 'info',
                                allow_dismiss: false,
                                delay: 2800,
                                animate: {
                                    enter: 'animated flipInY',
                                    exit: 'animated flipOutX'
                                },
                                onShow: function() {
                                    this.css({'width':'auto','height':'auto'});
                                },
                            });
                        }
                        else{
                            $.notify({
                                message:"<i class='fas fa-times-circle'></i> Something went wrong, Please try again!",
                            },{
                                type: 'danger',
                                allow_dismiss: false,
                                delay: 2800,
                                animate: {
                                    enter: 'animated flipInY',
                                    exit: 'animated flipOutX'
                                },
                                onShow: function() {
                                    this.css({'width':'auto','height':'auto'});
                                },
                            });
                        }
                    }
                })
        }
        //cart update
        function updateCartQuantity(key) {
            var quantity = $("#productQty" + key).children("option:selected").val();
            var total=$(this).data('total_quantity');
            var path="{{route('cart.update')}}"
            $.ajax({
                type:'POST',
                url:path,
                data:{
                    _token: '{{csrf_token()}}',
                    key: key,
                    quantity: quantity,
                },
                beforeSend: function () {
                    $('#loading').show();
                },

                complete: function () {
                    $('#loading').hide();
                },

                success:function (response) {
                    if(response.status){
                        $('#cart_list').html(response['cart_list']);
                        $.notify({
                            message:'<i class="fas fa-check-circle"></i> '+response['message'],
                        },{
                            type: 'info',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        });
                    }
                    else{
                        $.notify({
                            message:"<i class='fas fa-times-circle'></i> Something went wrong, Please try again!",
                        },{
                            type: 'danger',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        });
                    }
                }
            });
        }

        //cart mobile update
        $(document).on("click",".qty-changer .plus-btn",function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var spinner = $(this),
                input = spinner.closest(".qty-changer").find('input[type="text"]');
            var newVal = parseFloat(input.val())+1;
            $('#qty-input-'+id ).val(newVal);

            var productQuantity = $("#update-cart-"+id).data('product-quantity');

            console.log(newVal,productQuantity);

            if(newVal>productQuantity){
                $.notify({
                    message:"Out of stock!",
                },{
                    type: 'warning',
                    allow_dismiss: false,
                    delay: 2800,
                    animate: {
                        enter: 'animated flipInY',
                        exit: 'animated flipOutX'
                    },
                    onShow: function() {
                        this.css({'width':'auto','height':'auto'});
                    },
                });
                return
            }
            update_cart(id,productQuantity);
        });
        $(document).on("click",".qty-changer .minus-btn",function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var spinner = $(this),
                input = spinner.closest("div.qty-changer").find('input[type="text"]');
            if(input.val() == 1){
                return false;
            }
            if(input.val() != 1){
                var newVal = parseFloat(input.val())-1;
                $('#qty-input-'+id ).val(newVal);
            }
            var productQuantity = $("#update-cart-"+id).data('product-quantity');

            console.log(newVal,productQuantity);

            if(newVal>productQuantity){
                $.notify({
                    message:"Out of stock!",
                },{
                    type: 'warning',
                    allow_dismiss: false,
                    delay: 2800,
                    animate: {
                        enter: 'animated flipInY',
                        exit: 'animated flipOutX'
                    },
                    onShow: function() {
                        this.css({'width':'auto','height':'auto'});
                    },
                });
                return
            }
            update_cart(id,productQuantity);
        });
        function update_cart(id,productQuantity){
            var key = id;
            var quantity = $("#qty-input-"+key).val();
            var token="{{csrf_token()}}";
            var path="{{route('cart.update')}}";
            $.ajax({
                url:path,
                type:"POST",
                data:{
                    _token:token,
                    key: key,
                    quantity: quantity,
                    productQuantity:productQuantity,
                },
                success:function (data) {
                    console.log(data);
                    if(data['status']){
                        $('body #header-ajax').html(data['header']);
                        $('body #cart_counter').html(data['cart_count']);
                        $('body #cart_list').html(data['cart_list']);
                        $('body #total_price').html('$ '+data['total']);
                        $('body #header_cart').html(data['header_cart']);
                        $('body #mobile_cart').html(data['mobile_cart']);
                        $.notify({
                            title:'<strong>Success: </strong>',
                            message:data['message'],
                        },{
                            type: 'info',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        })
                    }
                    else{
                        $.notify({
                            title:'<strong>Oops: </strong>',
                            message:data['message'],
                        },{
                            type: 'danger',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        })
                    }
                }
            });
        }
        //cart delete
        function removeFromCart(key) {
            var path="{{route('cart.delete')}}"
            $.ajax({
                type:'POST',
                url:path,
                data:{
                    _token: '{{csrf_token()}}',
                    key: key,
                },
                beforeSend: function () {
                    $('#loading').show();
                },

                complete: function () {
                    $('#loading').hide();
                },

                success:function (response) {
                    if(response.status){
                        $('#cart_list').html(response['cart_list']);
                        $('body #header').html(response['header']);

                        $.notify({
                            message:'<i class="fas fa-check-circle"></i> '+response['message'],
                        },{
                            type: 'info',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        });
                    }
                    else{
                        $.notify({
                            message:"<i class='fas fa-times-circle'></i> Something went wrong, Please try again!",
                        },{
                            type: 'danger',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        });
                    }
                }
            });
        }

        //coupon
        $(document).on('click','.apply-coupon-mobile',function () {
            var code=$('[name="mobile_code"]').val();
            var path="{{route('coupon.add')}}"
            $.ajax({
                type:"POST",
                url:path,
                data:{
                    code:code,
                    _token:"{{csrf_token()}}",

                },

                beforeSend: function () {
                    $('#loading').show();
                },

                complete: function () {
                    $('#loading').hide();
                },

                success:function (response) {
                    if(response.status){
                        $('#cart_list').html(response['cart_list']);
                        $.notify({
                            message:response['message'],
                        },{
                            type: 'info',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        });
                    }
                    else{
                        $.notify({
                            message:response['message'],
                        },{
                            type: 'danger',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        });
                    }
                }

            });
        })

        //comment
        $(document).on('click','.post-comment-mobile',function () {
            var comment=$('[name="mobile_comment"]').val();
            var path="{{route('comment.add')}}"
            $.ajax({
                type:"POST",
                url:path,
                data:{
                    comment:comment,
                    _token:"{{csrf_token()}}",
                },

                beforeSend: function () {
                    $('#loading').show();
                },

                complete: function () {
                    $('#loading').hide();
                },

                success:function (response) {
                    if(response.status){
                        $.notify({
                            message:response['message'],
                        },{
                            type: 'info',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        });
                    }
                    else{
                        $.notify({
                            message:response['message'],
                        },{
                            type: 'danger',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        });
                    }
                }

            });
        })

        //For only Desktop version
        //coupon
        $(document).on('click','.apply-coupon-btn',function () {
            var code=$('#desktop_code').val();

            var path="{{route('coupon.add')}}"
            $.ajax({
                type:"POST",
                url:path,
                data:{
                    code:code,
                    _token:"{{csrf_token()}}",

                },

                beforeSend: function () {
                    $('#loading').show();
                },

                complete: function () {
                    $('#loading').hide();
                },

                success:function (response) {
                    if(response.status){
                        $('#cart_list').html(response['cart_list']);
                        $.notify({
                            message:response['message'],
                        },{
                            type: 'info',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        });
                    }
                    else{
                        $.notify({
                            message:response['message'],
                        },{
                            type: 'danger',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        });
                    }
                }

            });
        })

        //comment
        $(document).on('click','.submit-comment',function () {
            var comment=$('#desktop_comment').val();
            var path="{{route('comment.add')}}"
            $.ajax({
                type:"POST",
                url:path,
                data:{
                    comment:comment,
                    _token:"{{csrf_token()}}",
                },

                beforeSend: function () {
                    $('#loading').show();
                },

                complete: function () {
                    $('#loading').hide();
                },

                success:function (response) {
                    if(response.status){
                        $.notify({
                            message:response['message'],
                        },{
                            type: 'info',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        });
                    }
                    else{
                        $.notify({
                            message:response['message'],
                        },{
                            type: 'danger',
                            allow_dismiss: false,
                            delay: 2800,
                            animate: {
                                enter: 'animated flipInY',
                                exit: 'animated flipOutX'
                            },
                            onShow: function() {
                                this.css({'width':'auto','height':'auto'});
                            },
                        });
                    }
                }

            });
        })
    </script>
@endpush
