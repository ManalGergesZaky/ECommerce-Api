<?php

namespace App\Http\Resources;

use App\Http\Resources\CartResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'cartDetailes';

    public function toArray($request)
    {
        return [
            "id"=> $this->id,
            "quantity"=> $this->quantity,
            "cart"=> new CartResource($this->cart),
            // "cart"=> $this->cart,
            "product"=>new ProductResource( $this->product),
        ];
    }
}
