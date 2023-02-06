<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'catId'=>$this->id,
            'catName'=>$this->title,
            'catUrl'=>$this->slug,
            'photo'=>$this->photo,
            'imagePath'=>$this->image_path,
            'isParent'=>$this->is_parent,
            'products'=>ProductResource::collection($this->whenLoaded('products')),
            'isFeatured'=>$this->is_featured,
            'summary'=>$this->summary,
            'parentId'=>$this->parent_id,
            'status'=>$this->status,
            'createdAt'=>$this->created_at
        ];
    }
}
