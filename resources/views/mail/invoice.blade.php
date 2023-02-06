<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta http-equiv="Content-Type" content="text/html;" />
    <meta charset="UTF-8">
    <style media="all">
        @font-face {
            font-family: 'Roboto';
            font-weight: normal;
            font-style: normal;
        }

        * {
            margin: 0;
            padding: 0;
            line-height: 1.3;
            font-family: 'Roboto';
            color: #333542;
        }

        body {
            font-size: .875rem;
        }

        .gry-color *,
        .gry-color {
            color: #878f9c;
        }

        table {
            width: 100%;
        }

        table th {
            font-weight: normal;
        }

        table.padding th {
            padding: .5rem .7rem;
        }

        table.padding td {
            padding: .7rem;
        }

        table.sm-padding td {
            padding: .2rem .7rem;
        }

        .border-bottom td,
        .border-bottom th {
            border-bottom: 1px solid #eceff4;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .small {
            font-size: .85rem;
        }

        .currency {}
    </style>
</head>

<body>
    <div>
        @php
            $logo = get_settings('logo');
        @endphp
        <div style="background: #eceff4;padding: 1.5rem;">
            <table>
                <tr>
                    <td>
                        @if ($logo != null)
                            <img loading="lazy" src="{{ asset($logo) }}" height="40" style="display:inline-block;">
                        @else
                            <img loading="lazy" src="{{ Helper::defaultLogo() }}" height="40"
                                style="display:inline-block;">
                        @endif
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="font-size: 1.2rem;" class="strong">{{ get_settings('site_title') }}</td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td class="gry-color small">{{ get_settings('address') }}</td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td class="gry-color small">Email: {{ get_settings('email') }}</td>
                    <td class="text-right small"><span class="gry-color small">Order ID:</span> <span
                            class="strong">{{ $order->order_number }}</span></td>
                </tr>
                <tr>
                    <td class="gry-color small">Phone: {{ get_settings('phone') }}</td>
                    <td class="text-right small"><span class="gry-color small">Order Date:</span> <span
                            class=" strong">{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</span>
                    </td>
                </tr>
            </table>

        </div>

        <div style="padding: 1.5rem;padding-bottom: 0">
            <table>
                <tr>
                    <td class="strong small gry-color">Bill to :</td>
                </tr>
                <tr>
                    <td class="strong">{{ $order->first_name }} {{ $order->last_name }}</td>
                </tr>
                <tr>
                    <td class="gry-color small">{{ $order->address }}, {{ $order->address2 }}, {{ $order->country }}
                    </td>
                </tr>
                <tr>
                    <td class="gry-color small">Email: {{ $order->email }}</td>
                </tr>
                <tr>
                    <td class="gry-color small">Phone: {{ $order->phone }}</td>
                </tr>
            </table>
        </div>

        <div style="padding: 1.5rem;">
            <table class="padding text-left small border-bottom">
                <thead>
                    <tr class="gry-color" style="background: #eceff4;">
                        <th width="35%">Product Name</th>
                        <th width="10%">Qty</th>
                        <th width="15%">Unit Price</th>
                        <th width="15%" class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="strong">
                    @foreach ($order->orderDetails as $key => $orderDetail)
                        @if ($orderDetail->product != null)
                            <tr class="">
                                <td>{{ ucfirst($orderDetail->product->title) }} @if ($orderDetail->variation != null)
                                        ({{ $orderDetail->variation }})
                                    @endif

                                </td>
                                <td class="gry-color">{{ $orderDetail->quantity }}</td>
                                <td class="gry-color currency">
                                    {{ Helper::currency_converter($orderDetail->price / $orderDetail->quantity) }}</td>
                                <td class="text-right currency">{{ Helper::currency_converter($orderDetail->price) }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="padding:0 1.5rem;">
            <table style="width: 40%;margin-left:auto;" class="text-right sm-padding small strong">
                <tbody>
                    <tr>
                        <th class="gry-color text-left">Sub Total</th>
                        <td class="currency">{{ Helper::currency_converter($order->orderDetails->sum('price')) }}</td>
                    </tr>
                    <tr>
                        <th class="gry-color text-left">Shipping Cost</th>
                        <td class="currency">{{ Helper::currency_converter($order->delivery_charge) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="gry-color text-left">Coupon</th>
                        <td class="currency">{{ Helper::currency_converter($order->coupon) }}</td>
                    </tr>
                    <tr>
                        <th class="text-left strong">Grand Total</th>
                        <td class="currency">{{ Helper::currency_converter($order->total_amount) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>
