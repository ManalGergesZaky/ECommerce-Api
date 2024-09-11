<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'order';

    public function toArray($request)
    {
        return [
            "id"=> $this->id,
            "total_price"=> $this->total_price,
            // "order_date"=>$this->order_date->format('YYYY-MM-DD'),
            "order_date"=>$this->order_date,
            "paid"=>$this->paid,
            "status"=> $this->status,
            "user"=> new UserResource($this->user),
        ];
    }
}
