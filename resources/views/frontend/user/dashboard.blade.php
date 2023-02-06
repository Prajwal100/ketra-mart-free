@extends('frontend.layouts.master')
@section('meta_title', $user->full_name . ' - Dashboard || ' . get_settings('site_title'))

@section('content')

    <main class="main-content">
        <div class="container">
            <!-- BreadCrumb Area -->
            <div class="page-title-area d-none d-md-block">
                <div class="page-title-content">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>My Account</li>
                    </ul>
                </div>
            </div>
            <!-- BreadCrumb Area  Ends-->

            <div class="row user-account-area">
                {{-- Sidepanel Tabs --}}
                <div class="col-sm-3">
                    <div class="nav flex-column nav-pills sidebar-tabs" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <a class="nav-link @if ($_GET == null) active @endif" id="home-tab"
                            data-toggle="pill" href="#home">Home</a>
                        <a class="nav-link" id="account-tab" data-toggle="pill" href="#account">Profile</a>
                        <a class="nav-link @if ($_GET != null && $_GET['active'] == 'order') active @endif" id="orders-tab"
                            data-toggle="pill" href="#orders">Orders</a>
                        <a class="nav-link" id="address-tab" data-toggle="pill" href="#address">Address</a>
                        <a class="nav-link" id="wishlist-tab" data-toggle="pill" href="#wishlist">Wishlist</a>
                        <a class="nav-link" id="logout-tab" data-toggle="pill" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                {{-- Tab Contents --}}
                <div class="col-sm-9">
                    <div class="tab-content sidebar-tab-content" id="v-pills-tabContent">
                        {{-- Dashbaord Home --}}
                        <div class="tab-pane fade @if ($_GET == null) show active @endif" id="home"
                            role="tabpanel" aria-labelledby="home-tab">
                            <div class="my-account-content mb-50">
                                <p>Hello <strong>{{ auth()->user()->username ?? auth()->user()->full_name }} !</strong> </p>
                                <p>From your account dashboard you can view your recent orders, manage your shipping and
                                    billing addresses, and <a href="account-details.html">edit your password and account
                                        details</a>.</p>
                            </div>
                            <div class="account-info-cards my-4">
                                <ul>
                                    <li>
                                        <div class="row">
                                            <div class="col-3 d-flex justify-content-center">
                                                <div class="icon-wrapper">
                                                    <i class='bx bxs-user bx-tada'></i>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="content-wrapper">
                                                    <a href="#account" data-toggle="pill">
                                                        <h6>My Personal Information</h6>
                                                        <p>Edit your name or email or change your password.</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-3 d-flex justify-content-center">
                                                <div class="icon-wrapper">
                                                    <i class='bx bx-map bx-tada'></i>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="content-wrapper">
                                                    <a href="#address" data-toggle="pill">
                                                        <h6>Address Book</h6>
                                                        <p>Setup your billing and shipping address.</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-3 d-flex justify-content-center">
                                                <div class="icon-wrapper">
                                                    <i class='bx bxs-layer'></i>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="content-wrapper">
                                                    <a href="#orders" data-toggle="pill">
                                                        <h6>My Orders</h6>
                                                        <p>What you have ordered are all here, you can check and edit orders
                                                            at anytime.</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-3 d-flex justify-content-center">
                                                <div class="icon-wrapper">
                                                    <i class='bx bxs-heart-circle bx-spin'></i>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="content-wrapper">
                                                    <a href="#wishlist" data-toggle="pill">
                                                        <h6>My Favorites</h6>
                                                        <p>All your favorites are added here in the wishlist.</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- Profile --}}
                        <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                            <form action="{{ route('update.account', $user->id) }}" method="post"
                                class="form profile-info-form">
                                @csrf
                                <div class="form-group">
                                    <label>Full Name *</label>
                                    <input type="text" class="form-control" name="full_name"
                                        value="{{ $user->full_name }}">
                                    @error('full_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Display Name *</label>
                                    <input type="text" class="form-control mb-0" name="username"
                                        value="{{ $user->username }}">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                    <small class="d-block form-text mb-4">This will be how your name will be displayed
                                        in the account section and in reviews.</small>
                                </div>

                                <div class="form-group">
                                    <label>Email address </label>
                                    <input type="email" class="form-control" disabled name="email"
                                        value="{{ $user->email }}">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Phone *</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ $user->phone }}">
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Current password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control" name="oldpassword">
                                    @error('oldpassword')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>New password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control" name="newpassword">
                                    @error('newpassword')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn primary-btn btn-reveal-right">UPDATE CHANGES <i
                                            class='bx bx-right-arrow-alt'></i></button>
                                </div>
                            </form>
                        </div>

                        {{-- Orders --}}
                        <div class="tab-pane fade @if ($_GET != null && $_GET['active'] == 'order') show active @endif" id="orders"
                            role="tabpanel" aria-labelledby="orders-tab">
                            <div class="wap-order">
                                <h5 class="order-head">My <span class="primary-text"> Orders </span></h5>
                                @forelse ($orders as $order)
                                    <div class="wap-lis">
                                        <div class="stat d-flex justify-content-between">
                                            <h6 class="ser-infh"><b>Order No.</b> {{ $order->order_number }}</h6>
                                            <h6 class="ser-infh pla"> <b>Order Date</b>
                                                :{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}
                                                &nbsp;| &nbsp; <b>Status:</b>
                                                <span>{{ ucfirst($order->order_status) }}</span>
                                                @if ($order->order_status == 'pending' || $order->order_status == 'process')
                                                    | <a href="{{ route('order.cancel.user', $order->id) }}"
                                                        onclick="return confirm('Are you sure?');"
                                                        class="badge badge-danger p-2">Cancel Order</a>
                                                @endif
                                            </h6>
                                        </div>
                                        <div class="franchies-wap table-responsive orders-table-wrapper mt-3">

                                            <table class="table orders-table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Image</th>
                                                        <th scope="col">Product Name</th>
                                                        <th scope="col">Product Variation</th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->orderDetails as $item)
                                                        @php
                                                            $Ptitle = $item->product['title'];
                                                            $variation = $item['variation'];
                                                        @endphp
                                                        <tr>
                                                            <th scope="row">{{ $loop->iteration }}</th>
                                                            <td>
                                                                <img src="{{ asset($item->product->thumbnail_image) }}"
                                                                    style="max-width: 80px">
                                                            </td>
                                                            <td>
                                                                <a style="font-weight: bold"
                                                                    href="{{ route('product.detail', $item->product->slug) }}"
                                                                    target="_blank">{{ ucfirst($Ptitle) }}</a>
                                                            </td>
                                                            <td>{{$item['variation']}}</td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>{{$item['variation'] ? Helper::currency_converter($item->product->stocks->where('variant',$item['variation'])->where('product_id',$item->product->id)->first()->price) : Helper::currency_converter($item->price,2)}}
                                                            </td>
                                                            <td>
                                                                {{ Helper::currency_converter($item->price) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    <tr class="last-tqab">
                                                        <td><span class="do">Sub Total: </span></td>
                                                        <td><span
                                                                class="totals">{{ Helper::currency_converter($order->subtotal) }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="last-tqab">
                                                        <td><span class="do">Shipping Cost:</span></td>
                                                        <td><span
                                                                class="totals">{{ Helper::currency_converter($order->delivery_charge) }}</span>
                                                        </td>
                                                    </tr>
                                                    @if ($order->coupon > 0)
                                                        <tr class="last-tqab">
                                                            <td><span class="do">Coupon:</span></td>
                                                            <td><span
                                                                    class="totals">{{ Helper::currency_converter($order->coupon) }}</span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <tr class="last-tqab">
                                                        <td><span class="do">Order Total:</span></td>
                                                        <td><span
                                                                class="totals">{{ Helper::currency_converter($order->total_amount) }}</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-cart d-flex flex-column align-items-center justify-content-center pb-40">
                                        <img width="200px" src="{{asset('frontend/assets/images/main/empty-cart.webp')}}" class="img-fluid" >
                                        <p >
                                            YOU DON'T HAVE ANY ORDERS.
                                        </p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                            <p class="mb-2">The following addresses will be used on the checkout page by default.
                            </p>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card card-address">
                                        <div class="card-body">
                                            <h5 class="card-title">Billing Address</h5>
                                            @if ($user->shipping != null)
                                                {{ $user->shipping->address }}, {{ $user->shipping->address2 }} <br>
                                                {{ $user->shipping->state }} <br>
                                                {{ $user->shipping->country }}, {{ $user->shipping->postcode }}
                                                <br>
                                            @else
                                                <p class="text-danger">Please add your billing address.</p>
                                            @endif
                                            <a href="javascript:void(0);" style="line-height: 3.5" data-toggle="modal"
                                                data-target="#editAddress" class="btn btn-sm primary-btn mt-2">Edit <i
                                                    class="far fa-edit"></i></a>
                                        </div>
                                    </div>
                                </div>

                                {{-- Billing Model --}}
                                <div class="modal fade" id="editAddress" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Billing Address
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('billing.address', $user->id) }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">Address</label>
                                                        <textarea name="address" id="" class="form-control" placeholder="Your address">{{ $user->shipping == null ? old('state') : $user->shipping->address }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Address 2 (optional)</label>
                                                        <input name="address2" id="" class="form-control"
                                                            placeholder="Your address2"
                                                            value="{{ $user->shipping == null ? old('state') : $user->shipping->address2 }}"></input>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Country</label>
                                                        <input name="country" id="" class="form-control"
                                                            placeholder="Nepal"
                                                            value="{{ $user->shipping == null ? old('state') : $user->shipping->country }}"></input>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Postcode</label>
                                                        <input name="postcode" id="" class="form-control"
                                                            placeholder="44600"
                                                            value="{{ $user->shipping == null ? old('state') : $user->shipping->postcode }}"></input>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">State</label>
                                                        <input name="state" id="" class="form-control"
                                                            placeholder="state"
                                                            value="{{ $user->shipping == null ? old('state') : $user->shipping->state }}"></input>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn primary-btn">Save address</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                {{-- Shipping Address --}}
                                <div class="modal fade" id="editsAddress" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Shipping Address
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('shipping.address', $user->id) }}" method="post">
                                                @csrf

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">Shipping Address</label>
                                                        <textarea name="saddress" id="" class="form-control" placeholder="Your shipping address">{{ $user->shipping == null ? old('saddress') : $user->shipping->saddress }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping Address2</label>
                                                        <input name="saddress2" id="" class="form-control"
                                                            placeholder="Your shipping address2"
                                                            value="{{ $user->shipping == null ? old('saddress2') : $user->shipping->saddress2 }}"></input>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping Country</label>
                                                        <input name="scountry" id="" class="form-control"
                                                            placeholder="Nepal"
                                                            value="{{ $user->shipping == null ? old('scountry') : $user->shipping->scountry }}"></input>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping Postcode</label>
                                                        <input name="spostcode" id="" class="form-control"
                                                            placeholder="44600"
                                                            value="{{ $user->shipping == null ? old('spostcode') : $user->shipping->spostcode }}"></input>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shipping State</label>
                                                        <input name="sstate" id="" class="form-control"
                                                            placeholder="state"
                                                            value="{{ $user->shipping == null ? old('sstate') : $user->shipping->sstate }}"></input>
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info">Save Address</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-4">
                                    <div class="card card-address">
                                        <div class="card-body">
                                            <h5 class="card-title"> Shipping Address</h5>
                                            @if ($user->shipping != null)
                                                {{ $user->shipping->saddress }}, {{ $user->shipping->saddress2 }} <br>
                                                {{ $user->shipping->sstate }}<br>
                                                {{ $user->shipping->scountry }},{{ $user->shipping->spostcode }}
                                                <br>
                                            @else
                                                <p class="text-danger">Please add your shipping address.</p>
                                            @endif
                                            <a href="javascript:;" data-toggle="modal" style="line-height: 3.5"
                                                data-target="#editsAddress" class="btn btn-sm primary-btn">Edit <i
                                                    class="far fa-edit"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Wishlist --}}
                        <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                            <div class="wap-order">
                                <h3 class="order-head">Wishlist</h3>
                                <div class="wap-lis">
                                    @include('frontend.layouts._wishlist', ['user' => $user])
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
@push('styles')
    <style>
        .key {
            color: #2b8286;
        }

        .value {
            font-weight: bold;
        }

        .detail {
            position: relative;
        }

        .detail a {
            border-bottom: 1px dotted #55a2a6;
        }

        .detail:hover .detail_info {
            display: block;
        }

        .detail_info {
            display: none;
            position: absolute;
            top: 0px;
            left: 45px;
            width: 200px;
            padding: 12px 15px;
            text-align: left;
            background-color: #d7fdff !important;
            border: 1px solid #55a2a6 !important;
            border-radius: 4px;
        }

        .order-details {
            height: 200px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        function removeWishlist(product_id) {
            $.ajax({
                url: "{{ route('wishlist.delete') }}",
                method: 'POST',
                data: {
                    id: product_id,
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(response) {
                    if (response.status == true) {
                        $('#wishlist_html').html(response['wishlist_html']);
                        $.notify({
                            title: '<strong>Success: </strong>',
                            message: response['msg'],
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
                            title: '<strong>Sorry: </strong>',
                            message: response['msg'],
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
                        })

                    }
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        }
    </script>
@endpush
