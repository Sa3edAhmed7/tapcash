<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray( $request)
    {
        return  [

            'receive_account' => $this->receive_account,
            'process_name' => $this->process_name,
            'process_type' => $this->process_type,
        ];
    }
}
