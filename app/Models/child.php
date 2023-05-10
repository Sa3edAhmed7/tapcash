<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class child extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirm_password',
        'phone',
        'national_id',
        'city',
        'type',
        'gender',
        'age',
        'deposite',
        'purchases_limit',
        'money_limit',
        'account_number',
    ];

    protected $table='children';

}
