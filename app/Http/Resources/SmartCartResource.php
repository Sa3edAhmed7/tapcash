<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SmartCartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return  [
            'user_id' => $this->user_id,
            'type' => $this->type,
            'Cart_number' => $this->Cart_number,
            'deposite' => $this->deposite,
            'money_limit' => $this->money_limit,
            'purchases_limit' => $this->purchases_limit,
        ];
    }
}
