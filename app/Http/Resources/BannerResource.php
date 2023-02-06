<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'bannerId'=>$this->id,
            'bannerName'=>$this->title,
            'bannerUrl'=>$this->slug,
            'description'=>$this->description,
            'imagePath'=>$this->image_path,
            'photo'=>$this->photo,
            'status'=>$this->status,
            'position'=>$this->position,
            'innerPosition'=>$this->inner_position,
            'condition'=>$this->condition,
            'createdAt'=>$this->created_at
        ];
    }
}
