<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' =>$this->name,
            'email'=>$this->email,
            'password'=>$this->password,
            'confirm_password'=>$this->confirm_password,
            'phone'=>$this->phone,
            'national_id'=>$this->national_id,
            'city'=>$this->city,
            'type'=>$this->type,
            'gender'=>$this->gender,
            'age'=>$this->age,
            'deposite'=>$this->deposite,
            'purchases_limit'=>$this->purchases_limit,
            'money_limit'=>$this->money_limit,
            'account_number'=>$this->account_number,
        ];
    }
}
