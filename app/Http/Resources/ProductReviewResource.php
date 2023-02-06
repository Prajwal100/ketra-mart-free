<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductReviewResource extends JsonResource
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
            'reviewId'=>$this->id,
            'userId'=>$this->user_id,
            'productId'=>$this->product_id,
            'rate'=>$this->rate,
            'review'=>$this->review,
            'reason'=>$this->reason,
            'status'=>$this->status,
            'createdAt'=>$this->created_at
        ];
    }
}
