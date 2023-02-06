<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <style media="all">
        @page {
            margin: 0;
            padding:0;
        }
        body{
            font-size: 0.875rem;
            font-weight: normal;
            padding:0;
            margin:0;
        }
        .gry-color *,
        .gry-color{
            color:#878f9c;
        }
        table{
            width: 100%;
        }
        table th{
            font-weight: normal;
        }
        table.padding th{
            padding: .25rem .7rem;
        }
        table.padding td{
            padding: .25rem .7rem;
        }
        table.sm-padding td{
            padding: .1rem .7rem;
        }
        .border-bottom td,
        .border-bottom th{
            border-bottom:1px solid #eceff4;
        }
    </style>
</head>
<body>
<div>

    @php
        $logo = get_settings('logo');
    @endphp

    <div style="background: #eceff4;padding: 1rem;">
        <table>
            <tr>
                <td>
                    @if($logo != null)
                        <img src="{{ asset($logo) }}" height="30" style="display:inline-block;">
                    @else
                        <img src="{{ Helper::defaultLogo() }}" height="30" style="display:inline-block;">
                    @endif
                </td>
                <td style="font-size: 1.5rem;" class="text-right strong">INVOICE</td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="font-size: 1rem;" class="strong">{{ get_settings('site_title') }}</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="gry-color small">{{ get_settings('address') }}</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="gry-color small">Email: {{ get_settings('email') }}</td>
                <td class="text-right small"><span class="gry-color small">Order ID:</span> <span class="strong">{{ $order->order_number }}</span></td>
            </tr>
            <tr>
                <td class="gry-color small">Phone: {{ get_settings('phone') }}</td>
                <td class="text-right small"><span class="gry-color small">Order Date:</span> <span class=" strong">{{ \Illuminate\Support\Carbon::parse($order->created_at)->format('d-m-Y') }}</span></td>
            </tr>
        </table>

    </div>

    <div style="padding: 1rem;padding-bottom: 0">
        <table>
            <tr><td class="strong">{{ $order->first_name }} {{ $order->last_name }}</td></tr>
            <tr><td class="gry-color small">Email: {{ $order->email }}</td></tr>
            <tr><td class="gry-color small">Phone: {{ $order->phone }}</td></tr>
            <tr><td class="strong small gry-color">Bill to:</td></tr>
            <tr><td class="gry-color small">{{ $order->address }},{{ $order->address2 }} {{ $order->state }}-{{ $order->postcode }}, {{ $order->country }}</td></tr>
            <br>
            <tr><td class="strong small gry-color">Shipping to:</td></tr>
            <tr><td class="gry-color small">{{ $order->saddress }},{{ $order->saddress2 }} {{ $order->sstate }}-{{ $order->spostcode }}, {{ $order->scountry }}</td></tr>

        </table>
    </div>

    <div style="padding: 1rem;">
        <table class="padding text-left small border-bottom">
            <thead>
            <tr class="gry-color" style="background: #eceff4;">
                <th width="35%" class="text-left">Product</th>
                <th width="35%" class="text-left">Product Name</th>
                <th width="35%" class="text-left">Product Variation</th>
                <th width="10%" class="text-left">Qty</th>
                <th width="15%" class="text-left">Unit Price</th>
                <th width="15%" class="text-right">Total</th>
            </tr>
            </thead>
            <tbody class="strong">
            @foreach ($order->orderDetails as $key => $orderDetail)
                @if ($orderDetail->product != null)
                    <tr class="">
                        <td class="product-thumbnail">
                            <a href="{{route('product.detail',$orderDetail->product['slug'])}}">
                                <img style="border:1px solid #ddd; height: 4rem" src="{{asset($orderDetail->product->thumbnail_image)}}" alt="item">
                            </a>
                        </td>
                        <td>{{ $orderDetail->product->title }}
                        </td>
                        <td class="">{{ $orderDetail->variation }}</td>
                        <td class="">{{ $orderDetail->quantity }}</td>
                        <td class="text-right currency">{{Helper::currency_converter($orderDetail->price/$orderDetail->quantity)}}</td>
                     	<td class="text-right currency">{{Helper::currency_converter($orderDetail->price)}}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

    <div style="padding:0 1.5rem;">
        <table class="text-right sm-padding small strong">
            <thead>
            <tr>
                <th width="60%"></th>
                <th width="40%"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                </td>
                <td>
                    <table class="text-right sm-padding small strong">
                        <tbody>
                        <tr>
                            <th class="gry-color text-left">Sub Total</th>
                            <td class="currency">{{Helper::currency_converter($order->subtotal)}}</td>
                        </tr>
                        <tr>
                            <th class="gry-color text-left">Shipping Cost</th>
                            <td class="currency">{{Helper::currency_converter($order->delivery_charge)}}</td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="gry-color text-left">Coupon Discount</th>
                            <td class="currency">{{Helper::currency_converter($order->coupon)}}</td>
                        </tr>
                        <tr>
                            <th class="text-left strong">Grand Total</th>
                            <td class="currency">{{Helper::currency_converter($order->total_amount)}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
