<?php

namespace App;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection,WithHeadings,WithMapping
{
    public function collection()
    {
        return Order::all();
    }

    public function headings(): array
    {
        return [
            'order_id',
            'total_amount',
            'sub_total',
            'payment_method',
            'payment_status',
            'order_status',
            'delivery_charge',
            'quantity',
            'coupon',
            'customer_name',
            'email',
        ];
    }

    /**
     * @var Order $order
     */

    public function map($order): array
    {
        return[
            $order->order_number,
            $order->total_amount,
            $order->subtotal,
            $order->payment_method,
            $order->payment_status,
            $order->order_status,
            $order->delivery_charge,
            $order->quantity,
            $order->coupon,
            $order->first_name.' '.$order->last_name,
            $order->email,

        ];
    }
}
