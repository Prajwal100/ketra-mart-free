<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'orderId'=>$this->id,
            'userId'=>$this->user_id,
            'orderNumber'=>$this->order_number,
            'subTotal'=>$this->sub_total,
            'totalAmount'=>$this->total_amount,
            'coupon'=>$this->coupon,
            'paymentMethod'=>$this->payment_method,
            'paymentStatus'=>$this->payment_status,
            'status'=>$this->condition,
            'deliveryCharge'=>$this->delivery_charge,
            'quantity'=>$this->quantity,
            'firstName'=>$this->first_name,
            'lastName'=>$this->last_name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'country'=>$this->country,
            'address'=>$this->address,
            'address2'=>$this->address2,
            'state'=>$this->state,
            'postCode'=>$this->postcode,
            'note'=>$this->note,
            'shippingFirstName'=>$this->sfirst_name,
            'shippingLastName'=>$this->slast_name,
            'shippingEmail'=>$this->semail,
            'shippingPhone'=>$this->sphone,
            'shippingCountry'=>$this->scountry,
            'shippingAddress'=>$this->saddress,
            'shippingAddress2'=>$this->saddress2,
            'shippingState'=>$this->sstate,
            'shippingPostCode'=>$this->spostcode,
        ];
    }
}
