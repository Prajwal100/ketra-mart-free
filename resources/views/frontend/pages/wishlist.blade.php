@extends('frontend.layouts.master')
@section('title','Wishlist page || Giftplease')

@section('content')

    <main class="main">
        <div class="page-header bg-dark"
             style="background-image: url({{asset('frontend/images/shop/page-header-back.jpg')}}); background-color: #3C63A4;">
            <h1 class="page-title">Wishlist</h1>
            <ul class="breadcrumb">
                <li><a href="#"><span class="iconify" data-icon="clarity:home-solid" data-inline="false"></span</a></li>
                <li>Wishlist</li>
            </ul>
        </div>
        <!-- End PageHeader -->
        <div class="page-content pt-10 pb-10">
            <div class="container" id="wishlist_list">
                @include('frontend.layouts._wishlist')
            </div>
        </div>
    </main>

@endsection

@section('scripts')
    <script>
        $('.move-to-cart').on('click',function (e) {

            e.preventDefault();
            var rowId=$(this).data('id');
            var token="{{csrf_token()}}";
            var path="{{route('wishlist.move.cart')}}";

            $.ajax({
                url:path,
                type:"POST",
                data:{
                    _token:token,
                    rowId:rowId,
                },
                beforeSend:function(){
                    $(this).html('<i class="fas fa-spinner fa-spin"></i> Moving to Cart..');
                },
                success:function (data) {
                    if(data['status']){
                        $('body #cart_counter').html(data['cart_count']);
                        $('body #wishlist_list').html(data['wishlist_list']);
                        $('body #header-ajax').html(data['header']);
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
                        })
                    }
                },
                error:function (err) {
                    $.notify({
                        title:'<strong>Sorry: </strong>',
                        message:'Something went wrong',
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
            })

        })
    </script>
    <script>
        $('.delete_wishlist').on('click',function (e) {

            e.preventDefault();
            var rowId=$(this).data('id');
            var token="{{csrf_token()}}";
            var path="{{route('wishlist.delete')}}";

            $.ajax({
                url:path,
                type:"POST",
                data:{
                    _token:token,
                    rowId:rowId,
                },
                success:function (data) {
                    if(data['status']){
                        $('body #cart_counter').html(data['cart_count']);
                        $('body #wishlist_list').html(data['wishlist_list']);
                        $('body #header-ajax').html(data['header']);

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
                        })
                    }
                },
                error:function (err) {
                    $.notify({
                        title:'<strong>rror! </strong>',
                        message:"Some error",
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
            })

        })
    </script>
@endsection
