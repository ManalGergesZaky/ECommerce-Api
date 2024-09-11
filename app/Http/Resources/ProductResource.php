<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    
    public static $wrap = 'product';

    public function toArray($request)
    {
        
        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => doubleval($this->price),
            "image" => $this->image_path,
            "quantity" => $this->quantity,
            "category" => new  CategoryResource($this->category),
            
            
            // "category" => CategoryResource::collection($this->category),

        ];
    }
}
