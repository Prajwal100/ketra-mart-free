<form>
    <div class="cart-table table-responsive">
        @if (session()->has('cart') && count(session()->get('cart')) > 0)
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col" width="30%">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>

                @foreach (session('cart') as $key => $cartItem)
                    @php
                        $product = \App\Models\Product::find($cartItem['product_id']);
                        $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                        $product_name_with_choice = $product->title;
                        if ($cartItem['variation'] != null) {
                            $product_name_with_choice = $product->title . ' - ' . $cartItem['variation'];
                        }
                    @endphp
                    <tr>
                        <td class="product-thumbnail">
                            <a href="{{ route('product.detail', $cartItem['slug']) }}">
                                <img style="border:1px solid #ddd"
                                     src="{{ $cartItem['image'] != null ? asset($cartItem['image']) : Helper::DefaultImage() }}"
                                     alt="item">
                            </a>
                        </td>
                        <td class="product-name">
                            <a href="{{ route('product.detail', $cartItem['slug']) }}"
                               target="_blank">{{ ucfirst($product_name_with_choice) }}
                            </a>

                        </td>
                        <td class="product-price">
                                <span
                                    class="unit-amount">{{ Helper::currency_converter($cartItem['price']) }}</span>
                        </td>
                        <td class="product-quantity">
                            <select name="quantity[{{ $key }}]" id="productQty{{ $key }}"
                                    data-total_quantity="{{ \App\Models\Product::where('id', $cartItem['id'])->value('current_stock') }}"
                                    onchange="updateCartQuantity('{{ $key }}')">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}"
                                        {{ $i == $cartItem['quantity'] ? 'selected' : '' }}> {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </td>
                        <td class="product-subtotal">
                            <span class="subtotal-amount">{{ Helper::currency_converter($cartItem['price'] * $cartItem['quantity']) }} </span>
                            <a href="javascript:;" onclick="removeFromCart({{ $key }})"
                               class="remove"><i class='bx bx-trash'></i></a>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        @else
            <div class="empty-cart d-flex flex-column align-items-center justify-content-center pb-40">
                <img src="{{asset('frontend/assets/images/main/empty-cart.webp')}}" class="img-fluid" >
                <p >
                    YOU DON'T HAVE ANY ITEMS IN
                    YOUR CART.
                </p>
            </div>
        @endif
    </div>

    <div class="mobile__cart-table d-block d-lg-none">
        @if (session()->has('cart') && count(session()->get('cart')) > 0)
            @foreach (session('cart') as $key => $cartItem)
                @php
                    $product = \App\Models\Product::find($cartItem['product_id']);
                    $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                    $product_name_with_choice = $product->title;
                @endphp
                <div class="cart-item row">
                    <div class="img-wrapper col-4">
                        <a href="{{ route('product.detail', $cartItem['slug']) }}">
                            <img
                                src="{{ $cartItem['image'] != null ? asset($cartItem['image']) : Helper::DefaultImage() }}"
                                alt="">
                        </a>
                    </div>
                    <div class="col-8 p-1">
                        <div class="d-flex justify-content-between">
                            <h1 class="product-title"><a href="{{ route('product.detail', $cartItem['slug']) }}"
                                                         target="_blank">{{ ucfirst($product->title) }}</a></h1>
                            <a href="javascript:" onclick="removeFromCart({{ $key }})"
                               class="remove pr-3"><i class='fa fa-times' style="color: #999999;"></i></a>
                        </div>
                        <div class="product-details">
                            <div class="row">
                               <div class="col-12">
                                   {{$cartItem['variation']}}
                               </div>
                            </div>

                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div class="mr-4 price">
                                <span>{{ Helper::currency_converter($cartItem['price']) }}</span>
                            </div>
                            <div class="input-counter qty-changer">
                                <span data-id="{{ $key }}" class="minus-btn"><i
                                        class="bx bx-minus"></i></span>
                                <input type="text" class="qty-input" id="qty-input-{{ $key }}"
                                       value="{{ $cartItem['quantity'] }}">
                                <span data-id="{{ $key }}" class="plus-btn"><i
                                        class="bx bx-plus"></i></span>
                                <input type="hidden" data-id="{{ $key }}"
                                       data-product-quantity="{{ \App\Models\Product::where('id', $cartItem['id'])->value('current_stock') }}"
                                       id="update-cart-{{ $key }}">
                            </div>
                        </div>
                    </div>
                </div>
                @if (!$loop->last)
                    <hr class="border-bottom-line">
                @endif
            @endforeach
        @else
            <div class="empty-cart d-flex flex-column align-items-center justify-content-center pb-40">
                <img src="{{asset('frontend/assets/images/main/empty-cart.webp')}}" class="img-fluid" >
                <p >
                    YOU DON'T HAVE ANY ITEMS IN
                    YOUR CART.
                </p>
            </div>
        @endif
    </div>

    <div class="cart-buttons ">
        <div class="row align-items-center">
            <div class=" col-lg-4 col-md-7 col-12 form-wrapper">


                <a href="{{ route('home') }}" class="optional-btn mt-3 text-capitalize d-none d-lg-inline-block">
                    <i class="bx bx-left-arrow-alt float-left mr-3"></i>
                    <span>Continue Shopping</span>
                </a>
            </div>
            <div class="col-lg-5 col-md-5 col-12 offset-lg-3 text-right">
                <div class="cart-totals">
                    @php($subtotal = 0)
                    @php($shipping_cost = 0)
                    @php($coupon_discount = 0)
                    @if (session()->has('cart') && count(session()->get('cart')) > 0)
                        @foreach (session('cart') as $key => $cartItem)
                            @php($subtotal += $cartItem['price'] * $cartItem['quantity'])
                            @php($shipping_cost += $cartItem['shipping_cost'])
                        @endforeach
                    @endif
                    @if (session()->has('coupon_discount'))
                        @php($coupon_discount = session()->get('coupon_discount'));
                    @endif
                    <ul>
                        <li>
                            <span>Subtotal</span> <span>{{ Helper::currency_converter($subtotal) }} </span></b>
                        </li>
                        {{-- <li> --}}
                        {{-- <span>Shipping</span> <span>{{Helper::currency_converter($shipping_cost)}}</span></b> --}}
                        {{-- </li> --}}

                        @if (session()->has('coupon_discount'))
                            <li>
                                <span>Save amount</span>
                                <span>{{ Helper::currency_converter(session('coupon_discount')) }}</span></b>
                            </li>
                        @endif

                        <li class="total">
                            <span>Total</span>
                            <span>{{ Helper::currency_converter($subtotal + $shipping_cost - $coupon_discount) }}</span></b>
                        </li>
                    </ul>
                </div>
                <div class="checkout-btn-wrapper">
                    <a href="{{ route('checkout') }}"
                       class="d-none pt-3 text-center default-btn secondary-btn checkout-paypal-btn">
                        <span>Continue To Checkout</span>
                        <i class="bx bx-right-arrow-alt float-right"></i></a>
                    <button type="button" class="mt-2 default-btn secondary-btn checkout-paypal-btn">
                        <a href="{{ route('checkout') }}" class="text-white">
                            Continue to <strong class="font-italic">Checkout</strong> <i
                                class="bx bx-right-arrow-alt float-right"></i>
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
