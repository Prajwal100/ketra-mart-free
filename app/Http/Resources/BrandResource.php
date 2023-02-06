<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'brandId'=>$this->id,
            'brandName'=>$this->title,
            'brandUrl'=>$this->slug,
            'photo'=>$this->photo,
            'imagePath'=>$this->image_path,
            'status'=>$this->status,
            'createdAt'=>$this->created_at,
        ];
    }
}
