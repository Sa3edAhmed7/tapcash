<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class related_accounts extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'child_id',
    ];

    protected $table='related_accounts';

    public function parent()
    {
        return $this->belongsTo(User::class,'parent_id');
    }
}
