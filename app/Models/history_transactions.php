<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history_transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_no',
        'process_type',
        'receive_account',
    ];

    protected $table='history_transactions';
}
