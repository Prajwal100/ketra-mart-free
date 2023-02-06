@component('mail::message')
    Hi {{$order['first_name']}},<br>
@if($order->order_status=="process")
    We are pleased to share that the items from your order #{{$order['order_number']}} have been shippped.
@elseif($order->order_status=="delivered")
     We are pleased to inform that your order #{{$order['order_number']}} has been delivered.
@elseif($order->order_status=="cancelled")
    Sorry to be the bearer of bad news, but your order #{{$order['order_number']}} was cancelled.
@endif


@component('mail::button', ['url' => $url])
Back To Home
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
