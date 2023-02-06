<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'productId' => $this->id,
            'productName' => $this->title,
            'productUrl' => $this->slug,
            'summary' => $this->summary,
            'description' => $this->description,
            'specification' => $this->specification,
            'quantity' => $this->stock,
            'brand' => new BrandResource($this->brand),
            'category' => new CategoryResource($this->category),
            'photo' => $this->photo,
            'imagePath' => $this->image_path,
            'variants' => $this->variants,
            'variantsPath' => $this->variants_path,
            'price' => $this->price,
            'offerPrice' => $this->purchase_price,
            'discount' => $this->discount,
            'tag' => $this->tags,
            'isFeatured' => $this->is_featured,
            'todaysDeal' => $this->todays_deal,
            'status' => $this->status,
            'createdAt' => $this->created_at,
            'reviews' => ProductReviewResource::collection($this->reviews),
        ];
    }
}
