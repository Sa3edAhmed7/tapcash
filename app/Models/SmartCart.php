<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmartCart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'Cart_number',
        'deposite',
        'purchases_limit',
        'expire_date',
        'money_limit',
    ];

    protected $table='smart_carts';

    // public function scopeExpired(Builder $query){
    //     return $query->where(DB::raw('expire_date + INTERVAL 1 DAY'), '<', Carbon::now()) ;
    // }
}
