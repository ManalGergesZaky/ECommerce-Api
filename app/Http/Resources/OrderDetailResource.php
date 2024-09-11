<?php

namespace App\Http\Resources;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'orderDetails';

    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'quantity'=> $this->quantity,
            'price_one_product'=> $this->price_for_one,
            'total_price'=>$this->total_price_for_product,
            'order'=>new OrderResource($this->order),
            'product'=>new ProductResource($this->product),

        ];
    }
}
