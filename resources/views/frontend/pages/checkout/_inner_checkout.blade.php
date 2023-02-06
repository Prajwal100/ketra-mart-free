<form action="{{ route('checkout.store') }}" method="post" class="form" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_PUBLISH') }}" id="payment-form" autocomplete="off">
    @csrf
    <div class="row gutter-lg">
        <div class="col-lg-12 mb-6">
            <h6 class="title title-simple text-left mb-3">Billing Details </h6>
            <div class="row">
                @php
                    if($user!=null){
                        $name = explode(' ', $user->full_name);
}
                @endphp
                <div class="col text-left">
                    <label>First Name *</label>
                    <input required type="text" class="form-control" id="firstName" name="first_name"
                           placeholder="Full name" value="{{ $name[0] ?? old('first_name') }}"/>
                </div>
                <div class="col text-left">
                    <label>Last Name *</label>
                    <input required type="text" class="form-control" id="lastName" name="last_name"
                           placeholder="Last name" value="{{ $name[1] ?? old('last_name') }}"/>
                </div>
            </div>
            <div class="row">
                <div class="col text-left">
                    <label>Email *</label>
                    <input required type="email" class="form-control" id="email" name="email" placeholder="Email"
                           value="{{ $user->email ?? old('email') }}"/>
                </div>
                <div class="col text-left">
                    <label>Phone *</label>
                    <input required type="text" class="form-control" id="phone" name="phone" placeholder="Phone"
                           value="{{ $user->phone  ?? old('phone')}}"/>
                </div>
            </div>

              <div class="row">
                  <div class="col text-left">
                      <label>Country / Region *</label>
                      <input required type="text" class="form-control" id="country" name="country" placeholder="Country"
                             value="{{ $user->country ?? old('country') }}"/>
                  </div>
              </div>

            <div class="row">
                <div class="col text-left">
                    <label>Street Address *</label>
                    <input required type="text" class="form-control" id="address" name="address"
                           value="{{ $user->address ?? old('address') }}" placeholder="House number and Street name"/>
                    <input type="text" class="form-control" id="address2" name="address2"
                           value="{{ $user->address2 ?? old('address') }}" placeholder="Appartments, suite, unit etc ..."/>
                </div>
            </div>


            <div class="row">
                <div class="col text-left">
                    <label>State / Province </label>
                    <input type="text" class="form-control" id="state" placeholder="State" name="state"
                           value="{{$user->state ?? old('state') }}"/>
                </div>
                <div class="col text-left">
                    <label>Postcode / ZIP </label>
                    <input type="text" class="form-control" id="postcode" placeholder="Postcode"
                           name="postcode" value="{{$user->postcode ?? old('postcode') }}"/>
                </div>
            </div>

            <div class="form-check styled-checkbox my-3 p-0">
                <input class="form-check-input inp-cbx" type="checkbox" id="different-address" value="1" name="different-address">
                <label class="form-check-label cbx d-flex" for="different-address">
                                        <span>
                                            <svg width="12px" height="10px" viewBox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg>
                                        </span>
                    <span>
                                            Ship to a different address?
                                        </span>
                </label>
            </div>


            <div class="shipping_address">
                <h6 class="title title-simple text-left mb-3">Shipping Details</h6>

                <div class="row">
                    <div class="col text-left">
                        <label for="scountry">Country / Region *</label>
                        <input  type="text" class="form-control" id="scountry" name="scountry" placeholder="Country"
                                value="{{ $user->scountry ?? old('scountry') }}"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-left">
                        <label for="saddress">Street Address *</label>
                        <input  type="text" class="form-control" id="saddress" name="saddress"
                                value="{{$user->saddress ??  old('saddress') }}" placeholder="House number and Street name"/>
                        <input type="text" class="form-control" id="saddress2" name="saddress2"
                               value="{{$user->saddress2 ??  old('saddress2') }}" placeholder="Appartments, suite, unit etc ..."/>
                    </div>
                </div>



                <div class="row">
                    <div class="col text-left">
                        <label>State / Province </label>
                        <input type="text" class="form-control" id="sstate" placeholder="State" name="sstate"
                               value="{{$user->sstate ??  old('sstate') }}"/>
                    </div>
                    <div class="col text-left">
                        <label>Postcode / ZIP </label>
                        <input type="text" class="form-control" id="spostcode" placeholder="Postcode"
                               name="spostcode" value="{{$user->spostcode ??  old('spostcode') }}"/>
                    </div>
                </div>

            </div>
            <h6 class="title title-simple text-left">Additional Information</h6>
            <div class="row">
                <div class="col text-left">
                    <label class="mb-3">Order Notes (optional)</label>
                    <textarea class="form-control" cols="30" rows="6" name="note"
                              placeholder="Notes about your order, e.g. special notes for delivery">{{ session()->has('comment') ? session()->get('comment') : old('note') }}</textarea>
                </div>
            </div>

        </div>
        <aside class="col-lg-12 sticky-sidebar-wrapper">
            <div class="sticky-sidebar" data-sticky-options="{'bottom': 50}">


                <h6 class="title title-simple text-left">Items in your Cart</h6>
                <div class="cart-table table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-left">
                        <tr>
                            <th width="20%">Product</th>
                            <th width="50%">Description</th>
                            <th width="15%">Qty</th>
                            <th width="15%">Price</th>
                        </tr>
                        </thead>
                        <tbody class="text-left">
                        @if(session()->has('cart') && count(session()->get('cart'))>0)
                            @foreach(session('cart') as $key=>$cartItem)
                                @php
                                    $product = \App\Models\Product::find($cartItem['product_id']);

                                    if ($cartItem['variation']) {
                                       $product_name_with_choice = $product->title.' - '.$cartItem['variation'];
                                    }
                                    else{
                                        $product_name_with_choice = $product->title;
                                    }

                                @endphp
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="{{route('product.detail',$cartItem['slug'])}}">
                                            <img style="border:1px solid #ddd" src="{{asset($cartItem['image'])}}"
                                                 alt="item">
                                        </a>
                                    </td>
                                    <td class="product-name pl-2">
                                        <a href="{{route('product.detail',$cartItem['slug'])}}">{{ucfirst($product_name_with_choice)}}</a>
                                    </td>
                                    <td class="product-quantity"><span
                                            class="unit-amount">{{$cartItem['quantity']}}</span></td>
                                    <td class="product-price">
                                        <span
                                            class="unit-amount">{{Helper::currency_converter($cartItem['quantity']*$cartItem['price'])}}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

                <h6 class="title title-simple text-left">Your Order Summary</h6>
                <div class="row summary mb-4">
                    <div class="col-sm-12 text-left">
                        <div class="payment accordion radio-type mt-3">
                            <h6 class="summary-subtitle">Payment Methods</h6>
                            <ul class="payment-metho-radio d-flex">
                                <li>
                                    <div class="radio-item_1">
                                        <input id="cashOnDelivery" value="cod"
                                            name="payment_method" type="radio" checked>
                                        <label for="cashOnDelivery" class="radio-label_1">Cash on
                                            Delivery</label>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-12">
                        <ul class="total-summary-list">
                            @php
                                $subtotal=0;
                                $shipping_cost=0;
                                $coupon_discount=0
                            @endphp
                            @if(session()->has('cart') && count( session()->get('cart')) > 0)
                                @foreach(session('cart') as $key => $cartItem)
                                    @php($subtotal+=$cartItem['price']*$cartItem['quantity'])
                                    @php($shipping_cost+=$cartItem['shipping_cost'])
                                @endforeach
                            @endif
                            @if(session()->has('coupon_discount'))
                                @php($coupon_discount=session()->get('coupon_discount'))
                            @endif
                            <li class="subtotal">
                                <span class="key">SUBTOTAL ({{session()->has('cart') ?count(session('cart')) : 0}} ITEMS): </span>
                                <span class="value">{{Helper::currency_converter($subtotal)}}</span>
                            </li>

                            <li class="charges ">
                                <span class="key">Coupon Discount:</span>
                                <span class="value">{{Helper::currency_converter($coupon_discount)}}</span>
                            </li>


                            <li class="grand-total">
                                <span class="key">GRAND TOTAL:</span>
                                <span
                                    class="value">{{Helper::currency_converter($subtotal+$shipping_cost-$coupon_discount)}}</span>
                            </li>
                        </ul>
                    </div>


                </div>

                <p class="checkout-info">Your personal data will used to process your order, support
                    your experience throughout this website, and for other purposes described in our
                    privacy policy.</p>
                <button type="submit" class="my-3 default-btn primary-btn checkout-paypal-btn w-50">
                    Place Your <strong class="font-italic">Order</strong> <span
                        class="bx bx-right-arrow-alt float-right"></span>
                </button>

            </div>
        </aside>
    </div>
</form>
